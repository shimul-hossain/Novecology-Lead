<?php

namespace App\Http\Controllers;

use App\Models\CRM\Client;
use App\Models\CRM\ClientAssign;
use App\Models\CRM\Information;
use App\Models\CRM\Intervention;
use App\Models\CRM\Project;
use App\Models\CRM\ProjectAssign;
use App\Models\CRM\ProjectStatus;
use App\Models\CRM\ProjectStatusPlanning;
use App\Models\CRM\Rapport;
use App\Models\CRM\SecondReport;
use App\Models\CRM\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectApiController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('checkToken');
    // }
    // Project list 
    public function index(){

        if(role() == 's_admin') 
        {
             $projects = Project::where('deleted_status', 'no')->get();
            } 
            else 
            {
                $ids = ProjectAssign::where('user_id', Auth::id())->orderBy('project_id')->get()->pluck('project_id'); 
                $projects = Project::whereIn('id', $ids)->where('deleted_status', 'no')->get();
        }
        return response()->json(['data' => $projects], 200);
    }
    
    // single Project 
    public function show($id){
            $project = Project::where('id', $id)->where('deleted_status', 'no')->first();
            $other = Work::where('project_id', $id)->first();
            $data1 = Rapport::where('project_id', $id)->first();
            $data2 = Information::where('project_id', $id)->first(); 
            $data4 = SecondReport::where('project_id', $id)->first();
            $data5 = Intervention::where('project_id', $id)->first();
            $client = Client::find($project->client_id);

            $data =  [
                        "id" =>  $project->id,
                        "project_name" =>  $project->project_name,
                        "first_name" =>  $project->first_name,
                        "last_name" =>  $project->last_name,
                        "phone" =>  $project->phone,
                        "email" =>  $project->email,
                        "pays" =>  $project->pays,
                        "image" =>  $project->image,
                        "department" =>  $project->department,
                        "precariousness" =>  $project->precariousness,
                        "zone" =>  $project->zone,
                        "postal_code" =>  $project->postal_code,
                        "city" =>  $project->city,
                        "address" =>  $project->address,
                        "present_address" =>  $project->present_address,
                        "address_lat" =>  $project->address_lat,
                        "address_lng" =>  $project->address_lng,
                        "nature_occupation" =>  $project->nature_occupation,
                        "occupation_type" =>  $project->occupation_type,
                        "fiscal_amount" =>  $project->fiscal_amount,
                        "foyer" =>  $project->foyer,
                        "family_person" =>  $project->family_person,
                        "date_fo_construction" =>  $project->date_fo_construction,
                        "auxiliary_heating" =>  $project->auxiliary_heating,
                        "heating_type" =>  $project->heating_type,
                        "second_heating_type" =>  $project->second_heating_type,
                        "other_second_heating_type" =>  $project->other_second_heating_type,
                        "transmitter_type" =>  $project->transmitter_type,
                        "number_of_radiator" =>  $project->number_of_radiator,
                        "radiator_type" =>  $project->radiator_type,
                        "other_radiator_type" =>  $project->other_radiator_type,
                        "hot_water_production" =>  $project->hot_water_production,
                        "hot_water_feature" =>  $project->hot_water_feature,
                        "volume" =>  $project->volume,
                        "annual_heating" =>  $project->annual_heating,
                        "adult_occupants" =>  $project->adult_occupants,
                        "child_occupants" =>  $project->child_occupants,
                        "family_situation" =>  $project->family_situation,
                        "mr_activity" =>  $project->mr_activity,
                        "mr_revenue" =>  $project->mr_revenue,
                        "mrs_activity" =>  $project->mrs_activity,
                        "mrs_revenue" =>  $project->mrs_revenue,
                        "monthly_credit" =>  $project->monthly_credit,
                        "revenue_credit" =>  $project->revenue_credit,
                        "living_space" =>  $project->living_space,
                        "cadstrable_plot" =>  $project->cadstrable_plot,
                        "house_over_15_years" =>  $project->house_over_15_years,
                        "comment" =>  $project->comment,
                        "date" =>  $project->date,
                        "company_id" =>  $project->company_id,
                        "client_id" =>  $project->client_id,
                        "client_name" =>  $client->first_name. ' ' .$client->last_name,
                        "client_address_lat" =>  $client->address_lat,
                        "client_address_lng" =>  $client->address_lng,
                        "client_address" =>  $client->present_address,
                        "lead_id" =>  $project->lead_id,
                        "user_id" =>  $project->user_id,
                        "batiment" => $project->house_over_15_years,
                        "status_chantier" =>  $project->status,
                        "travaux"       => $other->travaux, 
                        "status_financement"       => $other->financement, 
                        "reste_charge"       => $other->reste_charge,
                        'status_previsite'    => $data1->status_previsite, 
                        'client_previsite'    => $data1->customer_status_previsite, 
                        'statut_mpr_1'        => $data2->status_1,
                        'statut_mpr_2'        => $data2->status_2,  
                        'status_installation' => $data4->installation_status,
                        'preview_date' => $data5->preview_date,
                        "deleted_status" =>  $project->deleted_status,
                        "created_at" =>  $project->created_at,
                        "updated_at" =>  $project->updated_at,
                        'dynamic_status' => $project->getStatus->status ?? 'Pas de statut',
                        'type_of_installation' => $data4->installation_status,
                        'status_color' => getStatusColor($project->status),
                        'status_previsite_color' => getStatusPrevisiteColor($data1->status_previsite),
                        'status_installation_color' => getStatusColor($project->status),
                        'user_role'                 => role(),
                    ];
        
        return response()->json(['data' => $data], 200);    
    }

    public function userProject(){
        
        if(role() == 's_admin') 
        {
            $ids = Project::where('deleted_status', 'no')->pluck('id');
        } 
        else 
        {
            $ids = ProjectAssign::where('user_id', Auth::id())->orderBy('project_id')->get()->pluck('project_id'); 

        }

        // $data = Project::findMany($id);
        
        // foreach($id as $i)
        // {
        //     $mydata[] = Work::where('project_id', $i)->firstOrFail(); 


        // }

        foreach($ids as $key =>  $id)
        {
            $project = Project::find($id); 

            $other = Work::where('project_id', $id)->first();
            $data1 = Rapport::where('project_id', $id)->first();
            $data2 = Information::where('project_id', $id)->first(); 
            $data4 = SecondReport::where('project_id', $id)->first();
            $data5 = Intervention::where('project_id', $id)->first();
            $client = Client::find($project->client_id);

            $data[$key] =  [

                            "id" =>  $project->id,
                            "project_name" =>  $project->project_name,
                            "first_name" =>  $project->first_name,
                            "last_name" =>  $project->last_name,
                            "phone" =>  $project->phone,
                            "email" =>  $project->email,
                            "pays" =>  $project->pays,
                            "image" =>  $project->image,
                            "department" =>  $project->department,
                            "precariousness" =>  $project->precariousness,
                            "zone" =>  $project->zone,
                            "postal_code" =>  $project->postal_code,
                            "city" =>  $project->city,
                            "address" =>  $project->address,
                            "present_address" =>  $project->present_address,
                            "address_lat" =>  $project->address_lat,
                            "address_lng" =>  $project->address_lng,
                            "nature_occupation" =>  $project->nature_occupation,
                            "occupation_type" =>  $project->occupation_type,
                            "fiscal_amount" =>  $project->fiscal_amount,
                            "foyer" =>  $project->foyer,
                            "family_person" =>  $project->family_person,
                            "date_fo_construction" =>  $project->date_fo_construction,
                            "auxiliary_heating" =>  $project->auxiliary_heating,
                            "heating_type" =>  $project->heating_type,
                            "second_heating_type" =>  $project->second_heating_type,
                            "other_second_heating_type" =>  $project->other_second_heating_type,
                            "transmitter_type" =>  $project->transmitter_type,
                            "number_of_radiator" =>  $project->number_of_radiator,
                            "radiator_type" =>  $project->radiator_type,
                            "other_radiator_type" =>  $project->other_radiator_type,
                            "hot_water_production" =>  $project->hot_water_production,
                            "hot_water_feature" =>  $project->hot_water_feature,
                            "volume" =>  $project->volume,
                            "annual_heating" =>  $project->annual_heating,
                            "adult_occupants" =>  $project->adult_occupants,
                            "child_occupants" =>  $project->child_occupants,
                            "family_situation" =>  $project->family_situation,
                            "mr_activity" =>  $project->mr_activity,
                            "mr_revenue" =>  $project->mr_revenue,
                            "mrs_activity" =>  $project->mrs_activity,
                            "mrs_revenue" =>  $project->mrs_revenue,
                            "monthly_credit" =>  $project->monthly_credit,
                            "revenue_credit" =>  $project->revenue_credit,
                            "living_space" =>  $project->living_space,
                            "cadstrable_plot" =>  $project->cadstrable_plot,
                            "house_over_15_years" =>  $project->house_over_15_years,
                            "comment" =>  $project->comment,
                            "date" =>  $project->date,
                            "company_id" =>  $project->company_id,
                            "client_id" =>  $project->client_id,
                            "client_name" =>  $client->first_name. ' ' .$client->last_name,
                            "client_address_lat" =>  $client->address_lat,
                            "client_address_lng" =>  $client->address_lng,
                            "client_address" =>  $client->present_address,
                            "lead_id" =>  $project->lead_id,
                            "user_id" =>  $project->user_id,
                            "batiment" => $project->house_over_15_years,
                            "status_chantier" =>  $project->status,
                            "travaux"       => $other->travaux, 
                            "status_financement"       => $other->financement, 
                            "reste_charge"       => $other->reste_charge,
                            'status_previsite'    => $data1->status_previsite, 
                            'client_previsite'    => $data1->customer_status_previsite, 
                            'statut_mpr_1'        => $data2->status_1,
                            'statut_mpr_2'        => $data2->status_2,  
                            'status_installation' => $data4->installation_status,
                            'preview_date' => $data5->preview_date,
                            "deleted_status" =>  $project->deleted_status,
                            "created_at" =>  $project->created_at,
                            "updated_at" =>  $project->updated_at,
                            'dynamic_status' => $project->getStatus->status ?? 'Pas de statut',
                            'type_of_installation' => $data4->installation_status,
                            'status_color' => getStatusColor($project->status),
                            'status_previsite_color' => getStatusPrevisiteColor($data1->status_previsite),
                            'status_installation_color' => getStatusColor($project->status),
                            'user_role'                 => role(),

            ];

            }

                return response()->json(['data' => $data], 200);


    }


    public function projectTravaux(Request $request){

       $data1 = Rapport::where('project_id', $request->project_id)->first();
       $data2 = Information::where('project_id', $request->project_id)->first();
       $data3 = Work::where('project_id', $request->project_id)->first();
       $data4 = SecondReport::where('project_id', $request->project_id)->first();
   
   
       $data =  [
           'status_previsite'    => $data1->status_previsite, 
           'statut_mpr_1'        => $data2->status_1,
           'statut_mpr_2'        => $data2->status_2, 
           'financement'         => $data3->financement,
           'statut_installation' => $data4->installation_status,
   
       ]; 
   
       return response()->json(['data' => $data], 200);
    }

    public function projectStatus(){
       $data = ProjectStatus::all();  

       $status_previsite = $data->where('name', 'Statut previsite')->pluck('status'); 
       $status_installation = $data->where('name', 'Statut Installation')->pluck('status'); 
       $status_chantier =  ProjectStatusPlanning::pluck('status');
       $status_financement = $data->where('name', 'Financement')->pluck('status'); 
       $client_previsite = $data->where('name', 'Statut Client Prévisite')->pluck('status'); 
       $status_header = ['Statut previsite', 'Statut installation', 'Financement', 'Statut client prévisite', 'Statut planning'];
       return response()->json(['status_previsite' =>  $status_previsite, 'status_installation' => $status_installation, 'status_chantier' => $status_chantier, 'status_financement' => $status_financement, 'client_previsite' => $client_previsite, 'status_header' => $status_header], 200);
    //    return  response()->json(['data'  => $data], 200);
    }

    public function projectByStatus(Request $request){ 
        
            $status_previsite = $request->status_previsite;
            $installation_status = $request->status_installation;
            $status_mpr = $request->status_mpr;
            $status_chantier = $request->status_chantier;
            $financement = $request->financement;
            $client_previsite = $request->client_previsite;   


            $all = $request->all(); 


            foreach($all as $key =>  $a)
            {

                $data = [];
                if(role() == 's_admin') 
                {
                    $ids = Project::where('deleted_status', 'no')->pluck('id');
                } 
                else 
                {
                    $ids = ProjectAssign::where('user_id', Auth::id())->orderBy('project_id')->get()->pluck('project_id');
                }

                $projects = Project::with('get_report', 'get_info', 'get_second_report')->get();  



                return response($projects);
                // $other   = Work::where('project_id', $id)->firstOrFail(); 


                // foreach($ids as $i =>  $id)
                // {

                    
                //     $projects = Project::with('get_report', 'get_info', 'get_second_report')->where('id', $id)->where('customer_status_previsite', $client_previsite)->orWhere('status_previsite', $status_previsite)->orWhere('status_1', $status_mpr)->orWhere('installation_status', $installation_status)->get();  
                //     $other   = Work::where('project_id', $id)->firstOrFail(); 
           
                //     if($key == 'client_previsite' || $key == 'status_previsite')
                //     {

                //         $data1[$i]   = Rapport::where('project_id', $id)->where('customer_status_previsite', $client_previsite)->orWhere('status_previsite', $status_previsite)->first();
                //         // return response()->json($data1[$i]);
                //     }

                //     if($key == 'status_mpr')
                //     {
                //         $data2[$i]   = Information::where('project_id', $id)->where('status_1', $status_mpr)->first(); 
                //     }

                //     if($key == 'status_installation')
                //     {
                //         $data4[$i]   = SecondReport::where('project_id', $id)->where('installation_status', $installation_status)->first(); 
                //     }
                  
                //     $data5    = Intervention::where('project_id', $id)->first();  
                    

                //      if(isset($data1[$i]) || isset($data2[$i]) || isset($data4[$i]))
                //      {
                       
                                
                //             $data[] =  [ 
                //                 "id" =>  $project->id,
                //                 "project_name" =>  $project->project_name,
                //                 "first_name" =>  $project->first_name,
                //                 "last_name" =>  $project->last_name,
                //                 "phone" =>  $project->phone,
                //                 "email" =>  $project->email,
                //                 "pays" =>  $project->pays,
                //                 "image" =>  $project->image,
                //                 "department" =>  $project->department,
                //                 "precariousness" =>  $project->precariousness,
                //                 "zone" =>  $project->zone,
                //                 "postal_code" =>  $project->postal_code,
                //                 "city" =>  $project->city,
                //                 "address" =>  $project->address,
                //                 "present_address" =>  $project->present_address,
                //                 "address_lat" =>  $project->address_lat,
                //                 "address_lng" =>  $project->address_lng,
                //                 "nature_occupation" =>  $project->nature_occupation,
                //                 "occupation_type" =>  $project->occupation_type,
                //                 "fiscal_amount" =>  $project->fiscal_amount,
                //                 "foyer" =>  $project->foyer,
                //                 "family_person" =>  $project->family_person,
                //                 "date_fo_construction" =>  $project->date_fo_construction,
                //                 "auxiliary_heating" =>  $project->auxiliary_heating,
                //                 "heating_type" =>  $project->heating_type,
                //                 "second_heating_type" =>  $project->second_heating_type,
                //                 "other_second_heating_type" =>  $project->other_second_heating_type,
                //                 "transmitter_type" =>  $project->transmitter_type,
                //                 "number_of_radiator" =>  $project->number_of_radiator,
                //                 "radiator_type" =>  $project->radiator_type,
                //                 "other_radiator_type" =>  $project->other_radiator_type,
                //                 "hot_water_production" =>  $project->hot_water_production,
                //                 "hot_water_feature" =>  $project->hot_water_feature,
                //                 "volume" =>  $project->volume,
                //                 "annual_heating" =>  $project->annual_heating,
                //                 "adult_occupants" =>  $project->adult_occupants,
                //                 "child_occupants" =>  $project->child_occupants,
                //                 "family_situation" =>  $project->family_situation,
                //                 "mr_activity" =>  $project->mr_activity,
                //                 "mr_revenue" =>  $project->mr_revenue,
                //                 "mrs_activity" =>  $project->mrs_activity,
                //                 "mrs_revenue" =>  $project->mrs_revenue,
                //                 "monthly_credit" =>  $project->monthly_credit,
                //                 "revenue_credit" =>  $project->revenue_credit,
                //                 "living_space" =>  $project->living_space,
                //                 "cadstrable_plot" =>  $project->cadstrable_plot,
                //                 "house_over_15_years" =>  $project->house_over_15_years,
                //                 "comment" =>  $project->comment,
                //                 "date" =>  $project->date,
                //                 "company_id" =>  $project->company_id,
                //                 "client_id" =>  $project->client_id,
                //                 "lead_id" =>  $project->lead_id,
                //                 "user_id" =>  $project->user_id,
                //                 "status" =>  $project->status,
                //                 "travaux"       => $other->travaux, 
                //                 "financement"       => $other->financement, 
                //                 "reste_charge"       => $other->reste_charge,
                //                 'status_previsite'    => $project->get_report->status_previsite, 
                //                 'statut_mpr_1'        => $project->get_info->status_1,
                //                 'statut_mpr_2'        => $project->get_info->status_2,  
                //                 'statut_installation' => $project->get_second_report->installation_status,
                //                 'preview_date' => $data5->preview_date,
                //                 "deleted_status" =>  $project->deleted_status,
                //                 "created_at" =>  $project->created_at,
                //                 "updated_at" =>  $project->updated_at,
                //             ];
                //      }
                    



                //     }
              





            } 

    

     
        // $data1->customer_status_previsite == $client_previsite || $data1->status_previsite == $status_previsite || $data4->installation_status == $status_installation || $data2->status_1 == $status_mpr ||  $project->status == $status_chantier || getFeature($other->financement, $financement)

        if(count($data) > 0)
        {
            return  response()->json(['data' => $data], 200);
        }
        else 
        {
            return response()->json(['error' => "No projects found according to filter"]);
        }
    }
}
