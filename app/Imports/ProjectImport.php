<?php

namespace App\Imports;

use App\Models\CRM\Agent;
use App\Models\CRM\Audit;
use App\Models\CRM\Auditor;
use App\Models\CRM\AuditStatus;
use App\Models\CRM\Banque;
use App\Models\CRM\BanqueDepot;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\Delegate;
use App\Models\CRM\DemandeMairie;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\ProjectFacturation;
use App\Models\CRM\ProjectIntervention;
use App\Models\CRM\ReportResult;
use App\Models\CRM\Subvention;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProjectImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public $data = [];
    public $custom_field_column = [];
    public $label;
    public $intervention_data = [];
    public $telecommercial;
    public $sub_status;
    public  $client_header = [
        '__tracking__Fournisseur_de_lead',
        '__tracking__Type_de_campagne',
        '__tracking__Nom_campagne',
        '__tracking__Date_demande_lead',
        '__tracking__Date_attribution_télécommercial',
        '__tracking__Type_de_travaux_souhaité',
        '__tracking__Nom_Prénom',
        '__tracking__Code_postal',
        '__tracking__Email',
        '__tracking__téléphone',
        '__tracking__Département',
        '__tracking__Mode_de_chauffage',
        '__tracking__Propriétaire',
        '__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans',
        'Titre',
        'Nom',
        'Prenom',
        'Adresse',
        'Complément_adresse',
        'Code_Postal',
        'Ville',
        'Département',
        'Email',
        'phone',
        'fixed_number',
        'Observations',
        'Type_occupation',
        'Parcelle_cadastrale',
        'Revenue_Fiscale_de_Référence',
        'Nombre_de_foyer',
        'Nombre_de_personnes',
        'Age_du_bâtiment',
        'Zone',
        'precariousness',
        'Mode_de_chauffage',
        'Date_construction_maison',
        'Surface_habitable',
        'Surface_à_chauffer',
        'Consommation_chauffage_annuel',
        'Consommation_Chauffage_Annuel_2',
        'Depuis_quand_occupez_vous_le_logement',
        'Type_du_courant_du_logement',
        'auxiliary_heating_status',
        'auxiliary_heating',
        'second_heating_generator_status',
        'second_heating_generator',
        'Quels_sont_les_différents_émetteurs_de_chaleur_du_logement',
        'Préciser_le_type_de_radiateurs_Aluminium',
        'Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs',
        'Préciser_le_type_de_radiateurs_Fonte',
        'Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs',
        'Préciser_le_type_de_radiateurs_Acier',
        'Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs',
        'Préciser_le_type_de_radiateurs_Autre',
        'Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs',
        'Production_dapostropheeau_chaude_sanitaire',
        'Instantanné',
        'Accumulation',
        'Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude',
        'Précisez_le_volume_du_ballon_dapostropheeau_chaude',
        'Information_logement_observations',
        'Situation_familiale',
        'Y_a_t_il_des_enfants_dans_le_foyer_fiscale',
        'Personne_1',
        'Quel_est_le_contrat_de_travail_de_Personne_1',
        'Revenue_Personne_1',
        'Existehyphenthyphenil_un_conjoint',
        'Personne_2',
        'Quel_est_le_contrat_de_travail_de_Personne_2',
        'Revenue_Personne_2',
        'Crédit_du_foyer_mensuel',
        'Commentaires_revenue_et_crédit_du_foyer',
        'Type_de_contrat',
        'MaPrimeRenov',
        'Subvention_MaPrimeRénov_déduit_du_devis',
        'Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov',
        'Action_Logement',
        'CEE',
        'Credit',
        'Montant_Crédit',
        'Report_du_crédit',
        'Nombre_de_jours_report',
        'Reste_à_charge',
        'Reste_à_charge_Montant',
        'Mode_de_paiement',
        'Nombre_de_mensualités',
        'advance_visit',
        'Projet_observations'
    ];

    public function __construct($data, $custom_field_column, $label, $intervention_data, $telecommercial, $sub_status)
    {
        $this->data = $data;
        $this->custom_field_column = $custom_field_column;
        $this->label = $label;
        $this->intervention_data = $intervention_data;
        $this->telecommercial = $telecommercial;
        $this->sub_status = $sub_status;
    }

    public function model(array $row)
    { 
        $lead_tracking_custom_key = [];
        $lead_tracking_custom_value = [];
        $personal_information_custom_key = [];
        $personal_information_custom_value = [];
        $eligibility_custom_key = [];
        $eligibility_custom_value = [];
        $information_logement_custom_key = [];
        $information_logement_custom_value = [];
        $situation_foyer_custom_key = [];
        $situation_foyer_custom_value = [];
        $project_custom_key = [];
        $project_custom_value = [];
        $new_project = new NewProject();
        $new_client = new NewClient();
            
        if($this->sub_status){
            $new_project->project_sub_status = $this->sub_status;
        }
        $new_project->project_label = $this->label;
        $new_project->user_id = Auth::id();
        $interventionPrevisiteStatus = false;
        $interventionInstallationStatus = false;
        $interventionInstallationStatus2 = false;
        $interventionEtudeStatus = false;
        $importSubventionStatus = false;
        $importBanqueStatus = false;
        $importDemandeStatus = false;
        $importAuditStatus = false;
        $importCEEStatus = false;
        $imporMaPrimeRénovStatus = false;
        $imporClientStatus = false;
        $imporBanqueFacturationStatus = false;
        $imporActionLogementStatus = false;
        foreach($row as $file_key => $file_value){
            foreach ($this->data as $data_key => $data_value){
                if($file_key == $data_value){

                    if($data_key == '__tracking__Fournisseur_de_lead'){
                        $fournisseur = Fournisseur::where('type', 'lead')->where('suplier', $file_value)->first();
                        if($fournisseur){  
                            $new_project->$data_key = $fournisseur->id;
                            if(in_array($data_key, $this->client_header)){
                                $new_client->$data_key = $fournisseur->id;
                            }
                        }else{
                            $new_project->$data_key = $file_value;
                            if(in_array($data_key, $this->client_header)){
                                $new_client->$data_key = $file_value;
                            }
                        }
                    }else if($data_key == '__tracking__Date_demande_lead' || $data_key == '__tracking__Date_attribution_télécommercial' || $data_key == 'Compte_Compte_crée_le' || $data_key == 'Compte_email_de_récupération_Compte_crée_le' || $data_key == 'Compte_MaPrimeRénov_Compte_crée_le' || $data_key == 'Date_de_dépôt' || $data_key == 'Date_mise_à_jour'){  
                        if($file_value){
                            $new_project->$data_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value); 
                            if(in_array($data_key, $this->client_header)){
                                $new_client->$data_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value); 
                            }
                        }
                    }else if($data_key == 'Compte_Compte_crée_par'|| $data_key == 'Compte_email_de_récupération_Compte_crée_par'|| $data_key == 'Compte_MaPrimeRénov_Compte_crée_par'){  
                        if($file_value){
                            $new_project->$data_key = intval($file_value);
                        }
                    }else{
                        $new_project->$data_key = $file_value;
                        if(in_array($data_key, $this->client_header)){
                            $new_client->$data_key = $file_value;
                        }
                    }
 
                    if($data_key == 'Adresse'){
                        if($file_value){
                            // dispatch(new LocationLatLon($new_project->id, $file_value)); 
                            $client = new Client();
                            $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json', [
                                'query' => [
                                    'address' => $file_value,
                                    'components' => 'country:FR',
                                    'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E'
                                ]
                            ]); 
                            $data = json_decode($response->getBody(), true);
                            if ($data['status'] === 'OK') { 
                                $new_project->latitude = $data['results'][0]['geometry']['location']['lat'];
                                $new_project->longitude = $data['results'][0]['geometry']['location']['lng']; 
                                $new_client->latitude = $data['results'][0]['geometry']['location']['lat'];
                                $new_client->longitude = $data['results'][0]['geometry']['location']['lng']; 
                            } 
                        }   
                    }
                }
            }  
            foreach($this->custom_field_column as $column_key => $column_value){
                if($column_value){
                    if($column_key == 'lead_tracking_custom__field'){
                        foreach($column_value as $custom_key => $custom_value){
                            if($file_key == $custom_value){
                                $lead_tracking_custom_key[] = $custom_key;
                                $lead_tracking_custom_value[] = $file_value;
                            }
                        }
                    }
                    if($column_key == 'personal_information_custom__field'){
                        foreach($column_value as $custom_key => $custom_value){
                            if($file_key == $custom_value){
                                $personal_information_custom_key[] = $custom_key;
                                $personal_information_custom_value[] = $file_value;
                            }
                        }
                    }
                    if($column_key == 'eligibility_custom__field'){
                        foreach($column_value as $custom_key => $custom_value){
                            if($file_key == $custom_value){
                                $eligibility_custom_key[] = $custom_key;
                                $eligibility_custom_value[] = $file_value;
                            }
                        }
                    }
                    if($column_key == 'information_logement_custom__field'){
                        foreach($column_value as $custom_key => $custom_value){
                            if($file_key == $custom_value){
                                $information_logement_custom_key[] = $custom_key;
                                $information_logement_custom_value[] = $file_value;
                            }
                        }
                    }
                    if($column_key == 'situation_foyer_custom__field'){
                        foreach($column_value as $custom_key => $custom_value){
                            if($file_key == $custom_value){
                                $situation_foyer_custom_key[] = $custom_key;
                                $situation_foyer_custom_value[] = $file_value;
                            }
                        }
                    }
                    if($column_key == 'project_custom__field'){
                        foreach($column_value as $custom_key => $custom_value){
                            if($file_key == $custom_value){
                                $project_custom_key[] = $custom_key;
                                $project_custom_value[] = $file_value;
                            }
                        }
                    }
                }
            }
            foreach($this->intervention_data['intervention___previsite'] as $intervention___previsite_key => $intervention___previsite){
                if($intervention___previsite && !$interventionPrevisiteStatus){
                    $project_intervention_previsite = New ProjectIntervention();
                    $project_intervention_previsite->type = 'Pré-Visite Technico-Commercial';
                    $interventionPrevisiteStatus = true;
                }
                if($interventionPrevisiteStatus){
                    if($file_key == $intervention___previsite){
                        if($intervention___previsite_key == 'Date_intervention'){
                            // if(strtotime($file_value)){
                            //     $project_intervention_previsite->$intervention___previsite_key = $file_value;
                            // }
                            if($file_value){
                                $project_intervention_previsite->$intervention___previsite_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);
                            }

                        }else if($intervention___previsite_key == 'Prévisiteur_TechnicohyphenCommercial' || $intervention___previsite_key == 'Réfèrent_technique'){
                            $project_intervention_previsite->$intervention___previsite_key = intval($file_value);
                        }else{
                            $project_intervention_previsite->$intervention___previsite_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['intervention___installation'] as $intervention___installation_key => $intervention___installation){
                if($intervention___installation && !$interventionInstallationStatus){
                    $project_intervention_installation = New ProjectIntervention();
                    $project_intervention_installation->type = 'Installation';
                    $interventionInstallationStatus = true;
                }
                if($interventionInstallationStatus){
                    if($file_key == $intervention___installation){
                        if($intervention___installation_key == 'Date_intervention'){
                            // if(strtotime($file_value)){
                            //     $project_intervention_installation->$intervention___installation_key = $file_value;
                            // }
                            if($file_value){
                                $project_intervention_installation->$intervention___installation_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);
                            }
                        }else if($intervention___installation_key == 'Installateur_technique'){
                            $project_intervention_installation->$intervention___installation_key = intval($file_value);
                        }else{
                            $project_intervention_installation->$intervention___installation_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['intervention___installation2'] as $intervention___installation2_key => $intervention___installation2){
                if($intervention___installation2 && !$interventionInstallationStatus2){
                    $project_intervention_installation2 = New ProjectIntervention();
                    $project_intervention_installation2->type = 'Installation';
                    $interventionInstallationStatus2 = true;
                }
                if($interventionInstallationStatus2){
                    if($file_key == $intervention___installation2){
                        if($intervention___installation2_key == 'Date_intervention'){
                            // if(strtotime($file_value)){
                            //     $project_intervention_installation2->$intervention___installation2_key = $file_value;
                            // }
                            if($file_value){
                                $project_intervention_installation2->$intervention___installation2_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);
                            }
                        }else if($intervention___installation2_key == 'Installateur_technique'){
                            $project_intervention_installation2->$intervention___installation2_key = intval($file_value);
                        }else{
                            $project_intervention_installation2->$intervention___installation2_key = $file_value;
                        }
                    }
                }
            }

            
            foreach($this->intervention_data['intervention___etude'] as $intervention___etude_key => $intervention___etude){
                if($intervention___etude && !$interventionEtudeStatus){
                    $project_intervention_etude = New ProjectIntervention();
                    $project_intervention_etude->type = 'Etude';
                    $interventionEtudeStatus = true;
                }
                if($interventionEtudeStatus){
                    if($file_key == $intervention___etude){
                        if($intervention___etude_key == 'Date_intervention'){
                            // if(strtotime($file_value)){
                            //     $project_intervention_etude->$intervention___etude_key = $file_value;
                            // }
                            if($file_value){
                                $project_intervention_etude->$intervention___etude_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);
                            }
                        }else if($intervention___etude_key == 'Chargé_dapostropheétude' || $intervention___etude_key == 'Réfèrent_technique'){
                            $project_intervention_etude->$intervention___etude_key = intval($file_value);
                        }else{
                            $project_intervention_etude->$intervention___etude_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__subvention'] as $import__subvention_key => $import__subvention){
                if($import__subvention && !$importSubventionStatus){
                    $project__subvention = new Subvention();
                    $importSubventionStatus = true;
                }
                if($importSubventionStatus){
                    if($file_key == $import__subvention){
                        if($import__subvention_key == 'date_mise' || $import__subvention_key == 'date_de_depot' || $import__subvention_key == 'Consentement_reçu_le' || $import__subvention_key == 'Consentement_répondu_le' || $import__subvention_key == 'subvention_accorde_le' || $import__subvention_key == 'Date_forclusion' || $import__subvention_key == 'subvention_rejetee_le'){
                            if($file_value){ 
                                $project__subvention->$import__subvention_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);
                            }
                        }else if($import__subvention_key == 'gestionnaire_depot'){
                            $project__subvention->$import__subvention_key = intval($file_value);
                        }else if($import__subvention_key == 'Subvention_observation'){
                            $project__subvention->observations = $file_value;
                        }else{
                            $project__subvention->$import__subvention_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__banque'] as $import__banque_key => $import__banque){
                if($import__banque && !$importBanqueStatus){
                    $project__banque = new BanqueDepot();
                    $importBanqueStatus = true;
                }
                if($importBanqueStatus){
                    if($file_key == $import__banque){
                        if($import__banque_key == 'date_depot' || $import__banque_key == 'Date_de_notification_accord'){
                            if($file_value){
                                $project__banque->$import__banque_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);
                            }
                        }else if($import__banque_key == 'Banque'){
                            if($file_value){
                                $banque_item = Banque::where('name', $file_value)->first();
                                if($banque_item){
                                    $project__banque->banque_id = $banque_item->id;
                                }
                            }
                        }else{
                            $project__banque->$import__banque_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__demande'] as $import__demande_key => $import__demande){
                if($import__demande && !$importDemandeStatus){
                    $project__demande = new DemandeMairie();
                    $importDemandeStatus = true;
                }
                if($importDemandeStatus){
                    if($file_key == $import__demande){
                        if($import__demande_key == 'Date_de_réception_de_l_accord_de_mairie' || $import__demande_key == 'Date_de_dépôt_demande' || $import__demande_key == 'Date_de_réception_de_récépissé_de_mairie'){
                            if($file_value){
                                if($import__demande_key == 'Date_de_dépôt_demande'){
                                    $project__demande->Date_de_dépôt = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);
                                }else{
                                    $project__demande->$import__demande_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);
                                }
                            }  
                        }else if($import__demande_key == 'demande_Observations'){
                            $project__demande->Observations = $file_value;
                        }else if($import__demande_key == 'Demande_de_travaux'){
                            if($file_value){
                                $demande_travaux = BaremeTravauxTag::where('travaux', $file_value)->first();
                                if($demande_travaux){
                                    $project__demande->Demande_de_travaux = $demande_travaux->id;
                                }
                            }
                        }else{
                            $project__demande->$import__demande_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__audit'] as $import__audit_key => $import__audit){
                if($import__audit && !$importAuditStatus){
                    $project__audit = new Audit();
                    $importAuditStatus = true;
                }
                if($importAuditStatus){
                    if($file_key == $import__audit){
                        if($import__audit_key == 'release_date' || $import__audit_key == 'Audit_envoyé_le' || $import__audit_key == 'Audit_reçu_le'){
                            if($file_value){ 
                                $project__audit->$import__audit_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value); 
                            }   
                        }else if($import__audit_key == 'study_office'){
                            if($file_value){
                                $office = Auditor::where('company_name', $file_value)->first();
                                if($office){
                                    $project__audit->study_office = $office->id;
                                }
                            }
                        }else if($import__audit_key == 'audit_status'){
                            if($file_value){
                                $audit = AuditStatus::where('name', $file_value)->first();
                                if($audit){
                                    $project__audit->audit_status = $audit->id;
                                }
                            }
                        }else if($import__audit_key == 'report_result'){
                            if($file_value){
                                $result = ReportResult::where('name', $file_value)->first();
                                if($result){
                                    $project__audit->report_result = $result->id;
                                }
                            }
                        }else if($import__audit_key == 'audit_user'){
                            if($file_value){ 
                                $project__audit->audit_user = intval($file_value);;
                            }
                        }else if($import__audit_key == 'audit_Observations'){
                            if($file_value){ 
                                $project__audit->Observations = $file_value;
                            }
                        }else{
                            $project__audit->$import__audit_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__cee'] as $import__cee_key => $import__cee){
                if($import__cee && !$importCEEStatus){
                    $project__cee = new ProjectFacturation();
                    $project__cee->type = 'Encaissement CEE';
                    $importCEEStatus = true;
                }
                if($importCEEStatus){
                    if($file_key == $import__cee){
                        if($import__cee_key == 'Date_dépôt_pollueur' || $import__cee_key == 'Date_paiement_pollueur'){
                            if($file_value){ 
                                $project__cee->$import__cee_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value); 
                            }   
                        }else if($import__cee_key == 'Délégataire'){
                            if($file_value){
                                $office = Delegate::where('company_name', $file_value)->first();
                                if($office){    
                                    $project__cee->Délégataire = $office->id;
                                }
                            }
                        }else if($import__cee_key == 'facturation_Observations'){
                            if($file_value){ 
                                $project__cee->Observations = $file_value;
                            }
                        }else{
                            $project__cee->$import__cee_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__MaPrimeRénov'] as $import__MaPrimeRénov_key => $import__MaPrimeRénov){
                if($import__MaPrimeRénov && !$imporMaPrimeRénovStatus){
                    $project__MaPrimeRénov = new ProjectFacturation();
                    $project__MaPrimeRénov->type = 'Encaissement MaPrimeRénov’';
                    $imporMaPrimeRénovStatus = true;
                }
                if($imporMaPrimeRénovStatus){
                    if($file_key == $import__MaPrimeRénov){
                        if($import__MaPrimeRénov_key == 'Date_facturation_MaPrimeRénov' || $import__MaPrimeRénov_key == 'Date_APF' || $import__MaPrimeRénov_key == 'Paye_le' || $import__MaPrimeRénov_key == 'Date_paiement_MaPrimeRénov'){
                            if($file_value){ 
                                $project__MaPrimeRénov->$import__MaPrimeRénov_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value); 
                            }   
                        }else if($import__MaPrimeRénov_key == 'MaPrimeRénov_Mandataire' || $import__MaPrimeRénov_key == 'Avance_délégataire_MaPrimeRénov_Mandataire'){
                            if($file_value){
                                $office = Agent::where('company_name', $file_value)->first();
                                if($office){    
                                    if($import__MaPrimeRénov_key == 'MaPrimeRénov_Mandataire'){
                                        $project__MaPrimeRénov->Mandataire = $office->id;
                                    }else{
                                        $project__MaPrimeRénov->$import__MaPrimeRénov_key = $office->id;
                                    }
                                }
                            }
                        }else if($import__MaPrimeRénov_key == 'facturation_Observations'){
                            if($file_value){ 
                                $project__MaPrimeRénov->Observations = $file_value;
                            }
                        }else{
                            $project__MaPrimeRénov->$import__MaPrimeRénov_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__client'] as $import__client_key => $import__client){
                if($import__client && !$imporClientStatus){
                    $project__client = new ProjectFacturation();
                    $project__client->type = 'Encaissement Client';
                    $imporClientStatus = true;
                }
                if($imporClientStatus){
                    if($file_key == $import__client){
                        if($import__client_key == 'facturation_Observations'){
                            if($file_value){ 
                                $project__client->Observations = $file_value;
                            }
                        }else{
                            $project__client->$import__client_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__banque_facturation'] as $import__banque_facturation_key => $import__banque_facturation){
                if($import__banque_facturation && !$imporBanqueFacturationStatus){
                    $project__banque_facturation = new ProjectFacturation();
                    $project__banque_facturation->type = 'Encaissement Banque';
                    $imporBanqueFacturationStatus = true;
                }
                if($imporBanqueFacturationStatus){
                    if($file_key == $import__banque_facturation){
                        if($import__banque_facturation_key == 'Date_envoi_contrat' || $import__banque_facturation_key == 'Date_demande_de_financement' || $import__banque_facturation_key == 'Paye_le'){
                            if($file_value){ 
                                $project__banque_facturation->$import__banque_facturation_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value); 
                            } 
                        }else if($import__banque_facturation_key == 'facturation_Banque'){
                            if($file_value){
                                $banque_item = Banque::where('name', $file_value)->first();
                                if($banque_item){
                                    $project__banque_facturation->Banque = $banque_item->id;
                                }
                            }
                        }else if($import__banque_facturation_key == 'facturation_Observations'){
                            if($file_value){ 
                                $project__banque_facturation->Observations = $file_value;
                            }
                        }else{
                            $project__banque_facturation->$import__banque_facturation_key = $file_value;
                        }
                    }
                }
            }
            foreach($this->intervention_data['import__action_logement'] as $import__action_logement_key => $import__action_logement){
                if($import__action_logement && !$imporActionLogementStatus){
                    $project__action_logement = new ProjectFacturation();
                    $project__action_logement->type = 'Encaissement Action Logement';
                    $imporActionLogementStatus = true;
                }
                if($imporActionLogementStatus){
                    if($file_key == $import__action_logement){
                        if($import__action_logement_key == 'Date_facturation_Action_Logement' || $import__action_logement_key == 'Date_paiement_Action_Logement'){
                            if($file_value){ 
                                $project__action_logement->$import__action_logement_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value); 
                            }  
                        }else if($import__action_logement_key == 'facturation_Observations'){
                            if($file_value){ 
                                $project__action_logement->Observations = $file_value;
                            }
                        }else if($import__action_logement_key == 'facturation_AMO'){
                            if($file_value){ 
                                $project__action_logement->AMO = $file_value;
                            }
                        }else{
                            $project__action_logement->$import__action_logement_key = $file_value;
                        }
                    }
                }
            }
        } 

        $lead_tracking_custom__field = array_combine($lead_tracking_custom_key, $lead_tracking_custom_value); 
        $new_project->lead_tracking_custom_field_data = json_encode($lead_tracking_custom__field);   

        $personal_info_custom__field = array_combine($personal_information_custom_key, $personal_information_custom_value); 
        $new_project->personal_info_custom_field_data = json_encode($personal_info_custom__field);   

        $eligibility_custom__field = array_combine($eligibility_custom_key, $eligibility_custom_value); 
        $new_project->eligibility_custom_field_data = json_encode($eligibility_custom__field);   

        $information_logement_custom__field = array_combine($information_logement_custom_key, $information_logement_custom_value); 
        $new_project->information_logement_custom_field_data = json_encode($information_logement_custom__field);   

        $situation_foyer_custom__field = array_combine($situation_foyer_custom_key, $situation_foyer_custom_value); 
        $new_project->situation_foyer_custom_field_data = json_encode($situation_foyer_custom__field);   

        $project_custom__field = array_combine($project_custom_key, $project_custom_value); 
        $new_project->project_custom_field_data = json_encode($project_custom__field);   

        $new_client->save();
        $new_project->client_id = $new_client->id;
        if($this->telecommercial){
            $new_project->project_telecommercial = $this->telecommercial;
        }
        $new_project->save();
        if($interventionPrevisiteStatus){
            $project_intervention_previsite->project_id = $new_project->id;
            $project_intervention_previsite->save();
        }
        if($interventionInstallationStatus){
            $project_intervention_installation->project_id = $new_project->id;
            $project_intervention_installation->save();
        }
        if($interventionInstallationStatus2){
            $project_intervention_installation2->project_id = $new_project->id;
            $project_intervention_installation2->save();
        }
        if($interventionEtudeStatus){
            $project_intervention_etude->project_id = $new_project->id;
            $project_intervention_etude->save();
        }
        if($importSubventionStatus){
            $project__subvention->project_id = $new_project->id;
            $project__subvention->save(); 
            $project__subvention->numero_de_dossier = 'MPR-'.Carbon::now()->format('Y').'-'.sprintf('%07d', $project__subvention->id);
            $project__subvention->save(); 
        }
        if($importBanqueStatus){
            $project__banque->project_id = $new_project->id;
            $project__banque->save();  
        }
        if($importDemandeStatus){
            $project__demande->project_id = $new_project->id;
            $project__demande->save();  
        }
        if($importAuditStatus){
            $project__audit->project_id = $new_project->id;
            $project__audit->save();  
        }
        if($importCEEStatus){
            $project__cee->project_id = $new_project->id;
            $project__cee->save();  
        }
        if($imporMaPrimeRénovStatus){
            $project__MaPrimeRénov->project_id = $new_project->id;
            $project__MaPrimeRénov->save();  
        }
        if($imporClientStatus){
            $project__client->project_id = $new_project->id;
            $project__client->save();  
        }
        if($imporBanqueFacturationStatus){
            $project__banque_facturation->project_id = $new_project->id;
            $project__banque_facturation->save();  
        }
        if($imporActionLogementStatus){
            $project__action_logement->project_id = $new_project->id;
            $project__action_logement->save();  
        }
        return $new_project;
    }
}
















