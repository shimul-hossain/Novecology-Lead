<?php

namespace App\Imports;

use App\Events\PannelLog;
use App\Jobs\LocationLatLon;
use Carbon\Carbon;
use App\Models\CRM\Lead;
use App\Models\LeadCustomField;
use App\Models\CustomLeadFilter;
use App\Models\CRM\CompanyFilter;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\PannelLogActivity;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Date;

class LeadsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */ 
    public $data = [];
    public $custom_field_column = [];
    public $regie;
    public $label;
    public $telecommercial;
    public $sub_status;

    public function __construct($data, $custom_field_column, $regie, $label, $telecommercial, $sub_status)
    {
        $this->data = $data;
        $this->custom_field_column = $custom_field_column;
        $this->regie = $regie;
        $this->label = $label;
        $this->telecommercial = $telecommercial;
        $this->sub_status = $sub_status;
    }


    public function model(array $row)
    {  
        // dd($this->lead_tracking_custom__field);
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
        $new_lead = new LeadClientProject(); 
        
        $new_lead->lead_label   = $this->label;
        $new_lead->lead_status  = 1;
        $new_lead->company_id   = 1;    
        if($this->sub_status){
            $new_lead->sub_status  = $this->sub_status;
        }
        $new_lead->import_regie = $this->regie;
        if($this->telecommercial){
            $new_lead->lead_telecommercial = $this->telecommercial;
        }

        foreach($row as $file_key => $file_value){
            foreach ($this->data as $data_key => $data_value){
                if($file_key == $data_value){
                    if($data_key == '__tracking__Fournisseur_de_lead'){
                        $fournisseur = Fournisseur::where('type', 'lead')->where('suplier', $file_value)->first();
                        if($fournisseur){
                            $new_lead->$data_key = $fournisseur->id; 
                        }else{
                            $new_lead->$data_key = $file_value; 
                        }
                    }else if($data_key == '__tracking__Date_demande_lead' || $data_key == '__tracking__Date_attribution_télécommercial' ){ 
                            if($file_value){
                                $new_lead->$data_key = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($file_value);  
                            }
                    }else{
                        $new_lead->$data_key = $file_value; 
                    }
                    if($data_key == 'Adresse'){
                        if($file_value){
                            // dispatch(new LocationLatLon($new_lead->id, $file_value)); 
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
                                $new_lead->latitude = $data['results'][0]['geometry']['location']['lat'];
                                $new_lead->longitude = $data['results'][0]['geometry']['location']['lng']; 
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
        }

        $lead_tracking_custom__field = array_combine($lead_tracking_custom_key, $lead_tracking_custom_value); 
        $new_lead->lead_tracking_custom_field_data = json_encode($lead_tracking_custom__field);   

        $personal_info_custom__field = array_combine($personal_information_custom_key, $personal_information_custom_value); 
        $new_lead->personal_info_custom_field_data = json_encode($personal_info_custom__field);   

        $eligibility_custom__field = array_combine($eligibility_custom_key, $eligibility_custom_value); 
        $new_lead->eligibility_custom_field_data = json_encode($eligibility_custom__field);   

        $information_logement_custom__field = array_combine($information_logement_custom_key, $information_logement_custom_value); 
        $new_lead->information_logement_custom_field_data = json_encode($information_logement_custom__field);   

        $situation_foyer_custom__field = array_combine($situation_foyer_custom_key, $situation_foyer_custom_value); 
        $new_lead->situation_foyer_custom_field_data = json_encode($situation_foyer_custom__field);   

        $project_custom__field = array_combine($project_custom_key, $project_custom_value); 
        $new_lead->project_custom_field_data = json_encode($project_custom__field);   

        $new_lead->save();
        $pannel_activity = PannelLogActivity::create([
            'key'           => 'new_prospect__import',
            'feature_id'    => $new_lead->id,
            'feature_type'  => 'lead',
            'user_id'       => Auth::id(), 
        ]);
        event(new PannelLog($pannel_activity->id));
        return $new_lead;
    }
}
