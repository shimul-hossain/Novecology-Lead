<?php

namespace App\Http\Controllers\CRM;

use App\Events\PannelLog;
use Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\CRM\Tax;
use App\Models\CRM\Lead;
use App\Models\CRM\Work;
use App\Models\CRM\Scale;
use App\Models\CRM\Client;
use App\Exports\LeadExport;
use App\Models\CRM\Company;
use App\Models\CRM\Project;
use App\Models\CRM\Rapport;
use App\Exports\CheckExport;
use App\Exports\CompanyLead;
use App\Exports\RingoverNumberExport;
use App\Imports\LeadsImport;
use App\Mail\CRM\AssignMail;
use App\Models\CRM\Children;
use App\Models\CRM\Question;
use App\Models\CRM\ZoneInfo;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Models\CRM\LeadAssign;
use App\Models\CRM\LeadStatus;
use App\Models\CRM\SecondLead;
use App\Models\CRM\TravauxTag;
use App\Imports\NewLeadImports;
use App\Imports\NewLeadsImport;
use App\Models\CRM\Information;
use App\Models\CRM\LeadProject;
use App\Models\CRM\LeadTracker;
use App\Models\CRM\TravauxList;
use App\Mail\CRM\LeadAssignMail;
use App\Models\CRM\InsideFrance;
use App\Models\CRM\Intervention;
use App\Models\CRM\ProjectTrait;
use App\Models\CRM\SecondClient;
use App\Models\CRM\SecondReport;
use App\Models\CustomLeadFilter;
use App\Models\CRM\Notifications;
use App\Models\CRM\OutsideFrance;
use App\Models\CRM\SecondProject;
use App\Mail\CRM\NotificationMail;
use App\Models\CRM\PreInstallation;
use App\Http\Controllers\Controller;
use App\Mail\AutomatisationMail;
use App\Mail\CRM\CommentMentionMail;
use App\Models\Automatise;
use App\Models\Brand;
use App\Models\CRM\BaremeTravauxTag;
use App\Models\CRM\ClientBareme;
use App\Models\CRM\ClientProductNombre;
use App\Models\CRM\ClientTagProduct;
use App\Models\CRM\ClientTax;
use App\Models\CRM\ClientTracker;
use App\Models\CRM\ClientTravaux;
use App\Models\CRM\ClientTravauxTag;
use App\Models\CRM\DefaultHeaderFilter;
use App\Models\CRM\Fournisseur;
use App\Models\CRM\LeadHeaderFilter;
use App\Models\CRM\PostInstallation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\CRM\SecondInformation;
use Illuminate\Support\Facades\Session;
use App\Models\CRM\InterventionInstallation;
use App\Models\CRM\LeadActivityLog;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\LeadComment;
use App\Models\CRM\LeadCommentFile;
use App\Models\CRM\LeadHeader;
use App\Models\CRM\LeadProductNombre;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\LeadTax;
use App\Models\CRM\LeadTaxDeclarant;
use App\Models\CRM\LeadTravauxTag;
use App\Models\CRM\LeadWorkBareme;
use App\Models\CRM\LeadWorkTagProduct;
use App\Models\CRM\LeadWorkTravaux;
use App\Models\CRM\NewClient;
use App\Models\CRM\NewProject;
use App\Models\CRM\PannelLogActivity;
use App\Models\CRM\ProjectAssign;
use App\Models\CRM\ProjectBareme;
use App\Models\CRM\ProjectComment;
use App\Models\CRM\ProjectCommentFile;
use App\Models\CRM\ProjectCustomField;
use App\Models\CRM\ProjectGestionnaire;
use App\Models\CRM\ProjectProductNombre;
use App\Models\CRM\ProjectTag;
use App\Models\CRM\ProjectTagProduct;
use App\Models\CRM\ProjectTax;
use App\Models\CRM\ProjectTravaux;
use App\Models\CRM\ProjectTravauxTag;
use App\Models\CRM\Regie;
use App\Models\CRM\StatusChangeLog;
use App\Models\EmailTemplate;
use App\Models\LeadCustomField;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use DOMXPath;
use Exception;
use GuzzleHttp\Client as TAClient;
use Maatwebsite\Excel\HeadingRowImport;

use function PHPSTORM_META\type;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Throwable;

class LeadController extends Controller
{
    // Create New Lead 
    public function createLead(Request $request){

        if($request->x_lead_id){
            $lead = Lead::findOrFail($request->x_lead_id);
            $lead->tracker_name     = $request->tracker_name;
            $lead->tracker_platform = $request->tracker_platform;
            $lead->tracker_email    = $request->tracker_email;
            $lead->tracker_phone    = $request->tracker_phone;
            $lead->save();
        }else{

            $lead = Lead::create($request->except('_token','x_lead_id') + ['created_at' => Carbon::now()]);
            
        }
 
        return redirect()->route('leads.index',[$lead->company_id ,$lead->id]);
    }
    
    // update Image 
    public function updateImage(Request $request){
        
        $data = Lead::findOrFail($request->lead_id);

        if($request->file('image')){
            
            $image = $request->file('image'); 
            $filename = $data->id . '.' . $image->extension('image');
            $location = public_path('uploads/crm/leads');
            $image->move($location, $filename);
            $data->image = $filename;
            $data->save(); 
        }
        
        return back()->with('success', __('Image Updated Successfully'));   
    }

    // Update Project 
    public function projectUpdate(Request $request){
        $lead = Lead::findOrFail($request->lead_id);
        $lead->project_name = $request->project_name;
        $lead->save();
        return response()->json(['project_name' => $lead->project_name, 'alert' => __('Project Updated')] );
    }

    // update personal info 
    public function infoUpdate(Request $request){
            
        $lead = Lead::findOrFail($request->lead_id);
        $lead->first_name   = $request->first_name;
        $lead->last_name    = $request->last_name;
        $lead->phone        = $request->phone;
        $lead->email        = $request->email;
        $lead->pays         = $request->pays;
        $lead->postal_code  = $request->postal_code;
        $lead->city         = $request->city;
        $lead->address      = $request->address;
        $lead->save(); 
        
        return response()->json(['first_name' =>$lead->first_name, 'last_name' =>$lead->last_name, 'phone' => $lead->phone, 'email' => $lead->email, 'department' =>$lead->city, 'zone' => $lead->postal_code, 'alert' => __('Personal Info Updated')]);
    }

    // Update Tax info
    public function taxUpdate(Request $request){  

        $all_taxess = LeadTax::where('lead_id', $request->lead_id)->get(); 

        // if(Tax::where('tax_number',$request->tax_number)->where('tax_reference', $request->tax_reference)->exists()){
        //     return response()->json(['error' => __('This fiscal and reference notice already exists')]);
        // }
        // else{
            function downloadPage( $sURL, 
            $iConnectionTimeOut = 110, 
            $iTimeOut = 110,
            $aHeaders = array(),
            $sPostData = '')
            {
            $sUserAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2112.0 Safari/537.36';
            $sContent = ''; 
            $ch = curl_init();
            !empty($aHeaders) ?curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders):'';
            !empty($sProxy)   ?curl_setopt($ch, CURLOPT_PROXY, $sProxy):'';	
            if(!empty($sPostData))
            {
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$sPostData);
            }
            curl_setopt($ch, CURLOPT_USERAGENT,$sUserAgent);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HEADER, false);  	
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$iConnectionTimeOut);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, $iTimeOut);
            curl_setopt($ch, CURLOPT_URL, $sURL);
            curl_setopt($ch, CURLOPT_ENCODING, "gzip");
            $sContent = curl_exec($ch);
            $aInfo = curl_getinfo($ch);
            curl_close($ch);
            $sContent = str_replace("\t","",$sContent);
            $sContent = str_replace("\r","",$sContent);
            $sContent = str_replace("\n","",$sContent);
            return $sContent;
            }
            $sFiscal  = $request->tax_number;
            $sFacture  = $request->tax_reference;
            $aAnswer = [];
            $sURL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf';
            $sHTML = downloadPage($sURL);
            preg_match("/name=\"javax.faces.ViewState\" id=\"j_id__v_0:javax.faces.ViewState:1\" value=\"(.*?)\"/",$sHTML,$aData);
            $sViewState = isset($aData[1])?$aData[1]:'';
            $sPost = 'j_id_7%3Aspi='.$sFiscal.'&j_id_7%3Anum_facture='.$sFacture.'&j_id_7%3Aj_id_l=Valider&j_id_7_SUBMIT=1&javax.faces.ViewState='.urlencode($sViewState);
            $aHeaders = ['Host: cfsmsp.impots.gouv.fr',
                        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                        'Accept-Language: en-GB,en;q=0.5',
                        'Accept-Encoding: gzip, deflate, br',
                        'Referer: https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf',
                        'Content-Type: application/x-www-form-urlencoded',
                        'Origin: https://cfsmsp.impots.gouv.fr',
                        'DNT: 1',
                        'Connection: keep-alive',
                        'Upgrade-Insecure-Requests: 1',
                        'Sec-Fetch-Dest: document',
                        'Sec-Fetch-Mode: navigate',
                        'Sec-Fetch-Site: same-origin',
                        'Sec-Fetch-User: ?1'];
            $sURL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf';
            $sHTML = downloadPage( $sURL,110,110,[],$sPost);
            /*Parse Data*/
            preg_match('/<td class="labelImpair">Nom de naissance\s*<\/td>\s*<td class="labelImpair">(.*?)<\/td>\s*<td class="labelImpair">(.*?)<\/td>/', $sHTML, $aData);
            $aAnswer['declarant_1'] = isset($aData[1])?trim($aData[1]):'';
            $aAnswer['declarant_2'] = isset($aData[2])?trim($aData[2]):''; 

            preg_match('/<td class="labelPair">Nom\s*<\/td>\s*<td class="labelPair">(.*?)<\/td>\s*<td class="labelPair">(.*?)<\/td>/', $sHTML, $aData);
            $aAnswer['noms_declarant_1'] = isset($aData[1])?trim($aData[1]):'';
            $aAnswer['noms_declarant_2'] = isset($aData[2])?trim($aData[2]):'';
            

            preg_match('/<td class="labelPair">Prénom\(s\)\s*<\/td>\s*<td class="labelPair">(.*?)<\/td>\s*<td class="labelPair">(.*?)<\/td>/', $sHTML, $aData);
            $aAnswer['prenoms_declarant_1'] = isset($aData[1])?trim($aData[1]):'';
            $aAnswer['prenoms_declarant_2'] = isset($aData[2])?trim($aData[2]):'';


            preg_match('/<td class="labelImpair">Date de naissance\s*<\/td>\s*<td class="labelImpair">(.*?)<\/td>\s*<td class="labelImpair">(.*?)<\/td>/', $sHTML, $aData);
            $aAnswer['date_de_naissance_declarant_1'] = isset($aData[1])?trim($aData[1]):'';
            $aAnswer['date_de_naissance_declarant_2'] = isset($aData[2])?trim($aData[2]):'';



            preg_match('/Adresse déclarée au (.*?)<\/td>\s*<td class="labelPair">(.*?)<\/td>\s*<td class="labelPair">(.*?)<\/td>\s*<\/tr>\s*<tr>\s*<td class=\"labelPair\">\s*<\/td>\s*<td colspan=\"2\" class=\"labelPair\">(.*?)<\/td>\s*<\/tr>/', $sHTML, $aData);


            $aAnswer['address_date'] = isset($aData[1])?trim(strip_tags($aData[1])):'';
            $aAnswer['address_1'] = isset($aData[2])?trim($aData[2]):'';
            $aAnswer['address_2'] = isset($aData[4])?trim($aData[4]):'';

            preg_match('/Date de mise en recouvrement de l\'avis d\'impôt\s*<\/td>\s*<td class=\"textPair\">(.*?)<\/td>\s*<\/tr>/',$sHTML,$aData);
            $aAnswer['date_recouvrement'] = isset($aData[1])?trim($aData[1]):'';
            
            preg_match('/Date d\'établissement\s*<\/td>\s*<td class=\"textImpair\">(.*?)<\/td>\s*<\/tr>/',$sHTML,$aData);
            $aAnswer['date_of_establishment'] = isset($aData[1])?trim($aData[1]):'';
            
            preg_match('/Nombre de personne\(s\) à charge\s*<\/td>\s*<td class=\"textPair\">(.*?)<\/td>\s*<\/tr>/',$sHTML,$aData);         
            $aAnswer['nombre_de_personnes'] = isset($aData[1])?trim($aData[1]):'';
            
            preg_match('/Revenu fiscal de référence\s*<\/td>\s*<td class=\"textImpair\">(.*?) €\s*<\/td>\s*<\/tr>/',$sHTML,$aData);         
            $aAnswer['date_de_personnes'] = isset($aData[1])?preg_replace('/\xc2\xa0/', '',str_replace(' ','',$aData[1])):'';
            
            // $aJSONAnswer = json_encode($aAnswer);
            header('Content-type: application/json');
            // echo($aAnswer['declarant_1']); 
            // echo($aAnswer['declarant_2']); 
            // echo($aAnswer['noms_declarant_1']); 
            // echo($aAnswer['noms_declarant_2']); 
            // echo($aAnswer['prenoms_declarant_1']); 
            // echo($aAnswer['prenoms_declarant_2']); 
            // echo($aAnswer['address_1']); 
            // echo($aAnswer['address_2']); 
            // echo($aAnswer['nombre_de_personnes']); 
            // echo($aAnswer['date_de_personnes']); 

            if($aAnswer['prenoms_declarant_1']){

                /////////////////////////////////////////////////////////////////////


                // echo($aAnswer['noms_declarant_1'].'---');
                // echo($aAnswer['date_de_naissance_declarant_1'].'---');
                // echo($sFiscal.'---');
                // echo($aAnswer['date_de_personnes']);

                // die(); 
                $city = explode(' ', $aAnswer['address_2']);
                $location =  self::location($aAnswer['address_1']);
                array_shift($city); 
                $taxx =  LeadTax::create([
                    'lead_id'               => $request->lead_id,  
                    'tax_number'            => $request->tax_number, 
                    'tax_reference'         => $request->tax_reference, 
                    'first_name'            => $aAnswer['prenoms_declarant_1'],
                    'last_name'             => $aAnswer['noms_declarant_1'],
                    'second_first_name'     => $aAnswer['prenoms_declarant_2'] ?? null, 
                    'second_last_name'      => $aAnswer['noms_declarant_2'] ?? null, 
                    'kids'                  => $aAnswer['nombre_de_personnes'] ?? 0,
                    'pays'                  => $aAnswer['date_de_personnes'],
                    'city'                  => implode(' ', $city), 
                    'department'            => getDepartment2(substr($aAnswer['address_2'], 0,5)),
                    'postal_code'           => substr($aAnswer['address_2'], 0,5), 
                    'address'               => $aAnswer['address_1'] . ' ' .$aAnswer['address_2'],
                    'address2'              => $aAnswer['address_1'],
                    'google_address'        => $aAnswer['address_1'],
                    'latitude'              => $location['status'] == 'success' ? $location['lat']:'',
                    'longitude'             => $location['status'] == 'success' ? $location['lng']:'',
                    'user_id'           => Auth::id(),
                ]);
                // $client = new \GuzzleHttp\Client();
                // $request = $client->get('http://13.39.59.11:3000/api/scrap?family_name=QUEIROS MOREIRA&dob=06/04/1980&tax_number=3013358695382&ref_tax_income=26035');  


                if($taxx->second_first_name){
                    $person = 2 + $taxx->kids;
                }
                else{
                    $person = 1 + $taxx->kids;
                } 

                $MaPrimeRénov = Http::get('http://13.39.59.11:3000/api/scrap?family_name='.$aAnswer['prenoms_declarant_1'].'&dob='.$aAnswer['date_de_naissance_declarant_1'].'&tax_number='.$sFiscal.'&ref_tax_income='.$aAnswer['date_de_personnes']); 

                $taxx->family_person = $person;
                $taxx->MaPrimeRénov_status = json_decode($MaPrimeRénov->getBody()->getContents())->status;
                $lead = LeadClientProject::find($request->lead_id);

                if($all_taxess->count() > 0)
                    { 
                    $taxx->primary = 'no'; 
                    } 
                else{
                    $taxx->primary = 'yes';
                    $taxx->mark_check = 'yes';
                    $taxx->save(); 
                    $lead->Prenom                           = $taxx->first_name;
                    $lead->Nom                              = $taxx->last_name;
                    $lead->Revenue_Fiscale_de_Référence     = $taxx->pays;
                    $lead->Nombre_de_personnes              = $person;
                    $lead->Ville                            = $taxx->city;
                    $lead->Code_Postal                      = $taxx->postal_code;
                    $lead->Département                      = getDepartment3($taxx->postal_code);
                    $lead->Zone                             = getPrimaryZone($taxx->postal_code);
                    if($lead->precariousness_year == '2023'){
                        $lead->precariousness                   = getPrecariousness($person, $taxx->pays, $taxx->postal_code);
                    }else{
                        $lead->precariousness                   = getPrecariousness2024($person, $taxx->pays, $taxx->postal_code);
                    }
                    $lead->Adresse                          = $taxx->address2; 
                    $lead->Complément_adresse               = $taxx->address; 
                    $lead->latitude                         = $taxx->latitude; 
                    $lead->longitude                        = $taxx->longitude; 
                    $lead->lead_user_id                     = Auth::id();
                    $lead->save();

                    // $user = User::find(1);
                    // $name = Auth::user()->name;
                    // $subject = 'New Lead Create'; 
                    //     $body = 'A new Lead have been created by '.$name; 
                    // Mail::to($user->email)->send(new NotificationMail($subject, $body));

                    // $notification = Notifications::create([
                    //     'title'  => ['en' => 'Leads Creste', 'fr' =>'Les prospects créent'],
                    //     'body'   => ['en' =>  'A new Lead have been created by '.Auth::user()->name, 'fr' => 'Un nouveau Prospect a été créé par '.Auth::user()->name ],
                    //     'user_id' => 1,
                    //     'lead_id' => $lead->id
                    // ]);
                }

                $taxx->save(); 

                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => "Avis d'impôt",
                    'key'           => "Numéro d'exercice",
                    'value'         => $taxx->tax_number,
                    'feature_id'    => $request->lead_id,
                    'feature_type'  => 'lead',
                    'user_id'       => Auth::id(), 
                ]);
                event(new PannelLog($pannel_activity->id));
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => "Avis d'impôt",
                    'key'           => "Avis de référence",
                    'value'         => $taxx->tax_reference,
                    'feature_id'    => $request->lead_id,
                    'feature_type'  => 'lead',
                    'user_id'       => Auth::id(), 
                ]);
                event(new PannelLog($pannel_activity->id));

                    $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
                    $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
                    $activity = $activity_log->render(); 

                    $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
                    $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();
            
                    $view = view('includes.crm.view-notification', compact('notification')); 
                    $response = $view->render();


                    $tax = LeadTax::where('lead_id', $request->lead_id)->orderBy('primary', 'asc')->get();
                    $primary_tax = LeadTax::where('lead_id', $request->lead_id)->where('primary', 'yes')->first();
                    $type = 'lead_collapse_personal_information';
                    $data = LeadClientProject::find($request->lead_id);
                    $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
                    $tax_all = $all_taxes->render();
                    // $tax = Tax::where('lead_id', $request->lead_id)->where('company_id', $request->company_id)->orderBy('primary', 'asc')->get();
                    $all_taxes_data = view('includes.crm.lead-tax', compact('tax'));
                    $tax_all_data = $all_taxes_data->render();
                    $all_taxes_data2 = view('includes.crm.lead-tax-info', compact('tax'));
                    $tax_all_data2 = $all_taxes_data2->render();
                    return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => __('tax added successfully'),'address' => $taxx->address,'address2' => $taxx->address2,'fiscal_amount' => $taxx->pays,'family_person' => $person,'zone' => getPrimaryZone($taxx->postal_code),'precariousness' => $lead->precariousness, 'city' => getDepartment($taxx->postal_code), 'name' => $taxx->first_name.' '.$taxx->last_name, 'email' => $taxx->email, 'phone' => $taxx->phone, 'primary'=> $taxx->primary, 'response' => $response, 'count'=>$count, 'log' => $activity]);  
                    // return response('tax added successfully');   
            }
            else{
                return response()->json(['error' => __('Wrong fiscal number and reference notice')]);
            }
        // } 
    }
    
    // Update Work Info 
    public function presentWorkUpdate(Request $request){
        
        $lead = LeadClientProject::findOrFail($request->lead_id); 
        $lead->Type_de_logement                                                 = $request->Type_de_logement;    
        $lead->Type_de_chauffage                                                = $request->Type_de_chauffage;    
        $lead->Mode_de_chauffage                                                = $request->Mode_de_chauffage;    
        $lead->Date_construction_maison                                         = $request->Date_construction_maison;    
        $lead->Surface_habitable                                                = $request->Surface_habitable;    
        $lead->Consommation_chauffage_annuel                                    = $request->Consommation_chauffage_annuel;    
        $lead->Surface_à_chauffer                                               = $request->Surface_à_chauffer;    
        $lead->Mode_de_chauffage__a__                                           = $request->Mode_de_chauffage__a__;    
        $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__  = $request->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;    
        $lead->Consommation_Chauffage_Annuel_2                                  = $request->Consommation_Chauffage_Annuel_2;    
        $lead->Depuis_quand_occupez_vous_le_logement                            = $request->Depuis_quand_occupez_vous_le_logement;    
        $lead->auxiliary_heating_status                                         = $request->auxiliary_heating_status;    
        $lead->second_heating_generator_status                                  = $request->second_heating_generator_status;    
        $lead->auxiliary_heating                                                = $request->auxiliary_heating;    
        $lead->auxiliary_heating__a__                                           = $request->auxiliary_heating__a__;    
        $lead->second_heating_generator                                         = $request->second_heating_generator;    
        $lead->second_heating_generator__a__                                    = $request->second_heating_generator__a__;    
        $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement       = $request->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;    
        $lead->Production_dapostropheeau_chaude_sanitaire                       = $request->Production_dapostropheeau_chaude_sanitaire;    
        $lead->Instantanné                                                      = $request->Instantanné;    
        $lead->Accumulation                                                     = $request->Accumulation;    
        $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude               = $request->Précisez_le_volume_du_ballon_dapostropheeau_chaude;    
        $lead->Information_logement_observations                                = $request->Information_logement_observations;    
        $lead->Préciser_le_type_de_radiateurs_Aluminium                         = $request->Préciser_le_type_de_radiateurs_Aluminium;    
        $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs    = $request->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;    
        $lead->Préciser_le_type_de_radiateurs_Fonte                             = $request->Préciser_le_type_de_radiateurs_Fonte;    
        $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;    
        $lead->Préciser_le_type_de_radiateurs_Acier                             = $request->Préciser_le_type_de_radiateurs_Acier;    
        $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;    
        $lead->Préciser_le_type_de_radiateurs_Autre                             = $request->Préciser_le_type_de_radiateurs_Autre;    
        $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs        = $request->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;    
        $lead->Préciser_le_type_de_radiateurs_Autre___a__                       = $request->Préciser_le_type_de_radiateurs_Autre___a__;    
        $lead->Type_du_courant_du_logement                                      = $request->Type_du_courant_du_logement;    
        $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude   = $request->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;  
        $lead->Instantanné_Merci_de_préciser                                    = $request->Instantanné_Merci_de_préciser;  
        $lead->Accumulation_Merci_de_préciser                                   = $request->Accumulation_Merci_de_préciser;  
        $lead->Le_logement_possède_un_réseau_hydraulique                        = $request->Le_logement_possède_un_réseau_hydraulique;  
        $lead->auxiliary_heating__Insert_à_bois_Nombre                          = $request->auxiliary_heating__Insert_à_bois_Nombre;  
        $lead->auxiliary_heating__Poêle_à_bois_Nombre                           = $request->auxiliary_heating__Poêle_à_bois_Nombre;  
        $lead->auxiliary_heating__Poêle_à_gaz_Nombre                            = $request->auxiliary_heating__Poêle_à_gaz_Nombre;  
        $lead->auxiliary_heating__Convecteur_électrique_Nombre                  = $request->auxiliary_heating__Convecteur_électrique_Nombre;  
        $lead->auxiliary_heating__Sèche_serviette_Nombre                        = $request->auxiliary_heating__Sèche_serviette_Nombre;  
        $lead->auxiliary_heating__Panneau_rayonnant_Nombre                      = $request->auxiliary_heating__Panneau_rayonnant_Nombre;  
        $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre                  = $request->auxiliary_heating__Radiateur_bain_dhuile_Nombre;  
        $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre          = $request->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;  
        $lead->auxiliary_heating__Autre_Nombre                                  = $request->auxiliary_heating__Autre_Nombre;  
        $lead->save();
        foreach($lead->getChanges() as $key => $value){
            if($key != "updated_at" && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => 'Chantier de travail',
                    'key'           => $key,
                    'value'         => $value, 
                    'feature_id'    => $request->lead_id,
                    'feature_type'  => 'lead',
                    'user_id'       => Auth::id(), 
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = []; 
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){  
                $input_key[] = $key;
                $input_item[] = $item;   
            }  
            $costom_field_data = array_combine($input_key, $input_item); 
            $json = json_encode($costom_field_data); 
            $lead->information_logement_custom_field_data = $json;
            $lead->save(); 
        }

        // $lead2 = SecondLead::where('lead_id', $request->lead_id)->first(); 
        // $lead2->update([
        //     'specify_heating' => $request->specify_heating,
        //     'other_heating' => $request->other_heating,
        //     'annual_heating' => $request->annual_heating,
        //     'Surface_à_chauffer' => $request->Surface_à_chauffer,
        //     'Merci_de_précisez' => $request->Merci_de_précisez,
        //     'autre_field__transmitter_type' => $request->autre_field__transmitter_type,
        //     'radiatuers_Aluminium' => $request->radiatuers_Aluminium,
        //     'radiatuers_Aluminium_Nombre' => $request->radiatuers_Aluminium_Nombre,
        //     'radiatuers_Fonte' => $request->radiatuers_Fonte,
        //     'radiatuers_Fonte_Nombre' => $request->radiatuers_Fonte_Nombre,
        //     'radiatuers_Acier' => $request->radiatuers_Acier,
        //     'radiatuers_Acier_Nombre' => $request->radiatuers_Acier_Nombre,
        //     'radiatuers_Autre' => $request->radiatuers_Autre,
        //     'radiatuers_Autre_Nombre' => $request->radiatuers_Autre_Nombre,
        //     'autre_field__radiatuers' => $request->autre_field__radiatuers,
        //     'le_logement' => $request->le_logement,
        //     'annual_heating2' => $request->annual_heating2,
        //     'with_basement' => $request->with_basement,
        //     'supplementary' => $request->supplementary,
        //     'heating_generator' => $request->heating_generator,
        //     'ovservations' => $request->ovservations,
        //     'Type_du_courant_du_logement' => $request->Type_du_courant_du_logement,
        // ]);
        // foreach($lead2->getChanges() as $key => $value){
        //     if($key != "updated_at"){
        //         $pannel_activity = PannelLogActivity::create([
        //             'tab_name'      => 'Client',
        //             'block_name'    => 'Chantier de travail',
        //             'key'           => $key,
        //             'value'         => $value,
        //             'feature_id'    => $request->lead_id,
        //             'feature_type'  => 'lead',
        //             'user_id'       => Auth::id(), 
        //         ]);
        //         event(new PannelLog($pannel_activity->id));
        //     }
        // } 

        



 
        $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
        $activity = $activity_log->render();
 
 
 
         return response()->json(['alert' => __('Lead Work Info Updated'), 'log' => $activity]); 
   
    }
    // Update Work Info 
    public function workUpdate(Request $request){
        
        $lead = LeadClientProject::findOrFail($request->lead_id); 
        $lead->Type_occupation                  = $request->Type_occupation;
        $lead->Parcelle_cadastrale              = $request->Parcelle_cadastrale;
        $lead->Nombre_de_foyer                  = $request->Nombre_de_foyer;
        $lead->Age_du_bâtiment                  = $request->Age_du_bâtiment; 
        $lead->Type_habitation                  = $request->Type_habitation; 
        // $lead->Revenue_Fiscale_de_Référence     = $request->Revenue_Fiscale_de_Référence;
        // $lead->Nombre_de_personnes              = $request->Nombre_de_personnes;
        // $lead->precariousness_year              = $request->precariousness_year; 
        // if($request->precariousness_year == '2023'){
        //     $lead->precariousness                   = getPrecariousness($request->Nombre_de_personnes, $request->Revenue_Fiscale_de_Référence, $lead->Code_Postal); 
        // }else{
        //     $lead->precariousness                   = getPrecariousness2024($request->Nombre_de_personnes, $request->Revenue_Fiscale_de_Référence, $lead->Code_Postal); 
        // }
        $lead->Zone                             = $request->Zone; 
        $lead->save();
 
        foreach($lead->getChanges() as $key => $value){
            if($key != "updated_at" && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => 'Eligibility',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->lead_id,
                    'feature_type'  => 'lead',
                    'user_id'       => Auth::id(), 
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = []; 
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){  
                $input_key[] = $key;
                $input_item[] = $item;   
            }  
            $costom_field_data = array_combine($input_key, $input_item); 
            $json = json_encode($costom_field_data); 
            $lead->eligibility_custom_field_data = $json;
            $lead->save(); 
        }


        $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
        $activity = $activity_log->render();

        return response()->json(['alert' => __('Lead Eligibility Updated'),  'log' => $activity, 'precariousness' => $lead->precariousness]); 
        // return response('hello');
    }
    
    // update telephone 
    public function updateTelephone(Request $request){
        
        $request->validate([
            'telephone' => 'required|numeric',
        ]);

        $data = Lead::findOrFail($request->lead_id);

        $data->phone = $request->telephone;

        $data->save();

        return response($data->phone);
    }
        
    // update Email 
    public function updateEmail(Request $request){
        
        $request->validate([
            'email' => 'required|email',
        ]); 
        $data = Lead::findOrFail($request->lead_id);

        $data->email = $request->email;

        $data->save();

        return response($data->email);
    }

    // update Department 
    public function updateDepartment(Request $request){ 

        $request->validate([
            'department' => 'required',
        ]);
        
        $data = Lead::findOrFail($request->lead_id);

        $data->department = $request->department;

        $data->save();

        return response($data->department);
    }
       
    // update Precarious 
    public function updatePrecarious(Request $request){
        
        $request->validate([
            'precarious' => 'required',
        ]);

        $data = Lead::findOrFail($request->lead_id);

        $data->precariousness = $request->precarious;

        $data->save();

        return response($data->precariousness);
    }
    
    // update Zone 
    public function updateZone(Request $request){
        
        $request->validate([
            'zone' => 'required',
        ]);

        $data = Lead::findOrFail($request->lead_id);

        $data->zone = $request->zone;

        $data->save();

        return response($data->zone);
    } 
    
    // Update status 
    public function updateStatus(Request $request){

        $lead = Lead::findOrFail($request->lead_id);
        if($lead->status == $request->status){
            // return response()->json('error', 'Status Already '.$request->status);
            return response()->json(['error' => __('Status Already').' '.$request->status]);
        }
        else{ 

            $lead->status = $request->status;
            $lead->save();

            $assignees = LeadAssign::where('lead_id', $lead->id)->get();
            
           $current_user = User::findOrFail(Auth::id()); 
           $lead_user = User::findOrFail($lead->user_id); 
           
           $user = User::find(1);
           $name = Auth::user()->name;
           $subject = 'Lead Status Change'; 
           $body = 'Lead Status have been Changed to '.$request->status .' by '.$name;
        //    if($user->email_professional){
        //        Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
        //    }

            $notification = Notifications::create([
                'title'  => ['en' => 'Lead Status Change', 'fr' =>'Changement de statut de prospect'],
                'body'   => ['en' => 'Lead Status have been Changed to '.$request->status .' by '. Auth::user()->name, 'fr' => 'Le statut du prospect a été modifié en '.$request->status .' par '. Auth::user()->name],
                'user_id' => 1,
                'lead_id' => $lead->id
                ]);

            if($assignees->count() > 0){
                foreach($assignees as $assignee){
                    $user = User::find($assignee->user_id);
                    $name = Auth::user()->name;
                    $subject = 'Lead Status Change'; 
                    $body = 'Lead Status have been Changed to '.$request->status .' by '.$name;
                    // if($user->email_professional){
                    //     Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
                    // }
                    $notification = Notifications::create([
                        'title'  => ['en' => 'Lead Status Change', 'fr' =>'Changement de statut de prospect'],
                        'body'   => ['en' => 'Lead Status have been Changed to '.$request->status .' by '. Auth::user()->name, 'fr' => 'Le statut du prospect a été modifié en '.$request->status.' par '. Auth::user()->name],
                        'user_id' => $assignee->user_id,
                        'lead_id' => $lead->id
                    ]);
                }
            }
            
            $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
            $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();

            $view = view('includes.crm.view-notification', compact('notification')); 
            $response = $view->render(); 
          
            // return response()->json('success', 'Status Change To '.$lead->status);
            return response()->json(['response' => $response, 'success' => __('Status Change To').' '.$lead->status, 'count'=>$count]);
        }

    }

    // Update Comments 
    public function updateComment(Request $request){


        $data = Lead::findOrFail($request->lead_id);
        $data->comment = $request->comment;
        $data->save();

        return response()->json(['comment' => $data->comment, 'alert' => __('Comment Updated')]);
    }

    // Lead To Client 
    public function leadToClient(Request $request){
        $lead = LeadClientProject::find($request->lead_id); 
        if($lead->lead_label == 7){
            return back();
        }
        $lead->lead_label = 7;
        $lead->sub_status = 5;
        $lead->etiquette_automatise_recurrence_status = 0;
        $lead->etiquette_automatise_id = 0;
        $lead->etiquette_fin = 0;
        $lead->etiquette_automatise_recurrence_start = null;
        $lead->statut_automatise_recurrence_status = 0;
        $lead->statut_automatise_id = 0;
        $lead->statut_fin = 0;
        $lead->statut_automatise_recurrence_start = null;
        $lead->save();
        $client = new NewClient(); 
        $client->lead_id                                                            = $lead->id;
        $client->company_id                                                         = $lead->company_id;
        $client->lead_telecommercial                                                = $lead->lead_telecommercial;
        $client->__tracking__Fournisseur_de_lead                                    = $lead->__tracking__Fournisseur_de_lead;
        $client->__tracking__Type_de_campagne                                       = $lead->__tracking__Type_de_campagne;
        $client->__tracking__Type_de_campagne__a__                                  = $lead->__tracking__Type_de_campagne__a__;
        $client->__tracking__Nom_campagne                                           = $lead->__tracking__Nom_campagne;
        $client->__tracking__Date_demande_lead                                      = $lead->__tracking__Date_demande_lead;
        $client->__tracking__Date_attribution_télécommercial                        = $lead->__tracking__Date_attribution_télécommercial;
        $client->__tracking__Type_de_travaux_souhaité                               = $lead->__tracking__Type_de_travaux_souhaité;
        $client->__tracking__Nom_Prénom                                             = $lead->__tracking__Nom_Prénom;
        $client->__tracking__Code_postal                                            = $lead->__tracking__Code_postal;
        $client->__tracking__Email                                                  = $lead->__tracking__Email;
        $client->__tracking__téléphone                                              = $lead->__tracking__téléphone;
        $client->__tracking__Département                                            = $lead->__tracking__Département;
        $client->__tracking__Mode_de_chauffage                                      = $lead->__tracking__Mode_de_chauffage;
        $client->__tracking__Mode_de_chauffage__a__                                 = $lead->__tracking__Mode_de_chauffage__a__;
        $client->__tracking__Propriétaire                                           = $lead->__tracking__Propriétaire;
        $client->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans         = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
        $client->Titre                                                              = $lead->Titre;    
        $client->Prenom                                                             = $lead->Prenom;
        $client->Nom                                                                = $lead->Nom;
        $client->Adresse                                                            = $lead->Adresse;
        $client->Complément_adresse                                                 = $lead->Complément_adresse;
        $client->Code_Postal                                                        = $lead->Code_Postal;
        $client->Ville                                                              = $lead->Ville;
        $client->Département                                                        = $lead->Département;
        $client->Email                                                              = $lead->Email;
        $client->same_as_work_address                                               = $lead->same_as_work_address;
        $client->Adresse_Travaux                                                    = $lead->Adresse_Travaux;
        $client->Complément_adresse_Travaux                                         = $lead->Complément_adresse_Travaux;
        $client->Code_postal_Travaux                                                = $lead->Code_postal_Travaux;
        $client->Ville_Travaux                                                      = $lead->Ville_Travaux;
        $client->Departement_Travaux                                                = $lead->Departement_Travaux;
        $client->phone                                                              = $lead->phone;
        $client->fixed_number                                                       = $lead->fixed_number;
        $client->Observations                                                       = $lead->Observations;
        $client->precariousness                                                     = $lead->precariousness;
        $client->Type_occupation                                                    = $lead->Type_occupation;
        $client->Parcelle_cadastrale                                                = $lead->Parcelle_cadastrale;
        $client->Revenue_Fiscale_de_Référence                                       = $lead->Revenue_Fiscale_de_Référence;
        $client->Nombre_de_foyer                                                    = $lead->Nombre_de_foyer;
        $client->Nombre_de_personnes                                                = $lead->Nombre_de_personnes;
        $client->Age_du_bâtiment                                                    = $lead->Age_du_bâtiment;
        $client->Zone                                                               = $lead->Zone;
        $client->Éligibilité_MaPrimeRenov                                           = $lead->Éligibilité_MaPrimeRenov;
        $client->Mode_de_chauffage                                                  = $lead->Mode_de_chauffage;
        $client->Mode_de_chauffage__a__                                             = $lead->Mode_de_chauffage__a__;
        $client->Date_construction_maison                                           = $lead->Date_construction_maison;
        $client->Surface_habitable                                                  = $lead->Surface_habitable;
        $client->Surface_à_chauffer                                                 = $lead->Surface_à_chauffer;
        $client->Consommation_chauffage_annuel                                      = $lead->Consommation_chauffage_annuel;
        $client->Consommation_Chauffage_Annuel_2                                    = $lead->Consommation_Chauffage_Annuel_2;
        $client->Depuis_quand_occupez_vous_le_logement                              = $lead->Depuis_quand_occupez_vous_le_logement;
        $client->Type_du_courant_du_logement                                        = $lead->Type_du_courant_du_logement;
        $client->auxiliary_heating_status                                           = $lead->auxiliary_heating_status;
        $client->auxiliary_heating                                                  = $lead->auxiliary_heating;
        $client->auxiliary_heating__a__                                             = $lead->auxiliary_heating__a__;
        $client->second_heating_generator_status                                    = $lead->second_heating_generator_status;
        $client->second_heating_generator                                           = $lead->second_heating_generator;
        $client->second_heating_generator__a__                                      = $lead->second_heating_generator__a__;
        $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement         = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
        $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__    = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
        $client->Préciser_le_type_de_radiateurs_Aluminium                           = $lead->Préciser_le_type_de_radiateurs_Aluminium;
        $client->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs      = $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
        $client->Préciser_le_type_de_radiateurs_Fonte                               = $lead->Préciser_le_type_de_radiateurs_Fonte;
        $client->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
        $client->Préciser_le_type_de_radiateurs_Acier                               = $lead->Préciser_le_type_de_radiateurs_Acier;
        $client->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
        $client->Préciser_le_type_de_radiateurs_Autre                               = $lead->Préciser_le_type_de_radiateurs_Autre;
        $client->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
        $client->Préciser_le_type_de_radiateurs_Autre___a__                         = $lead->Préciser_le_type_de_radiateurs_Autre___a__;
        $client->Production_dapostropheeau_chaude_sanitaire                         = $lead->Production_dapostropheeau_chaude_sanitaire;
        $client->Instantanné                                                        = $lead->Instantanné;
        $client->Accumulation                                                       = $lead->Accumulation;
        $client->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude     = $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
        $client->Instantanné_Merci_de_préciser                                      = $lead->Instantanné_Merci_de_préciser;
        $client->Accumulation_Merci_de_préciser                                     = $lead->Accumulation_Merci_de_préciser;
        $client->Le_logement_possède_un_réseau_hydraulique                          = $lead->Le_logement_possède_un_réseau_hydraulique;
        $client->auxiliary_heating__Insert_à_bois_Nombre                          = $lead->auxiliary_heating__Insert_à_bois_Nombre;
        $client->auxiliary_heating__Poêle_à_bois_Nombre                          = $lead->auxiliary_heating__Poêle_à_bois_Nombre;
        $client->auxiliary_heating__Poêle_à_gaz_Nombre                          = $lead->auxiliary_heating__Poêle_à_gaz_Nombre;
        $client->auxiliary_heating__Convecteur_électrique_Nombre                          = $lead->auxiliary_heating__Convecteur_électrique_Nombre;
        $client->auxiliary_heating__Sèche_serviette_Nombre                          = $lead->auxiliary_heating__Sèche_serviette_Nombre;
        $client->auxiliary_heating__Panneau_rayonnant_Nombre                          = $lead->auxiliary_heating__Panneau_rayonnant_Nombre;
        $client->auxiliary_heating__Radiateur_bain_dhuile_Nombre                          = $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
        $client->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                          = $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
        $client->auxiliary_heating__Autre_Nombre                          = $lead->auxiliary_heating__Autre_Nombre;
        $client->Précisez_le_volume_du_ballon_dapostropheeau_chaude                 = $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
        $client->Information_logement_observations                                  = $lead->Information_logement_observations;
        $client->Situation_familiale                                                = $lead->Situation_familiale;
        $client->Situation_familiale___a__                                          = $lead->Situation_familiale___a__;
        $client->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                         = $lead->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
        $client->Personne_1                                                         = $lead->Personne_1;
        $client->Quel_est_le_contrat_de_travail_de_Personne_1                       = $lead->Quel_est_le_contrat_de_travail_de_Personne_1;
        $client->Quel_est_le_contrat_de_travail_de_Personne_1__a__                  = $lead->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
        $client->Revenue_Personne_1                                                 = $lead->Revenue_Personne_1;
        $client->Existehyphenthyphenil_un_conjoint                                  = $lead->Existehyphenthyphenil_un_conjoint;
        $client->Personne_2                                                         = $lead->Personne_2;
        $client->Quel_est_le_contrat_de_travail_de_Personne_2                       = $lead->Quel_est_le_contrat_de_travail_de_Personne_2;
        $client->Quel_est_le_contrat_de_travail_de_Personne_2__a__                  = $lead->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
        $client->Revenue_Personne_2                                                 = $lead->Revenue_Personne_2;
        $client->Crédit_du_foyer_mensuel                                            = $lead->Crédit_du_foyer_mensuel;
        $client->Commentaires_revenue_et_crédit_du_foyer                            = $lead->Commentaires_revenue_et_crédit_du_foyer;
        $client->Type_de_contrat                                                   = $lead->Type_de_contrat;
        $client->MaPrimeRenov                                                      = $lead->MaPrimeRenov;
        $client->Subvention_MaPrimeRénov_déduit_du_devis                           = $lead->Subvention_MaPrimeRénov_déduit_du_devis;
        $client->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
        $client->Action_Logement                                                   = $lead->Action_Logement;
        $client->CEE                                                               = $lead->CEE;
        $client->Credit                                                            = $lead->Credit;
        $client->Montant_Crédit                                                    = $lead->Montant_Crédit;
        $client->Report_du_crédit                                                  = $lead->Report_du_crédit;
        $client->Nombre_de_jours_report                                            = $lead->Nombre_de_jours_report;
        $client->Reste_à_charge                                                    = $lead->Reste_à_charge;
        $client->Reste_à_charge_Montant                                            = $lead->Reste_à_charge_Montant;
        $client->Survente                                                          = $lead->Survente;
        $client->Montant_survente                                                  = $lead->Montant_survente;
        $client->Observations_reste_à_charge                                       = $lead->Observations_reste_à_charge;
        $client->Mode_de_paiement                                                  = $lead->Mode_de_paiement;
        $client->Nombre_de_mensualités                                             = $lead->Nombre_de_mensualités;
        $client->advance_visit                                                     = $lead->advance_visit; 
        $client->Projet_observations                                               = $lead->Projet_observations; 
        $client->Montant_estimée_de_lapostropheaide                                = $lead->Montant_estimée_de_lapostropheaide; 
        $client->latitude                                                          = $lead->latitude;
        $client->longitude                                                         = $lead->longitude;
        $client->lead_tracking_custom_field_data                                   = $lead->lead_tracking_custom_field_data;
        $client->personal_info_custom_field_data                                   = $lead->personal_info_custom_field_data; 
        $client->eligibility_custom_field_data                                     = $lead->eligibility_custom_field_data;
        $client->situation_foyer_custom_field_data                                 = $lead->situation_foyer_custom_field_data;
        $client->project_custom_field_data                                         = $lead->project_custom_field_data;
        $client->user_id                                                           = Auth::id();
        $client->Type_habitation                                                   = $lead->Type_habitation;
        $client->Type_de_logement                                                  = $lead->Type_de_logement;
        $client->Type_de_chauffage                                                 = $lead->Type_de_chauffage;

        $client->save();
        
            

        $project = new NewProject();

        $project->user_id                                                            = Auth::id();
        $project->lead_id                                                           = $lead->id;
        $project->client_id                                                         = $client->id;
        $project->company_id                                                        = $lead->company_id;
        $project->lead_telecommercial                                               = $lead->lead_telecommercial;
        $project->project_label                                                     = 1;
        $project->project_telecommercial                                            = $request->user_id; 
        $project->project_gestionnaire                                              = $request->gestionnaire_id;  
        $project->__tracking__Fournisseur_de_lead                                   = $lead->__tracking__Fournisseur_de_lead;
        $project->__tracking__Type_de_campagne                                      = $lead->__tracking__Type_de_campagne;
        $project->__tracking__Type_de_campagne__a__                                 = $lead->__tracking__Type_de_campagne__a__;
        $project->__tracking__Nom_campagne                                          = $lead->__tracking__Nom_campagne;
        $project->__tracking__Date_demande_lead                                     = $lead->__tracking__Date_demande_lead;
        $project->__tracking__Date_attribution_télécommercial                       = $lead->__tracking__Date_attribution_télécommercial;
        $project->__tracking__Type_de_travaux_souhaité                              = $lead->__tracking__Type_de_travaux_souhaité;
        $project->__tracking__Nom_Prénom                                            = $lead->__tracking__Nom_Prénom;
        $project->__tracking__Code_postal                                           = $lead->__tracking__Code_postal;
        $project->__tracking__Email                                                 = $lead->__tracking__Email;
        $project->__tracking__téléphone                                             = $lead->__tracking__téléphone;
        $project->__tracking__Département                                           = $lead->__tracking__Département;
        $project->__tracking__Mode_de_chauffage                                     = $lead->__tracking__Mode_de_chauffage;
        $project->__tracking__Mode_de_chauffage__a__                                = $lead->__tracking__Mode_de_chauffage__a__;
        $project->__tracking__Propriétaire                                          = $lead->__tracking__Propriétaire;
        $project->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans        = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
        $project->Titre                                                             = $lead->Titre;
        $project->Prenom                                                            = $lead->Prenom;
        $project->Nom                                                               = $lead->Nom;
        $project->Adresse                                                           = $lead->Adresse;
        $project->Complément_adresse                                                = $lead->Complément_adresse;
        $project->Code_Postal                                                       = $lead->Code_Postal;
        $project->Ville                                                             = $lead->Ville;
        $project->Département                                                       = $lead->Département;
        $project->Email                                                             = $lead->Email;
        $project->same_as_work_address                                              = $lead->same_as_work_address;
        $project->Adresse_Travaux                                                   = $lead->Adresse_Travaux;
        $project->Complément_adresse_Travaux                                        = $lead->Complément_adresse_Travaux;
        $project->Code_postal_Travaux                                               = $lead->Code_postal_Travaux;
        $project->Ville_Travaux                                                     = $lead->Ville_Travaux;
        $project->Departement_Travaux                                               = $lead->Departement_Travaux;
        $project->phone                                                             = $lead->phone;
        $project->fixed_number                                                      = $lead->fixed_number;
        $project->Observations                                                      = $lead->Observations;
        $project->precariousness                                                    = $lead->precariousness;
        $project->Type_occupation                                                   = $lead->Type_occupation;
        $project->Parcelle_cadastrale                                               = $lead->Parcelle_cadastrale;
        $project->Revenue_Fiscale_de_Référence                                      = $lead->Revenue_Fiscale_de_Référence;
        $project->Nombre_de_foyer                                                   = $lead->Nombre_de_foyer;
        $project->Nombre_de_personnes                                               = $lead->Nombre_de_personnes;
        $project->Age_du_bâtiment                                                   = $lead->Age_du_bâtiment;
        $project->Zone                                                              = $lead->Zone;
        $project->Éligibilité_MaPrimeRenov                                          = $lead->Éligibilité_MaPrimeRenov;
        $project->Mode_de_chauffage                                                 = $lead->Mode_de_chauffage;
        $project->Mode_de_chauffage__a__                                            = $lead->Mode_de_chauffage__a__;
        $project->Date_construction_maison                                          = $lead->Date_construction_maison;
        $project->Surface_habitable                                                 = $lead->Surface_habitable;
        $project->Surface_à_chauffer                                                = $lead->Surface_à_chauffer;
        $project->Consommation_chauffage_annuel                                     = $lead->Consommation_chauffage_annuel;
        $project->Consommation_Chauffage_Annuel_2                                   = $lead->Consommation_Chauffage_Annuel_2;
        $project->Depuis_quand_occupez_vous_le_logement                             = $lead->Depuis_quand_occupez_vous_le_logement;
        $project->Type_du_courant_du_logement                                       = $lead->Type_du_courant_du_logement;
        $project->auxiliary_heating_status                                          = $lead->auxiliary_heating_status;
        $project->auxiliary_heating                                                 = $lead->auxiliary_heating;
        $project->auxiliary_heating__a__                                            = $lead->auxiliary_heating__a__;
        $project->second_heating_generator_status                                   = $lead->second_heating_generator_status;
        $project->second_heating_generator                                          = $lead->second_heating_generator;
        $project->second_heating_generator__a__                                     = $lead->second_heating_generator__a__;
        $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement        = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
        $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__   = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
        $project->Préciser_le_type_de_radiateurs_Aluminium                          = $lead->Préciser_le_type_de_radiateurs_Aluminium;
        $project->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs     = $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Fonte                              = $lead->Préciser_le_type_de_radiateurs_Fonte;
        $project->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Acier                              = $lead->Préciser_le_type_de_radiateurs_Acier;
        $project->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Autre                              = $lead->Préciser_le_type_de_radiateurs_Autre;
        $project->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
        $project->Préciser_le_type_de_radiateurs_Autre___a__                        = $lead->Préciser_le_type_de_radiateurs_Autre___a__;
        $project->Production_dapostropheeau_chaude_sanitaire                        = $lead->Production_dapostropheeau_chaude_sanitaire;
        $project->Instantanné                                                       = $lead->Instantanné;
        $project->Accumulation                                                      = $lead->Accumulation;
        $project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude    = $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
        $project->Instantanné_Merci_de_préciser                                     = $lead->Instantanné_Merci_de_préciser;
        $project->Accumulation_Merci_de_préciser                                    = $lead->Accumulation_Merci_de_préciser;
        $project->Le_logement_possède_un_réseau_hydraulique                         = $lead->Le_logement_possède_un_réseau_hydraulique;
        $project->auxiliary_heating__Insert_à_bois_Nombre                         = $lead->auxiliary_heating__Insert_à_bois_Nombre;
        $project->auxiliary_heating__Poêle_à_bois_Nombre                         = $lead->auxiliary_heating__Poêle_à_bois_Nombre;
        $project->auxiliary_heating__Poêle_à_gaz_Nombre                         = $lead->auxiliary_heating__Poêle_à_gaz_Nombre;
        $project->auxiliary_heating__Convecteur_électrique_Nombre                         = $lead->auxiliary_heating__Convecteur_électrique_Nombre;
        $project->auxiliary_heating__Sèche_serviette_Nombre                         = $lead->auxiliary_heating__Sèche_serviette_Nombre;
        $project->auxiliary_heating__Panneau_rayonnant_Nombre                         = $lead->auxiliary_heating__Panneau_rayonnant_Nombre;
        $project->auxiliary_heating__Radiateur_bain_dhuile_Nombre                         = $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
        $project->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                         = $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
        $project->auxiliary_heating__Autre_Nombre                         = $lead->auxiliary_heating__Autre_Nombre;
        $project->Précisez_le_volume_du_ballon_dapostropheeau_chaude                = $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
        $project->Information_logement_observations                                 = $lead->Information_logement_observations;
        $project->Situation_familiale                                               = $lead->Situation_familiale;
        $project->Situation_familiale___a__                                         = $lead->Situation_familiale___a__;
        $project->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                        = $lead->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
        $project->Personne_1                                                        = $lead->Personne_1;
        $project->Quel_est_le_contrat_de_travail_de_Personne_1                      = $lead->Quel_est_le_contrat_de_travail_de_Personne_1;
        $project->Quel_est_le_contrat_de_travail_de_Personne_1__a__                 = $lead->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
        $project->Revenue_Personne_1                                                = $lead->Revenue_Personne_1;
        $project->Existehyphenthyphenil_un_conjoint                                 = $lead->Existehyphenthyphenil_un_conjoint;
        $project->Personne_2                                                        = $lead->Personne_2;
        $project->Quel_est_le_contrat_de_travail_de_Personne_2                      = $lead->Quel_est_le_contrat_de_travail_de_Personne_2;
        $project->Quel_est_le_contrat_de_travail_de_Personne_2__a__                 = $lead->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
        $project->Revenue_Personne_2                                                = $lead->Revenue_Personne_2;
        $project->Crédit_du_foyer_mensuel                                           = $lead->Crédit_du_foyer_mensuel;
        $project->Commentaires_revenue_et_crédit_du_foyer                           = $lead->Commentaires_revenue_et_crédit_du_foyer;
        $project->__projet__Adresse_des_travaux                                     = $lead->__projet__Adresse_des_travaux;
        $project->__projet__Code_postale_des_travaux                                = $lead->__projet__Code_postale_des_travaux;
        $project->__projet__Ville_des_travaux                                       = $lead->__projet__Ville_des_travaux;
        $project->__projet__Département_des_travaux                                 = $lead->__projet__Département_des_travaux;
        $project->Type_de_contrat                                                   = $lead->Type_de_contrat;
        $project->MaPrimeRenov                                                      = $lead->MaPrimeRenov;
        $project->Subvention_MaPrimeRénov_déduit_du_devis                           = $lead->Subvention_MaPrimeRénov_déduit_du_devis;
        $project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
        $project->Action_Logement                                                   = $lead->Action_Logement;
        $project->CEE                                                               = $lead->CEE;
        $project->Credit                                                            = $lead->Credit;
        $project->Montant_Crédit                                                    = $lead->Montant_Crédit;
        $project->Report_du_crédit                                                  = $lead->Report_du_crédit;
        $project->Nombre_de_jours_report                                            = $lead->Nombre_de_jours_report;
        $project->Reste_à_charge                                                    = $lead->Reste_à_charge;
        $project->Reste_à_charge_Montant                                            = $lead->Reste_à_charge_Montant;
        $project->Survente                                                          = $lead->Survente;
        $project->Montant_survente                                                  = $lead->Montant_survente;
        $project->Observations_reste_à_charge                                       = $lead->Observations_reste_à_charge;
        $project->Mode_de_paiement                                                  = $lead->Mode_de_paiement;
        $project->Nombre_de_mensualités                                             = $lead->Nombre_de_mensualités;
        $project->advance_visit                                                     = $lead->advance_visit; 
        $project->Projet_observations                                               = $lead->Projet_observations; 
        $project->latitude                                                          = $lead->latitude; 
        $project->longitude                                                         = $lead->longitude; 
        $project->Montant_estimée_de_lapostropheaide                                = $lead->Montant_estimée_de_lapostropheaide; 
        $project->question_data                                                     = $lead->question_data;  
        $project->lead_tracking_custom_field_data                                    = $lead->lead_tracking_custom_field_data;
        $project->personal_info_custom_field_data                                    = $lead->personal_info_custom_field_data; 
        $project->eligibility_custom_field_data                                      = $lead->eligibility_custom_field_data;
        $project->situation_foyer_custom_field_data                                  = $lead->situation_foyer_custom_field_data;
        $project->project_custom_field_data                                          = $lead->project_custom_field_data;
        $project->Type_habitation                                                    = $lead->Type_habitation;
        $project->Type_de_logement                                                   = $lead->Type_de_logement;
        $project->Type_de_chauffage                                                  = $lead->Type_de_chauffage;

        $project->project_sub_status = 5; 
        $project->save();
            
            // if($request->user_id){
            //     ProjectAssign::create([
            //         'user_id' => $request->user_id,
            //         'project_id' => $project->id,
            //     ]);
            // }
            // if($request->gestionnaire_id){
            //     ProjectGestionnaire::create([
            //         'user_id' => $request->gestionnaire_id,
            //         'project_id' => $project->id,
            //     ]);
            // }

            $taxs = LeadTax::where('lead_id', $request->lead_id)->get();
            foreach($taxs as $tax){
                ClientTax::create([
                    'client_id' => $client->id,
                    'tax_number' => $tax->tax_number,
                    'tax_reference' => $tax->tax_reference,
                    'title' => $tax->title,
                    'first_name' => $tax->first_name,
                    'last_name' => $tax->last_name,
                    'second_title' => $tax->second_title,
                    'second_first_name' => $tax->second_first_name,
                    'second_last_name' => $tax->second_last_name,
                    'kids' => $tax->kids,
                    'phone' => $tax->phone,
                    'telephone' => $tax->telephone,
                    'email' => $tax->email,
                    'pays' => $tax->pays,
                    'postal_code' => $tax->postal_code,
                    'city' => $tax->city,
                    'address' => $tax->address,
                    'primary' => $tax->primary,
                    'type' => $tax->type,
                    'mark_check' => $tax->mark_check,
                    'address2' => $tax->address2,
                    'family_person' => $tax->family_person,
                    'observations' => $tax->observations,
                    'department' => $tax->department,
                    'same_as_work_address' => $tax->same_as_work_address,
                    'Adresse_Travaux' => $tax->Adresse_Travaux,
                    'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                    'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                    'Ville_Travaux' => $tax->Ville_Travaux,
                    'Departement_Travaux' => $tax->Departement_Travaux, 
                    'house_owner_status' => $tax->house_owner_status, 
                    'property_tax_status' => $tax->property_tax_status, 
                    'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                    'Existe_déclarant' => $tax->Existe_déclarant, 
                    'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                    'google_address' => $tax->google_address, 
                    'latitude' => $tax->latitude, 
                    'longitude' => $tax->longitude, 
                    'user_id' => $tax->user_id,
                    'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                    'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                    'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                    'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                    'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                    'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                ]);
                ProjectTax::create([
                    'project_id' => $project->id,
                    'tax_number' => $tax->tax_number,
                    'tax_reference' => $tax->tax_reference,
                    'title' => $tax->title,
                    'first_name' => $tax->first_name,
                    'last_name' => $tax->last_name,
                    'second_title' => $tax->second_title,
                    'second_first_name' => $tax->second_first_name,
                    'second_last_name' => $tax->second_last_name,
                    'kids' => $tax->kids,
                    'phone' => $tax->phone,
                    'telephone' => $tax->telephone,
                    'email' => $tax->email,
                    'pays' => $tax->pays,
                    'postal_code' => $tax->postal_code,
                    'city' => $tax->city,
                    'address' => $tax->address,
                    'primary' => $tax->primary,
                    'type' => $tax->type,
                    'mark_check' => $tax->mark_check,
                    'address2' => $tax->address2,
                    'family_person' => $tax->family_person,
                    'observations' => $tax->observations,
                    'department' => $tax->department,
                    'same_as_work_address' => $tax->same_as_work_address,
                    'Adresse_Travaux' => $tax->Adresse_Travaux,
                    'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                    'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                    'Ville_Travaux' => $tax->Ville_Travaux,
                    'Departement_Travaux' => $tax->Departement_Travaux, 
                    'house_owner_status' => $tax->house_owner_status, 
                    'property_tax_status' => $tax->property_tax_status, 
                    'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                    'Existe_déclarant' => $tax->Existe_déclarant, 
                    'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                    'google_address' => $tax->google_address, 
                    'latitude' => $tax->latitude, 
                    'longitude' => $tax->longitude, 
                    'user_id' => $tax->user_id,
                    'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                    'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                    'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                    'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                    'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                    'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                ]);
            }

            $childrens = Children::where('lead_id', $request->lead_id)->get(); 
            foreach($childrens as $children){
                Children::create([
                    'name'          => $children->name,
                    'birth_date'    => $children->birth_date,
                    'client_id'     =>$client->id, 
                ]);
                
                Children::create([
                    'name'          => $children->name,
                    'birth_date'    => $children->birth_date,
                    'project_id'    =>$project->id, 
                ]);
            }  

            $lead_baremes = $lead->LeadBareme;
            if($lead_baremes){
                foreach($lead_baremes as $bareme){
                    ProjectBareme::create([
                        'project_id' => $project->id,
                        'barame_id'  => $bareme->id
                    ]); 
                    ClientBareme::create([
                        'client_id'  => $client->id,
                        'barame_id'  => $bareme->id    
                    ]);
                }
            } 
            $lead_travauxs = $lead->LeadTravax;
            if($lead_travauxs){
                foreach($lead_travauxs as $travaux){
                    ProjectTravaux::create([
                        'project_id' => $project->id,
                        'travaux_id' => $travaux->id
                    ]);

                    ClientTravaux::create([
                        'client_id' => $client->id,
                        'travaux_id' => $travaux->id
                    ]);
                }
            } 

            $lead_travaux_tags = LeadTravauxTag::where('lead_id', $lead->id)->get();
            if($lead_travaux_tags){
                foreach($lead_travaux_tags as $travaux_tag){
                    ProjectTravauxTag::create([
                        'project_id' => $project->id,
                        'tag_id' => $travaux_tag->tag_id
                    ]);

                    ClientTravauxTag::create([
                        'client_id' => $client->id,
                        'tag_id' => $travaux_tag->tag_id,
                        'surface' => $travaux_tag->surface,
                        'Nombre_de_split' => $travaux_tag->Nombre_de_split,
                        'Type_de_comble' => $travaux_tag->Type_de_comble,
                        'marque' => $travaux_tag->marque,
                        'shab' => $travaux_tag->shab,
                        'Nombre_de_pièces_dans_le_logement' => $travaux_tag->Nombre_de_pièces_dans_le_logement,
                        'Type_de_radiateur' => $travaux_tag->Type_de_radiateur,
                        'Nombre_de_radiateurs_électrique' => $travaux_tag->Nombre_de_radiateurs_électrique,
                        'Nombre_de_radiateurs_combustible' => $travaux_tag->Nombre_de_radiateurs_combustible,
                        'Nombre_de_radiateur_total_dans_le_logement' => $travaux_tag->Nombre_de_radiateur_total_dans_le_logement,
                        'Thermostat_supplémentaire' => $travaux_tag->Thermostat_supplémentaire,
                        'Nombre_thermostat_supplémentaire' => $travaux_tag->Nombre_thermostat_supplémentaire,
                    ]);

                    $tag_item = ProjectTag::create([
                        'project_id'    => $project->id,
                        'tag_id'        => $travaux_tag->tag_id, 
                        'surface'        => $travaux_tag->surface, 
                        'Nombre_de_split'        => $travaux_tag->Nombre_de_split, 
                        'Type_de_comble'        => $travaux_tag->Type_de_comble, 
                        'marque'        => $travaux_tag->marque, 
                        'shab'        => $travaux_tag->shab, 
                        'Nombre_de_pièces_dans_le_logement'        => $travaux_tag->Nombre_de_pièces_dans_le_logement, 
                        'Type_de_radiateur'        => $travaux_tag->Type_de_radiateur, 
                        'Nombre_de_radiateurs_électrique'        => $travaux_tag->Nombre_de_radiateurs_électrique, 
                        'Nombre_de_radiateurs_combustible'        => $travaux_tag->Nombre_de_radiateurs_combustible, 
                        'Nombre_de_radiateur_total_dans_le_logement'        => $travaux_tag->Nombre_de_radiateur_total_dans_le_logement, 
                        'Thermostat_supplémentaire'        => $travaux_tag->Thermostat_supplémentaire, 
                        'Nombre_thermostat_supplémentaire'        => $travaux_tag->Nombre_thermostat_supplémentaire, 
                    ]);

                    $lead_tag_products = LeadWorkTagProduct::where('work_id', $lead->id)->where('tag_id', $travaux_tag->tag_id)->get();
                    if($lead_tag_products){
                        foreach($lead_tag_products as $product){
                            ProjectTagProduct::create([
                                'project_id'    => $project->id,
                                'tag_id'        => $tag_item->id,
                                'product_id'    => $product->product_id,
                            ]);

                            ClientTagProduct::create([
                                'client_id'     => $client->id,
                                'tag_id'        => $product->tag_id,
                                'product_id'    => $product->product_id,
                            ]);
                        }
                    }
                }
                
            }   


            foreach($lead->getLeadComments->where('lead_reset_status', 0) as $comment){
                $project_comment = ProjectComment::create([
                    'comment'       => $comment->comment,
                    'project_id'    => $project->id,
                    'status'        => $comment->status,
                    'category_id'   => $comment->category_id,
                    'user_id'       => $comment->user_id,
                ]);
                foreach($comment->file as $file){
                    ProjectCommentFile::create([
                        'comment_id' => $project_comment->id,
                        'name'       => $file->name,
                        'type'       => $file->type,
                    ]);
                }
            }

            $lead_product_nombres = LeadProductNombre::where('lead_id', $lead->id)->get();
            foreach($lead_product_nombres as $lead_product_nombre){
                ClientProductNombre::create([
                    'client_id' => $client->id,
                    'tag_id' => $lead_product_nombre->tag_id,
                    'product_id' => $lead_product_nombre->product_id,
                    'number' => $lead_product_nombre->number,
                ]);
                ProjectProductNombre::create([
                    'project_id' => $project->id,
                    'tag_id' => $lead_product_nombre->tag_id,
                    'product_id' => $lead_product_nombre->product_id,
                    'number' => $lead_product_nombre->number,
                ]);
            }
            

           $user = User::find(1);
           $name = Auth::user()->name;
           $subject = 'Lead Converted'; 
            $body = 'Lead have been converted to client by '.$name; 
            if($user->email_professional){
                // Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
            }

           $notification = Notifications::create([
            'title'  => ['en' => 'Lead Converted', 'fr' =>'Prospect converti'],
            'body'   => ['en' => 'Lead have been converted to client by '. Auth::user()->name, 'fr' => 'Les prospects ont été convertis en clients par '. Auth::user()->name],
            'user_id' => 1,
            'client_id' => $lead->id,
            ]); 

            $user = User::find(1);
            $name = Auth::user()->name;
            $subject = 'Project Create'; 
            $body = 'A new project have been created by '.$name; 
            if($user->email_professional){
                // Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
            }

           $notification = Notifications::create([
            'title'  => ['en' => 'Project Create', 'fr' =>'Créer un projet'],
            'body'   => ['en' => 'A new project have been created by '. Auth::user()->name, 'fr' => 'Un nouveau projet a été créé par '. Auth::user()->name],
            'user_id' => 1,
            'project_id' => $lead->id,
            ]); 

 
            $pannel_activity = PannelLogActivity::create([  
                'label_prev_id' => 6,
                'label_id'      => 7,
                'status'        => 'change_etiquette',
                'key'           => "etiquette",  
                'feature_type'  => 'lead',
                'feature_id'    => $lead->id,
                'user_id'       => Auth::id(), 
            ]); 
    
            $lead->etiquette_automatise_recurrence_status = 0;
            $lead->etiquette_automatise_id = 0; 
            $lead->etiquette_fin = 1;

            StatusChangeLog::create([
                'feature_id' => $lead->id,
                'from_id' => 6,
                'to_id' => 7,
                'statut_id' => 5,
                'regie_id' => $lead->leadTelecommercial ? ($lead->leadTelecommercial->getRegie ? $lead->leadTelecommercial->getRegie->id : null):null,
                'telecommercial_id' => $lead->lead_telecommercial ?? null,
                'status_type' => 'main',
                'type' => 'lead', 
            ]);
    
            event(new PannelLog($pannel_activity->id));

            $automatisations = Automatise::where('automatisation_for', 'prospects')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
            $travaux = '';
            $travaux_count = 1;
            foreach($lead->LeadTravax as $item){
                $travaux .= $item->travaux .($travaux_count != $lead->LeadTravax->count() ? ', ':'');
                $travaux_count++;
            }
            
            foreach($automatisations as $automatisation)
            {
                if(str_contains($automatisation->status, 'main'))
                {
                        $status = explode('_', $automatisation->status); 

                    if($status[1] == 7)
                    {
                        if($automatisation->recurrence == 'Oui'){
                            $lead->etiquette_automatise_recurrence_status = 1;
                            $lead->etiquette_automatise_id = $automatisation->id;
                            $lead->etiquette_automatise_recurrence_start = Carbon::now();
                        }
                        
                        if($automatisation->sending_type == 'send_email')
                        {
                            $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                            $subject = $template->object;
                            $body = $template->body;
                            
                            $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                            $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                            $body = str_replace('{titre}', $lead->Titre, $body);
                            $body = str_replace('{nom_client}', $lead->Nom, $body);
                            $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                            $body = str_replace('{email_client}', $lead->Email, $body);
                            $body = str_replace('{téléphone_client}', $lead->phone, $body);
                            if($lead->leadTelecommercial){
                                $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                if($lead->leadTelecommercial->getRegie){
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                    $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                }else{
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }
                            }else{
                                $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            } 
                            
                            $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                            $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                            $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                            $body = str_replace('{projet_travaux}', $travaux, $body);
                            $body = str_replace('{statut_projet}', ' ', $body);
                            $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                            $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                            $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                            $body = str_replace('{installation_date_intervention}', ' ', $body);
                            $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                            $body = str_replace('{SAV_date_intervention}', ' ', $body);
                            $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                            $body = str_replace('{etude_date_intervention}', ' ', $body);
                            $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                            $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                            $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                            
                            // $subject = $automatisation->name;
                            if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                            {
                                
                                if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                {
                                
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files =public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }

                                    if($automatisation->select_to == 'Telecommercial'){
                                        $data["email"] = $lead->leadTelecommercial->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($lead->leadTelecommercial->email_professional){
                                            $data["email"] = $lead->leadTelecommercial->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 
                                    }
                            
                                    // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                }

                            }
                            if($automatisation->select_to == 'Client')
                            { 
                                $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                                
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }

                            if($automatisation->select_to == 'Mail personnalisé')
                            { 
                                $data["email"] = $automatisation->custom_email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                                
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }
                                
                            if($automatisation->select_to_cc){
                                if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                {
                                    
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
                                    }
    
                                }
                                if($automatisation->select_to_cc == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                    
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cc == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cc;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                            if($automatisation->select_to_cci){
                                if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                {
                                    
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }

                                        }
                                    }
    
                                }
                                if($automatisation->select_to_cci == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                    
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cci == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cci;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                        }
                        else
                        {

                        $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                        $body = $template->body;
                        
                        $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                        $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                        $body = str_replace('{titre}', $lead->Titre, $body);
                        $body = str_replace('{nom_client}', $lead->Nom, $body);
                        $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                        $body = str_replace('{email_client}', $lead->Email, $body);
                        $body = str_replace('{téléphone_client}', $lead->phone, $body);
                        if($lead->leadTelecommercial){
                            $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                            if($lead->leadTelecommercial->getRegie){
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                            }else{
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            }
                        }else{
                            $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                            $body = str_replace('{regie}', ' ', $body);
                        } 
                        $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                        $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                        $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                        $body = str_replace('{projet_travaux}', $travaux, $body);
                        $body = str_replace('{statut_projet}', ' ', $body);
                        $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                        $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                        $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                        $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                        $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                        $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                        $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 

                        $subject = $automatisation->name;
                        
                        if($automatisation->select_to == 'Client')
                        { 
                        
                            try {
    
                                $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                $client = new \Nexmo\Client($basic);
                        
                                $receiverNumber = $lead->phone;
                                $message = $body;
                        
                                $message = $client->message()->send([
                                    'to' => str_replace('+', '', $receiverNumber),
                                    'from' => 'Novecology',
                                    'text' => $message
                                ]);
                        
                                
                                    
                            } catch (Exception $e) {
                                
                            }

                        }
                        if($automatisation->select_to_cc){
                            if($automatisation->select_to_cc == 'Client')
                            { 
                            
                                try {
        
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                            
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                            
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                            
                                    
                                        
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                        }
                        if($automatisation->select_to_cci){
                            if($automatisation->select_to_cci == 'Client')
                            { 
                            
                                try {
        
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                            
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                            
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                            
                                    
                                        
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                        }
                        
                        
                        }
                    }   
                }
            } 

           return redirect()->route('client.lead.update', $client->id); 
        return back();
         

    }
    public function bulkConvert(){
        if(Auth::id() != 1){
            return redirect('/');
        }
        $validar_leads = LeadClientProject::where('lead_label', 6)->where('Type_de_contrat', 'BAR TH 173')->take(50)->get();
        foreach ($validar_leads as $lead){

            // $lead = LeadClientProject::find($request->lead_id); 
            $lead->lead_label = 7;
            $lead->sub_status = 5;
            $lead->etiquette_automatise_recurrence_status = 0;
            $lead->etiquette_automatise_id = 0;
            $lead->etiquette_fin = 0;
            $lead->etiquette_automatise_recurrence_start = null;
            $lead->statut_automatise_recurrence_status = 0;
            $lead->statut_automatise_id = 0;
            $lead->statut_fin = 0;
            $lead->statut_automatise_recurrence_start = null;
            $lead->save();
            $client = new NewClient(); 
            $client->lead_id                                                            = $lead->id;
            $client->company_id                                                         = $lead->company_id;
            $client->lead_telecommercial                                                = $lead->lead_telecommercial;
            $client->__tracking__Fournisseur_de_lead                                    = $lead->__tracking__Fournisseur_de_lead;
            $client->__tracking__Type_de_campagne                                       = $lead->__tracking__Type_de_campagne;
            $client->__tracking__Type_de_campagne__a__                                  = $lead->__tracking__Type_de_campagne__a__;
            $client->__tracking__Nom_campagne                                           = $lead->__tracking__Nom_campagne;
            $client->__tracking__Date_demande_lead                                      = $lead->__tracking__Date_demande_lead;
            $client->__tracking__Date_attribution_télécommercial                        = $lead->__tracking__Date_attribution_télécommercial;
            $client->__tracking__Type_de_travaux_souhaité                               = $lead->__tracking__Type_de_travaux_souhaité;
            $client->__tracking__Nom_Prénom                                             = $lead->__tracking__Nom_Prénom;
            $client->__tracking__Code_postal                                            = $lead->__tracking__Code_postal;
            $client->__tracking__Email                                                  = $lead->__tracking__Email;
            $client->__tracking__téléphone                                              = $lead->__tracking__téléphone;
            $client->__tracking__Département                                            = $lead->__tracking__Département;
            $client->__tracking__Mode_de_chauffage                                      = $lead->__tracking__Mode_de_chauffage;
            $client->__tracking__Mode_de_chauffage__a__                                 = $lead->__tracking__Mode_de_chauffage__a__;
            $client->__tracking__Propriétaire                                           = $lead->__tracking__Propriétaire;
            $client->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans         = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $client->Titre                                                              = $lead->Titre;    
            $client->Prenom                                                             = $lead->Prenom;
            $client->Nom                                                                = $lead->Nom;
            $client->Adresse                                                            = $lead->Adresse;
            $client->Complément_adresse                                                 = $lead->Complément_adresse;
            $client->Code_Postal                                                        = $lead->Code_Postal;
            $client->Ville                                                              = $lead->Ville;
            $client->Département                                                        = $lead->Département;
            $client->Email                                                              = $lead->Email;
            $client->same_as_work_address                                               = $lead->same_as_work_address;
            $client->Adresse_Travaux                                                    = $lead->Adresse_Travaux;
            $client->Complément_adresse_Travaux                                         = $lead->Complément_adresse_Travaux;
            $client->Code_postal_Travaux                                                = $lead->Code_postal_Travaux;
            $client->Ville_Travaux                                                      = $lead->Ville_Travaux;
            $client->Departement_Travaux                                                = $lead->Departement_Travaux;
            $client->phone                                                              = $lead->phone;
            $client->fixed_number                                                       = $lead->fixed_number;
            $client->Observations                                                       = $lead->Observations;
            $client->precariousness                                                     = $lead->precariousness;
            $client->Type_occupation                                                    = $lead->Type_occupation;
            $client->Parcelle_cadastrale                                                = $lead->Parcelle_cadastrale;
            $client->Revenue_Fiscale_de_Référence                                       = $lead->Revenue_Fiscale_de_Référence;
            $client->Nombre_de_foyer                                                    = $lead->Nombre_de_foyer;
            $client->Nombre_de_personnes                                                = $lead->Nombre_de_personnes;
            $client->Age_du_bâtiment                                                    = $lead->Age_du_bâtiment;
            $client->Zone                                                               = $lead->Zone;
            $client->Éligibilité_MaPrimeRenov                                           = $lead->Éligibilité_MaPrimeRenov;
            $client->Mode_de_chauffage                                                  = $lead->Mode_de_chauffage;
            $client->Mode_de_chauffage__a__                                             = $lead->Mode_de_chauffage__a__;
            $client->Date_construction_maison                                           = $lead->Date_construction_maison;
            $client->Surface_habitable                                                  = $lead->Surface_habitable;
            $client->Surface_à_chauffer                                                 = $lead->Surface_à_chauffer;
            $client->Consommation_chauffage_annuel                                      = $lead->Consommation_chauffage_annuel;
            $client->Consommation_Chauffage_Annuel_2                                    = $lead->Consommation_Chauffage_Annuel_2;
            $client->Depuis_quand_occupez_vous_le_logement                              = $lead->Depuis_quand_occupez_vous_le_logement;
            $client->Type_du_courant_du_logement                                        = $lead->Type_du_courant_du_logement;
            $client->auxiliary_heating_status                                           = $lead->auxiliary_heating_status;
            $client->auxiliary_heating                                                  = $lead->auxiliary_heating;
            $client->auxiliary_heating__a__                                             = $lead->auxiliary_heating__a__;
            $client->second_heating_generator_status                                    = $lead->second_heating_generator_status;
            $client->second_heating_generator                                           = $lead->second_heating_generator;
            $client->second_heating_generator__a__                                      = $lead->second_heating_generator__a__;
            $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement         = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
            $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__    = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
            $client->Préciser_le_type_de_radiateurs_Aluminium                           = $lead->Préciser_le_type_de_radiateurs_Aluminium;
            $client->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs      = $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
            $client->Préciser_le_type_de_radiateurs_Fonte                               = $lead->Préciser_le_type_de_radiateurs_Fonte;
            $client->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
            $client->Préciser_le_type_de_radiateurs_Acier                               = $lead->Préciser_le_type_de_radiateurs_Acier;
            $client->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
            $client->Préciser_le_type_de_radiateurs_Autre                               = $lead->Préciser_le_type_de_radiateurs_Autre;
            $client->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
            $client->Préciser_le_type_de_radiateurs_Autre___a__                         = $lead->Préciser_le_type_de_radiateurs_Autre___a__;
            $client->Production_dapostropheeau_chaude_sanitaire                         = $lead->Production_dapostropheeau_chaude_sanitaire;
            $client->Instantanné                                                        = $lead->Instantanné;
            $client->Accumulation                                                       = $lead->Accumulation;
            $client->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude     = $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
            $client->Instantanné_Merci_de_préciser                                      = $lead->Instantanné_Merci_de_préciser;
            $client->Accumulation_Merci_de_préciser                                     = $lead->Accumulation_Merci_de_préciser;
            $client->Le_logement_possède_un_réseau_hydraulique                          = $lead->Le_logement_possède_un_réseau_hydraulique;
            $client->auxiliary_heating__Insert_à_bois_Nombre                          = $lead->auxiliary_heating__Insert_à_bois_Nombre;
            $client->auxiliary_heating__Poêle_à_bois_Nombre                          = $lead->auxiliary_heating__Poêle_à_bois_Nombre;
            $client->auxiliary_heating__Poêle_à_gaz_Nombre                          = $lead->auxiliary_heating__Poêle_à_gaz_Nombre;
            $client->auxiliary_heating__Convecteur_électrique_Nombre                          = $lead->auxiliary_heating__Convecteur_électrique_Nombre;
            $client->auxiliary_heating__Sèche_serviette_Nombre                          = $lead->auxiliary_heating__Sèche_serviette_Nombre;
            $client->auxiliary_heating__Panneau_rayonnant_Nombre                          = $lead->auxiliary_heating__Panneau_rayonnant_Nombre;
            $client->auxiliary_heating__Radiateur_bain_dhuile_Nombre                          = $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
            $client->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                          = $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
            $client->auxiliary_heating__Autre_Nombre                          = $lead->auxiliary_heating__Autre_Nombre;
            $client->Précisez_le_volume_du_ballon_dapostropheeau_chaude                 = $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
            $client->Information_logement_observations                                  = $lead->Information_logement_observations;
            $client->Situation_familiale                                                = $lead->Situation_familiale;
            $client->Situation_familiale___a__                                          = $lead->Situation_familiale___a__;
            $client->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                         = $lead->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
            $client->Personne_1                                                         = $lead->Personne_1;
            $client->Quel_est_le_contrat_de_travail_de_Personne_1                       = $lead->Quel_est_le_contrat_de_travail_de_Personne_1;
            $client->Quel_est_le_contrat_de_travail_de_Personne_1__a__                  = $lead->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
            $client->Revenue_Personne_1                                                 = $lead->Revenue_Personne_1;
            $client->Existehyphenthyphenil_un_conjoint                                  = $lead->Existehyphenthyphenil_un_conjoint;
            $client->Personne_2                                                         = $lead->Personne_2;
            $client->Quel_est_le_contrat_de_travail_de_Personne_2                       = $lead->Quel_est_le_contrat_de_travail_de_Personne_2;
            $client->Quel_est_le_contrat_de_travail_de_Personne_2__a__                  = $lead->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
            $client->Revenue_Personne_2                                                 = $lead->Revenue_Personne_2;
            $client->Crédit_du_foyer_mensuel                                            = $lead->Crédit_du_foyer_mensuel;
            $client->Commentaires_revenue_et_crédit_du_foyer                            = $lead->Commentaires_revenue_et_crédit_du_foyer;
            $client->Type_de_contrat                                                   = $lead->Type_de_contrat;
            $client->MaPrimeRenov                                                      = $lead->MaPrimeRenov;
            $client->Subvention_MaPrimeRénov_déduit_du_devis                           = $lead->Subvention_MaPrimeRénov_déduit_du_devis;
            $client->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
            $client->Action_Logement                                                   = $lead->Action_Logement;
            $client->CEE                                                               = $lead->CEE;
            $client->Credit                                                            = $lead->Credit;
            $client->Montant_Crédit                                                    = $lead->Montant_Crédit;
            $client->Report_du_crédit                                                  = $lead->Report_du_crédit;
            $client->Nombre_de_jours_report                                            = $lead->Nombre_de_jours_report;
            $client->Reste_à_charge                                                    = $lead->Reste_à_charge;
            $client->Reste_à_charge_Montant                                            = $lead->Reste_à_charge_Montant;
            $client->Survente                                                          = $lead->Survente;
            $client->Montant_survente                                                  = $lead->Montant_survente;
            $client->Observations_reste_à_charge                                       = $lead->Observations_reste_à_charge;
            $client->Mode_de_paiement                                                  = $lead->Mode_de_paiement;
            $client->Nombre_de_mensualités                                             = $lead->Nombre_de_mensualités;
            $client->advance_visit                                                     = $lead->advance_visit; 
            $client->Projet_observations                                               = $lead->Projet_observations; 
            $client->Montant_estimée_de_lapostropheaide                                = $lead->Montant_estimée_de_lapostropheaide; 
            $client->latitude                                                          = $lead->latitude;
            $client->longitude                                                         = $lead->longitude;
            $client->lead_tracking_custom_field_data                                   = $lead->lead_tracking_custom_field_data;
            $client->personal_info_custom_field_data                                   = $lead->personal_info_custom_field_data; 
            $client->eligibility_custom_field_data                                     = $lead->eligibility_custom_field_data;
            $client->situation_foyer_custom_field_data                                 = $lead->situation_foyer_custom_field_data;
            $client->project_custom_field_data                                         = $lead->project_custom_field_data;
            $client->user_id                                                           = Auth::id();
            $client->Type_habitation                                                   = $lead->Type_habitation;
            $client->Type_de_logement                                                  = $lead->Type_de_logement;
            $client->Type_de_chauffage                                                 = $lead->Type_de_chauffage;
    
            $client->save();
            
                
    
            $project = new NewProject();
    
            $project->user_id                                                            = Auth::id();
            $project->lead_id                                                           = $lead->id;
            $project->client_id                                                         = $client->id;
            $project->company_id                                                        = $lead->company_id;
            $project->lead_telecommercial                                               = $lead->lead_telecommercial;
            $project->project_label                                                     = 1;
            $project->project_telecommercial                                            = $lead->lead_telecommercial; 
            $project->__tracking__Fournisseur_de_lead                                   = $lead->__tracking__Fournisseur_de_lead;
            $project->__tracking__Type_de_campagne                                      = $lead->__tracking__Type_de_campagne;
            $project->__tracking__Type_de_campagne__a__                                 = $lead->__tracking__Type_de_campagne__a__;
            $project->__tracking__Nom_campagne                                          = $lead->__tracking__Nom_campagne;
            $project->__tracking__Date_demande_lead                                     = $lead->__tracking__Date_demande_lead;
            $project->__tracking__Date_attribution_télécommercial                       = $lead->__tracking__Date_attribution_télécommercial;
            $project->__tracking__Type_de_travaux_souhaité                              = $lead->__tracking__Type_de_travaux_souhaité;
            $project->__tracking__Nom_Prénom                                            = $lead->__tracking__Nom_Prénom;
            $project->__tracking__Code_postal                                           = $lead->__tracking__Code_postal;
            $project->__tracking__Email                                                 = $lead->__tracking__Email;
            $project->__tracking__téléphone                                             = $lead->__tracking__téléphone;
            $project->__tracking__Département                                           = $lead->__tracking__Département;
            $project->__tracking__Mode_de_chauffage                                     = $lead->__tracking__Mode_de_chauffage;
            $project->__tracking__Mode_de_chauffage__a__                                = $lead->__tracking__Mode_de_chauffage__a__;
            $project->__tracking__Propriétaire                                          = $lead->__tracking__Propriétaire;
            $project->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans        = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $project->Titre                                                             = $lead->Titre;
            $project->Prenom                                                            = $lead->Prenom;
            $project->Nom                                                               = $lead->Nom;
            $project->Adresse                                                           = $lead->Adresse;
            $project->Complément_adresse                                                = $lead->Complément_adresse;
            $project->Code_Postal                                                       = $lead->Code_Postal;
            $project->Ville                                                             = $lead->Ville;
            $project->Département                                                       = $lead->Département;
            $project->Email                                                             = $lead->Email;
            $project->same_as_work_address                                              = $lead->same_as_work_address;
            $project->Adresse_Travaux                                                   = $lead->Adresse_Travaux;
            $project->Complément_adresse_Travaux                                        = $lead->Complément_adresse_Travaux;
            $project->Code_postal_Travaux                                               = $lead->Code_postal_Travaux;
            $project->Ville_Travaux                                                     = $lead->Ville_Travaux;
            $project->Departement_Travaux                                               = $lead->Departement_Travaux;
            $project->phone                                                             = $lead->phone;
            $project->fixed_number                                                      = $lead->fixed_number;
            $project->Observations                                                      = $lead->Observations;
            $project->precariousness                                                    = $lead->precariousness;
            $project->Type_occupation                                                   = $lead->Type_occupation;
            $project->Parcelle_cadastrale                                               = $lead->Parcelle_cadastrale;
            $project->Revenue_Fiscale_de_Référence                                      = $lead->Revenue_Fiscale_de_Référence;
            $project->Nombre_de_foyer                                                   = $lead->Nombre_de_foyer;
            $project->Nombre_de_personnes                                               = $lead->Nombre_de_personnes;
            $project->Age_du_bâtiment                                                   = $lead->Age_du_bâtiment;
            $project->Zone                                                              = $lead->Zone;
            $project->Éligibilité_MaPrimeRenov                                          = $lead->Éligibilité_MaPrimeRenov;
            $project->Mode_de_chauffage                                                 = $lead->Mode_de_chauffage;
            $project->Mode_de_chauffage__a__                                            = $lead->Mode_de_chauffage__a__;
            $project->Date_construction_maison                                          = $lead->Date_construction_maison;
            $project->Surface_habitable                                                 = $lead->Surface_habitable;
            $project->Surface_à_chauffer                                                = $lead->Surface_à_chauffer;
            $project->Consommation_chauffage_annuel                                     = $lead->Consommation_chauffage_annuel;
            $project->Consommation_Chauffage_Annuel_2                                   = $lead->Consommation_Chauffage_Annuel_2;
            $project->Depuis_quand_occupez_vous_le_logement                             = $lead->Depuis_quand_occupez_vous_le_logement;
            $project->Type_du_courant_du_logement                                       = $lead->Type_du_courant_du_logement;
            $project->auxiliary_heating_status                                          = $lead->auxiliary_heating_status;
            $project->auxiliary_heating                                                 = $lead->auxiliary_heating;
            $project->auxiliary_heating__a__                                            = $lead->auxiliary_heating__a__;
            $project->second_heating_generator_status                                   = $lead->second_heating_generator_status;
            $project->second_heating_generator                                          = $lead->second_heating_generator;
            $project->second_heating_generator__a__                                     = $lead->second_heating_generator__a__;
            $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement        = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
            $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__   = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
            $project->Préciser_le_type_de_radiateurs_Aluminium                          = $lead->Préciser_le_type_de_radiateurs_Aluminium;
            $project->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs     = $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
            $project->Préciser_le_type_de_radiateurs_Fonte                              = $lead->Préciser_le_type_de_radiateurs_Fonte;
            $project->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
            $project->Préciser_le_type_de_radiateurs_Acier                              = $lead->Préciser_le_type_de_radiateurs_Acier;
            $project->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
            $project->Préciser_le_type_de_radiateurs_Autre                              = $lead->Préciser_le_type_de_radiateurs_Autre;
            $project->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
            $project->Préciser_le_type_de_radiateurs_Autre___a__                        = $lead->Préciser_le_type_de_radiateurs_Autre___a__;
            $project->Production_dapostropheeau_chaude_sanitaire                        = $lead->Production_dapostropheeau_chaude_sanitaire;
            $project->Instantanné                                                       = $lead->Instantanné;
            $project->Accumulation                                                      = $lead->Accumulation;
            $project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude    = $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
            $project->Instantanné_Merci_de_préciser                                     = $lead->Instantanné_Merci_de_préciser;
            $project->Accumulation_Merci_de_préciser                                    = $lead->Accumulation_Merci_de_préciser;
            $project->Le_logement_possède_un_réseau_hydraulique                         = $lead->Le_logement_possède_un_réseau_hydraulique;
            $project->auxiliary_heating__Insert_à_bois_Nombre                         = $lead->auxiliary_heating__Insert_à_bois_Nombre;
            $project->auxiliary_heating__Poêle_à_bois_Nombre                         = $lead->auxiliary_heating__Poêle_à_bois_Nombre;
            $project->auxiliary_heating__Poêle_à_gaz_Nombre                         = $lead->auxiliary_heating__Poêle_à_gaz_Nombre;
            $project->auxiliary_heating__Convecteur_électrique_Nombre                         = $lead->auxiliary_heating__Convecteur_électrique_Nombre;
            $project->auxiliary_heating__Sèche_serviette_Nombre                         = $lead->auxiliary_heating__Sèche_serviette_Nombre;
            $project->auxiliary_heating__Panneau_rayonnant_Nombre                         = $lead->auxiliary_heating__Panneau_rayonnant_Nombre;
            $project->auxiliary_heating__Radiateur_bain_dhuile_Nombre                         = $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
            $project->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                         = $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
            $project->auxiliary_heating__Autre_Nombre                         = $lead->auxiliary_heating__Autre_Nombre;
            $project->Précisez_le_volume_du_ballon_dapostropheeau_chaude                = $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
            $project->Information_logement_observations                                 = $lead->Information_logement_observations;
            $project->Situation_familiale                                               = $lead->Situation_familiale;
            $project->Situation_familiale___a__                                         = $lead->Situation_familiale___a__;
            $project->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                        = $lead->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
            $project->Personne_1                                                        = $lead->Personne_1;
            $project->Quel_est_le_contrat_de_travail_de_Personne_1                      = $lead->Quel_est_le_contrat_de_travail_de_Personne_1;
            $project->Quel_est_le_contrat_de_travail_de_Personne_1__a__                 = $lead->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
            $project->Revenue_Personne_1                                                = $lead->Revenue_Personne_1;
            $project->Existehyphenthyphenil_un_conjoint                                 = $lead->Existehyphenthyphenil_un_conjoint;
            $project->Personne_2                                                        = $lead->Personne_2;
            $project->Quel_est_le_contrat_de_travail_de_Personne_2                      = $lead->Quel_est_le_contrat_de_travail_de_Personne_2;
            $project->Quel_est_le_contrat_de_travail_de_Personne_2__a__                 = $lead->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
            $project->Revenue_Personne_2                                                = $lead->Revenue_Personne_2;
            $project->Crédit_du_foyer_mensuel                                           = $lead->Crédit_du_foyer_mensuel;
            $project->Commentaires_revenue_et_crédit_du_foyer                           = $lead->Commentaires_revenue_et_crédit_du_foyer;
            $project->__projet__Adresse_des_travaux                                     = $lead->__projet__Adresse_des_travaux;
            $project->__projet__Code_postale_des_travaux                                = $lead->__projet__Code_postale_des_travaux;
            $project->__projet__Ville_des_travaux                                       = $lead->__projet__Ville_des_travaux;
            $project->__projet__Département_des_travaux                                 = $lead->__projet__Département_des_travaux;
            $project->Type_de_contrat                                                   = $lead->Type_de_contrat;
            $project->MaPrimeRenov                                                      = $lead->MaPrimeRenov;
            $project->Subvention_MaPrimeRénov_déduit_du_devis                           = $lead->Subvention_MaPrimeRénov_déduit_du_devis;
            $project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
            $project->Action_Logement                                                   = $lead->Action_Logement;
            $project->CEE                                                               = $lead->CEE;
            $project->Credit                                                            = $lead->Credit;
            $project->Montant_Crédit                                                    = $lead->Montant_Crédit;
            $project->Report_du_crédit                                                  = $lead->Report_du_crédit;
            $project->Nombre_de_jours_report                                            = $lead->Nombre_de_jours_report;
            $project->Reste_à_charge                                                    = $lead->Reste_à_charge;
            $project->Reste_à_charge_Montant                                            = $lead->Reste_à_charge_Montant;
            $project->Survente                                                          = $lead->Survente;
            $project->Montant_survente                                                  = $lead->Montant_survente;
            $project->Observations_reste_à_charge                                       = $lead->Observations_reste_à_charge;
            $project->Mode_de_paiement                                                  = $lead->Mode_de_paiement;
            $project->Nombre_de_mensualités                                             = $lead->Nombre_de_mensualités;
            $project->advance_visit                                                     = $lead->advance_visit; 
            $project->Projet_observations                                               = $lead->Projet_observations; 
            $project->latitude                                                          = $lead->latitude; 
            $project->longitude                                                         = $lead->longitude; 
            $project->Montant_estimée_de_lapostropheaide                                = $lead->Montant_estimée_de_lapostropheaide; 
            $project->question_data                                                     = $lead->question_data;  
            $project->lead_tracking_custom_field_data                                    = $lead->lead_tracking_custom_field_data;
            $project->personal_info_custom_field_data                                    = $lead->personal_info_custom_field_data; 
            $project->eligibility_custom_field_data                                      = $lead->eligibility_custom_field_data;
            $project->situation_foyer_custom_field_data                                  = $lead->situation_foyer_custom_field_data;
            $project->project_custom_field_data                                          = $lead->project_custom_field_data;
            $project->Type_habitation                                                    = $lead->Type_habitation;
            $project->Type_de_logement                                                   = $lead->Type_de_logement;
            $project->Type_de_chauffage                                                  = $lead->Type_de_chauffage;
    
            $project->project_sub_status = 5; 
            $project->save();
                
            // if($request->user_id){
            //     ProjectAssign::create([
            //         'user_id' => $request->user_id,
            //         'project_id' => $project->id,
            //     ]);
            // }
            // if($request->gestionnaire_id){
            //     ProjectGestionnaire::create([
            //         'user_id' => $request->gestionnaire_id,
            //         'project_id' => $project->id,
            //     ]);
            // }

            $taxs = LeadTax::where('lead_id', $lead->id)->get();
            foreach($taxs as $tax){
                ClientTax::create([
                    'client_id' => $client->id,
                    'tax_number' => $tax->tax_number,
                    'tax_reference' => $tax->tax_reference,
                    'title' => $tax->title,
                    'first_name' => $tax->first_name,
                    'last_name' => $tax->last_name,
                    'second_title' => $tax->second_title,
                    'second_first_name' => $tax->second_first_name,
                    'second_last_name' => $tax->second_last_name,
                    'kids' => $tax->kids,
                    'phone' => $tax->phone,
                    'telephone' => $tax->telephone,
                    'email' => $tax->email,
                    'pays' => $tax->pays,
                    'postal_code' => $tax->postal_code,
                    'city' => $tax->city,
                    'address' => $tax->address,
                    'primary' => $tax->primary,
                    'type' => $tax->type,
                    'mark_check' => $tax->mark_check,
                    'address2' => $tax->address2,
                    'family_person' => $tax->family_person,
                    'observations' => $tax->observations,
                    'department' => $tax->department,
                    'same_as_work_address' => $tax->same_as_work_address,
                    'Adresse_Travaux' => $tax->Adresse_Travaux,
                    'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                    'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                    'Ville_Travaux' => $tax->Ville_Travaux,
                    'Departement_Travaux' => $tax->Departement_Travaux, 
                    'house_owner_status' => $tax->house_owner_status, 
                    'property_tax_status' => $tax->property_tax_status, 
                    'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                    'Existe_déclarant' => $tax->Existe_déclarant, 
                    'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                    'google_address' => $tax->google_address, 
                    'latitude' => $tax->latitude, 
                    'longitude' => $tax->longitude, 
                    'user_id' => $tax->user_id,
                    'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                    'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                    'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                    'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                    'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                    'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                ]);
                ProjectTax::create([
                    'project_id' => $project->id,
                    'tax_number' => $tax->tax_number,
                    'tax_reference' => $tax->tax_reference,
                    'title' => $tax->title,
                    'first_name' => $tax->first_name,
                    'last_name' => $tax->last_name,
                    'second_title' => $tax->second_title,
                    'second_first_name' => $tax->second_first_name,
                    'second_last_name' => $tax->second_last_name,
                    'kids' => $tax->kids,
                    'phone' => $tax->phone,
                    'telephone' => $tax->telephone,
                    'email' => $tax->email,
                    'pays' => $tax->pays,
                    'postal_code' => $tax->postal_code,
                    'city' => $tax->city,
                    'address' => $tax->address,
                    'primary' => $tax->primary,
                    'type' => $tax->type,
                    'mark_check' => $tax->mark_check,
                    'address2' => $tax->address2,
                    'family_person' => $tax->family_person,
                    'observations' => $tax->observations,
                    'department' => $tax->department,
                    'same_as_work_address' => $tax->same_as_work_address,
                    'Adresse_Travaux' => $tax->Adresse_Travaux,
                    'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                    'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                    'Ville_Travaux' => $tax->Ville_Travaux,
                    'Departement_Travaux' => $tax->Departement_Travaux, 
                    'house_owner_status' => $tax->house_owner_status, 
                    'property_tax_status' => $tax->property_tax_status, 
                    'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                    'Existe_déclarant' => $tax->Existe_déclarant, 
                    'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                    'google_address' => $tax->google_address, 
                    'latitude' => $tax->latitude, 
                    'longitude' => $tax->longitude, 
                    'user_id' => $tax->user_id,
                    'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                    'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                    'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                    'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                    'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                    'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                ]);
            }

            $childrens = Children::where('lead_id', $lead->id)->get(); 
            foreach($childrens as $children){
                Children::create([
                    'name'          => $children->name,
                    'birth_date'    => $children->birth_date,
                    'client_id'     =>$client->id, 
                ]);
                
                Children::create([
                    'name'          => $children->name,
                    'birth_date'    => $children->birth_date,
                    'project_id'    =>$project->id, 
                ]);
            }  

            $lead_baremes = $lead->LeadBareme;
            if($lead_baremes){
                foreach($lead_baremes as $bareme){
                    ProjectBareme::create([
                        'project_id' => $project->id,
                        'barame_id'  => $bareme->id
                    ]); 
                    ClientBareme::create([
                        'client_id'  => $client->id,
                        'barame_id'  => $bareme->id    
                    ]);
                }
            } 
            $lead_travauxs = $lead->LeadTravax;
            if($lead_travauxs){
                foreach($lead_travauxs as $travaux){
                    ProjectTravaux::create([
                        'project_id' => $project->id,
                        'travaux_id' => $travaux->id
                    ]);

                    ClientTravaux::create([
                        'client_id' => $client->id,
                        'travaux_id' => $travaux->id
                    ]);
                }
            } 

            $lead_travaux_tags = LeadTravauxTag::where('lead_id', $lead->id)->get();
            if($lead_travaux_tags){
                foreach($lead_travaux_tags as $travaux_tag){
                    ProjectTravauxTag::create([
                        'project_id' => $project->id,
                        'tag_id' => $travaux_tag->tag_id
                    ]);

                    ClientTravauxTag::create([
                        'client_id' => $client->id,
                        'tag_id' => $travaux_tag->tag_id,
                        'surface' => $travaux_tag->surface,
                        'Nombre_de_split' => $travaux_tag->Nombre_de_split,
                        'Type_de_comble' => $travaux_tag->Type_de_comble,
                        'marque' => $travaux_tag->marque,
                        'shab' => $travaux_tag->shab,
                        'Nombre_de_pièces_dans_le_logement' => $travaux_tag->Nombre_de_pièces_dans_le_logement,
                        'Type_de_radiateur' => $travaux_tag->Type_de_radiateur,
                        'Nombre_de_radiateurs_électrique' => $travaux_tag->Nombre_de_radiateurs_électrique,
                        'Nombre_de_radiateurs_combustible' => $travaux_tag->Nombre_de_radiateurs_combustible,
                        'Nombre_de_radiateur_total_dans_le_logement' => $travaux_tag->Nombre_de_radiateur_total_dans_le_logement,
                        'Thermostat_supplémentaire' => $travaux_tag->Thermostat_supplémentaire,
                        'Nombre_thermostat_supplémentaire' => $travaux_tag->Nombre_thermostat_supplémentaire,
                    ]);

                    $tag_item = ProjectTag::create([
                        'project_id'    => $project->id,
                        'tag_id'        => $travaux_tag->tag_id, 
                        'surface'        => $travaux_tag->surface, 
                        'Nombre_de_split'        => $travaux_tag->Nombre_de_split, 
                        'Type_de_comble'        => $travaux_tag->Type_de_comble, 
                        'marque'        => $travaux_tag->marque, 
                        'shab'        => $travaux_tag->shab, 
                        'Nombre_de_pièces_dans_le_logement'        => $travaux_tag->Nombre_de_pièces_dans_le_logement, 
                        'Type_de_radiateur'        => $travaux_tag->Type_de_radiateur, 
                        'Nombre_de_radiateurs_électrique'        => $travaux_tag->Nombre_de_radiateurs_électrique, 
                        'Nombre_de_radiateurs_combustible'        => $travaux_tag->Nombre_de_radiateurs_combustible, 
                        'Nombre_de_radiateur_total_dans_le_logement'        => $travaux_tag->Nombre_de_radiateur_total_dans_le_logement, 
                        'Thermostat_supplémentaire'        => $travaux_tag->Thermostat_supplémentaire, 
                        'Nombre_thermostat_supplémentaire'        => $travaux_tag->Nombre_thermostat_supplémentaire, 
                    ]);

                    $lead_tag_products = LeadWorkTagProduct::where('work_id', $lead->id)->where('tag_id', $travaux_tag->tag_id)->get();
                    if($lead_tag_products){
                        foreach($lead_tag_products as $product){
                            ProjectTagProduct::create([
                                'project_id'    => $project->id,
                                'tag_id'        => $tag_item->id,
                                'product_id'    => $product->product_id,
                            ]);

                            ClientTagProduct::create([
                                'client_id'     => $client->id,
                                'tag_id'        => $product->tag_id,
                                'product_id'    => $product->product_id,
                            ]);
                        }
                    }
                }
                
            }   


            foreach($lead->getLeadComments->where('lead_reset_status', 0) as $comment){
                $project_comment = ProjectComment::create([
                    'comment'       => $comment->comment,
                    'project_id'    => $project->id,
                    'status'        => $comment->status,
                    'category_id'   => $comment->category_id,
                    'user_id'       => $comment->user_id,
                ]);
                foreach($comment->file as $file){
                    ProjectCommentFile::create([
                        'comment_id' => $project_comment->id,
                        'name'       => $file->name,
                        'type'       => $file->type,
                    ]);
                }
            }

            $lead_product_nombres = LeadProductNombre::where('lead_id', $lead->id)->get();
            foreach($lead_product_nombres as $lead_product_nombre){
                ClientProductNombre::create([
                    'client_id' => $client->id,
                    'tag_id' => $lead_product_nombre->tag_id,
                    'product_id' => $lead_product_nombre->product_id,
                    'number' => $lead_product_nombre->number,
                ]);
                ProjectProductNombre::create([
                    'project_id' => $project->id,
                    'tag_id' => $lead_product_nombre->tag_id,
                    'product_id' => $lead_product_nombre->product_id,
                    'number' => $lead_product_nombre->number,
                ]);
            }
            

            $user = User::find(1);
            $name = Auth::user()->name;
            $subject = 'Lead Converted'; 
            $body = 'Lead have been converted to client by '.$name; 
            if($user->email_professional){
                // Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
            }

            $notification = Notifications::create([
            'title'  => ['en' => 'Lead Converted', 'fr' =>'Prospect converti'],
            'body'   => ['en' => 'Lead have been converted to client by '. Auth::user()->name, 'fr' => 'Les prospects ont été convertis en clients par '. Auth::user()->name],
            'user_id' => 1,
            'client_id' => $lead->id,
            ]); 

            $user = User::find(1);
            $name = Auth::user()->name;
            $subject = 'Project Create'; 
            $body = 'A new project have been created by '.$name; 
            if($user->email_professional){
                // Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
            }

            $notification = Notifications::create([
            'title'  => ['en' => 'Project Create', 'fr' =>'Créer un projet'],
            'body'   => ['en' => 'A new project have been created by '. Auth::user()->name, 'fr' => 'Un nouveau projet a été créé par '. Auth::user()->name],
            'user_id' => 1,
            'project_id' => $lead->id,
            ]); 

    
            $pannel_activity = PannelLogActivity::create([  
                'label_prev_id' => 6,
                'label_id'      => 7,
                'status'        => 'change_etiquette',
                'key'           => "etiquette",  
                'feature_type'  => 'lead',
                'feature_id'    => $lead->id,
                'user_id'       => Auth::id(), 
            ]); 
    
            $lead->etiquette_automatise_recurrence_status = 0;
            $lead->etiquette_automatise_id = 0; 
            $lead->etiquette_fin = 1;
    
            event(new PannelLog($pannel_activity->id));

            $automatisations = Automatise::where('automatisation_for', 'prospects')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
            $travaux = '';
            $travaux_count = 1;
            foreach($lead->LeadTravax as $item){
                $travaux .= $item->travaux .($travaux_count != $lead->LeadTravax->count() ? ', ':'');
                $travaux_count++;
            }
            
            foreach($automatisations as $automatisation)
            {
                if(str_contains($automatisation->status, 'main'))
                {
                        $status = explode('_', $automatisation->status); 

                    if($status[1] == 7)
                    {
                        if($automatisation->recurrence == 'Oui'){
                            $lead->etiquette_automatise_recurrence_status = 1;
                            $lead->etiquette_automatise_id = $automatisation->id;
                            $lead->etiquette_automatise_recurrence_start = Carbon::now();
                        }
                        
                        if($automatisation->sending_type == 'send_email')
                        {
                            $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                            $subject = $template->object;
                            $body = $template->body;
                            
                            $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                            $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                            $body = str_replace('{titre}', $lead->Titre, $body);
                            $body = str_replace('{nom_client}', $lead->Nom, $body);
                            $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                            $body = str_replace('{email_client}', $lead->Email, $body);
                            $body = str_replace('{téléphone_client}', $lead->phone, $body);
                            if($lead->leadTelecommercial){
                                $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                if($lead->leadTelecommercial->getRegie){
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                    $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                }else{
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }
                            }else{
                                $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            } 
                            
                            $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                            $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                            $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                            $body = str_replace('{projet_travaux}', $travaux, $body);
                            $body = str_replace('{statut_projet}', ' ', $body);
                            $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                            $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                            $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                            $body = str_replace('{installation_date_intervention}', ' ', $body);
                            $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                            $body = str_replace('{SAV_date_intervention}', ' ', $body);
                            $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                            $body = str_replace('{etude_date_intervention}', ' ', $body);
                            $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                            $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                            $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                            
                            // $subject = $automatisation->name;
                            if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                            {
                                
                                if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                {
                                
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files =public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }

                                    if($automatisation->select_to == 'Telecommercial'){
                                        $data["email"] = $lead->leadTelecommercial->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($lead->leadTelecommercial->email_professional){
                                            $data["email"] = $lead->leadTelecommercial->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 
                                    }
                            
                                    // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                }

                            }
                            if($automatisation->select_to == 'Client')
                            { 
                                $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                                
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }

                            if($automatisation->select_to == 'Mail personnalisé')
                            { 
                                $data["email"] = $automatisation->custom_email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                                
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }
                                
                            if($automatisation->select_to_cc){
                                if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                {
                                    
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
                                    }
    
                                }
                                if($automatisation->select_to_cc == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                    
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cc == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cc;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                            if($automatisation->select_to_cci){
                                if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                {
                                    
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }

                                        }
                                    }
    
                                }
                                if($automatisation->select_to_cci == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                    
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cci == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cci;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                        }
                        else
                        {

                        $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                        $body = $template->body;
                        
                        $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                        $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                        $body = str_replace('{titre}', $lead->Titre, $body);
                        $body = str_replace('{nom_client}', $lead->Nom, $body);
                        $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                        $body = str_replace('{email_client}', $lead->Email, $body);
                        $body = str_replace('{téléphone_client}', $lead->phone, $body);
                        if($lead->leadTelecommercial){
                            $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                            if($lead->leadTelecommercial->getRegie){
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                            }else{
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            }
                        }else{
                            $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                            $body = str_replace('{regie}', ' ', $body);
                        } 
                        $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                        $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                        $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                        $body = str_replace('{projet_travaux}', $travaux, $body);
                        $body = str_replace('{statut_projet}', ' ', $body);
                        $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                        $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                        $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                        $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                        $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                        $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                        $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 

                        $subject = $automatisation->name;
                        
                        if($automatisation->select_to == 'Client')
                        { 
                        
                            try {
    
                                $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                $client = new \Nexmo\Client($basic);
                        
                                $receiverNumber = $lead->phone;
                                $message = $body;
                        
                                $message = $client->message()->send([
                                    'to' => str_replace('+', '', $receiverNumber),
                                    'from' => 'Novecology',
                                    'text' => $message
                                ]);
                        
                                
                                    
                            } catch (Exception $e) {
                                
                            }

                        }
                        if($automatisation->select_to_cc){
                            if($automatisation->select_to_cc == 'Client')
                            { 
                            
                                try {
        
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                            
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                            
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                            
                                    
                                        
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                        }
                        if($automatisation->select_to_cci){
                            if($automatisation->select_to_cci == 'Client')
                            { 
                            
                                try {
        
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                            
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                            
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                            
                                    
                                        
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                        }
                        
                        
                        }
                    }   
                }
            } 
      
        }
        return 'Success';
         

    }

    // Lead Export 
    public function leadExport( $status ){

        if($status === 'client'){
            return Excel::download(new LeadExport($status), 'clients.xlsx');
        }else{
            return Excel::download(new LeadExport($status), 'leads.xlsx');
        }
    }

    // Lead Import 
    public function leadImport(Request $request){
        $request->validate([
            'file' => 'required|file',
        ]);
        $data = $request->except('_token', 'file', 'lead_tracking_custom__field', 'personal_information_custom__field', 'eligibility_custom__field', 'information_logement_custom__field', 'situation_foyer_custom__field', 'project_custom__field', 'selected_regie', 'selected_label', 'selected__telecommercial', 'selected_sub_status'); 
        $custom_field_column = [];
        $custom_field_column['lead_tracking_custom__field'] = $request->lead_tracking_custom__field;
        $custom_field_column['personal_information_custom__field'] = $request->personal_information_custom__field;
        $custom_field_column['eligibility_custom__field'] = $request->eligibility_custom__field;
        $custom_field_column['information_logement_custom__field'] = $request->information_logement_custom__field;
        $custom_field_column['situation_foyer_custom__field'] = $request->situation_foyer_custom__field;
        $custom_field_column['project_custom__field'] = $request->project_custom__field;
        $regie = $request->selected_regie;
        $label = $request->selected_label;   
        $telecommercial = $request->selected__telecommercial;   
        $sub_status = $request->selected_sub_status;   

        Excel::import(new LeadsImport($data, $custom_field_column, $regie, $label, $telecommercial, $sub_status), request()->file('file'));

        $file = request()->file('file'); 
        $data = Excel::toArray([], $file);
        $count = 0;
        if (isset($data[0])) {
            $count = count($data[0]) - 1;
        }

        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' importer avec succès');
    }


    // Delete Lead 
    public function leadDelete(Request $request){
        
         Lead::findOrFail($request->lead_id)->update([
            'deleted_status' => 'yes',
         ]);
         $notifications = Notifications::where('lead_id', $request->lead_id)->get();
         if($notifications->count() > 0){
             foreach($notifications as $notification){
                 $notification->delete();
             }
         }

        return back()->with('success', __('Lead Successfully Deleted'));
    }

    // Lead Header Filter 
    public function leadHeaderFilter(Request $request){

        if(!checkAction(Auth::id(), 'lead', 'add_filter') && role() != 's_admin'){
            return back();
        }

        $existing_filter = LeadHeaderFilter::where('user_id', Auth::id())->get();
        
        foreach($existing_filter as $item){
            $item->delete();
        } 
         
        if($request->header_id){
            foreach($request->header_id as $id){
                LeadHeaderFilter::create([
                    'lead_header_id' => $id,
                    'user_id'        => Auth::id(),
                    'status'         =>'show',
                ]);
            }
        }
       

        return back()->with('success', __('Filter Added'));
    }

    // All Lead Search 
    public function allLeadSearch(Request $request){

        $company_name = 'all';
        $search = $request->search;
        $column = $request->column;
        if($search){

            $progress_leads = Lead::where($column, 'LIKE', '%'.$search.'%')->where('status', 'in-progress')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
            $pre_validate_leads = Lead::where($column, 'LIKE', '%'.$search.'%')->where('status', 'pre-validated')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
            $verified_leads = Lead::where($column, 'LIKE', '%'.$search.'%')->where('status', 'verified')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        }
        else{
            
            $progress_leads = Lead::where('status', 'in-progress')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
            $pre_validate_leads = Lead::where('status', 'pre-validated')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
            $verified_leads = Lead::where('status', 'verified')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        }
        
        $filter_status = LeadHeaderFilter::where('user_id', Auth::id())->orderBy('lead_header_id', 'asc')->get();
        $progress_view = view('includes.crm.progress_leads', compact('progress_leads', 'filter_status', 'company_name'));
        $pre_validate_view = view('includes.crm.pre_validate_leads', compact('pre_validate_leads', 'filter_status', 'company_name'));
        $verified_view = view('includes.crm.verified_leads', compact('verified_leads', 'filter_status', 'company_name')); 


        $progress = $progress_view->render();
        $pre_validate = $pre_validate_view->render();
        $verified = $verified_view->render();
        return response()->json(['progress' => $progress, 'pre_validate' => $pre_validate, 'verified' => $verified]); 


        // return response($column);
    }

    //Company Lead Search
    public function companyLeadSearch(Request $request){

        
        $search     = $request->search;
        $column     = $request->column;
        $company_id = $request->company_id;

        if($search){
            $progress_leads = Lead::where($column, 'LIKE', '%'.$search.'%')->where('company_id', $company_id)->where('status', 'in-progress')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
            $pre_validate_leads = Lead::where($column, 'LIKE', '%'.$search.'%')->where('company_id', $company_id)->where('status', 'pre-validated')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
            $verified_leads = Lead::where($column, 'LIKE', '%'.$search.'%')->where('company_id', $company_id)->where('status', 'verified')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        }
        else{
            $progress_leads = Lead::where('company_id', $company_id)->where('status', 'in-progress')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
            $pre_validate_leads = Lead::where('company_id', $company_id)->where('status', 'pre-validated')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
            $verified_leads = Lead::where('company_id', $company_id)->where('status', 'verified')->where('deleted_status', 'no')->where('convert_status', 'no')->where('data_status', 'yes')->orderBy('id', 'desc')->paginate(10);
        }
      
        $filter_status = LeadHeaderFilter::where('user_id', Auth::id())->orderBy('lead_header_id', 'asc')->get();
        $progress_view = view('includes.crm.progress_leads', compact('progress_leads', 'filter_status'));
        $pre_validate_view = view('includes.crm.pre_validate_leads', compact('pre_validate_leads', 'filter_status'));
        $verified_view = view('includes.crm.verified_leads', compact('verified_leads', 'filter_status')); 


        $progress = $progress_view->render();
        $pre_validate = $pre_validate_view->render();
        $verified = $verified_view->render();
        return response()->json(['progress' => $progress, 'pre_validate' => $pre_validate, 'verified' => $verified]); 

        

        // return response($inprogress);
    }

    // Lead Assign 
    public function leadAssign(Request $request){

        $lead_id = $request->lead_id;
        $user_id = $request->user_id; 
        
        $lead = LeadClientProject::find($lead_id);
        if($lead->lead_label == 1){
            $lead->lead_label = 2;
        }
        if($lead->lead_telecommercial != $user_id){
            $lead->lead_telecommercial = $user_id;

            $lead->save();

            $pannel_activity = PannelLogActivity::create([
                'key'           => 'telecommercial__change',
                'value'         => $user_id,
                'feature_id'    => $lead_id,
                'feature_type'  => 'lead',
                'user_id'       => Auth::id(), 
            ]);

            event(new PannelLog($pannel_activity->id));


            $user = User::find($user_id);
            $name = Auth::user()->name;
            $subject = 'New Lead Assign';
            $body = $user->name.', You have been assigned a lead by '.$name;
                // Mail::to($user->email)->send(new AssignMail($subject, $body));
            $notification = Notifications::create([
                'title'  => ['en' => 'Lead Assign', 'fr' =>'Attribution des rôles principaux'],
                'body'   => ['en' => 'You have been assigned a lead by '. Auth::user()->name, 'fr' => 'Vous avez été assigné à une piste par '. Auth::user()->name],
                'user_id' => $user_id,
                'lead_id' => $lead_id,
            ]); 
        }  

        return back()->with('success', __('Lead Assigned')); 

    }

    // Lead assignee 
    public function leadAssignee(Request $request){

        $lead_id = $request->lead_id;
        $users = User::all();

        $view = view('includes.crm.leadassign', compact('users', 'lead_id'));

        $response = $view->render();

        return response()->json(['response' => $response]);
    }

    // Lead assign checkbox 
    public function leadAssignCheckbox(Request $request, $status, $company_id = null){
        $checked_lead_id = explode(',', $request->checkedLead); 
        if($request->checkAll == 1){
             
            if($company_id){
                return Excel::download(new CompanyLead('all', $status, $company_id), 'leads.xlsx');
            }
            return Excel::download(new CheckExport('all', $status), 'leads.xlsx');
            
        }else{ 
            // $dd =  Lead::findMany($request->checkedLead);  
            if($company_id){
                
                return Excel::download(new CompanyLead('selected', $checked_lead_id, $company_id), 'leads.xlsx');
            }
            return Excel::download(new CheckExport('selected', $checked_lead_id), 'leads.xlsx');
        }

        // if($status === 'client'){
        //     return Excel::download(new LeadExport($status), 'clients.xlsx');
        // }else{
        //     return Excel::download(new LeadExport($status), 'leads.xlsx');
        // }

    }

    // Lead Bulk Assign 
    public function leadBulkAssign(Request $request){
 
        $checked_lead_id = explode(',', $request->checkedLead); 
        $user_id = $request->user_id; 
        // dd($checked_lead_id);
        $count = 0;
        foreach($checked_lead_id as $lead_id){ 
            
            $lead = LeadClientProject::find($lead_id);
            if($lead){
                $count++;
                if($lead->lead_label == 1){
                    $lead->lead_label = 2;
                }
                if($lead->lead_telecommercial != $user_id){
                    $lead->lead_telecommercial = $user_id;
        
                    $lead->save();
    
                    $pannel_activity = PannelLogActivity::create([
                        'key'           => 'telecommercial__change',
                        'value'         => $user_id,
                        'feature_id'    => $lead_id,
                        'feature_type'  => 'lead',
                        'user_id'       => Auth::id(), 
                    ]);
    
                    event(new PannelLog($pannel_activity->id));
    
        
                    $user = User::find($user_id);
                    $name = Auth::user()->name;
                    $subject = 'New Lead Assign';
                    $body = $user->name.', You have been assigned a lead by '.$name; 
                    $notification = Notifications::create([
                        'title'  => ['en' => 'Lead Assign', 'fr' =>'Attribution des rôles principaux'],
                        'body'   => ['en' => 'You have been assigned a lead by '. Auth::user()->name, 'fr' => 'Vous avez été assigné à une piste par '. Auth::user()->name],
                        'user_id' => $user_id,
                        'lead_id' => $lead_id,
                    ]); 
                } 
            }
        }

        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' attribué avec succès'); 
    }

    public function leadBulkAssignSupplier(Request $request){
 
        $checked_lead_id = explode(',', $request->checkedLead); 
        $supplier_id = $request->supplier_id; 
        // dd($checked_lead_id);
        $count = 0;
        foreach($checked_lead_id as $lead_id){ 
            $lead = LeadClientProject::find($lead_id);
            if($lead && $lead->__tracking__Fournisseur_de_lead != $supplier_id){
                $count++;
                $lead->__tracking__Fournisseur_de_lead = $supplier_id;
                $lead->save();

                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Lead Tracking',
                    'block_name'    => 'Suivi des prospects (formulaire et réponse)',
                    'key'           => '__tracking__Fournisseur_de_lead',
                    'value'         => $supplier_id,
                    'feature_id'    => $lead_id,
                    'feature_type'  => 'lead',
                    'user_id'       => Auth::id(), 
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        // return back()->with('success', 'fournisseur de lead attribué'); 
        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' fournisseur de lead attribué avec succès'); 
    }

    public function leadBulkRegieAssign(Request $request){
 
        $checked_lead_id = explode(',', $request->checkedLead); 
        $regie_id = $request->regie_id; 
        // dd($checked_lead_id);
        $count = 0;
        foreach($checked_lead_id as $lead_id){ 
            
            $lead = LeadClientProject::find($lead_id);
            if($lead){
                $count++;
                if($lead->import_regie != $regie_id){
                    $lead->import_regie = $regie_id; 
                    $lead->save(); 
                }
            }
        }

        // return back()->with('success', __('Lead Assigned')); 
        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' régie attribuée avec succès');
    }

    // Lead Bulk Delete 
    public function leadBulkDelete(Request $request){ 
        $checked_lead_id = explode(',', $request->checkedLead); 
        $count = 0;
        foreach($checked_lead_id as $lead_id){
            $lead = LeadClientProject::find($lead_id);
            if($lead){
                $count++;
                $lead->update(['lead_deleted_status' => 1, 'lead_telecommercial' => null]);
                Notifications::where('lead_id', $lead->id)->get()->each->delete(); 
            }
        }
        // return back()->with('success', __('Lead Successfully Deleted'));
        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' supprimé avec succès'); 
    }

    // Tax Info Update 
    public function taxInfoUpdate(Request $request){  
        // dd($request->all());
        $tax = LeadTax::find($request->tax_id);
        $lead  = LeadClientProject::find($request->lead_id);
        // $tax->update($request->except('_token','tax_id','lead_id','company_id', 'custom_field_data'));
 
        $tax->phone  = $request->phone;
        $tax->email  = $request->email;
        $tax->telephone  = $request->telephone;
        $tax->postal_code  = $request->postal_code;
        $tax->city  = $request->city; 
        $tax->title  = $request->title;
        $tax->first_name  = $request->first_name;
        $tax->last_name  = $request->last_name;
        $tax->second_title  = $request->second_title;
        $tax->second_first_name  = $request->second_first_name;
        $tax->second_last_name  = $request->second_last_name;
        $tax->observations  = $request->observations;
        // if($tax->same_as_work_address  != $request->same_as_work_address){ /
            
        $tax->same_as_work_address  = $request->same_as_work_address;
        $tax->google_address  = $request->google_address;
        if($request->same_as_work_address == 'no'){
            $tax->Adresse_Travaux  = $request->Adresse_Travaux;
            $tax->Complément_adresse_Travaux  = $request->Complément_adresse_Travaux;
            $tax->Code_postal_Travaux  = $request->Code_postal_Travaux;
            $tax->Ville_Travaux  = $request->Ville_Travaux;

        }else{
            $tax->Adresse_Travaux  = '';
            $tax->Complément_adresse_Travaux  = '';
            $tax->Code_postal_Travaux  = '';
            $tax->Ville_Travaux  = '';      
        }
        if($request->google_address){
            $location = self::location($request->google_address); 
            $tax->latitude  = $location['status'] == 'success' ? $location['lat']:'';
            $tax->longitude  = $location['status'] == 'success' ? $location['lng']:'';
        }
        
        // }else{
        //     if($tax->address2  != $request->address2){
        //         $location = self::location($request->address2); 
        //         $tax->latitude  = $location['status'] == 'success' ? $location['lat']:'';
        //         $tax->longitude  = $location['status'] == 'success' ? $location['lng']:'';
        //     }
        // }

        $tax->address  = $request->address;
        $tax->address2  = $request->address2;
        $tax->save();
        
        foreach($tax->getChanges() as $key => $value){
            if($key != "updated_at" && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => 'Informations personnelles',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->lead_id,
                    'feature_type'  => 'lead',
                    'user_id'       => Auth::id(), 
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = []; 
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){  
                $input_key[] = $key;
                $input_item[] = $item;   
            }  
            $costom_field_data = array_combine($input_key, $input_item); 
            $json = json_encode($costom_field_data); 
            $lead->personal_info_custom_field_data = $json;
            $lead->save(); 
        }


        $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
        $activity = $activity_log->render(); 
        if($tax->primary == 'yes'){
            $lead = LeadClientProject::where('id', $request->lead_id)->first();
            $lead->Titre       = $tax->title;
            $lead->Prenom       = $tax->first_name;
            $lead->Nom        = $tax->last_name;
            $lead->Email            = $tax->email;
            $lead->phone            = $tax->phone;
            $lead->fixed_number            = $tax->telephone;
            $lead->latitude            = $tax->latitude;
            $lead->longitude            = $tax->longitude;
            if($tax->same_as_work_address == 'no'){
                $lead->Ville             = $tax->Ville_Travaux;
                $lead->Code_Postal       = $tax->Code_postal_Travaux;
                $lead->Zone              = getPrimaryZone($tax->Code_postal_Travaux);
                $lead->Adresse           = $tax->Adresse_Travaux;
                $lead->Complément_adresse= $tax->Complément_adresse_Travaux;
                $lead->Département       = getDepartment3($tax->Code_postal_Travaux);
                if($lead->precariousness_year == '2023'){
                    $lead->precariousness    = getPrecariousness($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $tax->Code_postal_Travaux);
                }else{
                    $lead->precariousness    = getPrecariousness2024($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $tax->Code_postal_Travaux);
                }
                $lead->save(); 
                $zone_type = 'Zone_Hors_IDF';
                if($lead->Code_Postal){
                    if(\App\Models\CRM\CheckZone::where('postal_code', substr($lead->Code_Postal, 0,2))->exists()){
                        $zone_type = 'Zone_IDF';
                    }
                }
                return response()->json(['alert' => __('Info Updated Successfully'),'email' => $tax->email, 'phone' => $tax->phone, 'name' => $tax->first_name.' '.$tax->last_name, 'city' => getDepartment($tax->Code_postal_Travaux), 'zone' => $lead->Ville, 'precariousness' => $lead->precariousness, 'department' =>getDepartment2($tax->Code_postal_Travaux), 'address' => $tax->Adresse_Travaux, 'postal_code' => $tax->Code_postal_Travaux, 'ville' => $tax->Ville_Travaux, 'log' => $activity, 'loggleAddress' => urlencode($request->google_address), 'zone_type' => $zone_type]);
            }else{
                $lead->Ville             = $tax->city;
                $lead->Code_Postal       = $tax->postal_code;
                $lead->Zone              = getPrimaryZone($tax->postal_code);
                $lead->Adresse           = $tax->address2;
                $lead->Complément_adresse= $tax->address;
                $lead->Département       = getDepartment3($tax->postal_code);
                if($lead->precariousness_year == '2023'){
                    $lead->precariousness   = getPrecariousness($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $tax->postal_code);
                }else{
                    $lead->precariousness   = getPrecariousness2024($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $tax->postal_code);
                }
                $lead->save(); 
                $zone_type = 'Zone_Hors_IDF';
                if($lead->Code_Postal){
                    if(\App\Models\CRM\CheckZone::where('postal_code', substr($lead->Code_Postal, 0,2))->exists()){
                        $zone_type = 'Zone_IDF';
                    }
                }
                return response()->json(['alert' => __('Info Updated Successfully'),'email' => $tax->email, 'phone' => $tax->phone, 'name' => $tax->first_name.' '.$tax->last_name, 'city' => getDepartment($tax->postal_code), 'zone' => $lead->Ville, 'precariousness' => $lead->precariousness, 'department' =>getDepartment2($tax->postal_code), 'address' => $tax->address2, 'postal_code' => $tax->postal_code, 'ville' => $tax->city, 'log' => $activity, 'loggleAddress' => urlencode($request->google_address), 'zone_type' => $zone_type]);
            }
        }else{
            return response()->json(['alert' => __('Info Updated Successfully'), 'log' => $activity, 'loggleAddress' => urlencode($request->google_address)]);
        }
    }
    
    public function fiscal()
    {
        return view ('fiscal');
    }
    public function checkZone(Request $request){

        function downloadPage( $sURL, 
          $iConnectionTimeOut = 110, 
          $iTimeOut = 110,
          $aHeaders = array(),
          $sPostData = '')
        {
        $sUserAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2112.0 Safari/537.36';
        $sContent = ''; 
        $ch = curl_init();
        !empty($aHeaders) ?curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeaders):'';
        !empty($sProxy)   ?curl_setopt($ch, CURLOPT_PROXY, $sProxy):'';	
        if(!empty($sPostData))
        {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$sPostData);
        }
        curl_setopt($ch, CURLOPT_USERAGENT,$sUserAgent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);  	
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$iConnectionTimeOut);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $iTimeOut);
        curl_setopt($ch, CURLOPT_URL, $sURL);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        $sContent = curl_exec($ch);
        $aInfo = curl_getinfo($ch);
        curl_close($ch);
        $sContent = str_replace("\t","",$sContent);
        $sContent = str_replace("\r","",$sContent);
        $sContent = str_replace("\n","",$sContent);
        return $sContent;
        }
        $sFiscal  = $request->fiscal;
        $sFacture  = $request->facture;
        $aAnswer = [];
        $sURL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf';
        $sHTML = downloadPage($sURL);
        preg_match("/name=\"javax.faces.ViewState\" id=\"j_id__v_0:javax.faces.ViewState:1\" value=\"(.*?)\"/",$sHTML,$aData);
        $sViewState = isset($aData[1])?$aData[1]:'';
        $sPost = 'j_id_7%3Aspi='.$sFiscal.'&j_id_7%3Anum_facture='.$sFacture.'&j_id_7%3Aj_id_l=Valider&j_id_7_SUBMIT=1&javax.faces.ViewState='.urlencode($sViewState);
        $aHeaders = ['Host: cfsmsp.impots.gouv.fr',
                    'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',
                    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language: en-GB,en;q=0.5',
                    'Accept-Encoding: gzip, deflate, br',
                    'Referer: https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf',
                    'Content-Type: application/x-www-form-urlencoded',
                    'Origin: https://cfsmsp.impots.gouv.fr',
                    'DNT: 1',
                    'Connection: keep-alive',
                    'Upgrade-Insecure-Requests: 1',
                    'Sec-Fetch-Dest: document',
                    'Sec-Fetch-Mode: navigate',
                    'Sec-Fetch-Site: same-origin',
                    'Sec-Fetch-User: ?1'];
        $sURL = 'https://cfsmsp.impots.gouv.fr/secavis/faces/avis/saisie_error.jsf';
        $sHTML = downloadPage( $sURL,110,110,[],$sPost);
        /*Parse Data*/
        preg_match("/Nom de naissance<\/td><td class=\"labelImpair\">(.*?)<\/td><td class=\"labelImpair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
        $aAnswer['declarant_1'] = isset($aData[1])?$aData[1]:'';
        $aAnswer['declarant_2'] = isset($aData[2])?$aData[2]:''; 
        preg_match("/Nom<\/td><td class=\"labelPair\">(.*?)<\/td><td class=\"labelPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
        $aAnswer['noms_declarant_1'] = isset($aData[1])?$aData[1]:'';
        $aAnswer['noms_declarant_2'] = isset($aData[2])?$aData[2]:'';
        
        preg_match("/Prénom\(s\)<\/td><td class=\"labelPair\">(.*?)<\/td><td class=\"labelPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
        $aAnswer['prenoms_declarant_1'] = isset($aData[1])?$aData[1]:'';
        $aAnswer['prenoms_declarant_2'] = isset($aData[2])?$aData[2]:'';
        
        preg_match("/Adresse déclarée au (.*?)<\/td><td class=\"labelPair\">(.*?)<\/td><td class=\"labelPair\"><\/td><\/tr><tr><td class=\"labelPair\"><\/td><td colspan=\"2\" class=\"labelPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
        $aAnswer['address_date'] = isset($aData[1])?strip_tags($aData[1]):'';
        $aAnswer['address_1'] = isset($aData[2])?$aData[2]:'';
        $aAnswer['address_2'] = isset($aData[3])?$aData[3]:'';
        
        preg_match("/Date de mise en recouvrement de l'avis d'impôt<\/td><td class=\"textPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
        $aAnswer['date_recouvrement'] = isset($aData[1])?$aData[1]:'';
        
        preg_match("/Date d\'établissement<\/td><td class=\"textImpair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
        $aAnswer['date_of_establishment'] = isset($aData[1])?$aData[1]:'';
        
        preg_match("/Nombre de personne\(s\) à charge<\/td><td class=\"textPair\">(.*?)<\/td><\/tr>/",$sHTML,$aData);
        $aAnswer['nombre_de_personnes'] = isset($aData[1])?$aData[1]:'';
        
        preg_match("/Revenu fiscal de référence<\/td><td class=\"textImpair\">(.*?) €<\/td><\/tr></",$sHTML,$aData);
        $aAnswer['date_de_personnes'] = isset($aData[1])?preg_replace('/\xc2\xa0/', '',str_replace(' ','',$aData[1])):'';
        
        $aJSONAnswer = json_encode($aAnswer);
        header('Content-type: application/json');
        echo($aJSONAnswer); 
        // echo $aAnswer['declarant_1'] ."</n>";
        // echo $aAnswer['declarant_2'] ."</n>";
        // echo $aAnswer['address_1'] ."</n>";
        // echo $aAnswer['address_2'] ."</n>";
        // echo  $aAnswer['date_de_personnes']; 
    }

    public function taxPrimaryChange(Request $request){

        $all_tax = LeadTax::where('lead_id', $request->lead_id)->get();
        foreach($all_tax as $tax){
            $tax->primary = 'no';
            $tax->save();
        }

        $taxe = LeadTax::find($request->tax_id);

        // if($taxe->second_first_name){
        //     $person = 2 + $taxe->kids;
        // }
        // else{
        //     $person = 1 + $taxe->kids;
        // } 

        $taxe->primary = 'yes';
        $taxe->save();
        $lead = LeadClientProject::find($request->lead_id);
        $lead->Prenom       = $taxe->first_name;
        $lead->Nom        = $taxe->last_name;
        // $lead->Revenue_Fiscale_de_Référence    = $taxe->pays;
        $lead->Ville             = $taxe->city;
        if($taxe->same_as_work_address == 'no'){
            if(!$taxe->google_address){
                $location = self::location($taxe->Adresse_Travaux); 
                $lead->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                $lead->longitude  = $location['status'] == 'success' ? $location['lng']:''; 
            }
            $lead->Code_Postal      = $taxe->Code_postal_Travaux; 
            $lead->Zone             = getPrimaryZone($taxe->Code_postal_Travaux);
            $lead->Adresse           = $taxe->Adresse_Travaux;
            $lead->Complément_adresse= $taxe->Complément_adresse_Travaux;
            $lead->Département       = getDepartment3($taxe->Code_postal_Travaux);
            if($lead->precariousness_year == '2023'){
                $lead->precariousness   = getPrecariousness($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $taxe->Code_postal_Travaux);
            }else{
                $lead->precariousness   = getPrecariousness2024($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $taxe->Code_postal_Travaux);
            }
        }else{
            if(!$taxe->google_address){
                $location = self::location($taxe->address2); 
                $lead->latitude  = $location['status'] == 'success' ? $location['lat']:'';
                $lead->longitude  = $location['status'] == 'success' ? $location['lng']:''; 
            }
            $lead->Code_Postal      = $taxe->postal_code; 
            $lead->Zone             = getPrimaryZone($taxe->postal_code);
            $lead->Adresse           = $taxe->address2;
            $lead->Complément_adresse= $taxe->address;
            $lead->Département       = getDepartment3($taxe->postal_code);
            if($lead->precariousness_year == '2023'){
                $lead->precariousness   = getPrecariousness($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $taxe->postal_code);
            }else{
                $lead->precariousness   = getPrecariousness2024($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $taxe->postal_code);
            }
        };
        $lead->Email            = $taxe->email;
        $lead->phone            = $taxe->phone;
        // $lead->Revenue_Fiscale_de_Référence    = $taxe->pays;
        // $lead->Nombre_de_personnes    = $person;
        $lead->lead_user_id          = Auth::id();
        $lead->save();
 


        $tax = LeadTax::where('lead_id', $request->lead_id)->orderBy('primary', 'asc')->get();
        $primary_tax = LeadTax::where('lead_id', $request->lead_id)->where('primary', 'yes')->first();
        $type = 'lead_collapse_personal_information'; 
        $data = LeadClientProject::find($request->lead_id);
        $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
        $tax_all = $all_taxes->render();  

        return response()->json(['taxes' => $tax_all, 'alert' => __('Info Updated Successfully'),'address' => $taxe->address,'address2' => $taxe->address2, 'zone' => $lead->Zone ,'precariousness' => $lead->precariousness, 'city' => getDepartment($lead->Code_Postal), 'name' => $taxe->first_name.' '.$taxe->last_name, 'email' => $taxe->email, 'phone' => $taxe->phone]);

        // if($taxe->same_as_work_address == 'no'){
        //     return response()->json(['taxes' => $tax_all, 'alert' => __('Info Updated Successfully'),'address' => $taxe->address,'address2' => $taxe->address2, 'zone' => getPrimaryZone($taxe->Code_postal_Travaux),'precariousness' => getPrecariousness($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $taxe->Code_postal_Travaux), 'city' => getDepartment($taxe->Code_postal_Travaux), 'name' => $taxe->first_name.' '.$taxe->last_name, 'email' => $taxe->email, 'phone' => $taxe->phone]);
        // }else{
        //     return response()->json(['taxes' => $tax_all, 'alert' => __('Info Updated Successfully'),'address' => $taxe->address,'address2' => $taxe->address2, 'zone' => getPrimaryZone($taxe->postal_code),'precariousness' => getPrecariousness($lead->Nombre_de_personnes, $lead->Revenue_Fiscale_de_Référence, $taxe->postal_code), 'city' => getDepartment($taxe->postal_code), 'name' => $taxe->first_name.' '.$taxe->last_name, 'email' => $taxe->email, 'phone' => $taxe->phone]);
        // }
    }
    public function taxMarkCheck(Request $request){

        $taxe = LeadTax::find($request->tax_id); 
        $taxe->update([
            'mark_check' => $request->data,
        ]);
        $lead = LeadClientProject::find($request->lead_id);
        $tax = LeadTax::where('lead_id', $request->lead_id)->orderBy('primary', 'asc')->get();
        $primary_tax = LeadTax::where('lead_id', $request->lead_id)->where('primary', 'yes')->first();
        $fiscal_amount = LeadTax::where('lead_id', $request->lead_id)->where('mark_check', 'yes')->sum('pays'); 
        $family_person = LeadTax::where('lead_id', $request->lead_id)->where('mark_check', 'yes')->sum('family_person');
        if($lead->precariousness_year == '2023'){
            if($primary_tax->same_as_work_address == 'no'){
                $lead->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness($family_person, $fiscal_amount, $primary_tax->Code_postal_Travaux)
                ]);
            }else{
                $lead->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness($family_person, $fiscal_amount, $primary_tax->postal_code)
                ]);
            }
        }else{
            if($primary_tax->same_as_work_address == 'no'){
                $lead->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness2024($family_person, $fiscal_amount, $primary_tax->Code_postal_Travaux)
                ]);
            }else{
                $lead->update([
                    'Revenue_Fiscale_de_Référence'      => $fiscal_amount,
                    'Nombre_de_personnes'               => $family_person,
                    'precariousness'                    => getPrecariousness2024($family_person, $fiscal_amount, $primary_tax->postal_code)
                ]);
            }
        }
        $type = 'lead_collapse_personal_information';
        $data = LeadClientProject::find($request->lead_id);
        $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
        $tax_all = $all_taxes->render();  

        return response()->json(['taxes' => $tax_all, 'alert' => __('Updated Successfully'), 'fiscal_amount' => $fiscal_amount, 'family_person' => $family_person, 'precariousness' => $lead->precariousness]);
    }

    public function taxRemove(Request $request){
        // dd($request->all());
        $tax = Tax::find($request->tax_id);
        if($tax->primary == 'yes'){
            return redirect()->back()->with('error', __('This is primary Tax, Please another one'))->with('client_active', 'tax tab ko active');
        }else{
            $tax->delete();
            return redirect()->back()->with('success', __('Tax remove successfully'))->with('client_active', 'tax tab ko active');
        }
    }
    public function leadTaxRemove(Request $request){
        // dd($request->all());
        $tax = LeadTax::find($request->tax_id);
        if($tax->primary == 'yes'){
            return redirect()->back()->with('error', __('This is primary Tax, Please another one'))->with('client_active', 'tax tab ko active');
        }else{
            $tax->delete();
            return redirect()->back()->with('success', __('Tax remove successfully'))->with('client_active', 'tax tab ko active');
        }
    }

    public function leadUserStatusChange(Request $request){
        
        // dd($request->all());
        // $lead = Lead::findOrFail($request->lead_id);
        // $lead->user_status = $request->lead_status_id; 
        // $lead->save();

        return redirect()->back()->with('success', __('Status Updated'));
    }

    // create lead status 
    public function leadCreateStatus(Request $request){

        $request->validate([
            'status'            => 'required',
            'status_color'      => 'required',
            'background_color'  => 'required',
        ],[
            'status.required'           => __('Status is required'),
            'status_color.required'     => __('Status color is required'),
            'background_color.required' => __('Status background color is required'),
        ]);
 
        LeadStatus::create($request->except('_token'));
        return  redirect()->back()->with('success', __('Added Successfully'));
    }

    // create lead status 
    public function leadUpdateStatus(Request $request){
        $request->validate([
            'status'            => 'required',
            'status_color'      => 'required',
            'background_color'  => 'required',
        ],[
            'status.required'           => __('Status is required'),
            'status_color.required'     => __('Status color is required'),
            'background_color.required' => __('Status background color is required'),
        ]);
        LeadStatus::find($request->status_id)->update($request->except('_token', 'status_id'));
        // LeadStatus::create($request->except('_token'));
        return  redirect()->back()->with('success', __('Updated Successfully'));
    }

    public function leadDeleteStatus(Request $request){
        $leads = Lead::where('user_status', $request->lead_status_id)->get();
        if($leads->count() > 0){
            foreach($leads as $lead){
                $lead->user_status = 0;
                $lead->save();
            }
        }
        Session::forget('lead_tab_active');
        LeadStatus::find($request->lead_status_id)->delete();
        return redirect()->back()->with('success', __('Deleted Successfully'));
    }

    public function leadFoyerUpdate(Request $request){
        $lead = LeadClientProject::find($request->lead_id);
        if($request->birth_name){ 
            foreach($request->birth_name as $key => $value){
                if($value){
                    Children::create([
                        'name'          => $value,
                        'birth_date'    => $request->birth_date[$key],
                        'lead_id'       => $request->lead_id,
                        'created_by'    => Auth::id(),
                    ]);
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => 'Situation foyer',
                        'key'           => 'Nom',
                        'value'         => $value,
                        'feature_id'    => $request->lead_id,
                        'feature_type'  => 'lead',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => 'Situation foyer',
                        'key'           => 'Date De Naissance',
                        'value'         => $request->birth_date[$key],
                        'feature_id'    => $request->lead_id,
                        'feature_type'  => 'lead',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
            }
        }
        $lead->update($request->except(['_token','lead_id', 'birth_name', 'birth_date', 'custom_field_data'])); 
    

        foreach($lead->getChanges() as $key => $value){
            if($key != "updated_at" && $key != 'user_id'){
                $pannel_activity = PannelLogActivity::create([
                    'tab_name'      => 'Client',
                    'block_name'    => 'Situation foyer',
                    'key'           => $key,
                    'value'         => $value,
                    'feature_id'    => $request->lead_id,
                    'feature_type'  => 'lead',
                    'user_id'       => Auth::id(), 
                ]);
                event(new PannelLog($pannel_activity->id));
            }
        }

        $input_key = [];
        $input_item = []; 
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){  
                $input_key[] = $key;
                $input_item[] = $item;   
            }  
            $costom_field_data = array_combine($input_key, $input_item); 
            $json = json_encode($costom_field_data); 
            $lead->situation_foyer_custom_field_data = $json;
            $lead->save(); 
        }

        $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
        $activity = $activity_log->render();
        

        $childrens = Children::where('lead_id', $request->lead_id)->get();

        $child = view('includes.crm.children', compact('childrens'));
        
        $child_rander = $child->render();

        return response()->json(['alert' => __('Updated Successfully'), 'children' => $child_rander, 'log' => $activity]);
    }

    // Lead Tracker Update 
    public function leadTrackerUpdate(Request $request){

        $lead  = LeadClientProject::find($request->lead_id); 
            $lead->__tracking__Fournisseur_de_lead = $request->__tracking__Fournisseur_de_lead;
            $lead->__tracking__Type_de_campagne = $request->__tracking__Type_de_campagne;
            $lead->__tracking__Nom_campagne = $request->__tracking__Nom_campagne;
            $lead->__tracking__Date_demande_lead = $request->__tracking__Date_demande_lead;
            $lead->__tracking__Date_attribution_télécommercial = $request->__tracking__Date_attribution_télécommercial;
            $lead->__tracking__Nom_Prénom = $request->__tracking__Nom_Prénom;
            $lead->__tracking__Code_postal = $request->__tracking__Code_postal;
            $lead->__tracking__Département = getDepartment2($request->__tracking__Code_postal);
            $lead->__tracking__téléphone = $request->__tracking__téléphone;
            $lead->__tracking__Mode_de_chauffage = $request->__tracking__Mode_de_chauffage;
            $lead->__tracking__Propriétaire = $request->__tracking__Propriétaire;
            $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans = $request->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $lead->__tracking__Email = $request->__tracking__Email;
            $lead->__tracking__Type_de_campagne__a__ = $request->__tracking__Type_de_campagne__a__;
            $lead->__tracking__Mode_de_chauffage__a__ = $request->__tracking__Mode_de_chauffage__a__;
            $lead->__tracking__Type_de_travaux_souhaité = $request->__tracking__Type_de_travaux_souhaité;
            $lead->save();
            
            foreach($lead->getChanges() as $key => $value){
                if($key != 'updated_at'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Lead Tracking',
                        'block_name'    => 'Suivi des prospects (formulaire et réponse)',
                        'key'           => $key,
                        'value'         => $value,
                        'feature_id'    => $request->lead_id,
                        'feature_type'  => 'lead',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
            }
            
            $input_key = [];
            $input_item = []; 
            if($request->custom_field_data){
                foreach($request->custom_field_data as $key => $item){  
                    $input_key[] = $key;
                    $input_item[] = $item;   
                }  
                $costom_field_data = array_combine($input_key, $input_item); 
                $json = json_encode($costom_field_data); 
                $lead->lead_tracking_custom_field_data = $json;
                $lead->save(); 
            }

        $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
        $activity = $activity_log->render();
        
        return response()->json(['alert' => __('Updated Successfully'), 'log' => $activity, 'department' => $lead->__tracking__Département]); 
    }

    // lead travaux update 
    public function leadTravauxUpdate(Request $request){ 

        $lead = LeadClientProject::find($request->lead_id);
        $lead->update($request->except('_token', 'lead_id', 'product','bareme', 'travaux', 'tag_product', 'custom_field_data', 'surface', 'Nombre_de_split', 'Type_de_comble', 'tag_product_nombre', 'marque', 'shab', 'Type_de_radiateur', 'Nombre_de_radiateurs_électrique', 'Nombre_de_radiateurs_combustible', 'Thermostat_supplémentaire', 'Nombre_thermostat_supplémentaire', 'Nombre_de_radiateur_total_dans_le_logement','Nombre_de_pièces_dans_le_logement'));
            foreach($lead->getChanges() as $key => $value){
                if($key != 'updated_at' && $key != 'user_id'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Projet',
                        'block_name'    => 'Projet',
                        'key'           => $key,
                        'value'         => $value,
                        'feature_id'    => $request->lead_id,
                        'feature_type'  => 'lead',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
            }

        
        if($request->travaux){
            $travaux_list = array_merge($request->bareme,$request->travaux);
        }else{
            $travaux_list = $request->bareme;
        }

        $lead->LeadBareme()->sync($request->bareme);
        $lead->LeadTravax()->sync($travaux_list);
        LeadWorkTagProduct::where('work_id', $lead->id)->get()->each->delete();
        LeadTravauxTag::where('lead_id', $lead->id)->get()->each->delete();
        LeadProductNombre::where('lead_id', $lead->id)->get()->each->delete();
        // if(in_array(7, $request->bareme)){
            // $lead->LeadTravaxTags()->sync($travaux_list);
            foreach($travaux_list as $item){
                LeadTravauxTag::create([
                    'lead_id' => $lead->id,
                    'tag_id'  => $item,
                    'surface'  => $request->surface[$item] ?? '',
                    'Nombre_de_split'  => $request->Nombre_de_split[$item] ?? '',
                    'Type_de_comble'  => $request->Type_de_comble[$item] ?? '',
                    'marque'  => $request->marque[$item] ?? null,
                    'shab'  => $request->shab[$item] ?? null,
                    'Nombre_de_pièces_dans_le_logement'  => $request->Nombre_de_pièces_dans_le_logement[$item] ?? null,
                    'Type_de_radiateur'  => $request->Type_de_radiateur[$item] ?? null,
                    'Nombre_de_radiateurs_électrique'  => $request->Nombre_de_radiateurs_électrique[$item] ?? null,
                    'Nombre_de_radiateurs_combustible'  => $request->Nombre_de_radiateurs_combustible[$item] ?? null,
                    'Nombre_de_radiateur_total_dans_le_logement'  => $request->Nombre_de_radiateur_total_dans_le_logement[$item] ?? null,
                    'Thermostat_supplémentaire'  => $request->Thermostat_supplémentaire[$item] ?? null,
                    'Nombre_thermostat_supplémentaire'  => $request->Nombre_thermostat_supplémentaire[$item] ?? null,
                ]);
            }
        // }else{
        //     foreach($request->bareme as $item){
        //         LeadTravauxTag::create([
        //             'lead_id' => $lead->id,
        //             'tag_id'  => $item,
        //             'surface'  => $request->surface[$item] ?? '',
        //             'Nombre_de_split'  => $request->Nombre_de_split[$item] ?? '',
        //             'Type_de_comble'  => $request->Type_de_comble[$item] ?? '',
        //         ]);
        //     }
            // $lead->LeadTravaxTags()->sync($request->bareme);
        // }
        if($request->tag_product){
            foreach($request->tag_product as $tag => $product_arr){
                if($product_arr){
                    foreach($product_arr as $product_id){
                        LeadWorkTagProduct::create([
                            'work_id'       => $lead->id,
                            'tag_id'        => $tag,
                            'product_id'    => $product_id,
                        ]);
                    }
                }
            }
        }  

        
        $input_key = [];
        $input_item = []; 
        if($request->custom_field_data){
            foreach($request->custom_field_data as $key => $item){  
                $input_key[] = $key;
                $input_item[] = $item;   
            }  
            $costom_field_data = array_combine($input_key, $input_item); 
            $json = json_encode($costom_field_data); 
            $lead->project_custom_field_data = $json;
            $lead->save(); 
        }

        if($request->tag_product_nombre){
            foreach($request->tag_product_nombre as $key => $value){
                $number = explode('__', $value);
                LeadProductNombre::create([
                    'lead_id' => $lead->id,
                    'tag_id' => $number[0] ?? 0,
                    'product_id' => $key,
                    'number' => $number[1] ?? '',
                ]);
            }
        }
          
        $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
        $activity = $activity_log->render();
            // return response(__('Updated Successfully'));
        $question = Question::where('lead_id', $request->lead_id)->first();
        $data = view('includes.crm.lead_question', compact('lead'));
        $question = $data->render();
        $tag_list = ''; 
        // dd($lead->LeadBareme);
        foreach ($lead->LeadBareme as $keys => $tagg){
                $tag_list .= '<span class="btn btn-sm rounded" style="border:1px solid #5a616a; background-color: #ffd966">'.$tagg->tag.'</span>';
        }  
        return response()->json(['alert' => __('Updated Successfully'), 'questions' => $question, 'log' => $activity, 'tag' => $tag_list, 'maprime' =>MaPrimeRenovEstimatedAmount($lead->Mode_de_chauffage, $lead->precariousness,  LeadWorkBareme::where('work_id', $lead->id)->pluck('barame_id')), 'cee' => CEEEstimatedAmount($lead->Mode_de_chauffage, $lead->precariousness,  LeadWorkBareme::where('work_id', $lead->id)->pluck('barame_id'))]);
    }

    // lead question update 
    public function leadQuestionUpdate(Request $request){
        $data = Question::where('lead_id', $request->lead_id)->first();
        if($data){
            $data->update($request->except('_token', 'lead_id') + ['user_id' => Auth::id()]); 
        }else{
            Question::create($request->except('_token') + ['user_id' => Auth::id()]);
        }

        return response()->json(['alert' => __('Updated Successfully')]); 
    }
    
    // lead trait update 
    public function leadTraitUpdate(Request $request){
        $trait = ProjectTrait::where('lead_id', $request->lead_id)->first();
        if($trait){
            $trait->previsite = $request->previsite;
            $trait->projet_valide = $request->projet_valide;
            $trait->devis_signe = $request->devis_signe;
            $trait->project_charge = $request->project_charge;
            $trait->additional_work = $request->additional_work;
            $trait->additional_work_payable = $request->additional_work_payable;
            $trait->user_id  = Auth::id();
            $trait->save();  
        }else{
            ProjectTrait::create([
                'lead_id'                 => $request->lead_id,
                'previsite'               => $request->previsite,
                'projet_valide'           => $request->projet_valide,
                'devis_signe'             => $request->devis_signe,
                'project_charge'          => $request->project_charge,
                'additional_work'         => $request->additional_work,
                'additional_work_payable' => $request->additional_work_payable,
                'user_id'                 => Auth::id(),
            ]);
        }

        return response()->json(['alert' => __('Updated Successfully')]);
    }

    public function leadTaxCustomUpdate(Request $request){ 

        $all_taxess = LeadTax::where('lead_id', $request->lead_id)->get(); 
        $data = LeadClientProject::find($request->lead_id); 
                
        $taxx =  LeadTax::create([
            'tax_number'        => $request->tax_number, 
            'tax_reference'     => $request->tax_reference, 
            'lead_id'           => $request->lead_id, 
            'company_id'        => $request->company_id,
            'type'              => 'manually', 
            'user_id'           => Auth::id(),
        ]);


        if($all_taxess->count() > 0) { 
            $taxx->primary = 'no'; 
                $taxx->save();  
            } 
        else{
            $taxx->primary = 'yes';
            $taxx->pays = $data->Revenue_Fiscale_de_Référence;
            $taxx->family_person = $data->Nombre_de_personnes;
            $taxx->save();  

        }

        $pannel_activity = PannelLogActivity::create([
            'tab_name'      => 'Client',
            'block_name'    => "Avis d'impôt",
            'key'           => "Numéro d'exercice",
            'value'         => $taxx->tax_number,
            'feature_id'    => $request->lead_id,
            'feature_type'  => 'lead',
            'user_id'       => Auth::id(), 
        ]);
        event(new PannelLog($pannel_activity->id));
        $pannel_activity = PannelLogActivity::create([
            'tab_name'      => 'Client',
            'block_name'    => "Avis d'impôt",
            'key'           => "Avis de référence",
            'value'         => $taxx->tax_reference,
            'feature_id'    => $request->lead_id,
            'feature_type'  => 'lead',
            'user_id'       => Auth::id(), 
        ]); 
        event(new PannelLog($pannel_activity->id));
            $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
            $activity = $activity_log->render(); 


        $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();

        $view = view('includes.crm.view-notification', compact('notification')); 
        $response = $view->render();


        $tax = LeadTax::where('lead_id', $request->lead_id)->orderBy('primary', 'asc')->get();
        $primary_tax = LeadTax::where('lead_id', $request->lead_id)->where('primary', 'yes')->first();
        $type = 'lead_collapse_personal_information';
        $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
        $tax_all = $all_taxes->render(); 
        $all_taxes_data = view('includes.crm.lead-tax', compact('tax'));
        $all_taxes_data2 = view('includes.crm.lead-tax-info', compact('tax'));
        $tax_all_data = $all_taxes_data->render();
        $tax_all_data2 = $all_taxes_data2->render();
        return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => __('tax added successfully'), 'primary'=> $taxx->primary, 'response' => $response, 'count'=>$count, 'log' => $activity]);

                  
    }

    public function leadTaxCustomUpdate2(Request $request){ 

        $taxx = LeadTax::find($request->tax_id);  
                
        if($taxx){
            $taxx->update([
                'tax_number'        => $request->tax_number, 
                'tax_reference'     => $request->tax_reference, 
            ]);
            
            foreach($taxx->getChanges() as $key => $value){
                if($key == 'tax_number'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => "Avis d'impôt",
                        'key'           => "Numéro d'exercice",
                        'value'         => $taxx->tax_number,
                        'feature_id'    => $taxx->lead_id,
                        'feature_type'  => 'lead',
                        'user_id'       => Auth::id(), 
                    ]);
                    event(new PannelLog($pannel_activity->id));
                }
                if($key == 'tax_reference'){
                    $pannel_activity = PannelLogActivity::create([
                        'tab_name'      => 'Client',
                        'block_name'    => "Avis d'impôt",
                        'key'           => "Avis de référence",
                        'value'         => $taxx->tax_reference,
                        'feature_id'    => $taxx->lead_id,
                        'feature_type'  => 'lead',
                        'user_id'       => Auth::id(), 
                    ]); 
                    event(new PannelLog($pannel_activity->id));
                }
            }
     

            $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $taxx->lead_id)->orderBy('id', 'desc')->get();
            $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
            $activity = $activity_log->render(); 
    
            return response()->json(['alert' => 'mise à jour des taxes avec succès', 'log' => $activity]);
        }else{
            return response()->json(['error' => __('Something went wrong')]);
        }            
    }
    public function leadTaxCustomVerify(Request $request){
        $tax_number = $request->tax_number;
        $tax_reference = $request->tax_reference;

        $fiscal_response = Http::get("http://35.180.14.36:3003/api/scrap?numFiscal=$tax_number&reference=$tax_reference");   
        $response = json_decode($fiscal_response->getBody()->getContents()); 
        $response_errors = [0 => "Quelque chose s'est mal passé !! Réessayez plus tard.", 2 => "La référence de l’avis ne correspond à celle du dernier avis connu pour cet usager", 3 => "Vous devez vérifier les identifiants saisis. Il peut s'agir d'une erreur de saisie ou ces identifiants ne correspondent pas à un avis."];
        if($response->status != 1){
            return response()->json(['error' => $response_errors[$response->status]]);
        }else{
            $all_taxess = LeadTax::where('lead_id', $request->lead_id)->get();  
            $data = LeadClientProject::find($request->lead_id);
                 
            $taxx =  LeadTax::create([
                'tax_number'        => $request->tax_number, 
                'tax_reference'     => $request->tax_reference, 
                'lead_id'           => $request->lead_id, 
                'company_id'        => $request->company_id,
                'type'              => 'manually', 
                'user_id'           => Auth::id(),
            ]);
    
    
            if($all_taxess->count() > 0) { 
                $taxx->primary = 'no'; 
                    $taxx->save();  
                } 
            else{
                $taxx->primary = 'yes';
                $taxx->pays = $data->Revenue_Fiscale_de_Référence;
                $taxx->family_person = $data->Nombre_de_personnes;
                $taxx->save();  
    
            }
    
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Client',
                'block_name'    => "Avis d'impôt",
                'key'           => "Numéro d'exercice",
                'value'         => $taxx->tax_number,
                'feature_id'    => $request->lead_id,
                'feature_type'  => 'lead',
                'user_id'       => Auth::id(), 
            ]);
            event(new PannelLog($pannel_activity->id));
            $pannel_activity = PannelLogActivity::create([
                'tab_name'      => 'Client',
                'block_name'    => "Avis d'impôt",
                'key'           => "Avis de référence",
                'value'         => $taxx->tax_reference,
                'feature_id'    => $request->lead_id,
                'feature_type'  => 'lead',
                'user_id'       => Auth::id(), 
            ]); 
            event(new PannelLog($pannel_activity->id));
                $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->lead_id)->orderBy('id', 'desc')->get();
                $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
                $activity = $activity_log->render(); 
    
    
            $notification = Notifications::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
            $count = Notifications::where('user_id', Auth::id())->where('status', '0')->get()->count();
    
            $view = view('includes.crm.view-notification', compact('notification')); 
            $response = $view->render();
    
    
            $tax = LeadTax::where('lead_id', $request->lead_id)->orderBy('primary', 'asc')->get();
            $primary_tax = LeadTax::where('lead_id', $request->lead_id)->where('primary', 'yes')->first();
            $type = 'lead_collapse_personal_information';
            $all_taxes = view('includes.crm.personal_info', compact('primary_tax', 'type', 'data'));
            $tax_all = $all_taxes->render(); 
            $all_taxes_data = view('includes.crm.lead-tax', compact('tax'));
            $all_taxes_data2 = view('includes.crm.lead-tax-info', compact('tax'));
            $tax_all_data = $all_taxes_data->render();
            $tax_all_data2 = $all_taxes_data2->render();
            return response()->json(['taxes' => $tax_all, 'all_tax' => $tax_all_data, 'all_tax2' => $tax_all_data2, 'alert' => "La référence de l’avis qui a été saisie correspond à celle du dernier avis connu pour cet usager, pour le millésime concerné", 'primary'=> $taxx->primary, 'response' => $response, 'count'=>$count, 'log' => $activity]);  
        }
                  
    }
    public function leadTaxCustomVerify2(Request $request){

        $taxx = LeadTax::find($request->tax_id);  
                
        if($taxx){
            $tax_number = $request->tax_number;
            $tax_reference = $request->tax_reference;
    
            $fiscal_response = Http::get("http://35.180.14.36:3003/api/scrap?numFiscal=$tax_number&reference=$tax_reference");   
            $response = json_decode($fiscal_response->getBody()->getContents()); 
            $response_errors = [0 => "Quelque chose s'est mal passé !! Réessayez plus tard.", 2 => "La référence de l’avis ne correspond à celle du dernier avis connu pour cet usager", 3 => "Vous devez vérifier les identifiants saisis. Il peut s'agir d'une erreur de saisie ou ces identifiants ne correspondent pas à un avis."];
            if($response->status != 1){
                return response()->json(['error' => $response_errors[$response->status]]);
            }else{
                $taxx->update([
                    'tax_number'        => $tax_number, 
                    'tax_reference'     => $tax_reference,  
                ]);

                foreach($taxx->getChanges() as $key => $value){
                    if($key == 'tax_number'){
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Client',
                            'block_name'    => "Avis d'impôt",
                            'key'           => "Numéro d'exercice",
                            'value'         => $taxx->tax_number,
                            'feature_id'    => $taxx->lead_id,
                            'feature_type'  => 'lead',
                            'user_id'       => Auth::id(), 
                        ]);
                        event(new PannelLog($pannel_activity->id));
                    }
                    if($key == 'tax_reference'){
                        $pannel_activity = PannelLogActivity::create([
                            'tab_name'      => 'Client',
                            'block_name'    => "Avis d'impôt",
                            'key'           => "Avis de référence",
                            'value'         => $taxx->tax_reference,
                            'feature_id'    => $taxx->lead_id,
                            'feature_type'  => 'lead',
                            'user_id'       => Auth::id(), 
                        ]); 
                        event(new PannelLog($pannel_activity->id));
                    }
                } 
    
                $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $taxx->lead_id)->orderBy('id', 'desc')->get();
                $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
                $activity = $activity_log->render(); 
        
                return response()->json(['alert' => 'La référence de l’avis qui a été saisie correspond à celle du dernier avis connu pour cet usager, pour le millésime concerné', 'log' => $activity]);
            } 
        }else{
            return response()->json(['error' => __('Something went wrong')]);
        }                    
    }

    public function leadTrackingDateUpdate(Request $request){
        $ids = explode(',', $request->ids);
        $leads = LeadClientProject::whereIn('id', $ids)->get();
        $count = $leads->count();
        foreach($leads as $lead){
            $new_custom_data = [];
            if($lead->lead_tracking_custom_field_data){
                $data = json_decode($lead->lead_tracking_custom_field_data);
                foreach($data as $key  => $value){
                    if($key == 'audience' || $key == 'travaux_formulaire' || $key == 'type_de_chauffage'){
                        $new_custom_data[$key] = $value;
                    }
                } 
            }
            $old_id                     = $lead->id;
            $Nom_Prénom     = $lead->__tracking__Nom_Prénom;
            $Code_postal    = $lead->__tracking__Code_postal;
            $Email          = $lead->__tracking__Email;
            $téléphone      = $lead->__tracking__téléphone;
            $_Nom           = $lead->Nom;
            $_Prenom        = $lead->Prenom;
            $_Email         = $lead->Email;
            $_téléphone     = $lead->phone;
            $Fournisseur_de_lead      = $lead->__tracking__Fournisseur_de_lead;
            $Type_de_campagne      = $lead->__tracking__Type_de_campagne;
            $Nom_campagne      = $lead->__tracking__Nom_campagne;
            $Type_de_travaux_souhaité      = $lead->__tracking__Type_de_travaux_souhaité;
            $Mode_de_chauffage      = $lead->__tracking__Mode_de_chauffage;
            $Propriétaire      = $lead->__tracking__Propriétaire;
            $Votre_maison_ahyphenthyphenelle_plus_de_15_ans      = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $old_regie = null;
            if($lead->lead_label == 1){
                $old_regie = $lead->import_regie;
            }else{
                if($lead->leadTelecommercial && $lead->leadTelecommercial){
                 $old_regie = $lead->leadTelecommercial->regie_id;
                }
            }
            $lead->delete();
            $new_lead = new LeadClientProject(); 
             
            $new_lead->id                               = $old_id;
            $new_lead->lead_label                       = 1;
            $new_lead->lead_status                      = 1;
            $new_lead->company_id                       = 1;
            $new_lead->Nom                              = $_Nom;
            $new_lead->Prenom                           = $_Prenom;
            $new_lead->Email                            = $_Email;
            $new_lead->phone                            = $_téléphone;
            $new_lead->__tracking__Nom_Prénom           = $Nom_Prénom;
            $new_lead->__tracking__Code_postal          = $Code_postal;
            $new_lead->__tracking__Email                = $Email;
            $new_lead->__tracking__téléphone            = $téléphone;
            $new_lead->__tracking__Fournisseur_de_lead            = $Fournisseur_de_lead;
            $new_lead->__tracking__Type_de_campagne            = $Type_de_campagne;
            $new_lead->__tracking__Nom_campagne            = $Nom_campagne;
            $new_lead->__tracking__Type_de_travaux_souhaité            = $Type_de_travaux_souhaité;
            $new_lead->__tracking__Mode_de_chauffage            = $Mode_de_chauffage;
            $new_lead->__tracking__Propriétaire            = $Propriétaire;
            $new_lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans            = $Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $new_lead->__tracking__Date_attribution_télécommercial    = Carbon::today()->format('Y-m-d');
            $new_lead->lead_tracking_custom_field_data = json_encode($new_custom_data);
            $new_lead->__tracking__Date_demande_lead    = Carbon::today()->format('Y-m-d');
            $new_lead->import_regie                     = $old_regie;
            
            // if((role() == 'sales_manager' || role() == 'sales_manager_externe') && Auth::user()->getRegieTelecommercial){
            //     $new_lead->import_regie = Auth::user()->getRegieTelecommercial->id;
            // }

            $new_lead->save();


            LeadWorkBareme::where('work_id', $old_id)->get()->each->delete();
            LeadWorkTravaux::where('work_id', $old_id)->get()->each->delete();
            LeadWorkTagProduct::where('work_id', $old_id)->get()->each->delete();
            LeadTravauxTag::where('lead_id', $old_id)->get()->each->delete();
            LeadTax::where('lead_id', $old_id)->get()->each->delete();
            Children::where('lead_id', $old_id)->get()->each->delete();
            PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $old_id)->get()->each->update([
                'lead_reset_status' => 1
            ]);
            LeadComment::where('lead_id', $old_id)->get()->each->update([
                'lead_reset_status' => 1
            ]); 
            $pannel_activity = PannelLogActivity::create([  
                'key'           => "lead_reset__by", 
                'feature_id'    => $new_lead->id,
                'feature_type'  => 'lead',
                'lead_reset_status' => 1,
                'user_id'       => Auth::id(), 
            ]);   
            event(new PannelLog($pannel_activity->id));
        }

        // return back()->with('success', __('Updated Succesfully'));
        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' remise à zéro avec succès'); 
    }

    public function leadBulkUnassign(Request $request){
        return back();
        $checked_lead_id = explode(',', $request->ids); 
        foreach($checked_lead_id as $lead_id){ 
            $lead = LeadClientProject::find($lead_id);
            $lead->update([
                'lead_label' => 1,
                'lead_telecommercial' => null
            ]); 
        } 

        return back()->with('success', __('Unassigned Successfully'));
    }

    public function leadBarameChange(Request $request){ 
        $selected_bareme = $request->id;
        if($request->id && $request->travaux){
            $tagList = array_merge($request->id,$request->travaux);
        }else if($request->travaux){
            $tagList = $request->travaux;
        }else{
            $tagList = $request->id;
        }
        $tag_product = $request->tag_product;
        $surface = $request->surface;
        $Nombre_de_split = $request->Nombre_de_split;
        $Type_de_comble = $request->Type_de_comble;
        $tag_product_nombre = $request->tag_product_nombre;
        $marque = $request->marque;
        $shab = $request->shab;
        $Nombre_de_pièces_dans_le_logement = $request->Nombre_de_pièces_dans_le_logement;
        $Type_de_radiateur = $request->Type_de_radiateur;
        $Nombre_de_radiateurs_électrique = $request->Nombre_de_radiateurs_électrique;
        $Nombre_de_radiateurs_combustible = $request->Nombre_de_radiateurs_combustible;
        $Nombre_de_radiateur_total_dans_le_logement = $request->Nombre_de_radiateur_total_dans_le_logement;
        $Thermostat_supplémentaire = $request->Thermostat_supplémentaire;
        $Nombre_thermostat_supplémentaire = $request->Nombre_thermostat_supplémentaire;


        $marques = Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();

        $selected_travaux = $request->travaux;   
        $barame_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $bareme_data = view('admin.bareme__list', compact('barame_travaux_tags', 'selected_bareme'))->render(); 
        $travaux_data = view('admin.travaux__list', compact('barame_travaux_tags', 'selected_bareme', 'selected_travaux'))->render();
        $tag_data = view('admin.tag__list', compact('barame_travaux_tags', 'tagList'))->render();
        $product_data = view('admin.product__list', compact('barame_travaux_tags', 'tagList', 'tag_product', 'surface', 'Nombre_de_split', 'Type_de_comble', 'tag_product_nombre', 'marque', 'marques', 'shab', 'Type_de_radiateur', 'Nombre_de_radiateurs_électrique', 'Nombre_de_radiateurs_combustible', 'Thermostat_supplémentaire', 'Nombre_thermostat_supplémentaire', 'Nombre_de_radiateur_total_dans_le_logement','Nombre_de_pièces_dans_le_logement'))->render();
        return response()->json(['travaux' => $travaux_data, 'tag'=> $tag_data, 'product' => $product_data, 'bareme' => $bareme_data]);
        // return response()->json(['travaux' => $travaux_data, 'tag'=> $tag_data, 'product' => $product_data]);

    }

    public function leadTravauxChange(Request $request){
 
        if($request->travaux){
            $tagList = array_merge($request->id,$request->travaux);
        }else if($request->id){
            $tagList = $request->id;
        }else{
            $tagList = $request->travaux;
        }
         $tag_product = $request->tag_product;
        $surface = $request->surface;
        $Nombre_de_split = $request->Nombre_de_split;
        $Type_de_comble = $request->Type_de_comble;
        $tag_product_nombre = $request->tag_product_nombre;
        $marque = $request->marque;
        $shab = $request->shab;
        $Nombre_de_pièces_dans_le_logement = $request->Nombre_de_pièces_dans_le_logement;
        $Type_de_radiateur = $request->Type_de_radiateur;
        $Nombre_de_radiateurs_électrique = $request->Nombre_de_radiateurs_électrique;
        $Nombre_de_radiateurs_combustible = $request->Nombre_de_radiateurs_combustible;
        $Nombre_de_radiateur_total_dans_le_logement = $request->Nombre_de_radiateur_total_dans_le_logement;
        $Thermostat_supplémentaire = $request->Thermostat_supplémentaire;
        $Nombre_thermostat_supplémentaire = $request->Nombre_thermostat_supplémentaire;

        $marques = Brand::where('active', 'Oui')->orderBy('description', 'asc')->get();

        $barame_travaux_tags = BaremeTravauxTag::orderBy('order')->get();
        $tag_data = view('admin.tag__list', compact('barame_travaux_tags', 'tagList'))->render();
        $product_data = view('admin.product__list', compact('barame_travaux_tags', 'tagList', 'tag_product', 'surface', 'Nombre_de_split', 'Type_de_comble', 'tag_product_nombre', 'marque', 'marques', 'shab', 'Type_de_radiateur', 'Nombre_de_radiateurs_électrique', 'Nombre_de_radiateurs_combustible', 'Thermostat_supplémentaire', 'Nombre_thermostat_supplémentaire', 'Nombre_de_radiateur_total_dans_le_logement','Nombre_de_pièces_dans_le_logement'))->render();
        return response()->json(['tag'=> $tag_data, 'product' => $product_data]);
        // return response()->json(['travaux' => $travaux_data, 'tag'=> $tag_data, 'product' => $product_data]);
    }

    public function leadUserLimit(Request $request){
        $user = User::find($request->id); 
            $user->update([
                'lead_limit' => ($request->type == 'increase')? $user->lead_limit++ : $user->lead_limit--,
            ]); 
        return response('success');
    }

    public function leadDispatcher(Request $request){ 
        $ids = explode(',', $request->selected_lead_id);
        $count = 0;
        $lead_count = 0;
        // dd(array_slice($lead_id,0,2));
        foreach($request->lead_dispatcher_id as $key => $value){
            if($value){
                $lead_id_array = array_slice($ids,$count,$value);
                foreach($lead_id_array as $lead_id){ 
                    $lead = LeadClientProject::find($lead_id); 
                    if($lead){
                        $lead_count++;
                        $lead->lead_label = 2; 
                        $lead->lead_telecommercial = $key;  
                        $lead->save();
    
                        $pannel_activity = PannelLogActivity::create([
                            'key'           => 'telecommercial__change',
                            'value'         => $key,
                            'feature_id'    => $lead_id,
                            'feature_type'  => 'lead',
                            'user_id'       => Auth::id(), 
                        ]);
        
                        event(new PannelLog($pannel_activity->id));
                        
    
                        $user = User::find($key);
                        $name = Auth::user()->name;
                        $subject = 'New Lead Assign';
                        $body = $user->name.', You have been assigned a lead by '.$name; 
                        $notification = Notifications::create([
                            'title'  => ['en' => 'Lead Assign', 'fr' =>'Attribution des rôles principaux'],
                            'body'   => ['en' => 'You have been assigned a lead by '. Auth::user()->name, 'fr' => 'Vous avez été assigné à une piste par '. Auth::user()->name],
                            'user_id' => $key,
                            'lead_id' => $lead_id,
                        ]);  
                    }
                }

                $count += $value;
            }
        }

        // return back()->with('success', __('Lead Assigned'));
        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' dispatch avec succès.');
    }

    public function leadCommentStore(Request $request){
       $comment = LeadComment::create([
            'lead_id' => $request->lead_id,
            'comment' => $request->comment,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'created_at' => Carbon::now()
       ]);

       $path = public_path('uploads/crm/comment_file');
       if($request->file('attach_files')){
           foreach($request->file('attach_files') as $file){
               $file_type = $file->extension();
               $file_name = $comment->id.time().rand(0000,9999).'.'.$file_type;
               $file->move($path, $file_name);
               LeadCommentFile::create(['comment_id' => $comment->id, 'name' => $file_name, 'type' => $file_type]);
           }
       }

       $input_string = $request->comment;

       // Find JSON-like objects in the input string
       preg_match_all('/\[\[(.*?)\]\]/', $input_string, $matches);
       $taged_users_id = [];
       // Parse the JSON objects and replace the corresponding values in the input string
       foreach ($matches[1] as $json_object) {
           $parsed_object = json_decode($json_object);
           if (isset($parsed_object->value)) {
               $input_string = str_replace("[[$json_object]]", "<span style='text-decoration: underline; color: #4D056E; font-weight: 700;'>@{$parsed_object->value}</span>", $input_string);
           }
           if (isset($parsed_object->id)) {
               $taged_users_id[] = (int) $parsed_object->id;
           }
       }
       $comment->comment = $input_string;
       $comment->save(); 
       $lead = LeadClientProject::find($request->lead_id);
       $lead_id = sprintf('%08d', $lead->id);
       $lead_nom = $lead->Nom ?? '';
       $lead_prenom = $lead->Prenom ?? ''; 
       $link = route('leads.index',[$lead->company_id ,$lead->id]);
       
       $lead_label = $lead->getStatus->status; 
       $lead_statut = $lead->getSubStatus ? $lead->getSubStatus->name : (($lead->lead_label == 2) ? 'Nouvelle demande': 'Pas de sous statut');
       if(Auth::user()->profile_photo){
            $user_profile_link =  asset('uploads/crm/profiles')."/".Auth::user()->profile_photo;
        }
        else{
            $user_profile_link = asset('crm_assets/assets/images/icons/user.png');
        }

        $user_name = Auth::user()->name;
        $created_at = Carbon::parse($comment->created_at)->locale('fr')->translatedFormat('d F Y') .' a '. Carbon::parse($comment->created_at)->format('H:i');
        $category_color = $comment->getCategory->background_color ?? '#fff';
        $category_name = $comment->getCategory->name ?? '';
        $comment_text = $comment->comment;
        
       $title = "<p style='margin:0;font-size:20px;line-height:24px;text-align: center;'>TAG Commentaire</p>
                 <p style='text-align: center; font-size:18px margin-top:10px; margin-bottom: 0'>".Auth::user()->name." vous a mentionné dans un prospect</p>";
       $body = "<tr><td><h3 style='font-weight: 500; margin: 5px 0;'>Informations prospect:</h3></td></tr>
                <tr>
                    <td>
                        <p style='margin: 5px 0;'><strong>Id :</strong> BH$lead_id </p>
                        <p style='margin: 5px 0;'><strong>Nom :</strong> $lead_nom </p>
                        <p style='margin: 5px 0;'><strong>Prénom :</strong> $lead_prenom </p>
                        <p style='margin: 5px 0;'><strong>Type :</strong> Prospect </p>
                        <p style='margin: 5px 0;'><strong>Etiquette :</strong> $lead_label </p>
                        <p style='margin: 5px 0;'><strong>Statut :</strong> $lead_statut </p>
                        <p style='margin: 5px 0;'><strong>Lien  :</strong> <a href='$link'>Cliquez ici </a> </p>
                    </td>
                </tr> ";
        $response = "<div style='padding-top: 20px;'>
                        <div style='font-size: 14px;'>
                            <a href='#!' style='display: inline-block; text-decoration: none; color: inherit;'> 
                                <img src='$user_profile_link' alt='image' width='30' height='30' style='width:30px; height:30px; object-fit: cover; border-radius: 50%; border: 1px solid #5E5873; vertical-align: middle;'> 
                                <span style='padding-left: 5px; font-weight: 500;'>$user_name</span>
                            </a>
                            <div style='display: inline;'>
                                <span style='display: inline-block; font-size: 14px; color: #5E5873; padding-left: 6px; padding-right: 6px;'>a répondu le</span>
                                <span style='display: inline-block; font-size: 14px;'>$created_at</span>
                                <span style='border:1px solid #5a616a; background-color: $category_color; margin-left: 1rem; cursor: pointer; padding: 0.25rem 0.5rem;font-size: .875rem; line-height: 1.5; border-radius: 0.2rem'>$category_name</span>    
                            </div>
                        </div>
                        <div style='margin: 10px 0; padding: 10px 15px; font-size: 14px; color: #3E4B5B; background-color: #f3f3f7; border-radius: 6px;'>
                            <p style='font-size: 14px; white-space: pre-line; margin-top: 0; margin-bottom: 0;'>$comment_text</p>
                        </div>
                    </div>";
       foreach($taged_users_id as $tag_user){
            $user = User::find($tag_user);
            if($user && $user->status == 'active' && $user->email_professional){
                Mail::to($user->email_professional)->send(new CommentMentionMail($title, $body, $response)); 
            }
        } 

        if(role() == 's_admin'){
            $comments = LeadComment::where('lead_id', $request->lead_id)->orderBy('id', 'desc')->get(); 
        }else{
            $comments = LeadComment::whereIn('category_id', Auth::user()->commentCategory->pluck('id'))->where('lead_id', $request->lead_id)->orderBy('id', 'desc')->get(); 
        }
        $type = 'lead';
        $comment = view('includes.crm.project_comment', compact('comments', 'type'))->render();
        return response()->json(['comment' => $comment, 'alert' => __('Added Succesfully')]);

    }

    public function leadLockAccess(Request $request){
       
        $pannel_activity = PannelLogActivity::create($request->except(['_token','tab'])+['user_id' => Auth::id()]);

        if($request->value == 'open'){
            Session::put($request->tab, 'active');
        }else{
            Session::forget($request->tab);
        }
        event(new PannelLog($pannel_activity->id));
        $activities = PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $request->feature_id)->orderBy('id', 'desc')->get();
        $activity_log = view('includes.crm.lead-activity-log', compact('activities'));
        $activity = $activity_log->render();
        return response($activity);
    }

    public function leadLogDelete(Request $request){
        PannelLogActivity::find($request->id)->delete();
        return redirect()->back()->with('success', __('Deleted Successfully'));
    }

    public function leadStatusChange(Request $request){
        $lead = LeadClientProject::find($request->id);
        if($lead->lead_label == 7){
            return back()->with('success', 'Statut mis à jour');
        }
        $lead_current_label = $lead->lead_label;
        if($lead->lead_label != $request->status){
            $pannel_activity = PannelLogActivity::create([  
                'label_prev_id' => $lead->lead_label,
                'label_id'      => $request->status,
                'status'        => 'change_etiquette',
                'key'           => "etiquette", 
                'dead_reason'   => $request->dead_reason, 
                'feature_type'  => 'lead',
                'feature_id'    => $request->id,
                'user_id'       => Auth::id(), 
            ]); 
    
            $lead->etiquette_automatise_recurrence_status = 0;
            $lead->etiquette_automatise_id = 0; 
            $lead->etiquette_fin = 1;

            StatusChangeLog::create([
                'feature_id' => $lead->id,
                'from_id' => $lead->lead_label,
                'to_id' => $request->status,
                'statut_id' => $request->sub_status,
                'regie_id' => $lead->leadTelecommercial ? ($lead->leadTelecommercial->getRegie ? $lead->leadTelecommercial->getRegie->id : null):null,
                'telecommercial_id' => $lead->lead_telecommercial ?? null,
                'status_type' => 'main',
                'type' => 'lead', 
            ]);
    
            event(new PannelLog($pannel_activity->id));

            $automatisations = Automatise::where('automatisation_for', 'prospects')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
            $travaux = '';
            $travaux_count = 1;
            foreach($lead->LeadTravax as $item){
                $travaux .= $item->travaux .($travaux_count != $lead->LeadTravax->count() ? ', ':'');
                $travaux_count++;
            }
            
            foreach($automatisations as $automatisation)
            {
                if(str_contains($automatisation->status, 'main'))
                {
                     $status = explode('_', $automatisation->status); 

                    if($status[1] == $request->status)
                    {
                        if($automatisation->recurrence == 'Oui'){
                            $lead->etiquette_automatise_recurrence_status = 1;
                            $lead->etiquette_automatise_id = $automatisation->id;
                            $lead->etiquette_automatise_recurrence_start = Carbon::now();
                        }
                       
                       if($automatisation->sending_type == 'send_email')
                       {
                            $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                            $subject = $template->object;
                            $body = $template->body;
                            
                            $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                            $body = str_replace('{titre}', $lead->Titre, $body);
                            $body = str_replace('{nom_client}', $lead->Nom, $body);
                            $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                            $body = str_replace('{email_client}', $lead->Email, $body);
                            $body = str_replace('{téléphone_client}', $lead->phone, $body);
                            $body = str_replace('{raison}', $request->dead_reason, $body); 
                            if($lead->leadTelecommercial){
                                $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                if($lead->leadTelecommercial->getRegie){
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                    $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                }else{
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }
                            }else{
                                $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            } 
                            $body = str_replace('{id_chantier}', ' ', $body);
                            $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                            $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                            $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                            $body = str_replace('{projet_travaux}', $travaux, $body);
                            $body = str_replace('{statut_projet}', ' ', $body);
                            $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                            $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                            $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                            $body = str_replace('{installation_date_intervention}', ' ', $body);
                            $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                            $body = str_replace('{SAV_date_intervention}', ' ', $body);
                            $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                            $body = str_replace('{etude_date_intervention}', ' ', $body);
                            $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                            $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                            $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                            
                            // $subject = $automatisation->name;
                            if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                            {
                               
                                if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                {
                                
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files =public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }

                                    if($automatisation->select_to == 'Telecommercial'){
                                        $data["email"] = $lead->leadTelecommercial->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($lead->leadTelecommercial->email_professional){
                                            $data["email"] = $lead->leadTelecommercial->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 
                                    }
                            
                                    // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                }

                            }
                            if($automatisation->select_to == 'Client')
                            { 
                                $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                             
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }

                            if($automatisation->select_to == 'Mail personnalisé')
                            { 
                                $data["email"] = $automatisation->custom_email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                             
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }
                             
                            if($automatisation->select_to_cc){
                                if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                {
                                   
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
                                    }
    
                                }
                                if($automatisation->select_to_cc == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                 
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cc == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cc;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                            if($automatisation->select_to_cci){
                                if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                {
                                   
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }

                                        }
                                    }
    
                                }
                                if($automatisation->select_to_cci == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                 
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cci == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cci;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                       }
                       else
                       {

                        $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                        $body = $template->body;
                        
                        $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                        $body = str_replace('{titre}', $lead->Titre, $body);
                        $body = str_replace('{nom_client}', $lead->Nom, $body);
                        $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                        $body = str_replace('{email_client}', $lead->Email, $body);
                        $body = str_replace('{téléphone_client}', $lead->phone, $body);
                        $body = str_replace('{raison}', $request->dead_reason, $body);
                        if($lead->leadTelecommercial){
                            $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                            if($lead->leadTelecommercial->getRegie){
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                            }else{
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            }
                        }else{
                            $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                            $body = str_replace('{regie}', ' ', $body);
                        } 
                        $body = str_replace('{id_chantier}', ' ', $body);
                        $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                        $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                        $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                        $body = str_replace('{projet_travaux}', $travaux, $body);
                        $body = str_replace('{statut_projet}', ' ', $body);
                        $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                        $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                        $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                        $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                        $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                        $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                        $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 

                        $subject = $automatisation->name;
                        
                        if($automatisation->select_to == 'Client')
                        { 
                        
                            try {
  
                                $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                $client = new \Nexmo\Client($basic);
                      
                                $receiverNumber = $lead->phone;
                                $message = $body;
                      
                                $message = $client->message()->send([
                                    'to' => str_replace('+', '', $receiverNumber),
                                    'from' => 'Novecology',
                                    'text' => $message
                                ]);
                      
                                
                                  
                            } catch (Exception $e) {
                               
                            }

                        }
                        if($automatisation->select_to_cc){
                            if($automatisation->select_to_cc == 'Client')
                            { 
                            
                                try {
      
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                          
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                          
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                          
                                    
                                      
                                } catch (Exception $e) {
                                   
                                }
    
                            }
                        }
                        if($automatisation->select_to_cci){
                            if($automatisation->select_to_cci == 'Client')
                            { 
                            
                                try {
      
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                          
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                          
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                          
                                    
                                      
                                } catch (Exception $e) {
                                   
                                }
    
                            }
                        }
                        
                        
                       }
                    }   
                }
            }
            
        }
        if($lead->sub_status != $request->sub_status){
            $pannel_activity = PannelLogActivity::create([ 
            'status_prev_id' => $lead->sub_status,
                'status_id'      => $request->sub_status,
                'status'         => 'change_etiquette',
                'key'            => "status",  
                'feature_type'   => 'lead',
                'feature_id'     => $request->id,
                'user_id'        => Auth::id(), 
            ]); 

            $lead->statut_automatise_recurrence_status = 0;
            $lead->statut_automatise_id = 0; 
            $lead->statut_fin = 1;
    
            
            StatusChangeLog::create([
                'feature_id' => $lead->id,
                'from_id' => $lead->sub_status,
                'to_id' => $request->sub_status,
                'statut_id' => $request->sub_status,
                'regie_id' => $lead->leadTelecommercial ? ($lead->leadTelecommercial->getRegie ? $lead->leadTelecommercial->getRegie->id : null):null,
                'telecommercial_id' => $lead->lead_telecommercial ?? null,
                'status_type' => 'sub',
                'type' => 'lead', 
            ]);

            event(new PannelLog($pannel_activity->id));

            $automatisations = Automatise::where('automatisation_for', 'prospects')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
            $travaux = '';
            $travaux_count = 1;
            foreach($lead->LeadTravax as $item){
                $travaux .= $item->travaux .($travaux_count != $lead->LeadTravax->count() ? ', ':'');
                $travaux_count++;
            }
            
            foreach($automatisations as $automatisation)
            {
                if(str_contains($automatisation->status, 'sub'))
                {
                     $status = explode('_', $automatisation->status); 

                    if($status[1] == $request->sub_status)
                    {

                        if($automatisation->recurrence == 'Oui'){
                            $lead->statut_automatise_recurrence_status = 1;
                            $lead->statut_automatise_id = $automatisation->id;
                            $lead->statut_automatise_recurrence_start = Carbon::now();
                        }

                        if($automatisation->sending_type == 'send_email')
                        {
                            $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                            
                            $subject = $template->object;
                            $body = $template->body;

                            $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                            $body = str_replace('{titre}', $lead->Titre, $body);
                            $body = str_replace('{nom_client}', $lead->Nom, $body);
                            $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                            $body = str_replace('{email_client}', $lead->Email, $body);
                            $body = str_replace('{téléphone_client}', $lead->phone, $body);
                            $body = str_replace('{raison}', $request->dead_reason, $body);
                            if($lead->leadTelecommercial){
                                $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                if($lead->leadTelecommercial->getRegie){
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                    $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                }else{
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }
                            }else{
                                $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            } 
                            $body = str_replace('{id_chantier}', ' ', $body);
                            $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                            $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                            $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                            $body = str_replace('{projet_travaux}', $travaux, $body);
                            $body = str_replace('{statut_projet}', ' ', $body);
                            $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                            $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                            $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                            $body = str_replace('{installation_date_intervention}', ' ', $body);
                            $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                            $body = str_replace('{SAV_date_intervention}', ' ', $body);
                            $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                            $body = str_replace('{etude_date_intervention}', ' ', $body);
                            $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                            $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                            $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                       
                            if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                            {
                                if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                { 
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                            
                                    if($automatisation->select_to == 'Telecommercial'){
                                        $data["email"] = $lead->leadTelecommercial->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($lead->leadTelecommercial->email_professional){
                                            $data["email"] = $lead->leadTelecommercial->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                    }
                                    // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                }

                            }
                            if($automatisation->select_to == 'Client')
                            { 
                                $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                             
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                    // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));

                            }
                            
                            if($automatisation->select_to == 'Mail personnalisé')
                            { 
                                $data["email"] = $automatisation->custom_email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                             
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }
                            if($automatisation->select_to_cc){
                                if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                {
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    { 
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }

                                        }
                                        // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                    }

                                }
                                if($automatisation->select_to_cc == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                        // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));

                                } 
                                if($automatisation->select_to_cc == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cc;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    } 

                                } 
                            }
                            if($automatisation->select_to_cci){
                                if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                {
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    { 
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }

                                        }
                                    }

                                }
                                if($automatisation->select_to_cci == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cci == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cci;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                        }
                        else
                        {
 
                        $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                        $body = $template->body;

                        $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                        $body = str_replace('{titre}', $lead->Titre, $body);
                        $body = str_replace('{nom_client}', $lead->Nom, $body);
                        $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                        $body = str_replace('{email_client}', $lead->Email, $body);
                        $body = str_replace('{téléphone_client}', $lead->phone, $body);
                        $body = str_replace('{raison}', $request->dead_reason, $body);
                        if($lead->leadTelecommercial){
                            $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                            if($lead->leadTelecommercial->getRegie){
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                            }else{
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            }
                        }else{
                            $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                            $body = str_replace('{regie}', ' ', $body);
                        } 
                        $body = str_replace('{id_chantier}', ' ', $body);
                        $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                        $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                        $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                        $body = str_replace('{projet_travaux}', $travaux, $body);
                        $body = str_replace('{statut_projet}', ' ', $body);
                        $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                        $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                        $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                        $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                        $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                        $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                        $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 

                         $subject = $automatisation->name;
                         
                         if($automatisation->select_to == 'Client')
                         { 
                         
                             try {
   
                                 $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                 $client = new \Nexmo\Client($basic);
                       
                                 $receiverNumber = $lead->phone;
                                 $message = $body;
                       
                                 $message = $client->message()->send([
                                     'to' => str_replace('+', '', $receiverNumber),
                                     'from' => 'Novecology',
                                     'text' => $message
                                 ]);
                       
                                 
                                   
                             } catch (Exception $e) {
                                
                             }
 
                         }
                         if($automatisation->select_to_cc){
                            if($automatisation->select_to_cc == 'Client')
                            { 
                            
                                try {
    
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                        
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                        
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                        
                                    
                                    
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                         }
                         if($automatisation->select_to_cci){
                            if($automatisation->select_to_cci == 'Client')
                            { 
                            
                                try {
    
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                        
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                        
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                        
                                    
                                    
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                         }
                         
                         
                        }
                    }   
                }
            }



        }

        $lead->lead_label = $request->status;
        $lead->sub_status  = $request->sub_status;
        $lead->lead_ko_reason = $request->dead_reason;
        $lead->save();
         

        // $lead->update([
        //     'lead_label' => $request->status,
        //     'sub_status'  => $request->sub_status,
        //     'lead_ko_reason' => $request->dead_reason,
        // ]);

        // $pannel_activity = PannelLogActivity::create([
        //     'tab_name'      => 'Lead',
        //     'block_name'    => $request->sub_status,
        //     'key'           => "lead__etiquette___change",
        //     'value'         => $request->status,
        //     'feature_id'    => $request->id,
        //     'feature_type'  => 'lead',
        //     'user_id'       => Auth::id(), 
        // ]); 

        // event(new PannelLog($pannel_activity->id)); 
        if($request->status == 6 && $lead->Type_de_contrat == 'BAR TH 173' && $lead_current_label != $request->status){
            $lead->lead_label = 7;
            $lead->sub_status = 5;
            $lead->etiquette_automatise_recurrence_status = 0;
            $lead->etiquette_automatise_id = 0;
            $lead->etiquette_fin = 0;
            $lead->etiquette_automatise_recurrence_start = null;
            $lead->statut_automatise_recurrence_status = 0;
            $lead->statut_automatise_id = 0;
            $lead->statut_fin = 0;
            $lead->statut_automatise_recurrence_start = null;
            $lead->save();
            $client = new NewClient(); 
            $client->lead_id                                                            = $lead->id;
            $client->company_id                                                         = $lead->company_id;
            $client->lead_telecommercial                                                = $lead->lead_telecommercial;
            $client->__tracking__Fournisseur_de_lead                                    = $lead->__tracking__Fournisseur_de_lead;
            $client->__tracking__Type_de_campagne                                       = $lead->__tracking__Type_de_campagne;
            $client->__tracking__Type_de_campagne__a__                                  = $lead->__tracking__Type_de_campagne__a__;
            $client->__tracking__Nom_campagne                                           = $lead->__tracking__Nom_campagne;
            $client->__tracking__Date_demande_lead                                      = $lead->__tracking__Date_demande_lead;
            $client->__tracking__Date_attribution_télécommercial                        = $lead->__tracking__Date_attribution_télécommercial;
            $client->__tracking__Type_de_travaux_souhaité                               = $lead->__tracking__Type_de_travaux_souhaité;
            $client->__tracking__Nom_Prénom                                             = $lead->__tracking__Nom_Prénom;
            $client->__tracking__Code_postal                                            = $lead->__tracking__Code_postal;
            $client->__tracking__Email                                                  = $lead->__tracking__Email;
            $client->__tracking__téléphone                                              = $lead->__tracking__téléphone;
            $client->__tracking__Département                                            = $lead->__tracking__Département;
            $client->__tracking__Mode_de_chauffage                                      = $lead->__tracking__Mode_de_chauffage;
            $client->__tracking__Mode_de_chauffage__a__                                 = $lead->__tracking__Mode_de_chauffage__a__;
            $client->__tracking__Propriétaire                                           = $lead->__tracking__Propriétaire;
            $client->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans         = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $client->Titre                                                              = $lead->Titre;    
            $client->Prenom                                                             = $lead->Prenom;
            $client->Nom                                                                = $lead->Nom;
            $client->Adresse                                                            = $lead->Adresse;
            $client->Complément_adresse                                                 = $lead->Complément_adresse;
            $client->Code_Postal                                                        = $lead->Code_Postal;
            $client->Ville                                                              = $lead->Ville;
            $client->Département                                                        = $lead->Département;
            $client->Email                                                              = $lead->Email;
            $client->same_as_work_address                                               = $lead->same_as_work_address;
            $client->Adresse_Travaux                                                    = $lead->Adresse_Travaux;
            $client->Complément_adresse_Travaux                                         = $lead->Complément_adresse_Travaux;
            $client->Code_postal_Travaux                                                = $lead->Code_postal_Travaux;
            $client->Ville_Travaux                                                      = $lead->Ville_Travaux;
            $client->Departement_Travaux                                                = $lead->Departement_Travaux;
            $client->phone                                                              = $lead->phone;
            $client->fixed_number                                                       = $lead->fixed_number;
            $client->Observations                                                       = $lead->Observations;
            $client->precariousness                                                     = $lead->precariousness;
            $client->Type_occupation                                                    = $lead->Type_occupation;
            $client->Parcelle_cadastrale                                                = $lead->Parcelle_cadastrale;
            $client->Revenue_Fiscale_de_Référence                                       = $lead->Revenue_Fiscale_de_Référence;
            $client->Nombre_de_foyer                                                    = $lead->Nombre_de_foyer;
            $client->Nombre_de_personnes                                                = $lead->Nombre_de_personnes;
            $client->Age_du_bâtiment                                                    = $lead->Age_du_bâtiment;
            $client->Zone                                                               = $lead->Zone;
            $client->Éligibilité_MaPrimeRenov                                           = $lead->Éligibilité_MaPrimeRenov;
            $client->Mode_de_chauffage                                                  = $lead->Mode_de_chauffage;
            $client->Mode_de_chauffage__a__                                             = $lead->Mode_de_chauffage__a__;
            $client->Date_construction_maison                                           = $lead->Date_construction_maison;
            $client->Surface_habitable                                                  = $lead->Surface_habitable;
            $client->Surface_à_chauffer                                                 = $lead->Surface_à_chauffer;
            $client->Consommation_chauffage_annuel                                      = $lead->Consommation_chauffage_annuel;
            $client->Consommation_Chauffage_Annuel_2                                    = $lead->Consommation_Chauffage_Annuel_2;
            $client->Depuis_quand_occupez_vous_le_logement                              = $lead->Depuis_quand_occupez_vous_le_logement;
            $client->Type_du_courant_du_logement                                        = $lead->Type_du_courant_du_logement;
            $client->auxiliary_heating_status                                           = $lead->auxiliary_heating_status;
            $client->auxiliary_heating                                                  = $lead->auxiliary_heating;
            $client->auxiliary_heating__a__                                             = $lead->auxiliary_heating__a__;
            $client->second_heating_generator_status                                    = $lead->second_heating_generator_status;
            $client->second_heating_generator                                           = $lead->second_heating_generator;
            $client->second_heating_generator__a__                                      = $lead->second_heating_generator__a__;
            $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement         = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
            $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__    = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
            $client->Préciser_le_type_de_radiateurs_Aluminium                           = $lead->Préciser_le_type_de_radiateurs_Aluminium;
            $client->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs      = $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
            $client->Préciser_le_type_de_radiateurs_Fonte                               = $lead->Préciser_le_type_de_radiateurs_Fonte;
            $client->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
            $client->Préciser_le_type_de_radiateurs_Acier                               = $lead->Préciser_le_type_de_radiateurs_Acier;
            $client->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
            $client->Préciser_le_type_de_radiateurs_Autre                               = $lead->Préciser_le_type_de_radiateurs_Autre;
            $client->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
            $client->Préciser_le_type_de_radiateurs_Autre___a__                         = $lead->Préciser_le_type_de_radiateurs_Autre___a__;
            $client->Production_dapostropheeau_chaude_sanitaire                         = $lead->Production_dapostropheeau_chaude_sanitaire;
            $client->Instantanné                                                        = $lead->Instantanné;
            $client->Accumulation                                                       = $lead->Accumulation;
            $client->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude     = $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
            $client->Instantanné_Merci_de_préciser                                      = $lead->Instantanné_Merci_de_préciser;
            $client->Accumulation_Merci_de_préciser                                     = $lead->Accumulation_Merci_de_préciser;
            $client->Le_logement_possède_un_réseau_hydraulique                          = $lead->Le_logement_possède_un_réseau_hydraulique;
            $client->auxiliary_heating__Insert_à_bois_Nombre                          = $lead->auxiliary_heating__Insert_à_bois_Nombre;
            $client->auxiliary_heating__Poêle_à_bois_Nombre                          = $lead->auxiliary_heating__Poêle_à_bois_Nombre;
            $client->auxiliary_heating__Poêle_à_gaz_Nombre                          = $lead->auxiliary_heating__Poêle_à_gaz_Nombre;
            $client->auxiliary_heating__Convecteur_électrique_Nombre                          = $lead->auxiliary_heating__Convecteur_électrique_Nombre;
            $client->auxiliary_heating__Sèche_serviette_Nombre                          = $lead->auxiliary_heating__Sèche_serviette_Nombre;
            $client->auxiliary_heating__Panneau_rayonnant_Nombre                          = $lead->auxiliary_heating__Panneau_rayonnant_Nombre;
            $client->auxiliary_heating__Radiateur_bain_dhuile_Nombre                          = $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
            $client->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                          = $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
            $client->auxiliary_heating__Autre_Nombre                          = $lead->auxiliary_heating__Autre_Nombre;
            $client->Précisez_le_volume_du_ballon_dapostropheeau_chaude                 = $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
            $client->Information_logement_observations                                  = $lead->Information_logement_observations;
            $client->Situation_familiale                                                = $lead->Situation_familiale;
            $client->Situation_familiale___a__                                          = $lead->Situation_familiale___a__;
            $client->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                         = $lead->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
            $client->Personne_1                                                         = $lead->Personne_1;
            $client->Quel_est_le_contrat_de_travail_de_Personne_1                       = $lead->Quel_est_le_contrat_de_travail_de_Personne_1;
            $client->Quel_est_le_contrat_de_travail_de_Personne_1__a__                  = $lead->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
            $client->Revenue_Personne_1                                                 = $lead->Revenue_Personne_1;
            $client->Existehyphenthyphenil_un_conjoint                                  = $lead->Existehyphenthyphenil_un_conjoint;
            $client->Personne_2                                                         = $lead->Personne_2;
            $client->Quel_est_le_contrat_de_travail_de_Personne_2                       = $lead->Quel_est_le_contrat_de_travail_de_Personne_2;
            $client->Quel_est_le_contrat_de_travail_de_Personne_2__a__                  = $lead->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
            $client->Revenue_Personne_2                                                 = $lead->Revenue_Personne_2;
            $client->Crédit_du_foyer_mensuel                                            = $lead->Crédit_du_foyer_mensuel;
            $client->Commentaires_revenue_et_crédit_du_foyer                            = $lead->Commentaires_revenue_et_crédit_du_foyer;
            $client->Type_de_contrat                                                   = $lead->Type_de_contrat;
            $client->MaPrimeRenov                                                      = $lead->MaPrimeRenov;
            $client->Subvention_MaPrimeRénov_déduit_du_devis                           = $lead->Subvention_MaPrimeRénov_déduit_du_devis;
            $client->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
            $client->Action_Logement                                                   = $lead->Action_Logement;
            $client->CEE                                                               = $lead->CEE;
            $client->Credit                                                            = $lead->Credit;
            $client->Montant_Crédit                                                    = $lead->Montant_Crédit;
            $client->Report_du_crédit                                                  = $lead->Report_du_crédit;
            $client->Nombre_de_jours_report                                            = $lead->Nombre_de_jours_report;
            $client->Reste_à_charge                                                    = $lead->Reste_à_charge;
            $client->Reste_à_charge_Montant                                            = $lead->Reste_à_charge_Montant;
            $client->Survente                                                          = $lead->Survente;
            $client->Montant_survente                                                  = $lead->Montant_survente;
            $client->Observations_reste_à_charge                                       = $lead->Observations_reste_à_charge;
            $client->Mode_de_paiement                                                  = $lead->Mode_de_paiement;
            $client->Nombre_de_mensualités                                             = $lead->Nombre_de_mensualités;
            $client->advance_visit                                                     = $lead->advance_visit; 
            $client->Projet_observations                                               = $lead->Projet_observations; 
            $client->Montant_estimée_de_lapostropheaide                                = $lead->Montant_estimée_de_lapostropheaide; 
            $client->latitude                                                          = $lead->latitude;
            $client->longitude                                                         = $lead->longitude;
            $client->lead_tracking_custom_field_data                                   = $lead->lead_tracking_custom_field_data;
            $client->personal_info_custom_field_data                                   = $lead->personal_info_custom_field_data; 
            $client->eligibility_custom_field_data                                     = $lead->eligibility_custom_field_data;
            $client->situation_foyer_custom_field_data                                 = $lead->situation_foyer_custom_field_data;
            $client->project_custom_field_data                                         = $lead->project_custom_field_data;
            $client->user_id                                                           = Auth::id();
            $client->Type_habitation                                                   = $lead->Type_habitation;
            $client->Type_de_logement                                                  = $lead->Type_de_logement;
            $client->Type_de_chauffage                                                 = $lead->Type_de_chauffage;
    
            $client->save();
            
                
    
            $project = new NewProject();
    
            $project->user_id                                                            = Auth::id();
            $project->lead_id                                                           = $lead->id;
            $project->client_id                                                         = $client->id;
            $project->company_id                                                        = $lead->company_id;
            $project->lead_telecommercial                                               = $lead->lead_telecommercial;
            $project->project_label                                                     = 1;
            $project->project_telecommercial                                            = $lead->lead_telecommercial; 
            $project->__tracking__Fournisseur_de_lead                                   = $lead->__tracking__Fournisseur_de_lead;
            $project->__tracking__Type_de_campagne                                      = $lead->__tracking__Type_de_campagne;
            $project->__tracking__Type_de_campagne__a__                                 = $lead->__tracking__Type_de_campagne__a__;
            $project->__tracking__Nom_campagne                                          = $lead->__tracking__Nom_campagne;
            $project->__tracking__Date_demande_lead                                     = $lead->__tracking__Date_demande_lead;
            $project->__tracking__Date_attribution_télécommercial                       = $lead->__tracking__Date_attribution_télécommercial;
            $project->__tracking__Type_de_travaux_souhaité                              = $lead->__tracking__Type_de_travaux_souhaité;
            $project->__tracking__Nom_Prénom                                            = $lead->__tracking__Nom_Prénom;
            $project->__tracking__Code_postal                                           = $lead->__tracking__Code_postal;
            $project->__tracking__Email                                                 = $lead->__tracking__Email;
            $project->__tracking__téléphone                                             = $lead->__tracking__téléphone;
            $project->__tracking__Département                                           = $lead->__tracking__Département;
            $project->__tracking__Mode_de_chauffage                                     = $lead->__tracking__Mode_de_chauffage;
            $project->__tracking__Mode_de_chauffage__a__                                = $lead->__tracking__Mode_de_chauffage__a__;
            $project->__tracking__Propriétaire                                          = $lead->__tracking__Propriétaire;
            $project->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans        = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $project->Titre                                                             = $lead->Titre;
            $project->Prenom                                                            = $lead->Prenom;
            $project->Nom                                                               = $lead->Nom;
            $project->Adresse                                                           = $lead->Adresse;
            $project->Complément_adresse                                                = $lead->Complément_adresse;
            $project->Code_Postal                                                       = $lead->Code_Postal;
            $project->Ville                                                             = $lead->Ville;
            $project->Département                                                       = $lead->Département;
            $project->Email                                                             = $lead->Email;
            $project->same_as_work_address                                              = $lead->same_as_work_address;
            $project->Adresse_Travaux                                                   = $lead->Adresse_Travaux;
            $project->Complément_adresse_Travaux                                        = $lead->Complément_adresse_Travaux;
            $project->Code_postal_Travaux                                               = $lead->Code_postal_Travaux;
            $project->Ville_Travaux                                                     = $lead->Ville_Travaux;
            $project->Departement_Travaux                                               = $lead->Departement_Travaux;
            $project->phone                                                             = $lead->phone;
            $project->fixed_number                                                      = $lead->fixed_number;
            $project->Observations                                                      = $lead->Observations;
            $project->precariousness                                                    = $lead->precariousness;
            $project->Type_occupation                                                   = $lead->Type_occupation;
            $project->Parcelle_cadastrale                                               = $lead->Parcelle_cadastrale;
            $project->Revenue_Fiscale_de_Référence                                      = $lead->Revenue_Fiscale_de_Référence;
            $project->Nombre_de_foyer                                                   = $lead->Nombre_de_foyer;
            $project->Nombre_de_personnes                                               = $lead->Nombre_de_personnes;
            $project->Age_du_bâtiment                                                   = $lead->Age_du_bâtiment;
            $project->Zone                                                              = $lead->Zone;
            $project->Éligibilité_MaPrimeRenov                                          = $lead->Éligibilité_MaPrimeRenov;
            $project->Mode_de_chauffage                                                 = $lead->Mode_de_chauffage;
            $project->Mode_de_chauffage__a__                                            = $lead->Mode_de_chauffage__a__;
            $project->Date_construction_maison                                          = $lead->Date_construction_maison;
            $project->Surface_habitable                                                 = $lead->Surface_habitable;
            $project->Surface_à_chauffer                                                = $lead->Surface_à_chauffer;
            $project->Consommation_chauffage_annuel                                     = $lead->Consommation_chauffage_annuel;
            $project->Consommation_Chauffage_Annuel_2                                   = $lead->Consommation_Chauffage_Annuel_2;
            $project->Depuis_quand_occupez_vous_le_logement                             = $lead->Depuis_quand_occupez_vous_le_logement;
            $project->Type_du_courant_du_logement                                       = $lead->Type_du_courant_du_logement;
            $project->auxiliary_heating_status                                          = $lead->auxiliary_heating_status;
            $project->auxiliary_heating                                                 = $lead->auxiliary_heating;
            $project->auxiliary_heating__a__                                            = $lead->auxiliary_heating__a__;
            $project->second_heating_generator_status                                   = $lead->second_heating_generator_status;
            $project->second_heating_generator                                          = $lead->second_heating_generator;
            $project->second_heating_generator__a__                                     = $lead->second_heating_generator__a__;
            $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement        = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
            $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__   = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
            $project->Préciser_le_type_de_radiateurs_Aluminium                          = $lead->Préciser_le_type_de_radiateurs_Aluminium;
            $project->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs     = $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
            $project->Préciser_le_type_de_radiateurs_Fonte                              = $lead->Préciser_le_type_de_radiateurs_Fonte;
            $project->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
            $project->Préciser_le_type_de_radiateurs_Acier                              = $lead->Préciser_le_type_de_radiateurs_Acier;
            $project->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
            $project->Préciser_le_type_de_radiateurs_Autre                              = $lead->Préciser_le_type_de_radiateurs_Autre;
            $project->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
            $project->Préciser_le_type_de_radiateurs_Autre___a__                        = $lead->Préciser_le_type_de_radiateurs_Autre___a__;
            $project->Production_dapostropheeau_chaude_sanitaire                        = $lead->Production_dapostropheeau_chaude_sanitaire;
            $project->Instantanné                                                       = $lead->Instantanné;
            $project->Accumulation                                                      = $lead->Accumulation;
            $project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude    = $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
            $project->Instantanné_Merci_de_préciser                                     = $lead->Instantanné_Merci_de_préciser;
            $project->Accumulation_Merci_de_préciser                                    = $lead->Accumulation_Merci_de_préciser;
            $project->Le_logement_possède_un_réseau_hydraulique                         = $lead->Le_logement_possède_un_réseau_hydraulique;
            $project->auxiliary_heating__Insert_à_bois_Nombre                         = $lead->auxiliary_heating__Insert_à_bois_Nombre;
            $project->auxiliary_heating__Poêle_à_bois_Nombre                         = $lead->auxiliary_heating__Poêle_à_bois_Nombre;
            $project->auxiliary_heating__Poêle_à_gaz_Nombre                         = $lead->auxiliary_heating__Poêle_à_gaz_Nombre;
            $project->auxiliary_heating__Convecteur_électrique_Nombre                         = $lead->auxiliary_heating__Convecteur_électrique_Nombre;
            $project->auxiliary_heating__Sèche_serviette_Nombre                         = $lead->auxiliary_heating__Sèche_serviette_Nombre;
            $project->auxiliary_heating__Panneau_rayonnant_Nombre                         = $lead->auxiliary_heating__Panneau_rayonnant_Nombre;
            $project->auxiliary_heating__Radiateur_bain_dhuile_Nombre                         = $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
            $project->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                         = $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
            $project->auxiliary_heating__Autre_Nombre                         = $lead->auxiliary_heating__Autre_Nombre;
            $project->Précisez_le_volume_du_ballon_dapostropheeau_chaude                = $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
            $project->Information_logement_observations                                 = $lead->Information_logement_observations;
            $project->Situation_familiale                                               = $lead->Situation_familiale;
            $project->Situation_familiale___a__                                         = $lead->Situation_familiale___a__;
            $project->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                        = $lead->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
            $project->Personne_1                                                        = $lead->Personne_1;
            $project->Quel_est_le_contrat_de_travail_de_Personne_1                      = $lead->Quel_est_le_contrat_de_travail_de_Personne_1;
            $project->Quel_est_le_contrat_de_travail_de_Personne_1__a__                 = $lead->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
            $project->Revenue_Personne_1                                                = $lead->Revenue_Personne_1;
            $project->Existehyphenthyphenil_un_conjoint                                 = $lead->Existehyphenthyphenil_un_conjoint;
            $project->Personne_2                                                        = $lead->Personne_2;
            $project->Quel_est_le_contrat_de_travail_de_Personne_2                      = $lead->Quel_est_le_contrat_de_travail_de_Personne_2;
            $project->Quel_est_le_contrat_de_travail_de_Personne_2__a__                 = $lead->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
            $project->Revenue_Personne_2                                                = $lead->Revenue_Personne_2;
            $project->Crédit_du_foyer_mensuel                                           = $lead->Crédit_du_foyer_mensuel;
            $project->Commentaires_revenue_et_crédit_du_foyer                           = $lead->Commentaires_revenue_et_crédit_du_foyer;
            $project->__projet__Adresse_des_travaux                                     = $lead->__projet__Adresse_des_travaux;
            $project->__projet__Code_postale_des_travaux                                = $lead->__projet__Code_postale_des_travaux;
            $project->__projet__Ville_des_travaux                                       = $lead->__projet__Ville_des_travaux;
            $project->__projet__Département_des_travaux                                 = $lead->__projet__Département_des_travaux;
            $project->Type_de_contrat                                                   = $lead->Type_de_contrat;
            $project->MaPrimeRenov                                                      = $lead->MaPrimeRenov;
            $project->Subvention_MaPrimeRénov_déduit_du_devis                           = $lead->Subvention_MaPrimeRénov_déduit_du_devis;
            $project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
            $project->Action_Logement                                                   = $lead->Action_Logement;
            $project->CEE                                                               = $lead->CEE;
            $project->Credit                                                            = $lead->Credit;
            $project->Montant_Crédit                                                    = $lead->Montant_Crédit;
            $project->Report_du_crédit                                                  = $lead->Report_du_crédit;
            $project->Nombre_de_jours_report                                            = $lead->Nombre_de_jours_report;
            $project->Reste_à_charge                                                    = $lead->Reste_à_charge;
            $project->Reste_à_charge_Montant                                            = $lead->Reste_à_charge_Montant;
            $project->Survente                                                          = $lead->Survente;
            $project->Montant_survente                                                  = $lead->Montant_survente;
            $project->Observations_reste_à_charge                                       = $lead->Observations_reste_à_charge;
            $project->Mode_de_paiement                                                  = $lead->Mode_de_paiement;
            $project->Nombre_de_mensualités                                             = $lead->Nombre_de_mensualités;
            $project->advance_visit                                                     = $lead->advance_visit; 
            $project->Projet_observations                                               = $lead->Projet_observations; 
            $project->latitude                                                          = $lead->latitude; 
            $project->longitude                                                         = $lead->longitude; 
            $project->Montant_estimée_de_lapostropheaide                                = $lead->Montant_estimée_de_lapostropheaide; 
            $project->question_data                                                     = $lead->question_data;  
            $project->lead_tracking_custom_field_data                                    = $lead->lead_tracking_custom_field_data;
            $project->personal_info_custom_field_data                                    = $lead->personal_info_custom_field_data; 
            $project->eligibility_custom_field_data                                      = $lead->eligibility_custom_field_data;
            $project->situation_foyer_custom_field_data                                  = $lead->situation_foyer_custom_field_data;
            $project->project_custom_field_data                                          = $lead->project_custom_field_data;
            $project->Type_habitation                                                    = $lead->Type_habitation;
            $project->Type_de_logement                                                   = $lead->Type_de_logement;
            $project->Type_de_chauffage                                                  = $lead->Type_de_chauffage;
    
            $project->project_sub_status = 5; 
            $project->save();
                
            // if($request->user_id){
            //     ProjectAssign::create([
            //         'user_id' => $request->user_id,
            //         'project_id' => $project->id,
            //     ]);
            // }
            // if($request->gestionnaire_id){
            //     ProjectGestionnaire::create([
            //         'user_id' => $request->gestionnaire_id,
            //         'project_id' => $project->id,
            //     ]);
            // }

            $taxs = LeadTax::where('lead_id', $lead->id)->get();
            foreach($taxs as $tax){
                ClientTax::create([
                    'client_id' => $client->id,
                    'tax_number' => $tax->tax_number,
                    'tax_reference' => $tax->tax_reference,
                    'title' => $tax->title,
                    'first_name' => $tax->first_name,
                    'last_name' => $tax->last_name,
                    'second_title' => $tax->second_title,
                    'second_first_name' => $tax->second_first_name,
                    'second_last_name' => $tax->second_last_name,
                    'kids' => $tax->kids,
                    'phone' => $tax->phone,
                    'telephone' => $tax->telephone,
                    'email' => $tax->email,
                    'pays' => $tax->pays,
                    'postal_code' => $tax->postal_code,
                    'city' => $tax->city,
                    'address' => $tax->address,
                    'primary' => $tax->primary,
                    'type' => $tax->type,
                    'mark_check' => $tax->mark_check,
                    'address2' => $tax->address2,
                    'family_person' => $tax->family_person,
                    'observations' => $tax->observations,
                    'department' => $tax->department,
                    'same_as_work_address' => $tax->same_as_work_address,
                    'Adresse_Travaux' => $tax->Adresse_Travaux,
                    'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                    'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                    'Ville_Travaux' => $tax->Ville_Travaux,
                    'Departement_Travaux' => $tax->Departement_Travaux, 
                    'house_owner_status' => $tax->house_owner_status, 
                    'property_tax_status' => $tax->property_tax_status, 
                    'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                    'Existe_déclarant' => $tax->Existe_déclarant, 
                    'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                    'google_address' => $tax->google_address, 
                    'latitude' => $tax->latitude, 
                    'longitude' => $tax->longitude, 
                    'user_id' => $tax->user_id,
                    'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                    'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                    'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                    'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                    'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                    'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                ]);
                ProjectTax::create([
                    'project_id' => $project->id,
                    'tax_number' => $tax->tax_number,
                    'tax_reference' => $tax->tax_reference,
                    'title' => $tax->title,
                    'first_name' => $tax->first_name,
                    'last_name' => $tax->last_name,
                    'second_title' => $tax->second_title,
                    'second_first_name' => $tax->second_first_name,
                    'second_last_name' => $tax->second_last_name,
                    'kids' => $tax->kids,
                    'phone' => $tax->phone,
                    'telephone' => $tax->telephone,
                    'email' => $tax->email,
                    'pays' => $tax->pays,
                    'postal_code' => $tax->postal_code,
                    'city' => $tax->city,
                    'address' => $tax->address,
                    'primary' => $tax->primary,
                    'type' => $tax->type,
                    'mark_check' => $tax->mark_check,
                    'address2' => $tax->address2,
                    'family_person' => $tax->family_person,
                    'observations' => $tax->observations,
                    'department' => $tax->department,
                    'same_as_work_address' => $tax->same_as_work_address,
                    'Adresse_Travaux' => $tax->Adresse_Travaux,
                    'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                    'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                    'Ville_Travaux' => $tax->Ville_Travaux,
                    'Departement_Travaux' => $tax->Departement_Travaux, 
                    'house_owner_status' => $tax->house_owner_status, 
                    'property_tax_status' => $tax->property_tax_status, 
                    'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                    'Existe_déclarant' => $tax->Existe_déclarant, 
                    'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                    'google_address' => $tax->google_address, 
                    'latitude' => $tax->latitude, 
                    'longitude' => $tax->longitude, 
                    'user_id' => $tax->user_id,
                    'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                    'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                    'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                    'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                    'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                    'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                ]);
            }

            $childrens = Children::where('lead_id', $lead->id)->get(); 
            foreach($childrens as $children){
                Children::create([
                    'name'          => $children->name,
                    'birth_date'    => $children->birth_date,
                    'client_id'     =>$client->id, 
                ]);
                
                Children::create([
                    'name'          => $children->name,
                    'birth_date'    => $children->birth_date,
                    'project_id'    =>$project->id, 
                ]);
            }  

            $lead_baremes = $lead->LeadBareme;
            if($lead_baremes){
                foreach($lead_baremes as $bareme){
                    ProjectBareme::create([
                        'project_id' => $project->id,
                        'barame_id'  => $bareme->id
                    ]); 
                    ClientBareme::create([
                        'client_id'  => $client->id,
                        'barame_id'  => $bareme->id    
                    ]);
                }
            } 
            $lead_travauxs = $lead->LeadTravax;
            if($lead_travauxs){
                foreach($lead_travauxs as $travaux){
                    ProjectTravaux::create([
                        'project_id' => $project->id,
                        'travaux_id' => $travaux->id
                    ]);

                    ClientTravaux::create([
                        'client_id' => $client->id,
                        'travaux_id' => $travaux->id
                    ]);
                }
            } 

            $lead_travaux_tags = LeadTravauxTag::where('lead_id', $lead->id)->get();
            if($lead_travaux_tags){
                foreach($lead_travaux_tags as $travaux_tag){
                    ProjectTravauxTag::create([
                        'project_id' => $project->id,
                        'tag_id' => $travaux_tag->tag_id
                    ]);

                    ClientTravauxTag::create([
                        'client_id' => $client->id,
                        'tag_id' => $travaux_tag->tag_id,
                        'surface' => $travaux_tag->surface,
                        'Nombre_de_split' => $travaux_tag->Nombre_de_split,
                        'Type_de_comble' => $travaux_tag->Type_de_comble,
                        'marque' => $travaux_tag->marque,
                        'shab' => $travaux_tag->shab,
                        'Nombre_de_pièces_dans_le_logement' => $travaux_tag->Nombre_de_pièces_dans_le_logement,
                        'Type_de_radiateur' => $travaux_tag->Type_de_radiateur,
                        'Nombre_de_radiateurs_électrique' => $travaux_tag->Nombre_de_radiateurs_électrique,
                        'Nombre_de_radiateurs_combustible' => $travaux_tag->Nombre_de_radiateurs_combustible,
                        'Nombre_de_radiateur_total_dans_le_logement' => $travaux_tag->Nombre_de_radiateur_total_dans_le_logement,
                        'Thermostat_supplémentaire' => $travaux_tag->Thermostat_supplémentaire,
                        'Nombre_thermostat_supplémentaire' => $travaux_tag->Nombre_thermostat_supplémentaire,
                    ]);

                    $tag_item = ProjectTag::create([
                        'project_id'    => $project->id,
                        'tag_id'        => $travaux_tag->tag_id, 
                        'surface'        => $travaux_tag->surface, 
                        'Nombre_de_split'        => $travaux_tag->Nombre_de_split, 
                        'Type_de_comble'        => $travaux_tag->Type_de_comble, 
                        'marque'        => $travaux_tag->marque, 
                        'shab'        => $travaux_tag->shab, 
                        'Nombre_de_pièces_dans_le_logement'        => $travaux_tag->Nombre_de_pièces_dans_le_logement, 
                        'Type_de_radiateur'        => $travaux_tag->Type_de_radiateur, 
                        'Nombre_de_radiateurs_électrique'        => $travaux_tag->Nombre_de_radiateurs_électrique, 
                        'Nombre_de_radiateurs_combustible'        => $travaux_tag->Nombre_de_radiateurs_combustible, 
                        'Nombre_de_radiateur_total_dans_le_logement'        => $travaux_tag->Nombre_de_radiateur_total_dans_le_logement, 
                        'Thermostat_supplémentaire'        => $travaux_tag->Thermostat_supplémentaire, 
                        'Nombre_thermostat_supplémentaire'        => $travaux_tag->Nombre_thermostat_supplémentaire, 
                    ]);

                    $lead_tag_products = LeadWorkTagProduct::where('work_id', $lead->id)->where('tag_id', $travaux_tag->tag_id)->get();
                    if($lead_tag_products){
                        foreach($lead_tag_products as $product){
                            ProjectTagProduct::create([
                                'project_id'    => $project->id,
                                'tag_id'        => $tag_item->id,
                                'product_id'    => $product->product_id,
                            ]);

                            ClientTagProduct::create([
                                'client_id'     => $client->id,
                                'tag_id'        => $product->tag_id,
                                'product_id'    => $product->product_id,
                            ]);
                        }
                    }
                }
                
            }   


            foreach($lead->getLeadComments->where('lead_reset_status', 0) as $comment){
                $project_comment = ProjectComment::create([
                    'comment'       => $comment->comment,
                    'project_id'    => $project->id,
                    'status'        => $comment->status,
                    'category_id'   => $comment->category_id,
                    'user_id'       => $comment->user_id,
                ]);
                foreach($comment->file as $file){
                    ProjectCommentFile::create([
                        'comment_id' => $project_comment->id,
                        'name'       => $file->name,
                        'type'       => $file->type,
                    ]);
                }
            }

            $lead_product_nombres = LeadProductNombre::where('lead_id', $lead->id)->get();
            foreach($lead_product_nombres as $lead_product_nombre){
                ClientProductNombre::create([
                    'client_id' => $client->id,
                    'tag_id' => $lead_product_nombre->tag_id,
                    'product_id' => $lead_product_nombre->product_id,
                    'number' => $lead_product_nombre->number,
                ]);
                ProjectProductNombre::create([
                    'project_id' => $project->id,
                    'tag_id' => $lead_product_nombre->tag_id,
                    'product_id' => $lead_product_nombre->product_id,
                    'number' => $lead_product_nombre->number,
                ]);
            }
            

            $user = User::find(1);
            $name = Auth::user()->name;
            $subject = 'Lead Converted'; 
            $body = 'Lead have been converted to client by '.$name; 
            if($user->email_professional){
                // Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
            }

            $notification = Notifications::create([
            'title'  => ['en' => 'Lead Converted', 'fr' =>'Prospect converti'],
            'body'   => ['en' => 'Lead have been converted to client by '. Auth::user()->name, 'fr' => 'Les prospects ont été convertis en clients par '. Auth::user()->name],
            'user_id' => 1,
            'client_id' => $lead->id,
            ]); 

            $user = User::find(1);
            $name = Auth::user()->name;
            $subject = 'Project Create'; 
            $body = 'A new project have been created by '.$name; 
            if($user->email_professional){
                // Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
            }

            $notification = Notifications::create([
            'title'  => ['en' => 'Project Create', 'fr' =>'Créer un projet'],
            'body'   => ['en' => 'A new project have been created by '. Auth::user()->name, 'fr' => 'Un nouveau projet a été créé par '. Auth::user()->name],
            'user_id' => 1,
            'project_id' => $lead->id,
            ]); 

    
            $pannel_activity = PannelLogActivity::create([  
                'label_prev_id' => 6,
                'label_id'      => 7,
                'status'        => 'change_etiquette',
                'key'           => "etiquette",  
                'feature_type'  => 'lead',
                'feature_id'    => $lead->id,
                'user_id'       => Auth::id(), 
            ]); 
    
            $lead->etiquette_automatise_recurrence_status = 0;
            $lead->etiquette_automatise_id = 0; 
            $lead->etiquette_fin = 1;

            StatusChangeLog::create([
                'feature_id' => $lead->id,
                'from_id' => 6,
                'to_id' => 7,
                'statut_id' => $request->sub_status,
                'regie_id' => $lead->leadTelecommercial ? ($lead->leadTelecommercial->getRegie ? $lead->leadTelecommercial->getRegie->id : null):null,
                'telecommercial_id' => $lead->lead_telecommercial ?? null,
                'status_type' => 'main',
                'type' => 'lead', 
            ]);
    
            event(new PannelLog($pannel_activity->id));

            $automatisations = Automatise::where('automatisation_for', 'prospects')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
            $travaux = '';
            $travaux_count = 1;
            foreach($lead->LeadTravax as $item){
                $travaux .= $item->travaux .($travaux_count != $lead->LeadTravax->count() ? ', ':'');
                $travaux_count++;
            }
            
            foreach($automatisations as $automatisation)
            {
                if(str_contains($automatisation->status, 'main'))
                {
                        $status = explode('_', $automatisation->status); 

                    if($status[1] == 7)
                    {
                        if($automatisation->recurrence == 'Oui'){
                            $lead->etiquette_automatise_recurrence_status = 1;
                            $lead->etiquette_automatise_id = $automatisation->id;
                            $lead->etiquette_automatise_recurrence_start = Carbon::now();
                        }
                        
                        if($automatisation->sending_type == 'send_email')
                        {
                            $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                            $subject = $template->object;
                            $body = $template->body;
                            
                            $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                            $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                            $body = str_replace('{titre}', $lead->Titre, $body);
                            $body = str_replace('{nom_client}', $lead->Nom, $body);
                            $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                            $body = str_replace('{email_client}', $lead->Email, $body);
                            $body = str_replace('{téléphone_client}', $lead->phone, $body);
                            if($lead->leadTelecommercial){
                                $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                if($lead->leadTelecommercial->getRegie){
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                    $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                }else{
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                }
                            }else{
                                $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            } 
                            
                            $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                            $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                            $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                            $body = str_replace('{projet_travaux}', $travaux, $body);
                            $body = str_replace('{statut_projet}', ' ', $body);
                            $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                            $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                            $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                            $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                            $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                            $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                            $body = str_replace('{installation_date_intervention}', ' ', $body);
                            $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                            $body = str_replace('{SAV_date_intervention}', ' ', $body);
                            $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                            $body = str_replace('{etude_date_intervention}', ' ', $body);
                            $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                            $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                            $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                            
                            // $subject = $automatisation->name;
                            if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                            {
                                
                                if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                {
                                
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files =public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }

                                    if($automatisation->select_to == 'Telecommercial'){
                                        $data["email"] = $lead->leadTelecommercial->email;
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // });
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }else{
                                        if($lead->leadTelecommercial->email_professional){
                                            $data["email"] = $lead->leadTelecommercial->email_professional;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        } 
                                    }
                            
                                    // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                }

                            }
                            if($automatisation->select_to == 'Client')
                            { 
                                $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                                
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }

                            if($automatisation->select_to == 'Mail personnalisé')
                            { 
                                $data["email"] = $automatisation->custom_email;
                                $data["subject"] = $subject;
                                $data["body"] = $body;
                                if($template->file){
                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                }else{
                                    $files = '';
                                }
                                if($data["email"]){
                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                    //     $message->to($data["email"])
                                    //             ->subject($data["subject"]);
                                
                                    //     foreach ($files as $file){
                                    //         $message->attach($file);
                                    //     }            
                                    // });
                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                }
                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                            }
                                
                            if($automatisation->select_to_cc){
                                if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                {
                                    
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cc == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        }
                                    }
    
                                }
                                if($automatisation->select_to_cc == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                    
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cc == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cc;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                            if($automatisation->select_to_cci){
                                if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                {
                                    
                                    if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                    {
                                    
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($automatisation->select_to_cci == 'Telecommercial'){
                                            $data["email"] = $lead->leadTelecommercial->email;
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                    
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // }); 
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }else{
                                            if($lead->leadTelecommercial->email_professional){
                                                $data["email"] = $lead->leadTelecommercial->email_professional;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }

                                        }
                                    }
    
                                }
                                if($automatisation->select_to_cci == 'Client')
                                { 
                                    $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){
                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                        //     $message->to($data["email"])
                                        //             ->subject($data["subject"]);
                                    
                                        //     foreach ($files as $file){
                                        //         $message->attach($file);
                                        //     }            
                                        // }); 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                                if($automatisation->select_to_cci == 'Mail personnalisé')
                                { 
                                    $data["email"] = $automatisation->custom_email_cci;
                                    $data["subject"] = $subject;
                                    $data["body"] = $body;
                                    if($template->file){
                                        $files = public_path('uploads/email-files').'/'.$template->file;
                                    }else{
                                        $files = '';
                                    }
                                    if($data["email"]){ 
                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                    }
                                } 
                            }
                        }
                        else
                        {

                        $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                        $body = $template->body;
                        
                        $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                        $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                        $body = str_replace('{titre}', $lead->Titre, $body);
                        $body = str_replace('{nom_client}', $lead->Nom, $body);
                        $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                        $body = str_replace('{email_client}', $lead->Email, $body);
                        $body = str_replace('{téléphone_client}', $lead->phone, $body);
                        if($lead->leadTelecommercial){
                            $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                            if($lead->leadTelecommercial->getRegie){
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                            }else{
                                $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                $body = str_replace('{regie}', ' ', $body);
                            }
                        }else{
                            $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                            $body = str_replace('{regie}', ' ', $body);
                        } 
                        $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                        $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                        $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                        $body = str_replace('{projet_travaux}', $travaux, $body);
                        $body = str_replace('{statut_projet}', ' ', $body);
                        $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                        $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                        $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                        $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                        $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                        $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                        $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                        $body = str_replace('{installation_date_intervention}', ' ', $body);
                        $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                        $body = str_replace('{SAV_date_intervention}', ' ', $body);
                        $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                        $body = str_replace('{etude_date_intervention}', ' ', $body);
                        $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                        $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                        $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 

                        $subject = $automatisation->name;
                        
                        if($automatisation->select_to == 'Client')
                        { 
                        
                            try {
    
                                $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                $client = new \Nexmo\Client($basic);
                        
                                $receiverNumber = $lead->phone;
                                $message = $body;
                        
                                $message = $client->message()->send([
                                    'to' => str_replace('+', '', $receiverNumber),
                                    'from' => 'Novecology',
                                    'text' => $message
                                ]);
                        
                                
                                    
                            } catch (Exception $e) {
                                
                            }

                        }
                        if($automatisation->select_to_cc){
                            if($automatisation->select_to_cc == 'Client')
                            { 
                            
                                try {
        
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                            
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                            
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                            
                                    
                                        
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                        }
                        if($automatisation->select_to_cci){
                            if($automatisation->select_to_cci == 'Client')
                            { 
                            
                                try {
        
                                    $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                    $client = new \Nexmo\Client($basic);
                            
                                    $receiverNumber = $lead->phone;
                                    $message = $body;
                            
                                    $message = $client->message()->send([
                                        'to' => str_replace('+', '', $receiverNumber),
                                        'from' => 'Novecology',
                                        'text' => $message
                                    ]);
                            
                                    
                                        
                                } catch (Exception $e) {
                                    
                                }
    
                            }
                        }
                        
                        
                        }
                    }   
                }
            }  
        }

        return back()->with('success', 'Statut mis à jour');

    }
    public function leadStatusChangeBulk(Request $request){
        $checked_lead_id = explode(',', $request->selected_id);
        if(Auth::user()->getRoleName->category_id != 4){
            if(Auth::user()->getRoleName->category_id == 3){
                if(count($checked_lead_id) > 30){
                    return back()->with('error', 'Le changement de statut est limité a 30 prospects');
                }
            }else{
                if(count($checked_lead_id) > 10){
                    return back()->with('error', 'Le changement de statut est limité a 10 prospects');
                }
            }
        }
        $count = 0;
        foreach($checked_lead_id as $lead_id){
            $lead = LeadClientProject::find($lead_id);
            if($lead){
                if($lead->lead_label == 7){
                    continue;
                }
                $lead_current_label = $lead->lead_label;
                if($request->status == 6 && (!$lead->leadTelecommercial || !$lead->Type_de_contrat)){
                    continue;
                }
                $count++;
                if($lead->lead_label != $request->status){
                    $pannel_activity = PannelLogActivity::create([  
                        'label_prev_id' => $lead->lead_label,
                        'label_id'      => $request->status,
                        'status'        => 'change_etiquette',
                        'key'           => "etiquette", 
                        'dead_reason'   => $request->dead_reason, 
                        'feature_type'  => 'lead',
                        'feature_id'    => $lead_id,
                        'user_id'       => Auth::id(), 
                    ]); 

                    $lead->etiquette_automatise_recurrence_status = 0;
                    $lead->etiquette_automatise_id = 0; 
                    $lead->etiquette_fin = 1;

                    
                    StatusChangeLog::create([
                        'feature_id' => $lead->id,
                        'from_id' => $lead->lead_label,
                        'to_id' => $request->status,
                        'statut_id' => $request->sub_status,
                        'regie_id' => $lead->leadTelecommercial ? ($lead->leadTelecommercial->getRegie ? $lead->leadTelecommercial->getRegie->id : null):null,
                        'telecommercial_id' => $lead->lead_telecommercial ?? null,
                        'status_type' => 'main',
                        'type' => 'lead', 
                    ]);
            
                    event(new PannelLog($pannel_activity->id));
        
                    $automatisations = Automatise::where('automatisation_for', 'prospects')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
                    $travaux = '';
                    $travaux_count = 1;
                    foreach($lead->LeadTravax as $item){
                        $travaux .= $item->travaux .($travaux_count != $lead->LeadTravax->count() ? ', ':'');
                        $travaux_count++;
                    }
                    
                    foreach($automatisations as $automatisation)
                    {
                        if(str_contains($automatisation->status, 'main'))
                        {
                             $status = explode('_', $automatisation->status); 
        
                            if($status[1] == $request->status)
                            {
                                if($automatisation->recurrence == 'Oui'){
                                    $lead->etiquette_automatise_recurrence_status = 1;
                                    $lead->etiquette_automatise_id = $automatisation->id;
                                    $lead->etiquette_automatise_recurrence_start = Carbon::now();
                                }

                               if($automatisation->sending_type == 'send_email')
                               {
                                    $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                                    $subject = $template->object;
                                    $body = $template->body;
                                    
                                    $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                    $body = str_replace('{titre}', $lead->Titre, $body);
                                    $body = str_replace('{nom_client}', $lead->Nom, $body);
                                    $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                    $body = str_replace('{email_client}', $lead->Email, $body);
                                    $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                    $body = str_replace('{raison}', $request->dead_reason, $body);
                                    if($lead->leadTelecommercial){
                                        $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                        $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                        if($lead->leadTelecommercial->getRegie){
                                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                            $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                            $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                        }else{
                                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                            $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                            $body = str_replace('{regie}', ' ', $body);
                                        }
                                    }else{
                                        $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    } 
                                    $body = str_replace('{id_chantier}', ' ', $body);
                                    $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                    $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                    $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                    $body = str_replace('{projet_travaux}', $travaux, $body);
                                    $body = str_replace('{statut_projet}', ' ', $body);
                                    $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                    $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                    $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                    $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                                    
                                    // $subject = $automatisation->name;
                                    if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                                    {
                                       
                                        if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                        {
                                        
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files =public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
        
                                            if($automatisation->select_to == 'Telecommercial'){
                                                $data["email"] = $lead->leadTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($lead->leadTelecommercial->email_professional){
                                                    $data["email"] = $lead->leadTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                } 
                                            }
                                    
                                            // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                        }
        
                                    }
                                    if($automatisation->select_to == 'Client')
                                    { 
                                        $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                     
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                        // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                    }
        
                                    if($automatisation->select_to == 'Mail personnalisé')
                                    { 
                                        $data["email"] = $automatisation->custom_email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                     
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                        // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                    }
                                     
                                    if($automatisation->select_to_cc){
                                        if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                        {
                                           
                                            if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                            {
                                            
                                                
                                                $data["subject"] = $subject;
                                                $data["body"] = $body;
                                                if($template->file){
                                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                                }else{
                                                    $files = '';
                                                }
                                                if($automatisation->select_to_cc == 'Telecommercial'){
                                                    $data["email"] = $lead->leadTelecommercial->email;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // }); 
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }else{
                                                    if($lead->leadTelecommercial->email_professional){
                                                        $data["email"] = $lead->leadTelecommercial->email_professional;
                                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                        //     $message->to($data["email"])
                                                        //             ->subject($data["subject"]);
                                                
                                                        //     foreach ($files as $file){
                                                        //         $message->attach($file);
                                                        //     }            
                                                        // }); 
                                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                    }
                                                }
                                            }
            
                                        }
                                        if($automatisation->select_to_cc == 'Client')
                                        { 
                                            $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                         
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                        if($automatisation->select_to_cc == 'Mail personnalisé')
                                        { 
                                            $data["email"] = $automatisation->custom_email_cc;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){ 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                    }
                                    if($automatisation->select_to_cci){
                                        if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                        {
                                           
                                            if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                            {
                                            
                                                $data["subject"] = $subject;
                                                $data["body"] = $body;
                                                if($template->file){
                                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                                }else{
                                                    $files = '';
                                                }
                                                if($automatisation->select_to_cci == 'Telecommercial'){
                                                    $data["email"] = $lead->leadTelecommercial->email;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // }); 
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }else{
                                                    if($lead->leadTelecommercial->email_professional){
                                                        $data["email"] = $lead->leadTelecommercial->email_professional;
                                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                        //     $message->to($data["email"])
                                                        //             ->subject($data["subject"]);
                                                
                                                        //     foreach ($files as $file){
                                                        //         $message->attach($file);
                                                        //     }            
                                                        // }); 
                                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                    }
        
                                                }
                                            }
            
                                        }
                                        if($automatisation->select_to_cci == 'Client')
                                        { 
                                            $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                         
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                        if($automatisation->select_to_cci == 'Mail personnalisé')
                                        { 
                                            $data["email"] = $automatisation->custom_email_cci;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){ 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                    }
                               }
                               else
                               {
        
                                $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                                $body = $template->body;
                                
                                $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                $body = str_replace('{titre}', $lead->Titre, $body);
                                $body = str_replace('{nom_client}', $lead->Nom, $body);
                                $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                $body = str_replace('{email_client}', $lead->Email, $body);
                                $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                $body = str_replace('{raison}', $request->dead_reason, $body);
                                if($lead->leadTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                    if($lead->leadTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $body = str_replace('{id_chantier}', ' ', $body);
                                $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                $body = str_replace('{projet_travaux}', $travaux, $body);
                                $body = str_replace('{statut_projet}', ' ', $body);
                                $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
        
                                $subject = $automatisation->name;
                                
                                if($automatisation->select_to == 'Client')
                                { 
                                
                                    try {
          
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                              
                                        $receiverNumber = $lead->phone;
                                        $message = $body;
                              
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                              
                                        
                                          
                                    } catch (Exception $e) {
                                       
                                    }
        
                                }
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Client')
                                    { 
                                    
                                        try {
              
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                  
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                  
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                  
                                            
                                              
                                        } catch (Exception $e) {
                                           
                                        }
            
                                    }
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Client')
                                    { 
                                    
                                        try {
              
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                  
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                  
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                  
                                            
                                              
                                        } catch (Exception $e) {
                                           
                                        }
            
                                    }
                                }
                                
                                
                               }
                            }   
                        }
                    }
                    
                }
                if($lead->sub_status != $request->sub_status){
                    $pannel_activity = PannelLogActivity::create([ 
                    'status_prev_id' => $lead->sub_status,
                        'status_id'      => $request->sub_status,
                        'status'         => 'change_etiquette',
                        'key'            => "status",  
                        'feature_type'   => 'lead',
                        'feature_id'     => $lead_id,
                        'user_id'        => Auth::id(), 
                    ]); 

                    $lead->statut_automatise_recurrence_status = 0;
                    $lead->statut_automatise_id = 0; 
                    $lead->statut_fin = 1;

                    StatusChangeLog::create([
                        'feature_id' => $lead->id,
                        'from_id' => $lead->sub_status,
                        'to_id' => $request->sub_status,
                        'statut_id' => $request->sub_status,
                        'regie_id' => $lead->leadTelecommercial ? ($lead->leadTelecommercial->getRegie ? $lead->leadTelecommercial->getRegie->id : null):null,
                        'telecommercial_id' => $lead->lead_telecommercial ?? null,
                        'status_type' => 'sub',
                        'type' => 'lead', 
                    ]);
            
                    event(new PannelLog($pannel_activity->id));
        
                    $automatisations = Automatise::where('automatisation_for', 'prospects')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
                    $travaux = '';
                    $travaux_count = 1;
                    foreach($lead->LeadTravax as $item){
                        $travaux .= $item->travaux .($travaux_count != $lead->LeadTravax->count() ? ', ':'');
                        $travaux_count++;
                    }
                    
                    foreach($automatisations as $automatisation)
                    {
                        if(str_contains($automatisation->status, 'sub'))
                        {
                             $status = explode('_', $automatisation->status); 
        
                            if($status[1] == $request->sub_status)
                            {
                                if($automatisation->recurrence == 'Oui'){
                                    $lead->statut_automatise_recurrence_status = 1;
                                    $lead->statut_automatise_id = $automatisation->id;
                                    $lead->statut_automatise_recurrence_start = Carbon::now();
                                }
        
                                if($automatisation->sending_type == 'send_email')
                                {
                                    $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                                    
                                    $subject = $template->object;
                                    $body = $template->body;
        
                                    $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                    $body = str_replace('{titre}', $lead->Titre, $body);
                                    $body = str_replace('{nom_client}', $lead->Nom, $body);
                                    $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                    $body = str_replace('{email_client}', $lead->Email, $body);
                                    $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                    $body = str_replace('{raison}', $request->dead_reason, $body);
                                    if($lead->leadTelecommercial){
                                        $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                        $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                        if($lead->leadTelecommercial->getRegie){
                                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                            $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                            $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                        }else{
                                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                            $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                            $body = str_replace('{regie}', ' ', $body);
                                        }
                                    }else{
                                        $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    } 
                                    $body = str_replace('{id_chantier}', ' ', $body);
                                    $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                    $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                    $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                    $body = str_replace('{projet_travaux}', $travaux, $body);
                                    $body = str_replace('{statut_projet}', ' ', $body);
                                    $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                    $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                    $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                    $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                               
                                    if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                                    {
                                        if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                        { 
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                    
                                            if($automatisation->select_to == 'Telecommercial'){
                                                $data["email"] = $lead->leadTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($lead->leadTelecommercial->email_professional){
                                                    $data["email"] = $lead->leadTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }
                                            }
                                            // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                        }
        
                                    }
                                    if($automatisation->select_to == 'Client')
                                    { 
                                        $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                     
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                            // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
        
                                    }
                                    
                                    if($automatisation->select_to == 'Mail personnalisé')
                                    { 
                                        $data["email"] = $automatisation->custom_email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                     
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                        // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                    }
                                    if($automatisation->select_to_cc){
                                        if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                        {
                                            if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                            { 
                                                $data["subject"] = $subject;
                                                $data["body"] = $body;
                                                if($template->file){
                                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                                }else{
                                                    $files = '';
                                                }
                                                if($automatisation->select_to_cc == 'Telecommercial'){
                                                    $data["email"] = $lead->leadTelecommercial->email;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }else{
                                                    if($lead->leadTelecommercial->email_professional){
                                                        $data["email"] = $lead->leadTelecommercial->email_professional;
                                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                        //     $message->to($data["email"])
                                                        //             ->subject($data["subject"]);
                                                
                                                        //     foreach ($files as $file){
                                                        //         $message->attach($file);
                                                        //     }            
                                                        // });
                                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                    }
        
                                                }
                                                // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                            }
        
                                        }
                                        if($automatisation->select_to_cc == 'Client')
                                        { 
                                            $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                                // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
        
                                        } 
                                        if($automatisation->select_to_cc == 'Mail personnalisé')
                                        { 
                                            $data["email"] = $automatisation->custom_email_cc;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){ 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            } 
        
                                        } 
                                    }
                                    if($automatisation->select_to_cci){
                                        if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                        {
                                            if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                            { 
                                                $data["subject"] = $subject;
                                                $data["body"] = $body;
                                                if($template->file){
                                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                                }else{
                                                    $files = '';
                                                }
                                                if($automatisation->select_to_cci == 'Telecommercial'){
                                                    $data["email"] = $lead->leadTelecommercial->email;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // }); 
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }else{
                                                    if($lead->leadTelecommercial->email_professional){
                                                        $data["email"] = $lead->leadTelecommercial->email_professional;
                                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                        //     $message->to($data["email"])
                                                        //             ->subject($data["subject"]);
                                                
                                                        //     foreach ($files as $file){
                                                        //         $message->attach($file);
                                                        //     }            
                                                        // }); 
                                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                    }
        
                                                }
                                            }
        
                                        }
                                        if($automatisation->select_to_cci == 'Client')
                                        { 
                                            $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                        if($automatisation->select_to_cci == 'Mail personnalisé')
                                        { 
                                            $data["email"] = $automatisation->custom_email_cci;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){ 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                    }
                                }
                                else
                                {
         
                                $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                                $body = $template->body;
        
                                $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                $body = str_replace('{titre}', $lead->Titre, $body);
                                $body = str_replace('{nom_client}', $lead->Nom, $body);
                                $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                $body = str_replace('{email_client}', $lead->Email, $body);
                                $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                $body = str_replace('{raison}', $request->dead_reason, $body);
                                if($lead->leadTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                    if($lead->leadTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $body = str_replace('{id_chantier}', ' ', $body);
                                $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                $body = str_replace('{projet_travaux}', $travaux, $body);
                                $body = str_replace('{statut_projet}', ' ', $body);
                                $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
        
                                 $subject = $automatisation->name;
                                 
                                 if($automatisation->select_to == 'Client')
                                 { 
                                 
                                     try {
           
                                         $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                         $client = new \Nexmo\Client($basic);
                               
                                         $receiverNumber = $lead->phone;
                                         $message = $body;
                               
                                         $message = $client->message()->send([
                                             'to' => str_replace('+', '', $receiverNumber),
                                             'from' => 'Novecology',
                                             'text' => $message
                                         ]);
                               
                                         
                                           
                                     } catch (Exception $e) {
                                        
                                     }
         
                                 }
                                 if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Client')
                                    { 
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                            
                                        }
            
                                    }
                                 }
                                 if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Client')
                                    { 
                                    
                                        try {
            
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                
                                            
                                            
                                        } catch (Exception $e) {
                                            
                                        }
            
                                    }
                                 }
                                 
                                 
                                }
                            }   
                        }
                    } 
        
                }
        
                 
                $lead->lead_label = $request->status;
                $lead->sub_status  = $request->sub_status;
                $lead->lead_ko_reason = $request->dead_reason;
                $lead->save();

                // $lead->update([
                //     'lead_label' => $request->status,
                //     'sub_status'  => $request->sub_status,
                //     'lead_ko_reason' => $request->dead_reason,
                // ]);

                if($request->status == 6 && $lead->Type_de_contrat == 'BAR TH 173' && $lead_current_label != $request->status){
                    $lead->lead_label = 7;
                    $lead->sub_status = 5;
                    $lead->etiquette_automatise_recurrence_status = 0;
                    $lead->etiquette_automatise_id = 0;
                    $lead->etiquette_fin = 0;
                    $lead->etiquette_automatise_recurrence_start = null;
                    $lead->statut_automatise_recurrence_status = 0;
                    $lead->statut_automatise_id = 0;
                    $lead->statut_fin = 0;
                    $lead->statut_automatise_recurrence_start = null;
                    $lead->save();
                    $client = new NewClient(); 
                    $client->lead_id                                                            = $lead->id;
                    $client->company_id                                                         = $lead->company_id;
                    $client->lead_telecommercial                                                = $lead->lead_telecommercial;
                    $client->__tracking__Fournisseur_de_lead                                    = $lead->__tracking__Fournisseur_de_lead;
                    $client->__tracking__Type_de_campagne                                       = $lead->__tracking__Type_de_campagne;
                    $client->__tracking__Type_de_campagne__a__                                  = $lead->__tracking__Type_de_campagne__a__;
                    $client->__tracking__Nom_campagne                                           = $lead->__tracking__Nom_campagne;
                    $client->__tracking__Date_demande_lead                                      = $lead->__tracking__Date_demande_lead;
                    $client->__tracking__Date_attribution_télécommercial                        = $lead->__tracking__Date_attribution_télécommercial;
                    $client->__tracking__Type_de_travaux_souhaité                               = $lead->__tracking__Type_de_travaux_souhaité;
                    $client->__tracking__Nom_Prénom                                             = $lead->__tracking__Nom_Prénom;
                    $client->__tracking__Code_postal                                            = $lead->__tracking__Code_postal;
                    $client->__tracking__Email                                                  = $lead->__tracking__Email;
                    $client->__tracking__téléphone                                              = $lead->__tracking__téléphone;
                    $client->__tracking__Département                                            = $lead->__tracking__Département;
                    $client->__tracking__Mode_de_chauffage                                      = $lead->__tracking__Mode_de_chauffage;
                    $client->__tracking__Mode_de_chauffage__a__                                 = $lead->__tracking__Mode_de_chauffage__a__;
                    $client->__tracking__Propriétaire                                           = $lead->__tracking__Propriétaire;
                    $client->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans         = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
                    $client->Titre                                                              = $lead->Titre;    
                    $client->Prenom                                                             = $lead->Prenom;
                    $client->Nom                                                                = $lead->Nom;
                    $client->Adresse                                                            = $lead->Adresse;
                    $client->Complément_adresse                                                 = $lead->Complément_adresse;
                    $client->Code_Postal                                                        = $lead->Code_Postal;
                    $client->Ville                                                              = $lead->Ville;
                    $client->Département                                                        = $lead->Département;
                    $client->Email                                                              = $lead->Email;
                    $client->same_as_work_address                                               = $lead->same_as_work_address;
                    $client->Adresse_Travaux                                                    = $lead->Adresse_Travaux;
                    $client->Complément_adresse_Travaux                                         = $lead->Complément_adresse_Travaux;
                    $client->Code_postal_Travaux                                                = $lead->Code_postal_Travaux;
                    $client->Ville_Travaux                                                      = $lead->Ville_Travaux;
                    $client->Departement_Travaux                                                = $lead->Departement_Travaux;
                    $client->phone                                                              = $lead->phone;
                    $client->fixed_number                                                       = $lead->fixed_number;
                    $client->Observations                                                       = $lead->Observations;
                    $client->precariousness                                                     = $lead->precariousness;
                    $client->Type_occupation                                                    = $lead->Type_occupation;
                    $client->Parcelle_cadastrale                                                = $lead->Parcelle_cadastrale;
                    $client->Revenue_Fiscale_de_Référence                                       = $lead->Revenue_Fiscale_de_Référence;
                    $client->Nombre_de_foyer                                                    = $lead->Nombre_de_foyer;
                    $client->Nombre_de_personnes                                                = $lead->Nombre_de_personnes;
                    $client->Age_du_bâtiment                                                    = $lead->Age_du_bâtiment;
                    $client->Zone                                                               = $lead->Zone;
                    $client->Éligibilité_MaPrimeRenov                                           = $lead->Éligibilité_MaPrimeRenov;
                    $client->Mode_de_chauffage                                                  = $lead->Mode_de_chauffage;
                    $client->Mode_de_chauffage__a__                                             = $lead->Mode_de_chauffage__a__;
                    $client->Date_construction_maison                                           = $lead->Date_construction_maison;
                    $client->Surface_habitable                                                  = $lead->Surface_habitable;
                    $client->Surface_à_chauffer                                                 = $lead->Surface_à_chauffer;
                    $client->Consommation_chauffage_annuel                                      = $lead->Consommation_chauffage_annuel;
                    $client->Consommation_Chauffage_Annuel_2                                    = $lead->Consommation_Chauffage_Annuel_2;
                    $client->Depuis_quand_occupez_vous_le_logement                              = $lead->Depuis_quand_occupez_vous_le_logement;
                    $client->Type_du_courant_du_logement                                        = $lead->Type_du_courant_du_logement;
                    $client->auxiliary_heating_status                                           = $lead->auxiliary_heating_status;
                    $client->auxiliary_heating                                                  = $lead->auxiliary_heating;
                    $client->auxiliary_heating__a__                                             = $lead->auxiliary_heating__a__;
                    $client->second_heating_generator_status                                    = $lead->second_heating_generator_status;
                    $client->second_heating_generator                                           = $lead->second_heating_generator;
                    $client->second_heating_generator__a__                                      = $lead->second_heating_generator__a__;
                    $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement         = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
                    $client->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__    = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
                    $client->Préciser_le_type_de_radiateurs_Aluminium                           = $lead->Préciser_le_type_de_radiateurs_Aluminium;
                    $client->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs      = $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
                    $client->Préciser_le_type_de_radiateurs_Fonte                               = $lead->Préciser_le_type_de_radiateurs_Fonte;
                    $client->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
                    $client->Préciser_le_type_de_radiateurs_Acier                               = $lead->Préciser_le_type_de_radiateurs_Acier;
                    $client->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
                    $client->Préciser_le_type_de_radiateurs_Autre                               = $lead->Préciser_le_type_de_radiateurs_Autre;
                    $client->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs          = $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
                    $client->Préciser_le_type_de_radiateurs_Autre___a__                         = $lead->Préciser_le_type_de_radiateurs_Autre___a__;
                    $client->Production_dapostropheeau_chaude_sanitaire                         = $lead->Production_dapostropheeau_chaude_sanitaire;
                    $client->Instantanné                                                        = $lead->Instantanné;
                    $client->Accumulation                                                       = $lead->Accumulation;
                    $client->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude     = $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
                    $client->Instantanné_Merci_de_préciser                                      = $lead->Instantanné_Merci_de_préciser;
                    $client->Accumulation_Merci_de_préciser                                     = $lead->Accumulation_Merci_de_préciser;
                    $client->Le_logement_possède_un_réseau_hydraulique                          = $lead->Le_logement_possède_un_réseau_hydraulique;
                    $client->auxiliary_heating__Insert_à_bois_Nombre                          = $lead->auxiliary_heating__Insert_à_bois_Nombre;
                    $client->auxiliary_heating__Poêle_à_bois_Nombre                          = $lead->auxiliary_heating__Poêle_à_bois_Nombre;
                    $client->auxiliary_heating__Poêle_à_gaz_Nombre                          = $lead->auxiliary_heating__Poêle_à_gaz_Nombre;
                    $client->auxiliary_heating__Convecteur_électrique_Nombre                          = $lead->auxiliary_heating__Convecteur_électrique_Nombre;
                    $client->auxiliary_heating__Sèche_serviette_Nombre                          = $lead->auxiliary_heating__Sèche_serviette_Nombre;
                    $client->auxiliary_heating__Panneau_rayonnant_Nombre                          = $lead->auxiliary_heating__Panneau_rayonnant_Nombre;
                    $client->auxiliary_heating__Radiateur_bain_dhuile_Nombre                          = $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
                    $client->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                          = $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
                    $client->auxiliary_heating__Autre_Nombre                          = $lead->auxiliary_heating__Autre_Nombre;
                    $client->Précisez_le_volume_du_ballon_dapostropheeau_chaude                 = $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
                    $client->Information_logement_observations                                  = $lead->Information_logement_observations;
                    $client->Situation_familiale                                                = $lead->Situation_familiale;
                    $client->Situation_familiale___a__                                          = $lead->Situation_familiale___a__;
                    $client->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                         = $lead->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
                    $client->Personne_1                                                         = $lead->Personne_1;
                    $client->Quel_est_le_contrat_de_travail_de_Personne_1                       = $lead->Quel_est_le_contrat_de_travail_de_Personne_1;
                    $client->Quel_est_le_contrat_de_travail_de_Personne_1__a__                  = $lead->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
                    $client->Revenue_Personne_1                                                 = $lead->Revenue_Personne_1;
                    $client->Existehyphenthyphenil_un_conjoint                                  = $lead->Existehyphenthyphenil_un_conjoint;
                    $client->Personne_2                                                         = $lead->Personne_2;
                    $client->Quel_est_le_contrat_de_travail_de_Personne_2                       = $lead->Quel_est_le_contrat_de_travail_de_Personne_2;
                    $client->Quel_est_le_contrat_de_travail_de_Personne_2__a__                  = $lead->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
                    $client->Revenue_Personne_2                                                 = $lead->Revenue_Personne_2;
                    $client->Crédit_du_foyer_mensuel                                            = $lead->Crédit_du_foyer_mensuel;
                    $client->Commentaires_revenue_et_crédit_du_foyer                            = $lead->Commentaires_revenue_et_crédit_du_foyer;
                    $client->Type_de_contrat                                                   = $lead->Type_de_contrat;
                    $client->MaPrimeRenov                                                      = $lead->MaPrimeRenov;
                    $client->Subvention_MaPrimeRénov_déduit_du_devis                           = $lead->Subvention_MaPrimeRénov_déduit_du_devis;
                    $client->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
                    $client->Action_Logement                                                   = $lead->Action_Logement;
                    $client->CEE                                                               = $lead->CEE;
                    $client->Credit                                                            = $lead->Credit;
                    $client->Montant_Crédit                                                    = $lead->Montant_Crédit;
                    $client->Report_du_crédit                                                  = $lead->Report_du_crédit;
                    $client->Nombre_de_jours_report                                            = $lead->Nombre_de_jours_report;
                    $client->Reste_à_charge                                                    = $lead->Reste_à_charge;
                    $client->Reste_à_charge_Montant                                            = $lead->Reste_à_charge_Montant;
                    $client->Survente                                                          = $lead->Survente;
                    $client->Montant_survente                                                  = $lead->Montant_survente;
                    $client->Observations_reste_à_charge                                       = $lead->Observations_reste_à_charge;
                    $client->Mode_de_paiement                                                  = $lead->Mode_de_paiement;
                    $client->Nombre_de_mensualités                                             = $lead->Nombre_de_mensualités;
                    $client->advance_visit                                                     = $lead->advance_visit; 
                    $client->Projet_observations                                               = $lead->Projet_observations; 
                    $client->Montant_estimée_de_lapostropheaide                                = $lead->Montant_estimée_de_lapostropheaide; 
                    $client->latitude                                                          = $lead->latitude;
                    $client->longitude                                                         = $lead->longitude;
                    $client->lead_tracking_custom_field_data                                   = $lead->lead_tracking_custom_field_data;
                    $client->personal_info_custom_field_data                                   = $lead->personal_info_custom_field_data; 
                    $client->eligibility_custom_field_data                                     = $lead->eligibility_custom_field_data;
                    $client->situation_foyer_custom_field_data                                 = $lead->situation_foyer_custom_field_data;
                    $client->project_custom_field_data                                         = $lead->project_custom_field_data;
                    $client->user_id                                                           = Auth::id();
                    $client->Type_habitation                                                   = $lead->Type_habitation;
                    $client->Type_de_logement                                                  = $lead->Type_de_logement;
                    $client->Type_de_chauffage                                                 = $lead->Type_de_chauffage;
            
                    $client->save();
                    
                        
            
                    $project = new NewProject();
            
                    $project->user_id                                                            = Auth::id();
                    $project->lead_id                                                           = $lead->id;
                    $project->client_id                                                         = $client->id;
                    $project->company_id                                                        = $lead->company_id;
                    $project->lead_telecommercial                                               = $lead->lead_telecommercial;
                    $project->project_label                                                     = 1;
                    $project->project_telecommercial                                            = $lead->lead_telecommercial; 
                    $project->__tracking__Fournisseur_de_lead                                   = $lead->__tracking__Fournisseur_de_lead;
                    $project->__tracking__Type_de_campagne                                      = $lead->__tracking__Type_de_campagne;
                    $project->__tracking__Type_de_campagne__a__                                 = $lead->__tracking__Type_de_campagne__a__;
                    $project->__tracking__Nom_campagne                                          = $lead->__tracking__Nom_campagne;
                    $project->__tracking__Date_demande_lead                                     = $lead->__tracking__Date_demande_lead;
                    $project->__tracking__Date_attribution_télécommercial                       = $lead->__tracking__Date_attribution_télécommercial;
                    $project->__tracking__Type_de_travaux_souhaité                              = $lead->__tracking__Type_de_travaux_souhaité;
                    $project->__tracking__Nom_Prénom                                            = $lead->__tracking__Nom_Prénom;
                    $project->__tracking__Code_postal                                           = $lead->__tracking__Code_postal;
                    $project->__tracking__Email                                                 = $lead->__tracking__Email;
                    $project->__tracking__téléphone                                             = $lead->__tracking__téléphone;
                    $project->__tracking__Département                                           = $lead->__tracking__Département;
                    $project->__tracking__Mode_de_chauffage                                     = $lead->__tracking__Mode_de_chauffage;
                    $project->__tracking__Mode_de_chauffage__a__                                = $lead->__tracking__Mode_de_chauffage__a__;
                    $project->__tracking__Propriétaire                                          = $lead->__tracking__Propriétaire;
                    $project->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans        = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
                    $project->Titre                                                             = $lead->Titre;
                    $project->Prenom                                                            = $lead->Prenom;
                    $project->Nom                                                               = $lead->Nom;
                    $project->Adresse                                                           = $lead->Adresse;
                    $project->Complément_adresse                                                = $lead->Complément_adresse;
                    $project->Code_Postal                                                       = $lead->Code_Postal;
                    $project->Ville                                                             = $lead->Ville;
                    $project->Département                                                       = $lead->Département;
                    $project->Email                                                             = $lead->Email;
                    $project->same_as_work_address                                              = $lead->same_as_work_address;
                    $project->Adresse_Travaux                                                   = $lead->Adresse_Travaux;
                    $project->Complément_adresse_Travaux                                        = $lead->Complément_adresse_Travaux;
                    $project->Code_postal_Travaux                                               = $lead->Code_postal_Travaux;
                    $project->Ville_Travaux                                                     = $lead->Ville_Travaux;
                    $project->Departement_Travaux                                               = $lead->Departement_Travaux;
                    $project->phone                                                             = $lead->phone;
                    $project->fixed_number                                                      = $lead->fixed_number;
                    $project->Observations                                                      = $lead->Observations;
                    $project->precariousness                                                    = $lead->precariousness;
                    $project->Type_occupation                                                   = $lead->Type_occupation;
                    $project->Parcelle_cadastrale                                               = $lead->Parcelle_cadastrale;
                    $project->Revenue_Fiscale_de_Référence                                      = $lead->Revenue_Fiscale_de_Référence;
                    $project->Nombre_de_foyer                                                   = $lead->Nombre_de_foyer;
                    $project->Nombre_de_personnes                                               = $lead->Nombre_de_personnes;
                    $project->Age_du_bâtiment                                                   = $lead->Age_du_bâtiment;
                    $project->Zone                                                              = $lead->Zone;
                    $project->Éligibilité_MaPrimeRenov                                          = $lead->Éligibilité_MaPrimeRenov;
                    $project->Mode_de_chauffage                                                 = $lead->Mode_de_chauffage;
                    $project->Mode_de_chauffage__a__                                            = $lead->Mode_de_chauffage__a__;
                    $project->Date_construction_maison                                          = $lead->Date_construction_maison;
                    $project->Surface_habitable                                                 = $lead->Surface_habitable;
                    $project->Surface_à_chauffer                                                = $lead->Surface_à_chauffer;
                    $project->Consommation_chauffage_annuel                                     = $lead->Consommation_chauffage_annuel;
                    $project->Consommation_Chauffage_Annuel_2                                   = $lead->Consommation_Chauffage_Annuel_2;
                    $project->Depuis_quand_occupez_vous_le_logement                             = $lead->Depuis_quand_occupez_vous_le_logement;
                    $project->Type_du_courant_du_logement                                       = $lead->Type_du_courant_du_logement;
                    $project->auxiliary_heating_status                                          = $lead->auxiliary_heating_status;
                    $project->auxiliary_heating                                                 = $lead->auxiliary_heating;
                    $project->auxiliary_heating__a__                                            = $lead->auxiliary_heating__a__;
                    $project->second_heating_generator_status                                   = $lead->second_heating_generator_status;
                    $project->second_heating_generator                                          = $lead->second_heating_generator;
                    $project->second_heating_generator__a__                                     = $lead->second_heating_generator__a__;
                    $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement        = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement;
                    $project->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__   = $lead->Quels_sont_les_différents_émetteurs_de_chaleur_du_logement__a__;
                    $project->Préciser_le_type_de_radiateurs_Aluminium                          = $lead->Préciser_le_type_de_radiateurs_Aluminium;
                    $project->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs     = $lead->Préciser_le_type_de_radiateurs_Aluminium_Nombre_de_radiateurs;
                    $project->Préciser_le_type_de_radiateurs_Fonte                              = $lead->Préciser_le_type_de_radiateurs_Fonte;
                    $project->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Fonte_Nombre_de_radiateurs;
                    $project->Préciser_le_type_de_radiateurs_Acier                              = $lead->Préciser_le_type_de_radiateurs_Acier;
                    $project->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Acier_Nombre_de_radiateurs;
                    $project->Préciser_le_type_de_radiateurs_Autre                              = $lead->Préciser_le_type_de_radiateurs_Autre;
                    $project->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs         = $lead->Préciser_le_type_de_radiateurs_Autre_Nombre_de_radiateurs;
                    $project->Préciser_le_type_de_radiateurs_Autre___a__                        = $lead->Préciser_le_type_de_radiateurs_Autre___a__;
                    $project->Production_dapostropheeau_chaude_sanitaire                        = $lead->Production_dapostropheeau_chaude_sanitaire;
                    $project->Instantanné                                                       = $lead->Instantanné;
                    $project->Accumulation                                                      = $lead->Accumulation;
                    $project->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude    = $lead->Le_logement_possède_thyphen_il_un_ballon_dapostropheeau_chaude;
                    $project->Instantanné_Merci_de_préciser                                     = $lead->Instantanné_Merci_de_préciser;
                    $project->Accumulation_Merci_de_préciser                                    = $lead->Accumulation_Merci_de_préciser;
                    $project->Le_logement_possède_un_réseau_hydraulique                         = $lead->Le_logement_possède_un_réseau_hydraulique;
                    $project->auxiliary_heating__Insert_à_bois_Nombre                         = $lead->auxiliary_heating__Insert_à_bois_Nombre;
                    $project->auxiliary_heating__Poêle_à_bois_Nombre                         = $lead->auxiliary_heating__Poêle_à_bois_Nombre;
                    $project->auxiliary_heating__Poêle_à_gaz_Nombre                         = $lead->auxiliary_heating__Poêle_à_gaz_Nombre;
                    $project->auxiliary_heating__Convecteur_électrique_Nombre                         = $lead->auxiliary_heating__Convecteur_électrique_Nombre;
                    $project->auxiliary_heating__Sèche_serviette_Nombre                         = $lead->auxiliary_heating__Sèche_serviette_Nombre;
                    $project->auxiliary_heating__Panneau_rayonnant_Nombre                         = $lead->auxiliary_heating__Panneau_rayonnant_Nombre;
                    $project->auxiliary_heating__Radiateur_bain_dhuile_Nombre                         = $lead->auxiliary_heating__Radiateur_bain_dhuile_Nombre;
                    $project->auxiliary_heating__Radiateur_soufflan_électrique_Nombre                         = $lead->auxiliary_heating__Radiateur_soufflan_électrique_Nombre;
                    $project->auxiliary_heating__Autre_Nombre                         = $lead->auxiliary_heating__Autre_Nombre;
                    $project->Précisez_le_volume_du_ballon_dapostropheeau_chaude                = $lead->Précisez_le_volume_du_ballon_dapostropheeau_chaude;
                    $project->Information_logement_observations                                 = $lead->Information_logement_observations;
                    $project->Situation_familiale                                               = $lead->Situation_familiale;
                    $project->Situation_familiale___a__                                         = $lead->Situation_familiale___a__;
                    $project->Y_a_t_il_des_enfants_dans_le_foyer_fiscale                        = $lead->Y_a_t_il_des_enfants_dans_le_foyer_fiscale;
                    $project->Personne_1                                                        = $lead->Personne_1;
                    $project->Quel_est_le_contrat_de_travail_de_Personne_1                      = $lead->Quel_est_le_contrat_de_travail_de_Personne_1;
                    $project->Quel_est_le_contrat_de_travail_de_Personne_1__a__                 = $lead->Quel_est_le_contrat_de_travail_de_Personne_1__a__;
                    $project->Revenue_Personne_1                                                = $lead->Revenue_Personne_1;
                    $project->Existehyphenthyphenil_un_conjoint                                 = $lead->Existehyphenthyphenil_un_conjoint;
                    $project->Personne_2                                                        = $lead->Personne_2;
                    $project->Quel_est_le_contrat_de_travail_de_Personne_2                      = $lead->Quel_est_le_contrat_de_travail_de_Personne_2;
                    $project->Quel_est_le_contrat_de_travail_de_Personne_2__a__                 = $lead->Quel_est_le_contrat_de_travail_de_Personne_2__a__;
                    $project->Revenue_Personne_2                                                = $lead->Revenue_Personne_2;
                    $project->Crédit_du_foyer_mensuel                                           = $lead->Crédit_du_foyer_mensuel;
                    $project->Commentaires_revenue_et_crédit_du_foyer                           = $lead->Commentaires_revenue_et_crédit_du_foyer;
                    $project->__projet__Adresse_des_travaux                                     = $lead->__projet__Adresse_des_travaux;
                    $project->__projet__Code_postale_des_travaux                                = $lead->__projet__Code_postale_des_travaux;
                    $project->__projet__Ville_des_travaux                                       = $lead->__projet__Ville_des_travaux;
                    $project->__projet__Département_des_travaux                                 = $lead->__projet__Département_des_travaux;
                    $project->Type_de_contrat                                                   = $lead->Type_de_contrat;
                    $project->MaPrimeRenov                                                      = $lead->MaPrimeRenov;
                    $project->Subvention_MaPrimeRénov_déduit_du_devis                           = $lead->Subvention_MaPrimeRénov_déduit_du_devis;
                    $project->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov               = $lead->Le_demandeur_a_déjà_fait_une_demande_à_MaPrimeRenov;
                    $project->Action_Logement                                                   = $lead->Action_Logement;
                    $project->CEE                                                               = $lead->CEE;
                    $project->Credit                                                            = $lead->Credit;
                    $project->Montant_Crédit                                                    = $lead->Montant_Crédit;
                    $project->Report_du_crédit                                                  = $lead->Report_du_crédit;
                    $project->Nombre_de_jours_report                                            = $lead->Nombre_de_jours_report;
                    $project->Reste_à_charge                                                    = $lead->Reste_à_charge;
                    $project->Reste_à_charge_Montant                                            = $lead->Reste_à_charge_Montant;
                    $project->Survente                                                          = $lead->Survente;
                    $project->Montant_survente                                                  = $lead->Montant_survente;
                    $project->Observations_reste_à_charge                                       = $lead->Observations_reste_à_charge;
                    $project->Mode_de_paiement                                                  = $lead->Mode_de_paiement;
                    $project->Nombre_de_mensualités                                             = $lead->Nombre_de_mensualités;
                    $project->advance_visit                                                     = $lead->advance_visit; 
                    $project->Projet_observations                                               = $lead->Projet_observations; 
                    $project->latitude                                                          = $lead->latitude; 
                    $project->longitude                                                         = $lead->longitude; 
                    $project->Montant_estimée_de_lapostropheaide                                = $lead->Montant_estimée_de_lapostropheaide; 
                    $project->question_data                                                     = $lead->question_data;  
                    $project->lead_tracking_custom_field_data                                    = $lead->lead_tracking_custom_field_data;
                    $project->personal_info_custom_field_data                                    = $lead->personal_info_custom_field_data; 
                    $project->eligibility_custom_field_data                                      = $lead->eligibility_custom_field_data;
                    $project->situation_foyer_custom_field_data                                  = $lead->situation_foyer_custom_field_data;
                    $project->project_custom_field_data                                          = $lead->project_custom_field_data;
                    $project->Type_habitation                                                    = $lead->Type_habitation;
                    $project->Type_de_logement                                                   = $lead->Type_de_logement;
                    $project->Type_de_chauffage                                                  = $lead->Type_de_chauffage;
            
                    $project->project_sub_status = 5; 
                    $project->save();
                        
                    // if($request->user_id){
                    //     ProjectAssign::create([
                    //         'user_id' => $request->user_id,
                    //         'project_id' => $project->id,
                    //     ]);
                    // }
                    // if($request->gestionnaire_id){
                    //     ProjectGestionnaire::create([
                    //         'user_id' => $request->gestionnaire_id,
                    //         'project_id' => $project->id,
                    //     ]);
                    // }
        
                    $taxs = LeadTax::where('lead_id', $lead->id)->get();
                    foreach($taxs as $tax){
                        ClientTax::create([
                            'client_id' => $client->id,
                            'tax_number' => $tax->tax_number,
                            'tax_reference' => $tax->tax_reference,
                            'title' => $tax->title,
                            'first_name' => $tax->first_name,
                            'last_name' => $tax->last_name,
                            'second_title' => $tax->second_title,
                            'second_first_name' => $tax->second_first_name,
                            'second_last_name' => $tax->second_last_name,
                            'kids' => $tax->kids,
                            'phone' => $tax->phone,
                            'telephone' => $tax->telephone,
                            'email' => $tax->email,
                            'pays' => $tax->pays,
                            'postal_code' => $tax->postal_code,
                            'city' => $tax->city,
                            'address' => $tax->address,
                            'primary' => $tax->primary,
                            'type' => $tax->type,
                            'mark_check' => $tax->mark_check,
                            'address2' => $tax->address2,
                            'family_person' => $tax->family_person,
                            'observations' => $tax->observations,
                            'department' => $tax->department,
                            'same_as_work_address' => $tax->same_as_work_address,
                            'Adresse_Travaux' => $tax->Adresse_Travaux,
                            'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                            'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                            'Ville_Travaux' => $tax->Ville_Travaux,
                            'Departement_Travaux' => $tax->Departement_Travaux, 
                            'house_owner_status' => $tax->house_owner_status, 
                            'property_tax_status' => $tax->property_tax_status, 
                            'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                            'Existe_déclarant' => $tax->Existe_déclarant, 
                            'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                            'google_address' => $tax->google_address, 
                            'latitude' => $tax->latitude, 
                            'longitude' => $tax->longitude, 
                            'user_id' => $tax->user_id,
                            'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                            'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                            'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                            'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                            'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                            'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                        ]);
                        ProjectTax::create([
                            'project_id' => $project->id,
                            'tax_number' => $tax->tax_number,
                            'tax_reference' => $tax->tax_reference,
                            'title' => $tax->title,
                            'first_name' => $tax->first_name,
                            'last_name' => $tax->last_name,
                            'second_title' => $tax->second_title,
                            'second_first_name' => $tax->second_first_name,
                            'second_last_name' => $tax->second_last_name,
                            'kids' => $tax->kids,
                            'phone' => $tax->phone,
                            'telephone' => $tax->telephone,
                            'email' => $tax->email,
                            'pays' => $tax->pays,
                            'postal_code' => $tax->postal_code,
                            'city' => $tax->city,
                            'address' => $tax->address,
                            'primary' => $tax->primary,
                            'type' => $tax->type,
                            'mark_check' => $tax->mark_check,
                            'address2' => $tax->address2,
                            'family_person' => $tax->family_person,
                            'observations' => $tax->observations,
                            'department' => $tax->department,
                            'same_as_work_address' => $tax->same_as_work_address,
                            'Adresse_Travaux' => $tax->Adresse_Travaux,
                            'Complément_adresse_Travaux' => $tax->Complément_adresse_Travaux,
                            'Code_postal_Travaux' => $tax->Code_postal_Travaux,
                            'Ville_Travaux' => $tax->Ville_Travaux,
                            'Departement_Travaux' => $tax->Departement_Travaux, 
                            'house_owner_status' => $tax->house_owner_status, 
                            'property_tax_status' => $tax->property_tax_status, 
                            'MaPrimeRénov_status' => $tax->MaPrimeRénov_status, 
                            'Existe_déclarant' => $tax->Existe_déclarant, 
                            'Existe_déclarant_number' => $tax->Existe_déclarant_number, 
                            'google_address' => $tax->google_address, 
                            'latitude' => $tax->latitude, 
                            'longitude' => $tax->longitude, 
                            'user_id' => $tax->user_id,
                            'Nom_et_prénom_déclarant_1' => $tax->Nom_et_prénom_déclarant_1,
                            'Date_de_naissance_déclarant_1' => $tax->Date_de_naissance_déclarant_1,
                            'Nom_et_prénom_déclarant_2' => $tax->Nom_et_prénom_déclarant_2,
                            'Date_de_naissance_déclarant_2' => $tax->Date_de_naissance_déclarant_2,
                            'house_owner_status_déclarant_2' => $tax->house_owner_status_déclarant_2,
                            'property_tax_status_déclarant_2' => $tax->property_tax_status_déclarant_2,
                        ]);
                    }
        
                    $childrens = Children::where('lead_id', $lead->id)->get(); 
                    foreach($childrens as $children){
                        Children::create([
                            'name'          => $children->name,
                            'birth_date'    => $children->birth_date,
                            'client_id'     =>$client->id, 
                        ]);
                        
                        Children::create([
                            'name'          => $children->name,
                            'birth_date'    => $children->birth_date,
                            'project_id'    =>$project->id, 
                        ]);
                    }  
        
                    $lead_baremes = $lead->LeadBareme;
                    if($lead_baremes){
                        foreach($lead_baremes as $bareme){
                            ProjectBareme::create([
                                'project_id' => $project->id,
                                'barame_id'  => $bareme->id
                            ]); 
                            ClientBareme::create([
                                'client_id'  => $client->id,
                                'barame_id'  => $bareme->id    
                            ]);
                        }
                    } 
                    $lead_travauxs = $lead->LeadTravax;
                    if($lead_travauxs){
                        foreach($lead_travauxs as $travaux){
                            ProjectTravaux::create([
                                'project_id' => $project->id,
                                'travaux_id' => $travaux->id
                            ]);
        
                            ClientTravaux::create([
                                'client_id' => $client->id,
                                'travaux_id' => $travaux->id
                            ]);
                        }
                    } 
        
                    $lead_travaux_tags = LeadTravauxTag::where('lead_id', $lead->id)->get();
                    if($lead_travaux_tags){
                        foreach($lead_travaux_tags as $travaux_tag){
                            ProjectTravauxTag::create([
                                'project_id' => $project->id,
                                'tag_id' => $travaux_tag->tag_id
                            ]);
        
                            ClientTravauxTag::create([
                                'client_id' => $client->id,
                                'tag_id' => $travaux_tag->tag_id,
                                'surface' => $travaux_tag->surface,
                                'Nombre_de_split' => $travaux_tag->Nombre_de_split,
                                'Type_de_comble' => $travaux_tag->Type_de_comble,
                                'marque' => $travaux_tag->marque,
                                'shab' => $travaux_tag->shab,
                                'Nombre_de_pièces_dans_le_logement' => $travaux_tag->Nombre_de_pièces_dans_le_logement,
                                'Type_de_radiateur' => $travaux_tag->Type_de_radiateur,
                                'Nombre_de_radiateurs_électrique' => $travaux_tag->Nombre_de_radiateurs_électrique,
                                'Nombre_de_radiateurs_combustible' => $travaux_tag->Nombre_de_radiateurs_combustible,
                                'Nombre_de_radiateur_total_dans_le_logement' => $travaux_tag->Nombre_de_radiateur_total_dans_le_logement,
                                'Thermostat_supplémentaire' => $travaux_tag->Thermostat_supplémentaire,
                                'Nombre_thermostat_supplémentaire' => $travaux_tag->Nombre_thermostat_supplémentaire,
                            ]);
        
                            $tag_item = ProjectTag::create([
                                'project_id'    => $project->id,
                                'tag_id'        => $travaux_tag->tag_id, 
                                'surface'        => $travaux_tag->surface, 
                                'Nombre_de_split'        => $travaux_tag->Nombre_de_split, 
                                'Type_de_comble'        => $travaux_tag->Type_de_comble, 
                                'marque'        => $travaux_tag->marque, 
                                'shab'        => $travaux_tag->shab, 
                                'Nombre_de_pièces_dans_le_logement'        => $travaux_tag->Nombre_de_pièces_dans_le_logement, 
                                'Type_de_radiateur'        => $travaux_tag->Type_de_radiateur, 
                                'Nombre_de_radiateurs_électrique'        => $travaux_tag->Nombre_de_radiateurs_électrique, 
                                'Nombre_de_radiateurs_combustible'        => $travaux_tag->Nombre_de_radiateurs_combustible, 
                                'Nombre_de_radiateur_total_dans_le_logement'        => $travaux_tag->Nombre_de_radiateur_total_dans_le_logement, 
                                'Thermostat_supplémentaire'        => $travaux_tag->Thermostat_supplémentaire, 
                                'Nombre_thermostat_supplémentaire'        => $travaux_tag->Nombre_thermostat_supplémentaire, 
                            ]);
        
                            $lead_tag_products = LeadWorkTagProduct::where('work_id', $lead->id)->where('tag_id', $travaux_tag->tag_id)->get();
                            if($lead_tag_products){
                                foreach($lead_tag_products as $product){
                                    ProjectTagProduct::create([
                                        'project_id'    => $project->id,
                                        'tag_id'        => $tag_item->id,
                                        'product_id'    => $product->product_id,
                                    ]);
        
                                    ClientTagProduct::create([
                                        'client_id'     => $client->id,
                                        'tag_id'        => $product->tag_id,
                                        'product_id'    => $product->product_id,
                                    ]);
                                }
                            }
                        }
                        
                    }   
        
        
                    foreach($lead->getLeadComments->where('lead_reset_status', 0) as $comment){
                        $project_comment = ProjectComment::create([
                            'comment'       => $comment->comment,
                            'project_id'    => $project->id,
                            'status'        => $comment->status,
                            'category_id'   => $comment->category_id,
                            'user_id'       => $comment->user_id,
                        ]);
                        foreach($comment->file as $file){
                            ProjectCommentFile::create([
                                'comment_id' => $project_comment->id,
                                'name'       => $file->name,
                                'type'       => $file->type,
                            ]);
                        }
                    }
        
                    $lead_product_nombres = LeadProductNombre::where('lead_id', $lead->id)->get();
                    foreach($lead_product_nombres as $lead_product_nombre){
                        ClientProductNombre::create([
                            'client_id' => $client->id,
                            'tag_id' => $lead_product_nombre->tag_id,
                            'product_id' => $lead_product_nombre->product_id,
                            'number' => $lead_product_nombre->number,
                        ]);
                        ProjectProductNombre::create([
                            'project_id' => $project->id,
                            'tag_id' => $lead_product_nombre->tag_id,
                            'product_id' => $lead_product_nombre->product_id,
                            'number' => $lead_product_nombre->number,
                        ]);
                    }
                    
        
                    $user = User::find(1);
                    $name = Auth::user()->name;
                    $subject = 'Lead Converted'; 
                    $body = 'Lead have been converted to client by '.$name; 
                    if($user->email_professional){
                        // Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
                    }
        
                    $notification = Notifications::create([
                    'title'  => ['en' => 'Lead Converted', 'fr' =>'Prospect converti'],
                    'body'   => ['en' => 'Lead have been converted to client by '. Auth::user()->name, 'fr' => 'Les prospects ont été convertis en clients par '. Auth::user()->name],
                    'user_id' => 1,
                    'client_id' => $lead->id,
                    ]); 
        
                    $user = User::find(1);
                    $name = Auth::user()->name;
                    $subject = 'Project Create'; 
                    $body = 'A new project have been created by '.$name; 
                    if($user->email_professional){
                        // Mail::to($user->email_professional)->send(new NotificationMail($subject, $body));
                    }
        
                    $notification = Notifications::create([
                    'title'  => ['en' => 'Project Create', 'fr' =>'Créer un projet'],
                    'body'   => ['en' => 'A new project have been created by '. Auth::user()->name, 'fr' => 'Un nouveau projet a été créé par '. Auth::user()->name],
                    'user_id' => 1,
                    'project_id' => $lead->id,
                    ]); 
        
            
                    $pannel_activity = PannelLogActivity::create([  
                        'label_prev_id' => 6,
                        'label_id'      => 7,
                        'status'        => 'change_etiquette',
                        'key'           => "etiquette",  
                        'feature_type'  => 'lead',
                        'feature_id'    => $lead->id,
                        'user_id'       => Auth::id(), 
                    ]); 
            
                    $lead->etiquette_automatise_recurrence_status = 0;
                    $lead->etiquette_automatise_id = 0; 
                    $lead->etiquette_fin = 1;

                    StatusChangeLog::create([
                        'feature_id' => $lead->id,
                        'from_id' => 6,
                        'to_id' => 7,
                        'statut_id' => $request->sub_status,
                        'regie_id' => $lead->leadTelecommercial ? ($lead->leadTelecommercial->getRegie ? $lead->leadTelecommercial->getRegie->id : null):null,
                        'telecommercial_id' => $lead->lead_telecommercial ?? null,
                        'status_type' => 'main',
                        'type' => 'lead', 
                    ]);
            
            
                    event(new PannelLog($pannel_activity->id));
        
                    $automatisations = Automatise::where('automatisation_for', 'prospects')->where('type_de_campagne', 'status_change')->where('active', 'yes')->get(); 
                    $travaux = '';
                    $travaux_count = 1;
                    foreach($lead->LeadTravax as $item){
                        $travaux .= $item->travaux .($travaux_count != $lead->LeadTravax->count() ? ', ':'');
                        $travaux_count++;
                    }
                    
                    foreach($automatisations as $automatisation)
                    {
                        if(str_contains($automatisation->status, 'main'))
                        {
                                $status = explode('_', $automatisation->status); 
        
                            if($status[1] == 7)
                            {
                                if($automatisation->recurrence == 'Oui'){
                                    $lead->etiquette_automatise_recurrence_status = 1;
                                    $lead->etiquette_automatise_id = $automatisation->id;
                                    $lead->etiquette_automatise_recurrence_start = Carbon::now();
                                }
                                
                                if($automatisation->sending_type == 'send_email')
                                {
                                    $template = EmailTemplate::where('id', $automatisation->email_template)->first();
                                    $subject = $template->object;
                                    $body = $template->body;
                                    
                                    $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                    $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                                    $body = str_replace('{titre}', $lead->Titre, $body);
                                    $body = str_replace('{nom_client}', $lead->Nom, $body);
                                    $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                    $body = str_replace('{email_client}', $lead->Email, $body);
                                    $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                    if($lead->leadTelecommercial){
                                        $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                        $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                        if($lead->leadTelecommercial->getRegie){
                                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                            $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                            $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                        }else{
                                            $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                            $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                            $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                            $body = str_replace('{regie}', ' ', $body);
                                        }
                                    }else{
                                        $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    } 
                                    
                                    $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                    $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                    $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                    $body = str_replace('{projet_travaux}', $travaux, $body);
                                    $body = str_replace('{statut_projet}', ' ', $body);
                                    $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                    $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                    $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                    $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                    $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                    $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{installation_date_intervention}', ' ', $body);
                                    $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                    $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                    $body = str_replace('{etude_date_intervention}', ' ', $body);
                                    $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                    $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                    $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
                                    
                                    // $subject = $automatisation->name;
                                    if($automatisation->select_to == 'Telecommercial' || $automatisation->select_to == 'Telecommercial - professionnel')
                                    {
                                        
                                        if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                        {
                                        
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files =public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
        
                                            if($automatisation->select_to == 'Telecommercial'){
                                                $data["email"] = $lead->leadTelecommercial->email;
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                        
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // });
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }else{
                                                if($lead->leadTelecommercial->email_professional){
                                                    $data["email"] = $lead->leadTelecommercial->email_professional;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // });
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                } 
                                            }
                                    
                                            // Mail::to($lead->leadTelecommercial->email)->send(new AutomatisationMail($body, $subject));
                                        }
        
                                    }
                                    if($automatisation->select_to == 'Client')
                                    { 
                                        $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                        
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                        // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                    }
        
                                    if($automatisation->select_to == 'Mail personnalisé')
                                    { 
                                        $data["email"] = $automatisation->custom_email;
                                        $data["subject"] = $subject;
                                        $data["body"] = $body;
                                        if($template->file){
                                            $files = public_path('uploads/email-files').'/'.$template->file;
                                        }else{
                                            $files = '';
                                        }
                                        if($data["email"]){
                                            // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                            //     $message->to($data["email"])
                                            //             ->subject($data["subject"]);
                                        
                                            //     foreach ($files as $file){
                                            //         $message->attach($file);
                                            //     }            
                                            // });
                                            Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                        }
                                        // Mail::to($lead->Email)->send(new AutomatisationMail($body, $subject));
                                    }
                                        
                                    if($automatisation->select_to_cc){
                                        if($automatisation->select_to_cc == 'Telecommercial' || $automatisation->select_to_cc == 'Telecommercial - professionnel')
                                        {
                                            
                                            if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                            {
                                            
                                                
                                                $data["subject"] = $subject;
                                                $data["body"] = $body;
                                                if($template->file){
                                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                                }else{
                                                    $files = '';
                                                }
                                                if($automatisation->select_to_cc == 'Telecommercial'){
                                                    $data["email"] = $lead->leadTelecommercial->email;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // }); 
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }else{
                                                    if($lead->leadTelecommercial->email_professional){
                                                        $data["email"] = $lead->leadTelecommercial->email_professional;
                                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                        //     $message->to($data["email"])
                                                        //             ->subject($data["subject"]);
                                                
                                                        //     foreach ($files as $file){
                                                        //         $message->attach($file);
                                                        //     }            
                                                        // }); 
                                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                    }
                                                }
                                            }
            
                                        }
                                        if($automatisation->select_to_cc == 'Client')
                                        { 
                                            $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                            
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                        if($automatisation->select_to_cc == 'Mail personnalisé')
                                        { 
                                            $data["email"] = $automatisation->custom_email_cc;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){ 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                    }
                                    if($automatisation->select_to_cci){
                                        if($automatisation->select_to_cci == 'Telecommercial' || $automatisation->select_to_cci == 'Telecommercial - professionnel')
                                        {
                                            
                                            if($lead->leadTelecommercial && $lead->leadTelecommercial->status == 'active')
                                            {
                                            
                                                $data["subject"] = $subject;
                                                $data["body"] = $body;
                                                if($template->file){
                                                    $files = public_path('uploads/email-files').'/'.$template->file;
                                                }else{
                                                    $files = '';
                                                }
                                                if($automatisation->select_to_cci == 'Telecommercial'){
                                                    $data["email"] = $lead->leadTelecommercial->email;
                                                    // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                    //     $message->to($data["email"])
                                                    //             ->subject($data["subject"]);
                                            
                                                    //     foreach ($files as $file){
                                                    //         $message->attach($file);
                                                    //     }            
                                                    // }); 
                                                    Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                }else{
                                                    if($lead->leadTelecommercial->email_professional){
                                                        $data["email"] = $lead->leadTelecommercial->email_professional;
                                                        // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                        //     $message->to($data["email"])
                                                        //             ->subject($data["subject"]);
                                                
                                                        //     foreach ($files as $file){
                                                        //         $message->attach($file);
                                                        //     }            
                                                        // }); 
                                                        Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                                    }
        
                                                }
                                            }
            
                                        }
                                        if($automatisation->select_to_cci == 'Client')
                                        { 
                                            $data["email"] = $lead->Email ?? $lead->__tracking__Email;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){
                                                // Mail::send('includes.crm.mail.automatisation', $data, function($message)use($data, $files) {
                                                //     $message->to($data["email"])
                                                //             ->subject($data["subject"]);
                                            
                                                //     foreach ($files as $file){
                                                //         $message->attach($file);
                                                //     }            
                                                // }); 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                        if($automatisation->select_to_cci == 'Mail personnalisé')
                                        { 
                                            $data["email"] = $automatisation->custom_email_cci;
                                            $data["subject"] = $subject;
                                            $data["body"] = $body;
                                            if($template->file){
                                                $files = public_path('uploads/email-files').'/'.$template->file;
                                            }else{
                                                $files = '';
                                            }
                                            if($data["email"]){ 
                                                Mail::to($data["email"])->send(new AutomatisationMail($body, $subject, $files));
                                            }
                                        } 
                                    }
                                }
                                else
                                {
        
                                $template = SmsTemplate::where('id', $automatisation->sms_template)->first();
                                $body = $template->body;
                                
                                $body = str_replace('{id_prospect}', "BH".sprintf('%08d', $lead->id), $body);
                                $body = str_replace('{id_chantier}', "BH".sprintf('%08d', $project->id), $body);
                                $body = str_replace('{titre}', $lead->Titre, $body);
                                $body = str_replace('{nom_client}', $lead->Nom, $body);
                                $body = str_replace('{prénom_client}', $lead->Prenom, $body);
                                $body = str_replace('{email_client}', $lead->Email, $body);
                                $body = str_replace('{téléphone_client}', $lead->phone, $body);
                                if($lead->leadTelecommercial){
                                    $body = str_replace('{télécommercial_prénom_professionnel}', $lead->leadTelecommercial->prenom_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', $lead->leadTelecommercial->email_professional ?? ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', $lead->leadTelecommercial->phone_professional ?? ' ', $body);
                                    if($lead->leadTelecommercial->getRegie){
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', $lead->leadTelecommercial->getRegie->getUser->prenom_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', $lead->leadTelecommercial->getRegie->getUser->email_professional ?? ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', $lead->leadTelecommercial->getRegie->getUser->phone_professional ?? ' ', $body);
                                        $body = str_replace('{regie}', $lead->leadTelecommercial->getRegie->name ?? ' ', $body);
                                    }else{
                                        $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                        $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                        $body = str_replace('{regie}', ' ', $body);
                                    }
                                }else{
                                    $body = str_replace('{télécommercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{télécommercial_téléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_prénom_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_email_professionnel}', ' ', $body);
                                    $body = str_replace('{résponsable_commercial_réléphone_professionnel}', ' ', $body);
                                    $body = str_replace('{regie}', ' ', $body);
                                } 
                                $body = str_replace('{adresse_des_travaux}', $lead->Adresse, $body);
                                $body = str_replace('{code_postale_des_travaux}', $lead->Code_Postal, $body);
                                $body = str_replace('{ville_des_travaux}', $lead->Ville, $body);
                                $body = str_replace('{projet_travaux}', $travaux, $body);
                                $body = str_replace('{statut_projet}', ' ', $body);
                                $body = str_replace('{faisabilité_du_projet}', ' ', $body);
                                $body = str_replace('{gestionnaire_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_email_professionnel}', ' ', $body);
                                $body = str_replace('{gestionnaire_téléphone_professionnel}', ' ', $body); 
                                $body = str_replace('{prévisiteur_technico-commercial_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_email_professionnel}', ' ', $body);
                                $body = str_replace('{prévisiteur_technico-commercial_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_prénom_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_email_professionnel}', ' ', $body);
                                $body = str_replace('{chargé_d_etude_téléphone_professionnel}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_date_intervention}', ' ', $body);
                                $body = str_replace('{prévisite_technico-commercial_horaire_intervention}', ' ', $body);
                                $body = str_replace('{installation_date_intervention}', ' ', $body);
                                $body = str_replace('{installation_horaire_intervention}', ' ', $body);
                                $body = str_replace('{SAV_date_intervention}', ' ', $body);
                                $body = str_replace('{SAV_horaire_intervention}', ' ', $body);
                                $body = str_replace('{etude_date_intervention}', ' ', $body);
                                $body = str_replace('{etude_horaire_intervention}', ' ', $body); 
                                $body = str_replace('{cofrac_date_de_contrôle}', ' ', $body); 
                                $body = str_replace('{cofrac_horaire_intervention}', ' ', $body); 
        
                                $subject = $automatisation->name;
                                
                                if($automatisation->select_to == 'Client')
                                { 
                                
                                    try {
            
                                        $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                        $client = new \Nexmo\Client($basic);
                                
                                        $receiverNumber = $lead->phone;
                                        $message = $body;
                                
                                        $message = $client->message()->send([
                                            'to' => str_replace('+', '', $receiverNumber),
                                            'from' => 'Novecology',
                                            'text' => $message
                                        ]);
                                
                                        
                                            
                                    } catch (Exception $e) {
                                        
                                    }
        
                                }
                                if($automatisation->select_to_cc){
                                    if($automatisation->select_to_cc == 'Client')
                                    { 
                                    
                                        try {
                
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                    
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                    
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                    
                                            
                                                
                                        } catch (Exception $e) {
                                            
                                        }
            
                                    }
                                }
                                if($automatisation->select_to_cci){
                                    if($automatisation->select_to_cci == 'Client')
                                    { 
                                    
                                        try {
                
                                            $basic  = new \Nexmo\Client\Credentials\Basic('47594b57', 'NmRzA90qMz3cerm6');
                                            $client = new \Nexmo\Client($basic);
                                    
                                            $receiverNumber = $lead->phone;
                                            $message = $body;
                                    
                                            $message = $client->message()->send([
                                                'to' => str_replace('+', '', $receiverNumber),
                                                'from' => 'Novecology',
                                                'text' => $message
                                            ]);
                                    
                                            
                                                
                                        } catch (Exception $e) {
                                            
                                        }
            
                                    }
                                }
                                
                                
                                }
                            }   
                        }
                    }  
                }
            }
        }
    
        // return back()->with('success', 'Statut mis à jour');
        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' statut mis à jour'); 

    }

    public function leadKoRaisonUpdate(Request $request){
        LeadClientProject::find($request->lead_id)->update([
            'lead_ko_reason' => $request->value,
        ]);
        return response('success');
    }

    public function leadBaremeValidate(Request $request){
        $lead = LeadClientProject::find($request->lead_id); 
                
        return response()->json(['maprime' =>MaPrimeRenovEstimatedAmount($lead->Mode_de_chauffage, $lead->precariousness, $request->value), 'cee' => CEEEstimatedAmount($lead->Mode_de_chauffage, $lead->precariousness, $request->value)]);
    }

    public function leadNumberCopy(Request $request){
        return back();
        $leads = LeadClientProject::whereIn('id', $request->lead_id)->get();
        $numbers = '';
        foreach ($leads as $lead){
            if($lead->phone){
                $numbers .= $lead->phone .'</br>'. $lead->phone.'</br></br>';
            }
        }

        return response()->json(['numbers' => $numbers != '' ? $numbers:"Pas de numéro", 'status' => $numbers != '' ? 1:0]);
    }

    public function leadSimilarFile($id){
        $lead = LeadClientProject::find($id);
        if($lead && $lead->lead_deleted_status == 0 && ($lead->Nom || $lead->Adresse || $lead->phone)){
            $leads = LeadClientProject::where('lead_deleted_status', 0)->where(function($query) use($lead){
                if($lead->Nom && $lead->Adresse && $lead->phone){
                    $query->where('Nom', $lead->Nom)->orWhere('Adresse', $lead->Adresse)->orWhere('phone', $lead->phone);
                }elseif($lead->Nom && $lead->Adresse){
                    $query->where('Nom', $lead->Nom)->orWhere('Adresse', $lead->Adresse);
                }elseif($lead->Nom && $lead->phone){
                    $query->where('Nom', $lead->Nom)->orWhere('phone', $lead->phone);
                }elseif($lead->Adresse && $lead->phone){
                    $query->where('Adresse', $lead->Adresse)->orWhere('phone', $lead->phone);
                }elseif($lead->Nom){
                    $query->where('Nom', $lead->Nom);
                }elseif($lead->Adresse){
                    $query->where('Adresse', $lead->Adresse);
                }elseif($lead->phone){
                    $query->where('phone', $lead->phone);
                }
            })->get(); 
            return view('admin.lead-similar-file', compact('leads'));       
        }
        // $primary_tax = LeadTax::find($tax_id);
        // if($primary_tax->getLead && $primary_tax->getLead->lead_deleted_status == 0){
        //     $similar_tax = LeadTax::whereIn('id', checkDuplicateEntry($primary_tax))->get();
        //     return view('admin.lead-similar-file', compact('primary_tax', 'similar_tax'));       
        // }
        return redirect()->route('leads.all');
    }

    public function leadCallbackSetting(Request $request){
        $lead = LeadClientProject::find($request->id);
        if($lead){
            $lead->update([
                 'callback_time' => $request->callback_time,
                 'callback_mail_status' => 'no',
                 'callback_history_type' => 0,
                 'callback_user_id' => Auth::id(),
                 'callback_observations' => $request->callback_observations,
             ]);
     
             $pannel_activity = PannelLogActivity::create([
                 'tab_name'      => 'Lead',
                 'block_name'    => "Rappler",
                 'key'           => "callback_setting__activity",
                 'value'         => $request->callback_time,
                 'feature_id'    => $lead->id,
                 'feature_type'  => 'lead',
                 'user_id'       => Auth::id(), 
             ]); 
     
             event(new PannelLog($pannel_activity->id));
     
             return back()->with(__("Updated Succesfully"));
        }else{
            return back();
        }
    }

    
    public function leadFiscalStatusChange(Request $request){
        LeadTax::find($request->tax_id)->update([
            $request->field => $request->status,
        ]);

        return response('Mise à jour réussie');
    }

    public function leadPreImport(Request $request){

        $original_file_name = $request->file('file')->getClientOriginalName();

        $extension = $request->file('file')->getClientOriginalExtension();
        if($extension == 'csv' || $extension == 'xlsx'){
            $heading = (new HeadingRowImport())->toArray($request->file('file'));  

            HeadingRowFormatter::default('none');

            $second_heading = (new HeadingRowImport(2))->toArray($request->file('file'));  

            $headings = $heading[0][0];
            $second_headings = $second_heading[0][0];
            foreach ($headings as $key => $heading){
                if($heading && (str_contains($heading, 'date') || str_contains($heading, 'Date'))){
                    try { 
                        $second_headings[$key] = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($second_headings[$key]))->format('d/m/Y H:i');
                    } catch (Throwable $e) { 
                        $second_headings[$key] = $second_headings[$key];
                    }
                }
            }

            $headers = LeadHeader::all();
            $custom_fields = ProjectCustomField::all();
            $regies = Regie::all();
            $labels = LeadStatus::all();
            $lead_sub_status = LeadSubStatus::orderBy('order', 'asc')->get();

            $view = view('admin.lead-csv-header', compact('headings', 'headers', 'custom_fields', 'regies', 'labels', 'lead_sub_status', 'original_file_name', 'second_headings'))->render();
            return response()->json(['data' => $view]);
        }else{
            return response()->json(['error' => 'Veuillez entrer un fichier csv ou xlsx valide.']);
        }
    }

    public function leadFiscalInfoUpdate(Request $request){
        LeadTax::find($request->tax_id)->update([
        'Existe_déclarant_number' => $request->value,
        ]);

        return response('Mise à jour réussie');
    }

    public function postalCodeChange(Request $request){
        return response()->json(['department' => getDepartment2($request->code), 'zone' => getPrimaryZone($request->code)]);
    }

    public function ringoverNumberExport(Request $request){
        return back();
        // $ids = explode(',', $request->checkedLead); 
        // $leads = LeadClientProject::whereIn('id',$ids)->get()->map(function($lead) {									
        //     return [
        //             'Phone' => $lead->phone,
        //             'First Name' => $lead->Prenom,
        //             'Last Name' => $lead->Nom,
        //         ];
        //     });

        // return Excel::download(new RingoverNumberExport($leads), 'ringover_number.xlsx');
    }


    public function leadTaxDeclarantUpdate(Request $request){ 
        $lead_tax = LeadTax::find($request->tax_id);
        if($lead_tax){
            $lead_tax->Nom_et_prénom_déclarant_1 = $request->Nom_et_prénom_déclarant_1;
            $lead_tax->Date_de_naissance_déclarant_1 = $request->Date_de_naissance_déclarant_1;
            $lead_tax->Nom_et_prénom_déclarant_2 = $request->Nom_et_prénom_déclarant_2;
            $lead_tax->Date_de_naissance_déclarant_2 = $request->Date_de_naissance_déclarant_2;
            $lead_tax->house_owner_status_déclarant_2 = $request->house_owner_status_déclarant_2 ? 'yes':'no';
            $lead_tax->property_tax_status_déclarant_2 = $request->property_tax_status_déclarant_2 ? 'yes':'no';
            $lead_tax->house_owner_status = $request->house_owner_status;
            $lead_tax->property_tax_status = $request->property_tax_status;
            $lead_tax->Existe_déclarant = $request->Existe_déclarant;
            $lead_tax->Existe_déclarant_number = $request->Existe_déclarant_number;
            $lead_tax->save();
        }

        return back()->with('success', __('Updated Succesfully'))->with('client_active', '1');
    }

 
    public function leadImportRegieChange(Request $request){
        $users = User::where('regie_id', $request->regie_id)->where('deleted_status', 'no')->where('status', 'active')->get();
        $telecommercials = '<div class="form-group text-left mt-3" id="importRegieTelecommercial">
        <label class="form-label" for="">Télécommercial</label>
        <select name="selected__telecommercial" class="select2_select_option custom-select shadow-none form-control"> <option value="" selected>Sélectionnez</option>';

        foreach($users as $user){
            $telecommercials .="<option value='$user->id'>$user->name</option>";
        }

        $telecommercials .= '</select></div>';
        return response($telecommercials);
    }

    public function statusChangeList(Request $request){
        $status = $request->status;
        $lead_status = LeadStatus::find($status); 
        // if($status == 6){
        //     if(Auth::user()->getRoleName->category_id == 3 || Auth::user()->getRoleName->category_id == 4){
        //         $lead_sub_status = LeadSubStatus::whereIn('id', [52,53,54,25,50])->get();        
        //     }else{
        //         $lead_sub_status = LeadSubStatus::where('id', 25)->get();        
        //     }
        // }else{
        //     $lead_sub_status = LeadSubStatus::orderBy('order', 'asc')->get();        
        // }
        $lead_sub_status = $lead_status->getSubStatus;        

        $view = view('admin.lead_sub_status', compact('lead_sub_status', 'status'))->render();
        return response($view);
    }

    public function childrenRemoved(Request $request){
        $children = Children::find($request->id);
        if($children){
            $children->delete();
        }
        return response('success');
    }
    public function childrenUpdate(Request $request){
        $children = Children::find($request->id);
        if($children){
            $children->update([
                'name'          => $request->name,
                'birth_date'    => $request->date,
            ]);
        }  

        $view = view('includes.crm.birth_date', compact('children'))->render();
        
        return response($view);
    }

    public function leadModalRender(Request $request){
        $status = $request->status;
        $lead_status = LeadStatus::find($status); 
        $lead = LeadClientProject::find($request->id);
        // $lead_sub_status = LeadSubStatus::orderBy('order', 'asc')->get();
        $lead_sub_status = $lead_status->getSubStatus;
        if($request->type == 'sub_status'){
            $view = view('admin.lead_sub_status_change_modal', compact('lead', 'lead_sub_status', 'status'))->render();
        }else if($request->type == 'status'){
            $view = view('admin.lead_status_change_modal', compact('lead', 'lead_sub_status', 'status'))->render();
        }else{
            $view = '';
        }
        return response($view);
    }

    public function projectTagProductChange(Request $request){
        $products = $request->value;
        $tag_id = $request->tag_id;
        $tag_product_nombre = $request->tag_product_nombre;
        if($tag_id  == '2' || $tag_id == '6'){
            $view = view('admin.tag_product__nombre', compact('products', 'tag_id', 'tag_product_nombre'))->render();
            return($view);
        }
    }


    public function leadBulkRemiseZeroRegieAssign(Request $request){
        $ids = explode(',', $request->checkedLead);
        $regie_id = $request->regie_id; 
        $leads = LeadClientProject::whereIn('id', $ids)->get();
        $count = $leads->count();
        foreach($leads as $lead){
            $new_custom_data = [];
            if($lead->lead_tracking_custom_field_data){
                $data = json_decode($lead->lead_tracking_custom_field_data);
                foreach($data as $key  => $value){
                    if($key == 'audience' || $key == 'travaux_formulaire' || $key == 'type_de_chauffage'){
                        $new_custom_data[$key] = $value;
                    }
                } 
            }
            $old_id                     = $lead->id;
            $Nom_Prénom     = $lead->__tracking__Nom_Prénom;
            $Code_postal    = $lead->__tracking__Code_postal;
            $Email          = $lead->__tracking__Email;
            $téléphone      = $lead->__tracking__téléphone;
            $_Nom           = $lead->Nom;
            $_Prenom        = $lead->Prenom;
            $_Email         = $lead->Email;
            $_téléphone     = $lead->phone;
            $Fournisseur_de_lead      = $lead->__tracking__Fournisseur_de_lead;
            $Type_de_campagne      = $lead->__tracking__Type_de_campagne;
            $Nom_campagne      = $lead->__tracking__Nom_campagne;
            $Type_de_travaux_souhaité      = $lead->__tracking__Type_de_travaux_souhaité;
            $Mode_de_chauffage      = $lead->__tracking__Mode_de_chauffage;
            $Propriétaire      = $lead->__tracking__Propriétaire;
            $Votre_maison_ahyphenthyphenelle_plus_de_15_ans      = $lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $lead->delete();
            $new_lead = new LeadClientProject(); 
             
            $new_lead->id                               = $old_id;
            $new_lead->lead_label                       = 1;
            $new_lead->lead_status                      = 1;
            $new_lead->company_id                       = 1;
            $new_lead->Nom                              = $_Nom;
            $new_lead->Prenom                           = $_Prenom;
            $new_lead->Email                            = $_Email;
            $new_lead->phone                            = $_téléphone;
            $new_lead->__tracking__Nom_Prénom           = $Nom_Prénom;
            $new_lead->__tracking__Code_postal          = $Code_postal;
            $new_lead->__tracking__Email                = $Email;
            $new_lead->__tracking__téléphone            = $téléphone;
            $new_lead->__tracking__Fournisseur_de_lead            = $Fournisseur_de_lead;
            $new_lead->__tracking__Type_de_campagne            = $Type_de_campagne;
            $new_lead->__tracking__Nom_campagne            = $Nom_campagne;
            $new_lead->__tracking__Type_de_travaux_souhaité            = $Type_de_travaux_souhaité;
            $new_lead->__tracking__Mode_de_chauffage            = $Mode_de_chauffage;
            $new_lead->__tracking__Propriétaire            = $Propriétaire;
            $new_lead->__tracking__Votre_maison_ahyphenthyphenelle_plus_de_15_ans            = $Votre_maison_ahyphenthyphenelle_plus_de_15_ans;
            $new_lead->__tracking__Date_attribution_télécommercial    = Carbon::today()->format('Y-m-d');
            $new_lead->lead_tracking_custom_field_data = json_encode($new_custom_data);
            $new_lead->__tracking__Date_demande_lead    = Carbon::today()->format('Y-m-d');
            $new_lead->import_regie                     = $regie_id;
            
            // if((role() == 'sales_manager' || role() == 'sales_manager_externe') && Auth::user()->getRegieTelecommercial){
            //     $new_lead->import_regie = Auth::user()->getRegieTelecommercial->id;
            // }

            $new_lead->save();


            LeadWorkBareme::where('work_id', $old_id)->get()->each->delete();
            LeadWorkTravaux::where('work_id', $old_id)->get()->each->delete();
            LeadWorkTagProduct::where('work_id', $old_id)->get()->each->delete();
            LeadTravauxTag::where('lead_id', $old_id)->get()->each->delete();
            LeadTax::where('lead_id', $old_id)->get()->each->delete();
            Children::where('lead_id', $old_id)->get()->each->delete();
            PannelLogActivity::where('feature_type', 'lead')->where('feature_id', $old_id)->get()->each->update([
                'lead_reset_status' => 1
            ]);
            LeadComment::where('lead_id', $old_id)->get()->each->update([
                'lead_reset_status' => 1
            ]); 

            $pannel_activity = PannelLogActivity::create([  
                'key'           => "lead_reset__by", 
                'feature_id'    => $new_lead->id,
                'feature_type'  => 'lead',
                'lead_reset_status' => 1,
                'user_id'       => Auth::id(), 
            ]);   
            event(new PannelLog($pannel_activity->id));
        }

        // return back()->with('success', __('Updated Succesfully'));
        return back()->with('success',  $count.' prospect'.($count > 1 ? 's':'' ).' remise à zéro avec succès');
    }


    public function leadCommentDelete(Request $request){
        if(role() != 's_admin'){
            return back()->with('error', "Vous n'avez pas accès pour supprimer ceci");
        }
        $comment = LeadComment::find($request->id);
        if($comment){
            $comment->delete();
        }
        return back()->with('success', __('Deleted Succesfully'));
    }

    public function projectMarqueChange(Request $request){
        $tag = BaremeTravauxTag::find($request->tag_id);
        $marque = $request->value;
        $products = $tag->getProducts;
        $view = view('admin.marque-product', compact('products', 'marque'))->render();
        return response($view);
    }

    public function leadSingleDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $lead = LeadClientProject::find($request->id);
        if($lead){ 
            $lead->update(['lead_deleted_status' => 1, 'lead_telecommercial' => null]);
        }
        Notifications::where('lead_id', $request->id)->get()->each->delete(); 
        if($request->similar_status){
            return back()->with('success', __("Deleted Successfully"));
        }else{
            return redirect()->route('leads.all')->with('success', __("Deleted Successfully"));
        }
    }

    public function leadSimilarCheck(Request $request){
        if(!checkAction(Auth::id(), 'lead', 'similar-prospect') && role() != 's_admin'){
            return back();
        } 
        $field = $request->type;
        $leads = LeadClientProject::select($field, DB::raw('COUNT(*) as `count`'))
            ->groupBy($field)
            ->where('lead_deleted_status', 0)
            ->having('count', '>', 1)
            ->get()->pluck($field)->toArray();
        
        $similar_leads = LeadClientProject::whereIn($field, $leads)->where('lead_deleted_status', 0)->orderBy($field)->get();

        $view = view('admin.lead-similar-field', compact('similar_leads', 'field'))->render();
        $delete_modal = view('admin.similar-lead-delete-modal', compact('similar_leads'))->render();
        return response()->json(['view' => $view, 'delete_modal' => $delete_modal]);
    }

    public function similarLeadBulkDelete(Request $request){
        if(role() != 's_admin'){
            return back();
        }
        $checked_lead_id = explode(',', $request->similar_lead_bulk_id); 
        foreach($checked_lead_id as $lead_id){
            $lead = LeadClientProject::find($lead_id);
            if($lead){ 
                $lead->update(['lead_deleted_status' => 1, 'lead_telecommercial' => null]);
            }
            Notifications::where('lead_id', $lead_id)->get()->each->delete(); 
        }

        return back()->with('success', __("Deleted Successfully"));
    }

    public function leadDispatchRender(Request $request){

        if(!checkAction(Auth::id(), 'lead', 'dispatch') && role() != 's_admin'){
            return back();
        }

        $stats_regies = Auth::user()->allRegie; 
        $administrarif_role = ['s_admin', 'manager_direction', 'manager', 'adv', 'assistant_adv', 'Gestionnaire', 'adv_copy_1693686130', 'adv_copy_1693686162'];  
        $telecommercials = [];
        if(in_array(role(), $administrarif_role)){   
            $telecommercials = User::where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->with('getRoleName','getLeads')->get(); 
        }else{ 
            if($request->status == 1){ 
                if((role() == 'sales_manager' || role() == 'sales_manager_externe') && Auth::user()->getRegieTelecommercial){
                    $telecommercials = User::whereIn('regie_id', $stats_regies->pluck('id'))->where('deleted_status', 'no')->where('status', 'active')->whereIn('role_id', [8,23])->with('getRoleName','getLeads')->get();
                }
            }
        }   

        $view = view('admin.lead-dispatch-modal', compact('telecommercials'))->render();
        return response($view);
    }

    //END
}

