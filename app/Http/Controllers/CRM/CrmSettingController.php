<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CRM\Agent;
use App\Models\CRM\Amo;
use App\Models\CRM\Area;
use App\Models\CRM\Auditor;
use App\Models\CRM\AuditStatus;
use App\Models\CRM\Banque;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\BarthPrice;
use App\Models\CRM\Benefit;
use App\Models\CRM\Campagnetype;
use App\Models\CRM\Category;
use App\Models\CRM\ClientCompany;
use App\Models\CRM\CommentCategory;
use App\Models\CRM\CommercialTerrain;
use App\Models\CRM\Control;
use App\Models\CRM\Cumac;
use App\Models\CRM\CumacCategory;
use App\Models\CRM\Deal;
use App\Models\CRM\Delegate;
use App\Models\CRM\DocumentControl;
use App\Models\CRM\EnergyType;
use App\Models\CRM\Entrepot;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\FournisseurMateriel;
use App\Models\CRM\FournisseurType;
use App\Models\CRM\HeatingMode;
use App\Models\CRM\Installer;
use App\Models\CRM\LeadStatus;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\NatureMouvement;
use App\Models\CRM\NotionCategory;
use App\Models\CRM\NotionSubCategory;
use App\Models\CRM\PersonnelAutoriseReception;
use App\Models\CRM\PrestationGroup;
use App\Models\CRM\Product;
use App\Models\CRM\ProjectControlPhoto;
use App\Models\CRM\ProjectDeadReason;
use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\ProjectReflectionReason;
use App\Models\CRM\ProjectSubStatus;
use App\Models\CRM\QualityControlType;
use App\Models\CRM\Regie;
use App\Models\CRM\RejectReason;
use App\Models\CRM\ReportResult;
use App\Models\CRM\Role;
use App\Models\CRM\Scale;
use App\Models\CRM\StatusPlanningIntervention;
use App\Models\CRM\StatutCommande;
use App\Models\CRM\StatutMaprimerenov;
use App\Models\CRM\Subcategory;
use App\Models\CRM\TechnicalReferee;
use App\Models\CRM\TicketProblemStatus;
use App\Models\CRM\TypeDeLivraison;
use App\Models\RenoPrice;
use App\Models\RoleCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrmSettingController extends Controller
{

    public function product(){    
        if(!checkAction(Auth::id(), 'general__setting', 'produits') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $products = Product::orderBy('reference', 'asc')->get();
        $categories = Category::all();
        $subcategories = Subcategory::all(); 
        $brands = Brand::all();
        $benefits = Benefit::all();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $user = Auth::user();
        return view('admin.settings.product', compact('products','categories', 'subcategories', 'brands', 'bareme_travaux_tags', 'benefits', 'user'));
    }
    public function marque(){   
        if(!checkAction(Auth::id(), 'general__setting', 'marques') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $brands = Brand::all();  
        $benefits = Benefit::all();
        $user = Auth::user();
        return view('admin.settings.marque', compact('brands', 'user', 'benefits'));
    }
    public function prestation(){  
        if(!checkAction(Auth::id(), 'general__setting', 'prestations') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $benefits = Benefit::all(); 
        $scales = Scale::where('deleted_status', 'no')->get();
        $user = Auth::user();
        return view('admin.settings.prestation', compact('scales', 'benefits', 'user'));
    }
    public function fournisseur(){   
        if(!checkAction(Auth::id(), 'general__setting', 'fournisseurs') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $fournessers = Fournisseur::all();
        $type_fournisseurs = FournisseurType::all();
        $benefits = Benefit::all();
        return view('admin.settings.fournisseur', compact('fournessers', 'user', 'type_fournisseurs','benefits'));
    }
    public function societeClient(){   
        if(!checkAction(Auth::id(), 'general__setting', 'societe_client') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $client_companies = ClientCompany::all();
        $benefits = Benefit::all();
        return view('admin.settings.societe_client', compact('user','client_companies','benefits'));
    }
    public function produitsCategorie(){   
        if(!checkAction(Auth::id(), 'general__setting', 'produits_categorie') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $categories = Category::all();
        return view('admin.settings.produits_categorie', compact('user', 'benefits','categories'));
    }
    public function produitsSousCategorie(){   
        if(!checkAction(Auth::id(), 'general__setting', 'produits_sous_categorie') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $subcategories = Subcategory::all(); 
        return view('admin.settings.produits_sous_categorie', compact('user', 'benefits', 'subcategories'));
    }
    public function BARTH164(){   
        if(role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $barth_prices = BarthPrice::orderBy('order')->get();
        return view('admin.settings.barth', compact('user', 'benefits', 'barth_prices'));
    }
    public function renoAmpleur(){   
        if(role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $reno_prices = RenoPrice::orderBy('order')->get();
        return view('admin.settings.reno', compact('user', 'benefits', 'reno_prices'));
    }

    public function calculetteCumac(){   
        if(role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $cumac_categories = CumacCategory::all();
        return view('admin.settings.cumac', compact('user', 'benefits', 'cumac_categories'));
    }

    public function cumacPriceUpdate(Request $request){
        if(role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $cumac = Cumac::find($request->id);
        if($cumac){
            $cumac->update([
                'cef_intial' => $request->cef_intial,
                'cef_finale' => $request->cef_finale,
                'gain_cef' => $request->cef_intial - $request->cef_finale,
            ]);
        }
        return back()->with('success', __("Updated Successfully"));
    }


    public function baremesTravauxTag(){   
        if(!checkAction(Auth::id(), 'general__setting', 'baremes') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        return view('admin.settings.baremes_travaux_tag', compact('user', 'benefits', 'bareme_travaux_tags'));
    }
    public function delegataire(){   
        if(!checkAction(Auth::id(), 'general__setting', 'delegataires') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $delegates = Delegate::all();
        return view('admin.settings.delegataire', compact('user', 'benefits', 'delegates'));
    }

    public function dealsTarif(){   
        if(!checkAction(Auth::id(), 'general__setting', 'deals_tarifs') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $deals = Deal::all();
        return view('admin.settings.deals_tarif', compact('user', 'benefits', 'deals'));
    }
    public function amo(){   
        if(!checkAction(Auth::id(), 'general__setting', 'amo') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $amos = Amo::all();
        return view('admin.settings.amo', compact('user', 'benefits', 'amos'));
    }
    public function auditeurEnergetique(){   
        if(!checkAction(Auth::id(), 'general__setting', 'auditeur_energetique') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $auditors = Auditor::all();
        return view('admin.settings.auditeur_energetique', compact('user', 'benefits', 'auditors'));
    }
    public function zonesIntervention(){   
        if(!checkAction(Auth::id(), 'general__setting', 'zones_d_intervention') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $areas = Area::all();
        return view('admin.settings.zones_intervention', compact('user', 'benefits', 'areas'));
    }
    public function regie(){   
        if(!checkAction(Auth::id(), 'general__setting', 'regie') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $regies = Regie::all();
        $responsable_commercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [7, 22])->get();
        return view('admin.settings.regie', compact('user', 'benefits', 'responsable_commercials','regies'));
    }
    public function prescriptionChantier(){   
        if(!checkAction(Auth::id(), 'general__setting', 'question') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        return view('admin.settings.prescription_chantier', compact('user', 'benefits', 'bareme_travaux_tags'));
    }
    public function controleDesDocuments(){   
        if(!checkAction(Auth::id(), 'general__setting', 'controle_des_documents') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $document_controls = DocumentControl::orderBy('order', 'asc')->get();
        return view('admin.settings.controle_des_documents', compact('user', 'benefits', 'document_controls'));
    }
    public function banque(){   
        if(!checkAction(Auth::id(), 'general__setting', 'banque') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $banques = Banque::all(); 
        return view('admin.settings.banque', compact('user', 'benefits', 'banques'));
    }
    public function statutAudit(){   
        if(!checkAction(Auth::id(), 'general__setting', 'status_audit') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $all_audit_status = AuditStatus::all();
        return view('admin.settings.statut_audit', compact('user', 'benefits', 'all_audit_status'));
    }
    public function resultatDuRapportAudit(){   
        if(!checkAction(Auth::id(), 'general__setting', 'resultat_du_rapport') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $all_report_result = ReportResult::all();
        return view('admin.settings.resultat_rapport_audit', compact('user', 'benefits', 'all_report_result'));
    }
    public function commercialTerrain(){   
        if(!checkAction(Auth::id(), 'general__setting', 'commercial_terrain') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $commercial_terrain = CommercialTerrain::all();
        return view('admin.settings.commercial_terrain', compact('user', 'benefits', 'commercial_terrain'));
    }
    public function bureauDeContrôle(){   
        if(!checkAction(Auth::id(), 'general__setting', 'bureaux_de_controle') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $controls = Control::all();
        return view('admin.settings.bureau_de_dontrôle', compact('user', 'benefits', 'controls'));
    }
    public function typeDeProblème(){   
        if(!checkAction(Auth::id(), 'general__setting', 'status_du_probleme_ticket') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $ticket_problem_statuses = TicketProblemStatus::all();
        return view('admin.settings.type_de_probleme', compact('user', 'benefits', 'ticket_problem_statuses'));
    }
    public function typeEnergieChaud(){   
        if(!checkAction(Auth::id(), 'general__setting', 'type_energie_chaud') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $energy_types = EnergyType::all();
        return view('admin.settings.typ_energie_chaud', compact('user', 'benefits', 'energy_types'));
    }
    public function prestationsGroup(){   
        if(!checkAction(Auth::id(), 'general__setting', 'prestations_group') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $prestation_groups = PrestationGroup::all();
        $products = Product::latest()->get();
        return view('admin.settings.prestations_group', compact('user', 'benefits', 'prestation_groups', 'products'));
    }
    public function commentCategory(){   
        if(!checkAction(Auth::id(), 'general__setting', 'comment_category') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $comment_categories = CommentCategory::all();
        // $users = User::where('deleted_status', 'no')->where('status', 'active')->get();
        $categories = Role::where('status', 'active')->where('value', '<>', 's_admin')->get();
        return view('admin.settings.comment_category', compact('user', 'benefits', 'categories', 'comment_categories'));
    }
    public function controleQualite(){   
        if(!checkAction(Auth::id(), 'general__setting', 'quality_control') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $quality_controls = QualityControlType::all();
        return view('admin.settings.controle_qualite', compact('user', 'benefits', 'quality_controls'));
    }
    public function notionCategorie(){   
        if(!checkAction(Auth::id(), 'general__setting', 'notion_category') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $notion_categories = NotionCategory::orderBy('order', 'asc')->get();
        return view('admin.settings.notion_categorie', compact('user', 'benefits', 'notion_categories'));
    }
    public function notionSousCategorie(){   
        if(!checkAction(Auth::id(), 'general__setting', 'notion_sub_category') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all(); 
        $notion_categories = NotionCategory::orderBy('order', 'asc')->get();
        $notion_subcategories = NotionSubCategory::orderBy('order', 'asc')->get(); 
        return view('admin.settings.notion_sous_categorie', compact('user', 'benefits','notion_categories', 'notion_subcategories'));
    }
    public function sousStatutProspect(){   
        if(!checkAction(Auth::id(), 'general__setting', 'lead_sub_status') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $lead_sub_statuses = LeadSubStatus::with('getStatus')->orderBy('order', 'asc')->get();
        $lead_statuses = LeadStatus::orderBy('order', 'asc')->get();
        return view('admin.settings.sous_statut_prospect', compact('user', 'benefits', 'lead_sub_statuses', 'lead_statuses'));
    }
    public function modeDeChauffage(){   
        if(!checkAction(Auth::id(), 'general__setting', 'heating_mode') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $heatings = HeatingMode::orderBy('order', 'asc')->get();
        return view('admin.settings.mode_de_chauffage', compact('user', 'benefits', 'heatings'));
    }
    public function typeDeCampagne(){   
        if(!checkAction(Auth::id(), 'general__setting', 'campagne_type') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $campagnes = Campagnetype::all();
        return view('admin.settings.type_de_campagne', compact('user', 'benefits', 'campagnes'));
    }
    public function sousStatutChantier(){   
        if(!checkAction(Auth::id(), 'general__setting', 'project_sub_status') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $project_sub_statuses = ProjectSubStatus::with('getStatus')->orderBy('order','asc')->get();
        $project_statuses = ProjectNewStatus::orderBy('order', 'asc')->get();
        return view('admin.settings.sous_statut_chantier', compact('user', 'benefits', 'project_sub_statuses', 'project_statuses'));
    }
    public function statutPlanningIntervention(){   
        if(!checkAction(Auth::id(), 'general__setting', 'status_planning_intervention') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $status_interventions = StatusPlanningIntervention::all(); 
        return view('admin.settings.statut_planning_intervention', compact('user', 'benefits', 'status_interventions'));
    }
    public function chantiersRaisons(){   
        if(!checkAction(Auth::id(), 'general__setting', 'project_ko_reason') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $project_ko_reasons = ProjectDeadReason::all();
        return view('admin.settings.chantiers_ko_raisons', compact('user', 'benefits', 'project_ko_reasons'));
    }
    public function chantiersReflexionRaisons(){   
        if(!checkAction(Auth::id(), 'general__setting', 'project_reflection_reason') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $project_reflection_reasons = ProjectReflectionReason::all();
        return view('admin.settings.chantiers_reflexion_raisons', compact('user', 'benefits', 'project_reflection_reasons'));
    }
    public function controleConformitePhotoChantier(){   
        if(!checkAction(Auth::id(), 'general__setting', 'project_control_photo') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $project_control_photos = ProjectControlPhoto::all();
        $bareme_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        return view('admin.settings.controle_conformite_photo_chantier', compact('user', 'benefits', 'project_control_photos', 'bareme_travaux_tags'));
    }
    public function statutMaprimerenov(){   
        if(!checkAction(Auth::id(), 'general__setting', 'statut_maprimerenov') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $statut_maprimerenovs = StatutMaprimerenov::orderBy('order', 'asc')->get();
        return view('admin.settings.statut_maprimerenov', compact('user', 'benefits', 'statut_maprimerenovs'));
    }
    public function mandataireAnah(){   
        if(!checkAction(Auth::id(), 'general__setting', 'mandataire_anah') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $agents = Agent::all();
        return view('admin.settings.mandataire_anah', compact('user', 'benefits', 'agents'));
    }
    public function entrepriseDeTravaux(){   
        if(!checkAction(Auth::id(), 'general__setting', 'installateurs_rge') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $installers = Installer::all();
        return view('admin.settings.entreprise_de_travaux', compact('user', 'benefits', 'installers'));
    }
    public function motifRejet(){   
        if(!checkAction(Auth::id(), 'general__setting', 'reject_reason') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $reject_reasons = RejectReason::all();
        return view('admin.settings.motif_rejet', compact('user', 'benefits', 'reject_reasons'));
    }
    public function parametresDeCouleurUtilisateur(){   
        if(!checkAction(Auth::id(), 'general__setting', 'user_color') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $colored_role = Role::where('category_id', '1')->pluck('id')->toArray();
        $color_users = User::whereIn('role_id', $colored_role)->where('deleted_status', 'no')->where('status', 'active')->get();
        return view('admin.settings.parametres_de_couleur_utilisateur', compact('user', 'benefits', 'color_users'));
    }
    public function typeDeFournisseur(){   
        if(!checkAction(Auth::id(), 'general__setting', 'type_fournisseur') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $type_fournisseurs = FournisseurType::all();
        return view('admin.settings.type_de_fournisseur', compact('user', 'benefits', 'type_fournisseurs'));
    }
    public function referentTechnique(){   
        if(!checkAction(Auth::id(), 'general__setting', 'technical_referee') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $technical_referees = TechnicalReferee::all();
        return view('admin.settings.referent_technique', compact('user', 'benefits', 'technical_referees'));
    }

    public function natureMouvement(){   
        if(!checkAction(Auth::id(), 'general__setting', 'nature_mouvement') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $nature_mouvements = NatureMouvement::all();
        return view('admin.settings.nature_mouvement', compact('user', 'benefits', 'nature_mouvements'));
    }
    public function entrepot(){   
        if(!checkAction(Auth::id(), 'general__setting', 'entrepot') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $entrepots = Entrepot::all();
        return view('admin.settings.entrepot', compact('user', 'benefits', 'entrepots'));
    }
    public function personnelAutoriseReception(){   
        if(!checkAction(Auth::id(), 'general__setting', 'personnel_autorise_reception') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $personnel_autorise_receptions = PersonnelAutoriseReception::all();
        return view('admin.settings.personnel_autorise_reception', compact('user', 'benefits', 'personnel_autorise_receptions'));
    }
    public function statutCommande(){   
        if(!checkAction(Auth::id(), 'general__setting', 'statut_commande') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $statut_commandes = StatutCommande::all();
        return view('admin.settings.statut_commande', compact('user', 'benefits', 'statut_commandes'));
    }
    public function fournisseurMateriel(){   
        if(!checkAction(Auth::id(), 'general__setting', 'fournisseur_materiel') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $fournisseur_materiels = FournisseurMateriel::all();
        return view('admin.settings.fournisseur_materiel', compact('user', 'benefits', 'fournisseur_materiels'));
    }
    public function typeDeLivraison(){   
        if(!checkAction(Auth::id(), 'general__setting', 'type_de_livraison') && role() != 's_admin'){
            return redirect()->route('permission.none');
        }
        $user = Auth::user();
        $benefits = Benefit::all();
        $type_de_livraisons = TypeDeLivraison::all();
        return view('admin.settings.type_de_livraison', compact('user', 'benefits', 'type_de_livraisons'));
    }
}
