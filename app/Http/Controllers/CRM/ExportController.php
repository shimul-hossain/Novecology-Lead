<?php

namespace App\Http\Controllers\CRM;

use App\Exports\Export;
use App\Exports\RingoverExport;
use Illuminate\Http\Request;
use App\Models\CRM\LeadHeader;
use App\Models\CRM\Permission;
use App\Http\Controllers\Controller;
use App\Models\CRM\ClientSubStatus;
use App\Models\CRM\DocumentControl;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\LeadStatus;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\ProjectHeader;
use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\ProjectSubStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Permission::where('user_id', Auth::id())->where('name', 'export.index')->exists() || role() == 's_admin') {
                return $next($request);
            } 
            return redirect()->route('permission.none');
        })->only(['index', 'export']);
    }
     

    public function index(){
        $statuses       = LeadStatus::all();
        $sub_statuses   = LeadSubStatus::orderBy('order','asc')->get();
        $headers        = LeadHeader::all();

        return view('admin.export', compact('statuses', 'sub_statuses', 'headers'));
    }
    public function exportLite(){       
        $statuses = LeadStatus::all(); 
        $sub_statuses = LeadSubStatus::all();  
        if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
            // $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
            $stats_regies = Auth::user()->allRegie; 
            $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->get();
        }else{
            $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->get();
        }

        return view('admin.export-lite', compact('statuses', 'sub_statuses', 'telecommercials'));
    }

    public function categoryChange(Request $request){
        $headers = LeadHeader::all();
        if($request->value == 'prospect'){
            $statuses = LeadStatus::all();
            $status_data = view('admin.status_select_option', compact('statuses'))->render();
            $header_field = view('admin.lead_export_header', compact('headers'))->render();

        }elseif($request->value == 'client'){
            $status_data = '<option value="">Etiquette</option>';
            $header_field = view('admin.client_export_header', compact('headers'))->render();
            
        }elseif($request->value == 'chantier'){
            $headers = ProjectHeader::all(); 
            $document_controls = DocumentControl::orderBy('order', 'asc')->get();
            $statuses = ProjectNewStatus::orderBy('order', 'asc')->get();
            $status_data = view('admin.status_select_option', compact('statuses'))->render();
            $header_field = view('admin.project_export_header', compact('headers', 'document_controls'))->render();

        }else{
            return response('something is wrong');
        }
        return response()->json(['status' => $status_data, 'header_field' => $header_field]);
    }

    public function exportLabelChange(Request $request){
        $single_select = true;
        if($request->category == 'prospect'){
            $label = LeadStatus::find($request->label);
            if($label){
                $sub_statuses = $label->getSubStatus;
                $sub_status_data = view('admin.sub_status_select_option', compact('sub_statuses', 'single_select'))->render();
            }else{
                $sub_status_data = '';
            }
        }elseif($request->category == 'client'){
            $sub_status_data = '';
        }elseif($request->category == 'chantier'){
            $label = ProjectNewStatus::find($request->label);
            if($label){
                $sub_statuses = $label->getSubStatus;
                $sub_status_data = view('admin.sub_status_select_option', compact('sub_statuses', 'single_select'))->render();
            }else{
                $sub_status_data = '';
            }
        }else{
            return response('something is wrong');
        }
        return response()->json(['sub_status' => $sub_status_data]);
    }

    public function export(Request $request){
        // dd($request->all());
        if($request->submit_btn == 'ringover'){
            if($request->type == 'prospect'){
                $leads = LeadClientProject::query(); 
                if($request->label){
                    $leads->where('lead_label', $request->label);
                }
                if($request->status){
                    $leads->where('sub_status', $request->status);
                }
    
                $data = $leads->where('lead_deleted_status', 0)->get()->map(function($item){  
                    return [
                        'N° Mobile' => $item->phone,
                        'Prenom' => $item->Prenom,
                        'Nom' => $item->Nom,
                    ]; 
                }); 
            }elseif($request->type == 'client'){
                $clients = NewClient::query();
                // if($request->status){
                //     $clients->where('sub_status', $request->status);
                // }
                $data = $clients->where('deleted_status', 0)->get()->map(function($item){  
                    return [
                        'N° Mobile' => $item->phone,
                        'Prenom' => $item->Prenom,
                        'Nom' => $item->Nom,
                    ]; 
                });
            }else{
    
                $projects = NewProject::query();
    
                if($request->label){
                    $projects->where('project_label', $request->label);
                }
                if($request->status){
                    $projects->where('project_sub_status', $request->status);
                }
    
                $data = $projects->where('deleted_status', 0)->get()->map(function($item){  
                    return [
                        'N° Mobile' => $item->phone,
                        'Prenom' => $item->Prenom,
                        'Nom' => $item->Nom,
                    ]; 
                });
            } 
            return Excel::download(new RingoverExport($data), $request->type.'.csv');
            
        }else{
            if(!$request->selected_header && !$request->selected_intervention_header && !$request->selected_suivi_facturation_header && !$request->selected_gestion_header){
                return back()->with('error', "Le champ d'en-tête est obligatoire");
            }
            // dd($request->all());
            // dd(array_keys($request->selected_header)); 
            $header = array_keys($request->selected_header ?? []);

            $intervention_header = ['type' => 'Intervention', 
                                    'Date_intervention' => 'Date intervention', 
                                    'Horaire_intervention' => 'Horaire intervention', 
                                    'Statut_planning' => 'Statut Planning', 
                                    'Installateur_technique' => 'Installateur technique', 
                                    'Prévisiteur_TechnicohyphenCommercial' => 'Prévisiteur Technico-Commercial', 
                                    'Contre_prévisiteur' => 'Contre prévisiteur', 
                                    'Chargé_dapostropheétude' => 'Chargé d’étude', 
                                    'Technicien_SAV' => 'Technicien SAV', 
                                    'Technicien' => 'Technicien', 
                                    'Réfèrent_technique' => 'Referent téchnique', 
                                    'Faisabilité_du_chantier' => 'Faisabilité du chantier', 
                                    'Validation_referent_technique' => 'Validation referent technique', 
                                    'Statut_contrat' => 'Statut contrat', 
                                    'Dossier_administratif_complet' => 'Dossier administratif complet', 
                                    'Travaux_supplémentaires' => 'Travaux supplémentaires', 
                                    'Statut_Installation' => 'Statut Installation', 
                                    'Statut_SAV' => 'Statut SAV', 
                                    'Précisions_déplacement' => 'Précisions déplacement', 
                                    'Observations' => 'Observations'];
            
            $suivi_facturation_header = [
                                            'type' => 'Encaissement',
                                            'Statut_règlement' => 'Statut réglement',
                                            'Montant' => 'Montant',
                                            'Observations' => 'Observations',
                                        ];
            $gestion_header = [
                                'type' => 'Paiement',
                                'Statut_facture' => 'Statut facture',
                                'Numéro_de_facture' => 'Numéro de facture',
                                'Montant_HT' => 'Montant HT',
                                'Montant_TTC' => 'Montant TTC',
                                'Observations' => 'Observations',
                            ];

            if($request->selected_intervention_header){
                foreach ($request->selected_intervention_header as $i_header){
                    foreach($intervention_header as $item){
                        $header[] = $item. ' '.$i_header;
                    }
                }
            } 
            if($request->selected_suivi_facturation_header){
                foreach ($request->selected_suivi_facturation_header as $s_header){
                    foreach($suivi_facturation_header as $item){
                        $header[] = $item. ' '.$s_header;
                    }
                }
            } 
            if($request->selected_gestion_header){
                foreach ($request->selected_gestion_header as $g_header){
                    foreach($gestion_header as $item){
                        $header[] = $item. ' '.$g_header;
                    }
                }
            } 
            
            if($request->type == 'prospect'){
                $leads = LeadClientProject::query(); 
                if($request->label){
                    $leads->where('lead_label', $request->label);
                }
                if($request->status){
                    $leads->where('sub_status', $request->status);
                }
    
                $data = $leads->where('lead_deleted_status', 0)->get()->map(function($item) use ($request) {  
                    foreach($request->selected_header as $key => $value){
                        switch ($value) {
                            case '__tracking__Fournisseur_de_lead':
                                $field[$key] = $item->getSupplier->suplier ?? '';
                                break;
    
                            case '__tracking__Département':
                                $field[$key] = getDepartment2($item->__tracking__Code_postal);
                                break;
                            case 'Département':
                                $field[$key] = getDepartment2($item->Code_Postal);
                                break;
                            case 'Barème':
                                $field[$key] = $item->LeadBareme->count() > 0 ? implode(',', $item->LeadBareme()->pluck('bareme')->toArray()) : '';
                                break;
                            case 'Travaux':
                                $field[$key] = $item->LeadTravax->count() > 0 ? implode(',', $item->LeadTravax()->pluck('travaux')->toArray()) : '';
                                break;
                            case 'Statut':
                                $field[$key] = $item->getSubStatus->name ?? '';
                                break;
                            case 'Etiquette':
                                $field[$key] = $item->getStatus->status ?? '';
                                break;
                            case 'Telecommercial':
                                $field[$key] = $item->leadTelecommercial->name ?? '';
                                break;
                            case 'Regie':
                                $field[$key] = $item->lead_label == 1 ? ($item->getRegie->name ?? '') : ($item->leadTelecommercial ? $item->leadTelecommercial->getRegie->name ?? '' : '');
                                break;
                            case 'Responsable_commercial':
                                $field[$key] = $item->leadTelecommercial ? ($item->leadTelecommercial->getRegie ? $item->leadTelecommercial->getRegie->getUser->name ?? '': '') : '';
                                break;
                            case 'Audience':
                                $field[$key] = getCustomFieldData('audience', $item->lead_tracking_custom_field_data);
                                break;
                            case 'Age_du_bâtiment':
                                $field[$key] = $item->Age_du_bâtiment == 'Oui' ? 'Plus de 15 ans' : ($item->Age_du_bâtiment == 'Non' ? 'plus de 2 ans et moins de 15 ans' : $item->Age_du_bâtiment);
                                break;
                            default:
                                $field[$key] = $item->$value;
                                break;
                        } 
                    }
                    return $field;
                });
            }elseif($request->type == 'client'){
                $clients = NewClient::query();
                // if($request->status){
                //     $clients->where('sub_status', $request->status);
                // }
                $data = $clients->where('deleted_status', 0)->get()->map(function($item) use ($request) {  
                    foreach($request->selected_header as $key => $value){
                        switch ($value) {
                            case '__tracking__Fournisseur_de_lead':
                                $field[$key] = $item->getSupplier->suplier ?? '';
                                break;
                            case '__tracking__Département':
                                $field[$key] = getDepartment2($item->__tracking__Code_postal);
                                break;
                            case 'Département':
                                $field[$key] = getDepartment2($item->Code_Postal);
                                break;
                            case 'Audience':
                                $field[$key] = getCustomFieldData('audience', $item->lead_tracking_custom_field_data);
                                break;
                            case 'Age_du_bâtiment':
                                $field[$key] = $item->Age_du_bâtiment == 'Oui' ? 'Plus de 15 ans' : ($item->Age_du_bâtiment == 'Non' ? 'plus de 2 ans et moins de 15 ans' : $item->Age_du_bâtiment);
                                break;
                            default:
                                $field[$key] = $item->$value;
                                break;
                        } 
                    }
                    return $field;
                });
            }else{
    
                $projects = NewProject::query();
    
                if($request->label){
                    $projects->where('project_label', $request->label);
                }
                if($request->status){
                    $projects->where('project_sub_status', $request->status);
                }
    
                $data = $projects->where('deleted_status', 0)->with('getInterventionWithNoOrder')->get()->map(function($item) use ($request, $intervention_header, $suivi_facturation_header, $gestion_header) {  
                    $field =[];
                    if($request->selected_header){
                        foreach($request->selected_header as $key => $value){
                            $explode = explode('___', $value);
                            if($explode[0] == 'controle'){
                                if($item->projectDocumentControl()->where('document_id', $explode[1])->exists()){
                                    if($explode[2] == 'le'){
                                        $field[$key] = $item->projectDocumentControl()->where('document_id', $explode[1])->first()->Réceptionné_le;
                                    }else{
                                        $field[$key] = $item->projectDocumentControl()->where('document_id', $explode[1])->first()->Réceptionné_par ? User::find($item->projectDocumentControl()->where('document_id', $explode[1])->first()->Réceptionné_par)->name :'';
                                    }
                                }else{
                                    $field[$key] = '';
                                }
                            }else if($value == 'banque_id' || $value == 'banque_montant' || $value == 'date_depot' || $value == 'banque_numero_de_dossier' || $value == 'banque_status' || $value == 'Préciser_pièces_manquantes' || $value == 'Statut_accord_banque' || $value == 'Montant_crédit_accepté' || $value == 'Date_de_notification_accord' || $value == 'Raison_refus_du_crédit'){
                                $banque = $item->getDepot->first();
                                if($banque){
                                    if($value == 'banque_id'){
                                        $field[$key] = $banque->banque->name ?? '';
                                    }else{
                                        $field[$key] = $banque->$value ?? '';
                                    }
                                }else{
                                    $field[$key] = '';
                                }
                            }else if($value == 'audit_type' || $value == 'study_office' || $value == 'audit_status' || $value == 'audit_user' || $value == 'release_date' || $value == 'report_result' || $value == 'Audit_envoyé_le' || $value == 'Audit_reçu_le' || $value == 'Scénario_choisi' || $value == 'Travaux_du_scénario_choisi'|| $value == 'report_reference' || $value == 'auditObservations'){
                                $audit = $item->getAudit->first();
                                if($audit){
                                    if($value == 'study_office'){
                                        $field[$key] = $audit->office->name ?? '';
                                    }else if($value == 'audit_status'){
                                        $field[$key] = $audit->getStatus->name ?? '';
                                    }else if($value == 'audit_user'){
                                        $field[$key] = $field[$key] = $audit->audit_user ? User::find($audit->audit_user)->name :'';
                                    }else if($value == 'report_result'){
                                        $field[$key] = $audit->getResult->name ?? '';
                                    }else if($value == 'Travaux_du_scénario_choisi'){
                                        $travaux_list = '';
                                        foreach($audit->getTravaux as $key => $travaux){
                                            $travaux_list .= ($travaux->travaux . ($key+1 == $audit->getTravaux->count() ? '':', '));
                                        }
                                        $field[$key] = $travaux_list;
                                    }else if($value == 'auditObservations'){
                                        $field[$key] = $audit->Observations ?? '';
                                    }else{
                                        $field[$key] = $audit->$value ?? '';
                                    }
                                }else{
                                    $field[$key] = '';
                                }
                            }else if($value == 'Mairie' || $value == 'Statut_demande' || $value == 'Date_de_réception_de_l_accord_de_mairie' || $value == 'Date_de_dépôt2' || $value == 'Demande_de_travaux' || $value == 'Réception_du_récépissé_de_dépôt' || $value == 'Date_de_réception_de_récépissé_de_mairie' || $value == 'MairieObservations'){
                                $demande = $item->getDemandes->first();
                                if($demande){
                                    if($value == 'Demande_de_travaux'){
                                        $field[$key] = $demande->getTravaux->travaux ?? ''; 
                                    }else if($value == 'Date_de_dépôt2'){
                                        $field[$key] = $demande->Date_de_dépôt ?? '';
                                    }else if($value == 'MairieObservations'){
                                        $field[$key] = $demande->Observations ?? '';
                                    }else{
                                        $field[$key] = $demande->$value ?? '';
                                    }
                                }else{
                                    $field[$key] = '';
                                }
                            }else{
                                switch ($value) {
                                    case '__tracking__Fournisseur_de_lead':
                                        $field[$key] = $item->getSupplier->suplier ?? '';
                                        break;
                                    case '__tracking__Département':
                                        $field[$key] = getDepartment2($item->__tracking__Code_postal);
                                        break;
                                    case 'Département':
                                        $field[$key] = getDepartment2($item->Code_Postal);
                                        break;
                                    case 'Barème':
                                        $field[$key] = $item->ProjectBareme->count() > 0 ? implode(',', $item->ProjectBareme()->pluck('bareme')->toArray()) : '';
                                        break;
                                    case 'Travaux':
                                        $field[$key] = $item->ProjectTravaux->count() > 0 ? implode(',', $item->ProjectTravaux()->pluck('travaux')->toArray()) : '';
                                        break;
                                    case 'Compte_crée_par':
                                        $field[$key] = $item->Compte_crée_par ? User::find($item->Compte_crée_par)->name :'';
                                        break;
                                    case 'Compte_Email_de_récupération_crée_par':
                                        $field[$key] = $item->Compte_Email_de_récupération_crée_par ? User::find($item->Compte_Email_de_récupération_crée_par)->name :'';
                                        break;
                                    case 'Compte_MaPrimeRenov_Compte_crée_par':
                                        $field[$key] = $item->Compte_MaPrimeRenov_Compte_crée_par ? User::find($item->Compte_MaPrimeRenov_Compte_crée_par)->name :'';
                                        break; 
                                    case 'Statut':
                                        $field[$key] = $item->getSubStatus->name ?? '';
                                        break;
                                    case 'Etiquette':
                                        $field[$key] = $item->projectStatus->status ?? '';
                                        break;
                                    case 'Telecommercial':
                                        $field[$key] = $item->getProjectTelecommercial->name ?? '';
                                        break;
                                    case 'Regie':
                                        $field[$key] = $item->getProjectTelecommercial ? $item->getProjectTelecommercial->getRegie->name ?? '' : '';
                                        break;
                                    case 'Responsable_commercial':
                                        $field[$key] = $item->getProjectTelecommercial ? ($item->getProjectTelecommercial->getRegie ? $item->getProjectTelecommercial->getRegie->getUser->name ?? '': '') : '';
                                        break;
                                    case 'Audience':
                                        $field[$key] = getCustomFieldData('audience', $item->lead_tracking_custom_field_data);
                                        break;
                                    case 'Age_du_bâtiment':
                                        $field[$key] = $item->Age_du_bâtiment == 'Oui' ? 'Plus de 15 ans' : ($item->Age_du_bâtiment == 'Non' ? 'plus de 2 ans et moins de 15 ans' : $item->Age_du_bâtiment);
                                        break;
                                    default:
                                        $field[$key] = $item->$value;
                                        break;
                                } 
                            }
                        }
                    }
                    if($request->selected_intervention_header){
                        foreach($request->selected_intervention_header as $int_header){
                            if($item->getInterventionWithNoOrder->take($int_header)->count() == $int_header){
                                $intervention = $item->getInterventionWithNoOrder->take($int_header)->last(); 
                                foreach ($intervention_header as $key => $inter_header){
                                    if($key == 'Installateur_technique' || $key == 'Prévisiteur_TechnicohyphenCommercial' || $key == 'Contre_prévisiteur' || $key == 'Chargé_dapostropheétude' || $key == 'Technicien_SAV' || $key == 'Technicien'){
                                        if(($key == 'Installateur_technique' && $intervention->type == 'Installation') || ($key == 'Prévisiteur_TechnicohyphenCommercial' && ($intervention->type == 'Pré-Visite Technico-Commercial' || $intervention->type == 'DPE')) || ($key == 'Contre_prévisiteur' && $intervention->type == 'Contre Visite Technique') || ($key == 'Chargé_dapostropheétude' && $intervention->type == 'Etude') || ($key == 'Technicien_SAV' && $intervention->type == 'SAV') || ($key == 'Technicien' && ($intervention->type == 'Déplacement' || $intervention->type == 'Prévisite virtuelle'))){
                                            $field[$inter_header .' '.$int_header] = $intervention->getUser->name ?? '';
                                        }else{
                                            $field[$inter_header .' '.$int_header] = '';
                                        }
                                    }elseif($key == 'Réfèrent_technique'){
                                        $field[$inter_header .' '.$int_header] = $intervention->technicalRefree->name ?? '';
                                    }elseif($key == 'Dossier_administratif_complet'){
                                        $field[$inter_header .' '.$int_header] = ($intervention->Dossier_administratif_complet == 'yes' ? 'Oui':($intervention->Dossier_administratif_complet == 'no' ? 'Non':''));
                                    }else{
                                        $field[$inter_header .' '.$int_header] = $intervention->$key;
                                    }
                                }
                            } 
                        }
                    }
                    if($request->selected_suivi_facturation_header){
                        foreach($request->selected_suivi_facturation_header as $suivi_header){
                            if($item->getFacturationWithNoOrder->take($suivi_header)->count() == $suivi_header){
                                $facturation = $item->getFacturationWithNoOrder->take($suivi_header)->last(); 
                                foreach ($suivi_facturation_header as $key => $suivi_fac_header){
                                    $field[$suivi_fac_header .' '.$suivi_header] = $facturation->$key;
                                }
                            } 
                        }
                    }
                    if($request->selected_gestion_header){
                        foreach($request->selected_gestion_header as $ges_header){
                            if($item->getGestionWithNoOrder->take($ges_header)->count() == $ges_header){
                                $gestion = $item->getGestionWithNoOrder->take($ges_header)->last(); 
                                foreach ($gestion_header as $key => $gest_header){
                                    $field[$gest_header .' '.$ges_header] = $gestion->$key;
                                }
                            } 
                        }
                    }
                    return $field;
                });
            }
    
    
            // dd($header);
            return Excel::download(new Export($header,$data), $request->type.'.xlsx');
    
            // $statuses       = ProjectNewStatus::all();
            // $sub_statuses   = ProjectSubStatus::orderBy('order','asc')->get();
            // $headers        = LeadHeader::all();
    
            // return view('admin.export', compact('statuses', 'sub_statuses', 'headers'));
        }
    }

    public function exportLiteExport(Request $request){ 

        $request->validate([
            'telecommercial' => 'required'
        ], [
            'telecommercial.required' => "Veuillez d'abord sélectionner le télécommercial"
        ]);

        $leads = LeadClientProject::query();
        if($request->label){
            $leads->where('lead_label', $request->label);
        }
        if($request->status){
            $leads->where('sub_status', $request->status);
        }
        // if($request->telecommercial){
            $leads->where('lead_telecommercial', $request->telecommercial);
        // }
        $header = ['N° Mobile', 'Prenom', 'Nom', 'Nom campagne', 'Type de travaux souhaité'];

        $data = $leads->where('lead_deleted_status', 0)->whereNotNull('phone')->get()->map(function($item){  
            return [
                'N° Mobile' => $item->phone,
                'Prenom' => $item->Prenom,
                'Nom' => $item->Nom,
                'Nom campagne' => $item->__tracking__Nom_campagne,
                'Type de travaux souhaité' => $item->__tracking__Type_de_travaux_souhaité,
            ]; 
        });  
        return Excel::download(new RingoverExport($data, $header), $request->type.'.csv'); 
    }
}
