<?php

namespace App\Imports;

use App\Models\CRM\BanqueDepot;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\NewProject2;
use App\Models\CRM\ProjectComment;
use App\Models\CRM\ProjectIntervention;
use App\Models\CRM\ProjectTax;
use App\Models\CRM\Subvention;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use GuzzleHttp\Client;
class ProjectImportManual implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $data = []; 
    public $label; 
    public function __construct($data, $label)
    {
        $this->data = $data; 
        $this->label = $label; 
    }

    public function model(array $row)
    { 
        if($row['nom'] && $row['nom']){
            $new_project = new NewProject();
            $new_client = new NewClient();
            
            $situation = null;
            $tel = null;

            $new_client->company_id = 1;
            $new_client->deleted_status = 1;
            
            
            $new_project->project_label = $this->label;
            $new_project->company_id = 1;
            $new_project->deleted_status = 1;
            $new_project->user_id = Auth::id(); 

            if($row['tel']){
                $tel = str_replace('-', '', $row['tel']);
            }

            $new_project->Nom = $row['nom'] ?? null;
            $new_project->Prenom = $row['prenom'] ?? null;
            $new_project->Adresse = $row['adresse_installation'] ?? null;
            $new_project->Ville = $row['ville'] ?? null;
            $new_project->Code_Postal = $row['cp'] ?? null;
            $new_project->phone = $tel;
            $new_project->Email = $row['email_client'] ?? null;

            $new_project->Surface_à_chauffer = $row['superficie_interieure_chauffee'] ?? null;
            if($row['proprietaire_locataire']){
                $new_project->Type_habitation = 'Propriétaire occupant';
            }

            if($row['type_de_chauffage_nbre_de_radiateurs']){
                $new_project->Type_de_logement = 'Maison individuelle';
                if($row['type_de_chauffage_nbre_de_radiateurs'] == 'Electricité'){
                    $new_project->Type_de_chauffage = 'Electrique'; 
                    $new_project->Mode_de_chauffage = 'Electrique';
                }else{
                    $new_project->Type_de_chauffage = 'Combustible'; 
                    $new_project->Mode_de_chauffage = $row['type_de_chauffage_nbre_de_radiateurs'];
                }   
            }
            if($row['prix_de_vente_ttc']){
                $new_project->Type_de_contrat = 'Credit';
                $new_project->Statut_Projet = 'Devis signé';
                $new_project->Bon_De_Commande = $row['prix_de_vente_ttc'];
            }



            $new_client->save();
            $new_project->client_id = $new_client->id;
            $new_project->save(); 

            if($row['commentaires_installation']){ 
                ProjectComment::create([
                    'project_id' => $new_project->id,
                    'comment' => $row['commentaires_installation'],
                    'category_id' => 7,
                    'user_id' => Auth::id()
                ]);
            } 

            if($row['cq_instal']){ 
                ProjectComment::create([
                    'project_id' => $new_project->id,
                    'comment' => $row['cq_instal'],
                    'category_id' => 7,
                    'user_id' => Auth::id()
                ]);
            } 
            if($row['commentaires']){ 
                ProjectComment::create([
                    'project_id' => $new_project->id,
                    'comment' => $row['commentaires'],
                    'category_id' => 7,
                    'user_id' => Auth::id()
                ]);
            } 

            if($row['comment_cq_date_commentaires']){ 
                ProjectComment::create([
                    'project_id' => $new_project->id,
                    'comment' => $row['comment_cq_date_commentaires'],
                    'category_id' => 7,
                    'user_id' => Auth::id()
                ]);
            } 

            if($row['mpr_oui_non'] || $row['montant_mpr']){ 
                $mpr_oui_non = $row['mpr_oui_non'];
                $montant_mpr = $row['montant_mpr'];

                $message = "Mpr : $mpr_oui_non
                Montant mpr : $montant_mpr";

                ProjectComment::create([
                    'project_id' => $new_project->id,
                    'comment' => $message,
                    'category_id' => 7,
                    'user_id' => Auth::id()
                ]);
            } 

            if($row['situation']){
                $situation = str_replace('é', 'e', $row['situation']);
            } 
            NewProject2::create([
                'project_id' => $new_project->id,
                'manual_import' => 2,            
                'montant_cee' => $row['montant_cee']  ?? null,            
                'precariousness' => $situation,
            ]);
            
            if($row['avis_fiscal'] && $row['reference_avis']){

                $avis_fiscal_arr = explode('//', $row['avis_fiscal']);
                $reference_avis_arr = explode('//', $row['reference_avis']);

                $tax1 = ProjectTax::create([
                    'tax_number'        => trim($avis_fiscal_arr[0]),
                    'tax_reference'     => trim($reference_avis_arr[0]),
                    'project_id'        => $new_project->id,
                    'type'              => 'manually',
                    'user_id'           => Auth::id(),
                    'primary'           => 'yes',
                    'last_name'         => $row['nom'] ?? null,
                    'first_name'        => $row['prenom'] ?? null,
                    'address2'          => $row['adresse_installation'] ?? null,
                    'city'              => $row['ville'] ?? null,
                    'postal_code'       => $row['cp'] ?? null,
                    'phone'             =>  $tel,
                    'email'             => $row['email_client'] ?? null,
                ]); 

                if(isset($avis_fiscal_arr[1]) && isset($reference_avis_arr[1])){
                    $tax2 = ProjectTax::create([
                        'tax_number'        => trim($avis_fiscal_arr[1]),
                        'tax_reference'     => trim($reference_avis_arr[1]),
                        'project_id'        => $new_project->id,
                        'type'              => 'manually',
                        'user_id'           => Auth::id(),
                        'primary'           => 'no',
                    ]); 
                }
            }

            // if($row['mandataire_admnistratif']){
                $subvention = new Subvention();
                $subvention->project_id = $new_project->id;
                if($row['mandataire_admnistratif'] == 'NOVCO'){
                    $subvention->mandataire = 'NOVECOLOGY';
                }
                if($row['statut_mpr'] == 'Demande de subvention: Déposé'){
                    $subvention->subvention_status = 'Demande de subvention déposé';
                }else if($row['statut_mpr'] == 'Demande de solde: Déposé'){
                    $subvention->subvention_status = 'Demande de solde déposé';
                }else if($row['statut_mpr'] == 'Demande de subvention : Instruction en cours'){
                    $subvention->subvention_status = 'En cours d’instruction';
                }else if($row['statut_mpr'] == 'Demande de solde : Instruction en cours'){
                    $subvention->subvention_status = 'En cours d’instruction';
                }else if($row['statut_mpr'] == 'Demande de subvention : En attente de compléments demandé'){
                    $subvention->subvention_status = 'Demande de solde en attente de complément';
                }else if($row['statut_mpr'] == 'Subvention Rejetée'){
                    $subvention->subvention_status = 'Subvention rejetée';
                }else if($row['statut_mpr'] == "Recours en cours d'instruction"){
                    $subvention->subvention_status = 'En cours d’instruction';
                }

                $subvention->save();
            // }

            if($row['date_installation']){
                $intervention = new ProjectIntervention();

                $intervention->project_id = $new_project->id;
                $intervention->type = 'Installation';
                $intervention->Dossier_Installation = 'Oui';
                $intervention->Statut_Installation = 'Terminé - Complet'; 
                $intervention->Date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_installation']);
                
                $intervention->save();

            }
            if($row['montant_financement'] || $row['statut_financeur'] || $row['organisme_financement']){
                $banque = new BanqueDepot();
                $banque->project_id = $new_project->id;
                $banque->banque_montant = $row['montant_financement'];

                if($row['statut_financeur'] == 'Accepté'){
                    $banque->banque_status = 'Accord définitif';
                }else{
                    $banque->banque_status = $row['statut_financeur'];
                }

                if($row['organisme_financement'] == 'Domofinance'){
                    $banque->banque_id = 3;
                }else if($row['organisme_financement'] == 'Cetelem'){
                    $banque->banque_id = 4;
                }

                $banque->save();
            }
            return $new_project;
        }
        return;
    }
}
















