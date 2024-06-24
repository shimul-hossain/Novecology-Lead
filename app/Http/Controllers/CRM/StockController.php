<?php

namespace App\Http\Controllers\CRM;

use App\Exports\StockInstallationExport;
use App\Http\Controllers\Controller;
use App\Models\CRM\Benefit;
use App\Models\CRM\Commande;
use App\Models\CRM\CommandeProduct;
use App\Models\CRM\DocumentControl;
use App\Models\CRM\Entrepot;
use App\Models\CRM\FournisseurMateriel;
use App\Models\CRM\Mouvement;
use App\Models\CRM\NatureMouvement;
use App\Models\CRM\NewProject;
use App\Models\CRM\Permission;
use App\Models\CRM\PersonnelAutoriseReception;
use App\Models\CRM\Product;
use App\Models\CRM\Role;
use App\Models\CRM\StatutCommande;
use App\Models\CRM\StockCommandeHeader;
use App\Models\CRM\StockCommandeHeaderFilter;
use App\Models\CRM\StockInstallation;
use App\Models\CRM\StockInstallationProduct;
use App\Models\CRM\StockMouvementHeader;
use App\Models\CRM\StockMouvementHeaderFilter;
use App\Models\CRM\StockMouvementProduct;
use App\Models\CRM\TypeDeLivraison;
use App\Models\StockActivityLog;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Permission::where('user_id', Auth::id())->where('name', 'stock.index')->exists() || role() == 's_admin') {
                return $next($request);
            } 
            return redirect()->route('permission.none');
        }); 
    }

     
    public function index(){ 
        $mouvement_entree = Mouvement::where('mouvement', 'Entrée')->pluck('id')->toArray();
        $mouvement_sortie = Mouvement::where('mouvement', 'Sortie')->pluck('id')->toArray();
        $products = Product::where('stock_status', 'yes')->latest()->get()->map(function ($product) use ($mouvement_entree, $mouvement_sortie) {
            return [
                'reference'            => $product->reference,
                'etat'                 => $product->mouvementProducts->whereIn('mouvement_id', $mouvement_entree)->sum('quantity') - $product->mouvementProducts->whereIn('mouvement_id', $mouvement_sortie)->sum('quantity'),
                'stock_minimum'        => $product->stock_minimum, 
                'stock_intermediate'   => $product->stock_intermediate,  
            ];
        })->toArray();
        usort($products, function($a, $b) {
            return $b['etat'] <=> $a['etat'];
        }); 
        
        return view('admin.stocks.index', compact('products'));
    }
    public function Mouvements(){
        if(!checkAction(Auth::id(), 'stocks', 'mouvements') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $roles = Role::whereIn('category_id', ['1,2'])->pluck('id')->toArray();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $roles)->get();
        // $projects = NewProject::where('deleted_status', 0)->get()->map(function ($project){
        //     return [
        //         'id'            => $project->id,
        //         'Nom'           => $project->Nom,
        //         'Prenom'        => $project->Prenom, 
        //         'Code_Postal'   => $project->Code_Postal, 
        //         'tag'           => $project->ProjectTravauxTags()->count() > 0 ? implode(',', $project->ProjectTravauxTags->pluck('tag')->toArray()) : '',
        //     ];
        // });
        $projects = NewProject::where('deleted_status', 0)->get();
        $products = Product::where('stock_status', 'yes')->latest()->get();
        $headers = StockMouvementHeader::all();
        $header_filter = Auth::user()->stockMouvementHeaderFilter;
        $types = NatureMouvement::all();
        $entrepots = Entrepot::all();
        $receptions = PersonnelAutoriseReception::all();
        $mouvements = Mouvement::latest()->get();
        return view('admin.stocks.mouvements', compact('users', 'projects', 'products', 'headers', 'header_filter', 'types', 'entrepots', 'receptions', 'mouvements'));
    }
    public function mouvementFilter(){
        if(!checkAction(Auth::id(), 'stocks', 'mouvements') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $roles = Role::whereIn('category_id', ['1,2'])->pluck('id')->toArray();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $roles)->get();
        $projects = NewProject::where('deleted_status', 0)->get();
        $products = Product::where('stock_status', 'yes')->latest()->get();
        $headers = StockMouvementHeader::all();
        $header_filter = Auth::user()->stockMouvementHeaderFilter;
        $types = NatureMouvement::all();
        $entrepots = Entrepot::all();
        $receptions = PersonnelAutoriseReception::all();
        $mouvement = Mouvement::query();

        if(request()->client){
            $mouvement->where('project_id', request()->client);
        }
        if(request()->produit){
            $mouvement->where('product_id', request()->produit);
        }
        if(request()->mouvement_){
            $mouvement->where('mouvement', request()->mouvement_);
        }
        if(request()->type){
            $mouvement->where('mouvement_id', request()->type);
        }
        if(request()->entrepot){
            $mouvement->where('entrepot_id', request()->entrepot);
        }
        if(request()->enlevement){
            $mouvement->where('user_id', request()->enlevement);
        }
        if(request()->from || request()->to){
            $mouvement->whereBetween('date', [request()->from ?? Carbon::today(), request()->to ?? Carbon::today()]);
        }
        if(request()->reception){
            $mouvement->where('personnel_autorise_id', request()->reception);
        }

        $mouvements = $mouvement->orderBy('created_at', 'desc')->get();

        return view('admin.stocks.mouvements', compact('users', 'projects', 'products', 'headers', 'header_filter', 'types', 'entrepots', 'receptions', 'mouvements'));
    }

    public function stockMouvementCreate(Request $request){
        $request->validate([
            // 'product_id' => 'required',
            'project_id' => 'required',
            // 'quantity' => 'required',
            'mouvement' => 'required',
            'date' => 'required',
            'mouvement_id' => 'required',
            'entrepot_id' => 'required',
            'user_id' => 'required', 
            'personnel_autorise_id' => 'required',
            'bon_de_livraison' => 'file',
        ]); 
        $mouvement = Mouvement::create($request->except(['_token', 'bon_de_livraison', 'product', 'quantity']));

        foreach($request->except(['_token', 'bon_de_livraison', 'product', 'quantity']) as $key => $value){
            StockActivityLog::create([
                'module' => 'mouvement',
                'key' => $key,
                'value' => $value,
                'feature_id' => $mouvement->id,
                'type' => 'create',
                'user_id' => Auth::id(),
            ]);
        }

        if($request->file('bon_de_livraison')){
            $path = public_path('uploads/stock');
            $file = $request->file('bon_de_livraison');
            $fileName = $mouvement->id.time().'-mouvement.'.$file->extension();
            $file->move($path, $fileName);
            $mouvement->bon_de_livraison = $fileName;
            $mouvement->save();
        }

        if($request->product){
            foreach($request->product as $key => $product_id){
                StockMouvementProduct::create([
                    'mouvement_id' => $mouvement->id,
                    'product_id' => $product_id,
                    'quantity' => $request->quantity[$key]
                ]);
            }
        }

        return back()->with('success', __('Created Successfully'));
    }
    public function stockMouvementUpdate(Request $request){
        $request->validate([
            // 'product_id' => 'required',
            'project_id' => 'required',
            // 'quantity' => 'required',
            'mouvement' => 'required',
            'date' => 'required',
            'mouvement_id' => 'required',
            'entrepot_id' => 'required',
            'user_id' => 'required', 
            'personnel_autorise_id' => 'required',
            'bon_de_livraison' => 'file',
        ]); 
        $mouvement = Mouvement::find($request->id); 
        $x_date = $mouvement->date;
        if(!$mouvement){
            return back();
        }
        $mouvement->update($request->except(['_token', 'id', 'bon_de_livraison', 'product', 'quantity']));

        foreach($mouvement->getChanges() as $key => $value){
            if($key != 'updated_at'){
                if($key == 'date'){
                    if($value && $x_date && Carbon::parse($value)->format('d-m-Y') == Carbon::parse($x_date)->format('d-m-Y')){
                        continue;
                    }
                }
                StockActivityLog::create([
                    'module' => 'mouvement',
                    'key' => $key,
                    'value' => $value,
                    'feature_id' => $mouvement->id,
                    'type' => 'update',
                    'user_id' => Auth::id(),
                ]);
            }
        }

        if($request->file('bon_de_livraison')){
            $path = public_path('uploads/stock');
            $file = $request->file('bon_de_livraison');
            $fileName = $mouvement->id.time().'-mouvement.'.$file->extension();
            $file->move($path, $fileName);
            $mouvement->bon_de_livraison = $fileName;
            $mouvement->save();
        }

        $mouvement_product_id_arr = [];
        if($request->product){
            foreach($request->product as $key => $product_id){
                list($situation, $position) = explode('--', $key);
                if($situation == 'n'){
                    $mouvement_product = StockMouvementProduct::create([
                        'mouvement_id' => $mouvement->id,
                        'product_id' => $product_id,
                        'quantity' => $request->quantity[$key]
                    ]);
                    $mouvement_product_id_arr[] = $mouvement_product->id;
                }else{
                    $mouvement_product = StockMouvementProduct::find($position);
                    if($mouvement_product){
                        $mouvement_product->update([
                            'product_id' => $product_id,
                            'quantity' => $request->quantity[$key]
                        ]); 
                    $mouvement_product_id_arr[] = $mouvement_product->id;
                    }
                }
            }
        } 

        StockMouvementProduct::where('mouvement_id', $mouvement->id)->whereNotIn('id', $mouvement_product_id_arr)->get()->each->delete();

        return back()->with('success', __('Updated Successfully'));
    }

    public function mouvementDelete(Request $request){
        $mouvement = Mouvement::find($request->id); 
        if(!$mouvement){
            return back();
        }
        $mouvement->delete();

        return redirect()->route('stock.mouvements')->with('success', __('Deleted Successfully'));
    }

    public function MouvementDetails($id){
        if(!checkAction(Auth::id(), 'stocks', 'mouvements') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $mouvement = Mouvement::find($id);
        if(!$mouvement){
            return back();
        }

        $roles = Role::whereIn('category_id', ['1,2'])->pluck('id')->toArray();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $roles)->get();
        $projects = NewProject::where('deleted_status', 0)->get();
        $products = Product::where('stock_status', 'yes')->latest()->get(); 
        $types = NatureMouvement::all();
        $entrepots = Entrepot::all();
        $receptions = PersonnelAutoriseReception::all();
        $activities = $mouvement->activities;

        return view('admin.stocks.mouvement-details', compact('mouvement','users', 'projects', 'products', 'types', 'entrepots', 'receptions', 'activities'));
    }

    public function stockMouvementPdf($id){
        if(!checkAction(Auth::id(), 'stocks', 'mouvements') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $mouvement = Mouvement::find($id);
        if(!$mouvement){
            return back();
        }
        return view('admin.stocks.mouvement-pdf', compact('mouvement'));
    }

    public function mouvementHeaderFilter(Request $request){

        StockMouvementHeaderFilter::where('user_id', Auth::id())->get()->each->delete(); 
            
        if($request->header_id){
            foreach($request->header_id as $id){
                StockMouvementHeaderFilter::create([
                    'header_id'         => $id,
                    'user_id'           => Auth::id(),
                ]);
            }
        }

        return back()->with('success', __('Filter Added'));
    }
    public function etatDesStocks(){ 
        if(!checkAction(Auth::id(), 'stocks', 'etat_des_stocks') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $mouvement_entree = Mouvement::where('mouvement', 'Entrée')->pluck('id')->toArray();
        $mouvement_sortie = Mouvement::where('mouvement', 'Sortie')->pluck('id')->toArray();

        $all_products = Product::where('stock_status', 'yes')->latest()->get();
        $products = Product::where('stock_status', 'yes')->latest()->get()->map(function ($product)  use ($mouvement_entree, $mouvement_sortie){
            return [
                'id'                   => $product->id,
                'reference'            => $product->reference,
                'entree'               => $product->mouvementProducts->whereIn('mouvement_id', $mouvement_entree)->sum('quantity'),
                'sortie'               => $product->mouvementProducts->whereIn('mouvement_id', $mouvement_sortie)->sum('quantity'),
                'etat'                 => $product->mouvementProducts->whereIn('mouvement_id', $mouvement_entree)->sum('quantity') - $product->mouvementProducts->whereIn('mouvement_id', $mouvement_sortie)->sum('quantity'),
            ];
        })->toArray();
        usort($products, function($a, $b) {
            return $b['etat'] <=> $a['etat'];
        }); 

        $entrepots = Entrepot::all();
        return view('admin.stocks.etat-des-stocks', compact('all_products', 'products', 'entrepots'));
    }
    public function etatDesStocksFilter(){ 
        if(!checkAction(Auth::id(), 'stocks', 'etat_des_stocks') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $all_products = Product::where('stock_status', 'yes')->latest()->get();
        
        $mouvement_entree = Mouvement::where('mouvement', 'Entrée')->pluck('id')->toArray();
        $mouvement_sortie = Mouvement::where('mouvement', 'Sortie')->pluck('id')->toArray();

        $entrepots = Entrepot::all();
        $product = Product::query();
        $entrepot_id = request()->entrepot_id;

        if(request()->product_id){
            $product->where('id', request()->product_id);
        }
        if($entrepot_id){  
            $product->whereHas('mouvements', function ($query) use($entrepot_id) {
                $query->where('entrepot_id', $entrepot_id);
            });

            $mouvement_entree = Mouvement::where('mouvement', 'Entrée')->where('entrepot_id', $entrepot_id)->pluck('id')->toArray();
            $mouvement_sortie = Mouvement::where('mouvement', 'Sortie')->where('entrepot_id', $entrepot_id)->pluck('id')->toArray();

            // $products = $product->where('stock_status', 'yes')->with('mouvement')->get()->map(function ($product) use ($entrepot_id){
            //     return [
            //         'id'                   => $product->id,
            //         'reference'            => $product->reference,
            //         'entree'               => $product->mouvement->where('mouvement', 'Entrée')->where('entrepot_id', $entrepot_id)->sum('quantity'),
            //         'sortie'               => $product->mouvement->where('mouvement', 'Sortie')->where('entrepot_id', $entrepot_id)->sum('quantity'),
            //         'etat'                 => $product->mouvement->where('mouvement', 'Entrée')->where('entrepot_id', $entrepot_id)->sum('quantity') - $product->mouvement->where('mouvement', 'Sortie')->where('entrepot_id', $entrepot_id)->sum('quantity'),
            //     ];
            // })->toArray();
            // usort($products, function($a, $b) {
            //     return $b['etat'] <=> $a['etat'];
            // });
        }

        $products = $product->where('stock_status', 'yes')->get()->map(function ($product) use ($mouvement_entree, $mouvement_sortie){
            return [
                'id'                   => $product->id,
                'reference'            => $product->reference,
                'entree'               => $product->mouvementProducts->whereIn('mouvement_id', $mouvement_entree)->sum('quantity'),
                'sortie'               => $product->mouvementProducts->whereIn('mouvement_id', $mouvement_sortie)->sum('quantity'),
                'etat'                 => $product->mouvementProducts->whereIn('mouvement_id', $mouvement_entree)->sum('quantity') - $product->mouvementProducts->whereIn('mouvement_id', $mouvement_sortie)->sum('quantity'),
            ];
        })->toArray();
        usort($products, function($a, $b) {
            return $b['etat'] <=> $a['etat'];
        });  

        // $products = $product->get();

        return view('admin.stocks.etat-des-stocks', compact('all_products', 'products', 'entrepots'));
    }
    public function etatDesStocksDetails($id){
        if(!checkAction(Auth::id(), 'stocks', 'etat_des_stocks') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $product = Product::find($id);
        if(!$product){
            return back();
        }
        $mouvements = $product->mouvements;
        return view('admin.stocks.etat-des-stocks-details', compact('mouvements', 'product'));
    }
    public function Commandes(){  
        if(!checkAction(Auth::id(), 'stocks', 'commandes') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $products = Product::where('stock_status', 'yes')->latest()->get();
        $statuts = StatutCommande::all();
        $fournisseurs = FournisseurMateriel::all();
        $livraisons = TypeDeLivraison::all();
        $receptions = PersonnelAutoriseReception::all();
        $commandes = Commande::latest()->get();
        return view('admin.stocks.commandes', compact('products', 'statuts', 'fournisseurs', 'livraisons', 'receptions', 'commandes'));
    }

    public function CommandesFilter(){ 
        if(!checkAction(Auth::id(), 'stocks', 'commandes') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $products = Product::where('stock_status', 'yes')->latest()->get();
        $statuts = StatutCommande::all();
        $fournisseurs = FournisseurMateriel::all();
        $livraisons = TypeDeLivraison::all();
        $receptions = PersonnelAutoriseReception::all();

        $commande = Commande::query();
        if(request()->fournisseur_){
            $commande->where('fournisseur_id', request()->fournisseur_);
        }
        if(request()->statut){
            $commande->where('statut_id', request()->statut);
        }
        if(request()->reference_commande){
            $commande->where('reference_commande', 'LIKE' ,'%'.request()->statut.'%');
        }
        if(request()->type_de_livraison){
            $commande->where('type_de_livraison_id', request()->type_de_livraison);
        }
        if(request()->enlevement_par){
            $commande->where('enlevement_par_id', request()->enlevement_par);
        }
        if(request()->recu_par){
            $commande->where('recu_par_id', request()->recu_par);
        }
        if(request()->from || request()->to){
            $commande->whereBetween('date', [request()->from ?? Carbon::today(), request()->to ?? Carbon::today()]);
        }

        $commandes = $commande->get();

        return view('admin.stocks.commandes', compact('products', 'statuts', 'fournisseurs', 'livraisons', 'receptions', 'commandes'));
    }

    public function commandeDetails($id){
        if(!checkAction(Auth::id(), 'stocks', 'commandes') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $commande = Commande::find($id);
        if(!$commande){
            return back();
        }
        $products = Product::where('stock_status', 'yes')->latest()->get();
        $statuts = StatutCommande::all();
        $fournisseurs = FournisseurMateriel::all();
        $livraisons = TypeDeLivraison::all();
        $receptions = PersonnelAutoriseReception::all(); 
        $activities = $commande->activities;
        return view('admin.stocks.commande-details', compact('commande',  'products', 'statuts', 'fournisseurs', 'livraisons', 'receptions', 'activities'));
    }

    public function commandeStatusChange(Request $request){
        $commande = Commande::find($request->id);
        if(!$commande){
            return back();
        } 
        $commande->update([
            'statut_id' => $request->statut_id
        ]);

        return back()->with('success', __("Updated Successfully"));
    }

    public function stockCommandePdf($id){
        if(!checkAction(Auth::id(), 'stocks', 'commandes') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $commande = Commande::find($id);
        if(!$commande){
            return back();
        }
        return view('admin.stocks.commande-pdf', compact('commande'));

    }

    public function commandeCreate(Request $request){
        $request->validate([
            'statut_id' => 'required',
            'date' => 'required',
            'fournisseur_id' => 'required',
            'bon_de_livraison' => 'file',
            'type_de_livraison_id' => 'required',
            'enlevement_par_id' => 'required',
            'recu_par_id' => 'required',
        ]);

        $commande = Commande::create([
            'statut_id' => $request->statut_id,            
            'date' => $request->date,            
            'reference_commande' => $request->reference_commande,            
            'fournisseur_id' => $request->fournisseur_id,             
            'type_de_livraison_id' => $request->type_de_livraison_id,            
            'enlevement_par_id' => $request->enlevement_par_id,            
            'recu_par_id' => $request->recu_par_id,            
            'observation' => $request->observation,            
        ]);

        foreach($request->only(['statut_id', 'date', 'reference_commande', 'fournisseur_id', 'type_de_livraison_id', 'enlevement_par_id', 'recu_par_id', 'observation']) as $key => $value){
            StockActivityLog::create([
                'module' => 'commande',
                'key' => $key,
                'value' => $value,
                'feature_id' => $commande->id,
                'type' => 'create',
                'user_id' => Auth::id(),
            ]);
        }

        if($request->file('bon_de_livraison')){
            $path = public_path('uploads/stock');
            $file = $request->file('bon_de_livraison');
            $fileName = $commande->id.time().'-commande.'.$file->extension();
            $file->move($path, $fileName);
            $commande->bon_de_livraison = $fileName;
            $commande->save();
        }

        try{
            if($request->product){
                foreach($request->product as $key => $product_id){
                    CommandeProduct::create([
                        'commande_id' => $commande->id,
                        'product_id' => $product_id,
                        'quantity' => $request->quantity[$key]
                    ]);
                }
            }
        }
        catch(Exception $e){
            return back()->with('error', __('Something went wrong'));
        }

        return back()->with('success', __('Created Successfully'));



    }
    public function commandeUpdate(Request $request){
        $request->validate([
            'statut_id' => 'required',
            'date' => 'required',
            'fournisseur_id' => 'required',
            'bon_de_livraison' => 'file',
            'type_de_livraison_id' => 'required',
            'enlevement_par_id' => 'required',
            'recu_par_id' => 'required',
        ]);
        $commande = Commande::find($request->id);
        $x_date = $commande->date;
        $commande->update([
            'statut_id' => $request->statut_id,            
            'date' => $request->date,            
            'reference_commande' => $request->reference_commande,            
            'fournisseur_id' => $request->fournisseur_id,             
            'type_de_livraison_id' => $request->type_de_livraison_id,            
            'enlevement_par_id' => $request->enlevement_par_id,            
            'recu_par_id' => $request->recu_par_id,            
            'observation' => $request->observation,            
        ]);

        foreach($commande->getChanges() as $key => $value){
            if($key != 'updated_at'){
                if($key == 'date'){
                    if($value && $x_date && Carbon::parse($value)->format('d-m-Y') == Carbon::parse($x_date)->format('d-m-Y')){
                        continue;
                    }
                }
                StockActivityLog::create([
                    'module' => 'commande',
                    'key' => $key,
                    'value' => $value,
                    'feature_id' => $commande->id,
                    'type' => 'update',
                    'user_id' => Auth::id(),
                ]);
            }
        }

        if($request->file('bon_de_livraison')){
            $path = public_path('uploads/stock');
            $file = $request->file('bon_de_livraison');
            $fileName = $commande->id.time().'-commande.'.$file->extension();
            $file->move($path, $fileName);
            $commande->bon_de_livraison = $fileName;
            $commande->save();
        }
        $commande_product_id_arr = [];
        if($request->product){
            foreach($request->product as $key => $product_id){
                list($situation, $position) = explode('--', $key);
                if($situation == 'n'){
                    $commande_product = CommandeProduct::create([
                        'commande_id' => $commande->id,
                        'product_id' => $product_id,
                        'quantity' => $request->quantity[$key]
                    ]);
                    $commande_product_id_arr[] = $commande_product->id;
                }else{
                    $commande_product = CommandeProduct::find($position);
                    if($commande_product){
                        $commande_product->update([
                            'product_id' => $product_id,
                            'quantity' => $request->quantity[$key]
                        ]); 
                    $commande_product_id_arr[] = $commande_product->id;
                    }
                }
            }
        } 

        CommandeProduct::where('commande_id', $commande->id)->whereNotIn('id', $commande_product_id_arr)->get()->each->delete();

        return back()->with('success', __('Updated Successfully'));

    }

    public function commandeDelete(Request $request){
        $commande = Commande::find($request->id);
        if(!$commande){
            return back();
        }
        $commande->delete();

        return redirect()->route('stock.commandes')->with('success', __('Deleted Successfully'));
    }

    public function commandeHeaderFilter(Request $request){
        StockCommandeHeaderFilter::where('user_id', Auth::id())->get()->each->delete(); 
            
        if($request->header_id){
            foreach($request->header_id as $id){
                StockCommandeHeaderFilter::create([
                    'header_id'         => $id,
                    'user_id'           => Auth::id(),
                ]);
            }
        }
        return back()->with('success', __('Filter Added'));
    }
    
    public function installations(){ 
        
        if(!checkAction(Auth::id(), 'stocks', 'installations') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }

        $products = Product::where('stock_status', 'yes')->latest()->get();
        $projects = NewProject::where('deleted_status', 0)->get();
        $roles = Role::where('category_id', 1)->pluck('id')->toArray();
        $authorize_role = Role::whereIn('category_id', ['3', '4'])->pluck('value')->toArray();
        if(in_array(role(), $authorize_role)){
            $installations = StockInstallation::orderBy('date', 'desc')->get();
            $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $roles)->get();

            $mouvements_users = Mouvement::where('mouvement_id', 2)->where('mouvement', 'Sortie')->pluck('user_id')->toArray();
            $installation_users = StockInstallation::pluck('installateur_id')->toArray();

            $vehicle_users = User::whereIn('id', array_merge($mouvements_users,$installation_users))->get();
        }else{
            $installations = Auth::user()->stockInstallations;
            $users = User::where('id', Auth::id())->get();
            $vehicle_users = User::where('id', Auth::id())->get();
        }

        $week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
        $week_end  = Carbon::now()->endOfWeek()->format('Y-m-d'); 

        return view('admin.stocks.installations', compact('products', 'projects', 'users', 'installations', 'vehicle_users', 'week_start', 'week_end'));
    }

    public function installationsFilter(){ 
        
        if(!checkAction(Auth::id(), 'stocks', 'installations') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        if(!checkAction(Auth::id(), 'stocks_installations', 'filter') && role() != 's_admin'){
            return redirect()->route('stock.installations');
        }

        $products = Product::where('stock_status', 'yes')->latest()->get();
        $projects = NewProject::where('deleted_status', 0)->get();
        $roles = Role::where('category_id', 1)->pluck('id')->toArray();
        $authorize_role = Role::whereIn('category_id', ['3', '4'])->pluck('value')->toArray();

        $installation = StockInstallation::query();

        
        $week_start = Carbon::now()->startOfWeek()->format('Y-m-d');
        $week_end  = Carbon::now()->endOfWeek()->format('Y-m-d'); 

        if(request()->intaller){
            $installation->where('installateur_id', request()->intaller);
        }
        if(request()->client){
            $installation->where('project_id', request()->client);
        }
        if(request()->material_installe){
            $installer_ids = StockInstallationProduct::where('product_id', request()->material_installe)->pluck('installation_id')->toArray();
            $installation->whereIn('id', $installer_ids);
        }

        if(request()->custom_filter_date){
            $week_start = Carbon::parse(request()->custom_filter_date)->startOfWeek()->format('Y-m-d');
            $week_end  = Carbon::parse(request()->custom_filter_date)->endOfWeek()->format('Y-m-d');  
            $installation->whereBetween('date', [$week_start, $week_end]); 
        }



        if(in_array(role(), $authorize_role)){
            $installations = $installation->orderBy('date', 'desc')->get();
            $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $roles)->get();

            $mouvements_users = Mouvement::where('mouvement_id', 2)->where('mouvement', 'Sortie')->pluck('user_id')->toArray();
            $installation_users = StockInstallation::pluck('installateur_id')->toArray();

            $vehicle_users = User::whereIn('id', array_merge($mouvements_users,$installation_users))->get();
        }else{
            $installations = $installation->where('installateur_id', Auth::id())->orderBy('date', 'desc')->get();
            $users = User::where('id', Auth::id())->get();
            $vehicle_users = User::where('id', Auth::id())->get();
        } 

        return view('admin.stocks.installations', compact('products', 'projects', 'users', 'installations', 'vehicle_users', 'week_start', 'week_end'));
    }

    public function installationsExport(Request $request){
        if(!checkAction(Auth::id(), 'stocks_installations', 'export') && role() != 's_admin'){
            return back();
        }

        $header = ['date', 'Installateur', 'Client', 'Matériel Installé', 'Quantité', 'Observations'];

        $installation = StockInstallation::query();

        if($request->installateur_id){
            $installation->where('installateur_id', $request->installateur_id);
        }
        if($request->project_id){
            $installation->where('project_id', $request->project_id);
        }
        if($request->product_id){
            $installer_ids = StockInstallationProduct::where('product_id', $request->product_id)->pluck('installation_id')->toArray();
            $installation->whereIn('id', $installer_ids);
        }

        if($request->from || $request->to){
            $from = $request->from ?? Carbon::today()->format('Y-m-d');
            $to  = $request->to ?? Carbon::today()->format('Y-m-d');  
            $installation->whereBetween('date', [$from, $to]); 
        }
         
        $data = [];
        foreach($installation->orderBy('date', 'desc')->get() as $installation){
            foreach($installation->products as $key => $product){
                if($key == 0){
                    $field['date'] = Carbon::parse($installation->date)->format('d-m-Y');
                    $field['Installateur'] = $installation->installer->name ?? '';
                    $field['Client'] = $installation->project->Prenom.' '.$installation->project->Nom;
                    $field['Matériel Installé'] = $product->product->reference ?? '';
                    $field['Quantité'] = $product->quantity ?? '';
                    $field['Observations'] = $installation->observation;
                }else{
                    $field['date'] = '---';
                    $field['Installateur'] = '---';
                    $field['Client'] = '---';
                    $field['Matériel Installé'] = $product->product->reference ?? '';
                    $field['Quantité'] = $product->quantity ?? '';
                    $field['Observations'] = '---';
                }
                $data[] = $field;
            }
        } 


        return Excel::download(new StockInstallationExport($header,collect($data)), 'stock_installation.xlsx');
    }

    public function installationDetails($id){
        if(!checkAction(Auth::id(), 'stocks', 'installations') && role() != 's_admin'){
            return redirect()->route('stock.index');
        }
        $installation = StockInstallation::find($id);
        if(!$installation){
            return back()->with('error', __("Something went wrong"));
        } 

        $roles = Role::where('category_id', 1)->pluck('id')->toArray();
        $users = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', $roles)->get();

        $authorize_role = Role::whereIn('category_id', ['3', '4'])->pluck('value')->toArray();
        if(!in_array(role(), $authorize_role)){
            if($installation->installateur_id != Auth::id()){
                return redirect()->route('stock.installations');
            } 
            $users = User::where('id', Auth::id())->get();
        } 

        $products = Product::where('stock_status', 'yes')->latest()->get();
        $projects = NewProject::where('deleted_status', 0)->get();
        
        $activities = $installation->activities;

        return view('admin.stocks.installation-details', compact('products', 'projects', 'users', 'installation', 'activities'));


    }

    public function installationCreate(Request $request){
        $request->validate([
            'date' => 'required',
            'project_id' => 'required',
            'installateur_id' => 'required',
        ]);

        $installation = StockInstallation::create([
            'date' => $request->date,
            'project_id' => $request->project_id,
            'installateur_id' => $request->installateur_id,
            'user_id' => Auth::id(),
            'observation' => $request->observation,
        ]);

        
        foreach($request->only(['project_id', 'date', 'installateur_id', 'user_id', 'observation']) as $key => $value){
            StockActivityLog::create([
                'module' => 'installation',
                'key' => $key,
                'value' => $value,
                'feature_id' => $installation->id,
                'type' => 'create',
                'user_id' => Auth::id(),
            ]);
        }

        try{
            if($request->product){
                foreach($request->product as $key => $product_id){
                    StockInstallationProduct::create([
                        'installation_id' => $installation->id,
                        'product_id' => $product_id,
                        'quantity' => $request->quantity[$key]
                    ]);
                }
            }
        }
        catch(Exception $e){
            return back()->with('error', __('Something went wrong'));
        }

        return back()->with('success', __('Created Successfully'));
    }

    public function installationUpdate(Request $request){
        $request->validate([
            'date' => 'required',
            'project_id' => 'required',
            'installateur_id' => 'required',
        ]);

        $installation = StockInstallation::find($request->id);
        $x_date = $installation->date;
        $installation->update([
            'date' => $request->date,
            'project_id' => $request->project_id,
            'installateur_id' => $request->installateur_id,
            'observation' => $request->observation,
        ]);

        foreach($installation->getChanges() as $key => $value){
            if($key != 'updated_at'){
                if($key == 'date'){
                    if($value && $x_date && Carbon::parse($value)->format('d-m-Y') == Carbon::parse($x_date)->format('d-m-Y')){
                        continue;
                    }
                }
                StockActivityLog::create([
                    'module' => 'installation',
                    'key' => $key,
                    'value' => $value,
                    'feature_id' => $installation->id,
                    'type' => 'update',
                    'user_id' => Auth::id(),
                ]);
            }
        }

        
        $installation_product_id_arr = [];
        if($request->product){
            foreach($request->product as $key => $product_id){

                list($situation, $position) = explode('--', $key);
                if($situation == 'n'){
                   $installation_product = StockInstallationProduct::create([
                        'installation_id' => $installation->id,
                        'product_id' => $product_id,
                        'quantity' => $request->quantity[$key]
                    ]);
                    $installation_product_id_arr[] = $installation_product->id;
                }else{
                    $installation_product = StockInstallationProduct::find($position);
                    if($installation_product){
                        $installation_product->update([
                            'product_id' => $product_id,
                            'quantity' => $request->quantity[$key]
                        ]); 
                        $installation_product_id_arr[] = $installation_product->id;
                    }
                }
            }
        }

        StockInstallationProduct::where('installation_id', $installation->id)->whereNotIn('id', $installation_product_id_arr)->get()->each->delete();
       
        return back()->with('success', __('Updated Successfully'));
    }

    public function installationDelete(Request $request){
        $installation = StockInstallation::find($request->id);
        if(!$installation){
            return back();
        } 
        $installation->delete();

        return redirect()->route('stock.installations')->with('success', __('Deleted Successfully'));
    }

    public function logDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $log = StockActivityLog::find($request->id);
        if($log){
            $log->delete();
        }

        return back()->with('success', 'Deleted Successfully');
    }
}
