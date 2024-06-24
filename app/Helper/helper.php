<?php


// ThemeSettings

use App\Models\CRM\CompanyPermission;
use App\Models\CRM\LeadStatus;
use App\Models\CRM\LeadSubStatus;
use App\Models\CRM\NewProject;
use App\Models\CRM\Notifications;
use App\Models\CRM\ProjectIntervention;
use App\Models\CRM\ProjectNewStatus;
use App\Models\CRM\ProjectStatus;
use App\Models\CRM\ProjectSubStatus;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Guid\Guid;

function themesettings($user_id)
{
    if(\App\Models\ThemeSetting::where('user_id', $user_id)->first()){
        return \App\Models\ThemeSetting::where('user_id', $user_id)->first();
    }else{
        return \App\Models\ThemeSetting::first();
    }
}

function generalSetting(){
    return App\Models\BackOffice\GeneralSetting::first();
}

// Banner
function banner(){

    return \App\Models\Banner::get();
}

function bienvenue(){

    return \App\Models\Bienvenue::first();
}

function expertises(){

    return \App\Models\Expertise::first();
}

function workWith(){

    return \App\Models\WorkWith::get();
}

function aboutUs(){

    return \App\Models\About::get();
}

function logo(){

    return \App\Models\Logo::first();
}

function favicon(){

    return \App\Models\Favicon::first();
}

function oursolution(){

    return \App\Models\OurSolution::get();
}
function suppliers(){

    return \App\Models\Suppliers::get();
}

function opinions(){

    return \App\Models\ClintOpinion::where('status', 'show')->get();
}

function colorSetting(){

    return \App\Models\ColorSetting::first();
}


function getFooter(){

    return \App\Models\FooterSetting::first();
}


function getFooterColumn1(){

    return \App\Models\FooterColumnSetting::where('column_no','1st')->get();
}

function getSolution(){

    return \App\Models\OurSolution::latest()->take(5)->get();
}

function getFooterColumn3(){

    return \App\Models\AdviceAndGrants::latest()->take(5)->get();
}


function social(){

    return \App\Models\SocialLinkSetting::get();
}


function adviceCategory($category_id){

    return \App\Models\AdviceAndGrants::where('category_id',$category_id)->latest()->get();
}


function adviceFaqCount($advice_id){

    return \App\Models\AdviceFaq::where('advice_id',$advice_id)->get()->count();
}

function solutionReasonCount($id){

    return \App\Models\SolutionResons::where('our_solutions_id',$id)->get()->count();
}

function solutionDetailsCount($id){

    return \App\Models\OurSolutionDetails::where('solution_id',$id)->get()->count();
}

function role()
{
    return \Auth::user()->role;
} 

function checkMenuAccess()
{
    if(role() == 's_admin'){
        $navMenu = \App\Models\CRM\Navigation::all();
    }
    else {
        $navMenu = \App\Models\CRM\Permission::where('user_id', Auth::id())->whereNotNull('navigation_id')->orderBy('navigation_id', 'asc')->get(); 
    }

    return $navMenu;    
}

function getRegisterPage(){
    if(role() == 's_admin'){
        return App\Models\CRM\NonNavigation::where('route', 'user.register.index')->firstOrFail(); 
    }
    else{

         if(App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'user.register.index')->exists())
         {
            return App\Models\CRM\NonNavigation::where('route', 'user.register.index')->firstOrFail(); 
         }

    }
}

function getCreateCompany(){
    if(role() == 's_admin'){
        return App\Models\CRM\NonNavigation::where('route', 'company.add')->firstOrFail(); 
    }
    else{

         if(App\Models\CRM\Permission::where('user_id', Auth::id())->where('name', 'company.add')->exists())
         {
            return App\Models\CRM\NonNavigation::where('route', 'company.add')->firstOrFail();
         }

    }
}


    function getExtraPage()
        {
            return \App\Models\Pages::get();
        }
// get nofication
// function getNotifications(){
//     return Notifications::where('user_id',Auth::id())->orderBy('id', 'desc')->get();
// }

// get all notification 
function  countNotifications(){
    return 0;
}

function getEventCategory($id)
{
    return \App\Models\CRM\EventCategory::find($id);
}

// function companypAccess($role_id, $company_id)
// {
//     return CompanyPermission::where('role_id', $role_id)->where('company_id', $company_id)->exists();
// }


// get assign Lead
function getLeadAssign($lead_id, $user_id){
    return \App\Models\CRM\LeadAssign::where('lead_id', $lead_id)->where('user_id', $user_id)->exists();
}

// get Assignee 
function getLeadAssignee($lead_id){
    return \App\Models\CRM\LeadAssign::where('lead_id', $lead_id)->get();
}

// get Assignee Photo 
function getAssigneePhoto($user_id){
    return \App\Models\User::findOrFail($user_id);
}

//get primary Zone
function getCity($postal_code){
    $zone_code = substr($postal_code, 0,2);
    if($zone_code ==  '97'){
        $zone_code = substr($postal_code, 0, 3);
    }
    $zone = \App\Models\CRM\ZoneInfo::where('postal_code', $zone_code)->first()->city;
    if($zone){
       return $zone;
    }
    else{
       return '';
    }
}

//get primary Zone
function getDepartment($postal_code){
    if($postal_code){
        $zone_code = substr($postal_code, 0,2);
        if($zone_code ==  '97'){
            $zone_code = substr($postal_code, 0, 3);
        }
        $zone = \App\Models\CRM\ZoneInfo::where('postal_code', $zone_code)->first();
        if($zone){
           return $zone->city.' ('.$zone_code.') - '.\App\Models\CRM\Zone::find($zone->zone_id)->name;
        }
        else{
           return '';
        }
    }else{
        return '';
    }
}
//get primary Zone
function getDepartment2($postal_code){
    if($postal_code){
        $zone_code = substr($postal_code, 0,2);
        if($zone_code ==  '97'){
            $zone_code = substr($postal_code, 0, 3);
        }
        $zone = \App\Models\CRM\ZoneInfo::where('postal_code', $zone_code)->first();
        if($zone){
           return $zone->city.' ('.$zone_code.')';
        }
        else{
           return '';
        }
    }else{
        return '';
    }
}
//get primary Zone
function getDepartment3($postal_code){
    if($postal_code){
        $zone_code = substr($postal_code, 0,2);
        if($zone_code ==  '97'){
            $zone_code = substr($postal_code, 0, 3);
        }
        $zone = \App\Models\CRM\ZoneInfo::where('postal_code', $zone_code)->first();
        if($zone){
           return $zone->city;
        }
        else{
           return '';
        }
    }else{
        return '';
    }
}
//get primary Zone
function getPrimaryZone($postal_code){
    if($postal_code){
        $zone_code = substr($postal_code, 0,2);
        if($zone_code ==  '97'){
            $zone_code = substr($postal_code, 0, 3);
        }
        $zone = \App\Models\CRM\ZoneInfo::where('postal_code', $zone_code)->first();
        if($zone){
           return $zone->getZone->name;
        }
        else{
           return '';
        }
    }
    else{
       return '';
    }
}

// Check Zone
 function checkZone($lead_id, $company_id){
     if(\App\Models\CRM\Tax::where('lead_id', $lead_id)->where('company_id', $company_id)->where('primary', 'yes')->exists()){
         $postal_code = \App\Models\CRM\Tax::where('lead_id', $lead_id)->where('company_id', $company_id)->where('primary', 'yes')->first()->postal_code;
         if($postal_code){
             return getPrimaryZone($postal_code);
         }
         else{
             return '';
         }

     }
 }

//  Check Pre

// function getPrecariousness2($person, $fiscal_amount, $code){

//         $zone_code = substr($code, 0,2);
        
//         try{
//             if(\App\Models\CRM\CheckZone::where('postal_code', $zone_code)->exists()){
            
//                 if($person > 5){
//                     $fiscal_amount = $fiscal_amount / $person;
//                     $data = \App\Models\CRM\InsideFrance::where('person', 'extra')->first();
//                 }else{
//                     $data = \App\Models\CRM\InsideFrance::where('person', $person)->first();
//                 }
//                if( $fiscal_amount > $data->intermediaire){
//                    return 'Classique';
//                }
//                else if($fiscal_amount > $data->precaire){
//                    return 'Intermediaire';
//                }
//                else if($fiscal_amount > $data->grand_precaire){
//                    return 'Precaire';
//                }
//                else{
//                    return 'Grand Precaire';
//                }
//             }
//             else{
//                 if($person > 5){
//                     $fiscal_amount = $fiscal_amount / $person;
//                     $data = \App\Models\CRM\OutsideFrance::where('person', 'extra')->first();
//                 }
//                 else{
//                     $data = \App\Models\CRM\OutsideFrance::where('person', $person)->first();
//                 }
//                 if( $fiscal_amount > $data->intermediaire){
//                     return 'Classique';
//                 }
//                 else if($fiscal_amount > $data->precaire){
//                     return 'Intermediaire';
//                 }
//                 else if($fiscal_amount > $data->grand_precaire){
//                     return 'Precaire';
//                 }
//                 else{
//                     return 'Grand Precaire';
//                 }
//             }
//         }catch(Exception $e){
//             return '';
//         }
// }

function getPrecariousness($person, $fiscal_amount, $code){

    $zone_code = substr($code, 0,2);
    try{
        if(\App\Models\CRM\CheckZone::where('postal_code', $zone_code)->exists()){
            if($person > 5){
                $extra_person = $person - 5; 
                $last_item = \App\Models\CRM\InsideFrance::where('person', 5)->first();
                $extra_item = \App\Models\CRM\InsideFrance::where('person', 'extra')->first();

                if( $fiscal_amount > ($last_item->intermediaire + ($extra_item->intermediaire*$extra_person))){
                    return 'Classique';
                }
                else if($fiscal_amount > ($last_item->precaire + ($extra_item->precaire*$extra_person))){
                    return 'Intermediaire';
                }
                else if($fiscal_amount > ($last_item->grand_precaire + ($extra_item->grand_precaire*$extra_person))){
                    return 'Precaire';
                }
                else{
                    return 'Grand Precaire';
                }
            }else{
                $data = \App\Models\CRM\InsideFrance::where('person', $person)->first();
                if( $fiscal_amount > $data->intermediaire){
                    return 'Classique';
                }
                else if($fiscal_amount > $data->precaire){
                    return 'Intermediaire';
                }
                else if($fiscal_amount > $data->grand_precaire){
                    return 'Precaire';
                }
                else{
                    return 'Grand Precaire';
                }
            }
        }
        else{
            if($person > 5){
                $extra_person = $person - 5; 
                $last_item = \App\Models\CRM\OutsideFrance::where('person', 5)->first();
                $extra_item = \App\Models\CRM\OutsideFrance::where('person', 'extra')->first();
                if( $fiscal_amount > ($last_item->intermediaire + ($extra_item->intermediaire*$extra_person))){
                    return 'Classique';
                }
                else if($fiscal_amount > ($last_item->precaire + ($extra_item->precaire*$extra_person))){
                    return 'Intermediaire';
                }
                else if($fiscal_amount > ($last_item->grand_precaire + ($extra_item->grand_precaire*$extra_person))){
                    return 'Precaire';
                }
                else{
                    return 'Grand Precaire';
                }
            }
            else{
                $data = \App\Models\CRM\OutsideFrance::where('person', $person)->first();
                if( $fiscal_amount > $data->intermediaire){
                    return 'Classique';
                }
                else if($fiscal_amount > $data->precaire){
                    return 'Intermediaire';
                }
                else if($fiscal_amount > $data->grand_precaire){
                    return 'Precaire';
                }
                else{
                    return 'Grand Precaire';
                }
            }
        }
    }catch(Exception $e){
        return '';
    }
}
function getPrecariousness2024($person, $fiscal_amount, $code){
    $zone_code = substr($code, 0,2);
    try{
        if(\App\Models\CRM\CheckZone::where('postal_code', $zone_code)->exists()){
            if($person > 5){
                $extra_person = $person - 5; 
                $last_item = \App\Models\CRM\InsideFrance2024::where('person', 5)->first();
                $extra_item = \App\Models\CRM\InsideFrance2024::where('person', 'extra')->first();

                if( $fiscal_amount > ($last_item->intermediaire + ($extra_item->intermediaire*$extra_person))){
                    return 'Classique';
                }
                else if($fiscal_amount > ($last_item->precaire + ($extra_item->precaire*$extra_person))){
                    return 'Intermediaire';
                }
                else if($fiscal_amount > ($last_item->grand_precaire + ($extra_item->grand_precaire*$extra_person))){
                    return 'Precaire';
                }
                else{
                    return 'Grand Precaire';
                }
            }else{
                $data = \App\Models\CRM\InsideFrance2024::where('person', $person)->first();
                if( $fiscal_amount > $data->intermediaire){
                    return 'Classique';
                }
                else if($fiscal_amount > $data->precaire){
                    return 'Intermediaire';
                }
                else if($fiscal_amount > $data->grand_precaire){
                    return 'Precaire';
                }
                else{
                    return 'Grand Precaire';
                }
            }
        }
        else{
            if($person > 5){
                $extra_person = $person - 5; 
                $last_item = \App\Models\CRM\OutsideFrance2024::where('person', 5)->first();
                $extra_item = \App\Models\CRM\OutsideFrance2024::where('person', 'extra')->first();
                if( $fiscal_amount > ($last_item->intermediaire + ($extra_item->intermediaire*$extra_person))){
                    return 'Classique';
                }
                else if($fiscal_amount > ($last_item->precaire + ($extra_item->precaire*$extra_person))){
                    return 'Intermediaire';
                }
                else if($fiscal_amount > ($last_item->grand_precaire + ($extra_item->grand_precaire*$extra_person))){
                    return 'Precaire';
                }
                else{
                    return 'Grand Precaire';
                }
            }
            else{
                $data = \App\Models\CRM\OutsideFrance2024::where('person', $person)->first();
                if( $fiscal_amount > $data->intermediaire){
                    return 'Classique';
                }
                else if($fiscal_amount > $data->precaire){
                    return 'Intermediaire';
                }
                else if($fiscal_amount > $data->grand_precaire){
                    return 'Precaire';
                }
                else{
                    return 'Grand Precaire';
                }
            }
        }
    }catch(Exception $e){
        return '';
    }
}



function getFeature($array, $data){
    $items = explode(',', $array);
    foreach($items as $item){
        if($data == $item){
            return true;
        }
    }
}
 function taskAssign($client_id, $task_id){ 
    return \App\Models\CRM\TaskAssign::where('assignee_id', $client_id)->where('task_id', $task_id)->exists();
 }

 function getTaskTag($tag_id, $task_id){ 
    return \App\Models\CRM\TaskTag::where('task_id', $task_id)->where('tag_id', $tag_id)->exists();
 }

 function getProject($client_id){
     return \App\Models\CRM\Project::where('client_id', $client_id)->where('deleted_status', 'no')->orderBy('id', 'desc')->get();
 }
 function getClientAssign($client_id, $user_id){
    return \App\Models\CRM\ClientAssign::where('client_id', $client_id)->where('user_id', $user_id)->exists();
}
 function getProjectAssign($project_id, $user_id){
    return \App\Models\CRM\ProjectAssign::where('project_id', $project_id)->where('user_id', $user_id)->exists();
}
 function getProjectUser($project_id, $user_id){
    return \App\Models\CRM\ProjectUser::where('project_id', $project_id)->where('user_id', $user_id)->exists();
}
 function getProjectEquipeUser($project_id, $user_id){
    return \App\Models\CRM\ProjectEquipeUser::where('project_id', $project_id)->where('user_id', $user_id)->exists();
}

function getProjectStatus($name){
    return \App\Models\CRM\ProjectStatus::where('name', $name)->get();
}

 function getClientAssignee($client_id){
    return \App\Models\CRM\ClientAssign::where('client_id', $client_id)->get();
}
 function getProjectAssignee($project_id){
    return \App\Models\CRM\ProjectAssign::where('project_id', $project_id)->get();
}

function checkAction($user_id, $module, $action){
    if(\App\Models\CRM\ActionPermission::where('user_id', $user_id)->where('module_name', $module)->where('action_name', $action)->exists()){
        return true;
    }
}
function checkRoleAction($role_id, $module, $action){
    if(\App\Models\CRM\RoleActionPermission::where('role_id', $role_id)->where('module_name', $module)->where('action_name', $action)->exists()){
        return true;
    }
}
function checkRoleCategoryAction($category_id, $module, $action){
    if(\App\Models\CRM\RoleCategoryActionPermission::where('category_id', $category_id)->where('module_name', $module)->where('action_name', $action)->exists()){
        return true;
    }
}

function getLeadAccess($user_id, $lead_id){
    if(\App\Models\CRM\LeadAssign::where('user_id', $user_id)->where('lead_id', $lead_id)->exists()){
        return true;
    }
}
 
function getClientAccess($user_id, $client_id){
    if(\App\Models\CRM\ClientAssign::where('user_id', $user_id)->where('client_id', $client_id)->exists()){
        return true;
    }
}
 
function getProjectAccess($user_id, $project_id){
    if(\App\Models\CRM\ProjectAssign::where('user_id', $user_id)->where('project_id', $project_id)->exists()){
        return true;
    }
}

function checkNotificationStatus($module, $user_id){
    if(\App\Models\CRM\NotificationStatus::where('user_id', $user_id)->where('module_name', $module)->exists()){
       $data = \App\Models\CRM\NotificationStatus::where('user_id', $user_id)->where('module_name', $module)->first();  
       if($data->status == 'yes'){
           return true;
       }
    }
}

function getCookie(){
    return \App\Models\Cookie::where('device_ip', Request()->ip())->first();
}
 
function getProjectStatusPlanning(){
    return \App\Models\CRM\ProjectStatusPlanning::all();
}

function getStatusColor($status){
    $data = \App\Models\CRM\ProjectStatusPlanning::where('status', $status)->first();
    if($data){
        return $data->color;
    }else{
        return '#6c418e';
    }
}

function getStatusPrevisiteColor($status){
    $data = \App\Models\CRM\ProjectStatus::where('status', $status)->where('name', 'Statut previsite')->first();
    if($data){
        if($data->color){
            return $data->color;
        }else{
            return '#6c418e';
        }
    }else{
        return '#6c418e';
    }
}
 
function getProjectInputValue($project, $travaux, $input){

    $p_question = \App\Models\CRM\ProjectQuestion::where('project_id', $project)->where('travaux', $travaux)->first();
    if($p_question){
        $question = json_decode($p_question->data);
        if($question){
            foreach($question as $key  => $value){
                if($key == $input){
                    return $value;
                }
            } 
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function qualityControlInputValue($id, $input){

    $qc = \App\Models\CRM\ControleQuality::find($id);
    if($qc){
        $question = json_decode($qc->data);
        if($question){
            foreach($question as $key  => $value){
                if($key == $input){
                    return $value;
                }
            } 
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function getProjectSavInputValue($sav, $type, $input){

    $sav_data = \App\Models\CRM\SavFieldData::where('sav_id', $sav)->where('sav_type', $type)->first();
    if($sav_data){
        $sav = json_decode($sav_data->data);
        if($sav){
            foreach($sav as $key  => $value){
                if($key == $input){
                    return $value;
                }
            } 
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function getLeadCustomInputValue($lead_id, $input){

    $lead = \App\Models\CRM\Lead::find($lead_id);
    if($lead){
        $data = json_decode($lead->custom_data);
        if($data){
            foreach($data as $key  => $value){
                if($key == $input){
                    return $value;
                }
            } 
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function getProjectTabInputValue($tab, $input){

    $tab_data = \App\Models\CRM\CustomTabFieldData::where('tab_id', $tab)->first();
    if($tab_data){
        $tab = json_decode($tab_data->data);
        if($tab){
            foreach($tab as $key  => $value){
                if($key == $input){
                    return $value;
                }
            } 
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function getLeadInputValue($lead, $travaux, $input){
    $l_question = \App\Models\CRM\LeadQuestion::where('lead_id', $lead)->where('travaux', $travaux)->first();
    if($l_question){
        $question = json_decode($l_question->data);
        if($question){
            foreach($question as $key  => $value){
                if($key == $input){
                    return $value;
                }
            } 
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function getClientInputValue($client, $travaux, $input){
    $c_question = \App\Models\CRM\ClientQuestion::where('client_id', $client)->where('travaux', $travaux)->first();
    if($c_question){
        $question = json_decode($c_question->data);
        if($question){
            foreach($question as $key  => $value){
                if($key == $input){
                    return $value;
                }
            } 
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function getTravauxProduct(){
    return \App\Models\CRM\TravauxProduct::all();
}

function getProductByTravaux($travaux){
    return \App\Models\CRM\TravauxProduct::where('travaux', $travaux)->get();
}
function getProjectStaticTab($slug){
    return \App\Models\CRM\ProjectStaticTab::where('slug', $slug)->first();
}
function getAllStaticTab(){
    return \App\Models\CRM\ProjectStaticTab::all();
}
function getTabCollapsePermission($module){
    if(role() != 's_admin'){
        if(checkAction(Auth::id(), $module, 'edit')){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}

function getCustomFieldPermission(){
    if(role() != 's_admin'){
        if(checkAction(Auth::id(), 'custom_field', 'edit')){
            return false;
        }else{
            return true;
        }
    }else{
        return false;
    }
}

function checkDocumentAccess($project, $document){
    if(\App\Models\CRM\ProjectDocumentControl::where('project_id', $project)->where('document_id', $document)->exists()){
        return true;
    }else{
        return false;
    }
}



function nameShorter($name){
preg_match_all('/(?<=\s|^)\w/iu', $name, $matches);
$result = implode('', $matches[0]);
return strtoupper($result);
}

function checkAnalyticTogger($module){
    $data = \App\Models\CRM\AnalyticToggler::where('user_id', Auth::id())->where('module', $module)->first();
    if($data){
        if($data->status == 'show'){
            return true;
        }else{
            return false;
        }
    }else{
        return true;
    }
}

function getCalls()
{
    $client = new \GuzzleHttp\Client();
    $method = 'GET';
    $url =  "https://public-api.ringover.com/v2/calls";
    $api_key = "6b299466b4bb4453d32f9a982daa46157fca3b8c";
    try {
        $response = $client->get($url,
        [
            'headers' => [
                'Authorization' => $api_key,
            ],
        ]);

        $data =  json_decode($response->getBody()->getContents(), true);
        return $data['call_list'];
    } catch (\Exception $e) {
        return [];
    }
}

function seconds2human($ss) {
    $s = $ss%60;
    $m = floor(($ss%3600)/60);
    $h = floor(($ss%86400)/3600);
    if($ss){
        if($h != 0){
            return $h."h ". $m. "min ". $s."s";
        }elseif($m != 0){
            return $m. "min ". $s."s";
        }else{
            return $s."s";
        }
    }else{
        return "0s";
    }
}

function paginationNumber($module){
    $item = \App\Models\CRM\PaginationNumber::where('module', $module)->where('user_id', Auth::id())->first();
    if($item){
        return $item->number;
    }else{
        return 25;
    }
}

function MaPrimeRenovEstimatedAmount($mode_de_chauffage,$precaire, $baremes){
    $amount = 0;
    if($baremes){
        if(count($baremes) == 1 && $baremes[0] == 7){ 
            return 'Hors périmètre MaPrimeRenov';
        }else{
            if($mode_de_chauffage && $mode_de_chauffage != 'Autre'){
                foreach($baremes as $bareme){
                    $barem = \App\Models\CRM\BaremeTravauxTag::find($bareme);
                    if($barem){
                        if($precaire == 'Grand Precaire'){
                            $amount += $barem->grand_precaire_montant_maprime_fioul;
                        }else if($precaire == 'Precaire'){
                            $amount += $barem->precaire_montant_maprime_fioul;
                        }else if($precaire == 'Intermediaire'){
                            $amount += $barem->intermediaire_montant_maprime_fioul;
                        }else if($precaire == 'Classique'){
                            $amount += $barem->classique_montant_maprime_fioul;
                        }
                    }
                }
            }else{
                foreach($baremes as $bareme){
                    $barem = \App\Models\CRM\BaremeTravauxTag::find($bareme);
                    if($barem){
                        if($precaire == 'Grand Precaire'){
                            $amount += $barem->grand_precaire_montant_maprime_no_fioul;
                        }else if($precaire == 'Precaire'){
                            $amount += $barem->precaire_montant_maprime_no_fioul;
                        }else if($precaire == 'Intermediaire'){
                            $amount += $barem->intermediaire_montant_maprime_no_fioul;
                        }else if($precaire == 'Classique'){
                            $amount += $barem->classique_montant_maprime_no_fioul;
                        }
                    }
                }
            }
            return $amount > 20000?"20 000,00" .' €':EuroFormat($amount);
        }
    }else{
        return '';
    }
}

function CEEEstimatedAmount($mode_de_chauffage, $precaire, $baremes){

    if($baremes){
        $all_baremes = \App\Models\CRM\BaremeTravauxTag::whereIn('id', $baremes)->get(); 
        // dd($all_baremes);
        $selected_id = [];
        $kicked_id = [];  
        $case = [['113' => '112'],
                ['104' => '112'],
                ['143' => '112'], 
                ['101' => '148'],
                ['113' => '104'],
                ['113' => '143'],
                ['104' => '143']];
        $data_item = ['101', '104', '112', '113', '143', '148'];
            foreach($all_baremes as $bar){
                for ($i=0; $i< count($data_item); $i++){
                    if(str_contains($bar->bareme, $data_item[$i]))
                    {
                        $selected_id[$bar->id] = $data_item[$i]; 
                    }
                }
            }
            // dd($selected_id);
            // dd($case);
    
            foreach($selected_id as $item){
                for($j = 0; $j< count($case); $j++){
                    if(array_key_exists($item, $case[$j])){
                        if(in_array($case[$j][$item], $selected_id)){
                            foreach($selected_id as $key => $value){
                                if($case[$j][$item] == $value){
                                    $kicked_id[] = $key;
                                }
                            }
                        }
                    }
                }
            }
        //  dd($kicked_id);
        $amount = 0;
        if($mode_de_chauffage && $mode_de_chauffage != 'Autre'){
            foreach($all_baremes as $barem){ 
                if($barem && !in_array($barem->id, $kicked_id)){
                    if($precaire == 'Grand Precaire'){
                        $amount += $barem->grand_precaire_montant_cee_fioul;
                    }else if($precaire == 'Precaire'){
                        $amount += $barem->precaire_montant_cee_fioul;
                    }else if($precaire == 'Intermediaire'){
                        $amount += $barem->intermediaire_montant_cee_fioul;
                    }else if($precaire == 'Classique'){
                        $amount += $barem->classique_montant_cee_fioul;
                    }
                }
            }
        }else{
            foreach($all_baremes as $barem){ 
                if($barem && !in_array($barem->id, $kicked_id)){
                    if($precaire == 'Grand Precaire'){
                        $amount += $barem->grand_precaire_montant_cee_no_fioul;
                    }else if($precaire == 'Precaire'){
                        $amount += $barem->precaire_montant_cee_no_fioul;
                    }else if($precaire == 'Intermediaire'){
                        $amount += $barem->intermediaire_montant_cee_no_fioul;
                    }else if($precaire == 'Classique'){
                        $amount += $barem->classique_montant_cee_no_fioul;
                    }
                }
            }
        }
        // dd($amount);
        return $amount > 20000?'20 000,00'.' €':EuroFormat($amount);
    }else{
        return '';
    }

}
function EuroFormat($number){
    if($number && is_numeric($number)){
        $formatted_number = number_format($number, 2, ',', ' ');
        
        // Find the position of the last space character
        $last_space_position = strrpos($formatted_number, ' ');
    
        // If a space is found, replace it with a non-breaking space character
        if ($last_space_position !== false) {
            $formatted_number = substr_replace($formatted_number, ' ', $last_space_position, 1);
        }
    
        // Add the Euro symbol to the formatted number
        $formatted_euro =$formatted_number .' €';
    
        return $formatted_euro;
    }else{
        return '';
    }
    
    // if(strlen($euro) > 3){
    //     return substr_replace($euro, ' ', -3, 0);
    // }
    // return $euro;
}
function frenceNumberFormat($number){
    if($number && is_numeric($number)){
        $formatted_number = number_format($number, 2, ',', ' ');
        
        // Find the position of the last space character
        $last_space_position = strrpos($formatted_number, ' ');
    
        // If a space is found, replace it with a non-breaking space character
        if ($last_space_position !== false) {
            $formatted_number = substr_replace($formatted_number, ' ', $last_space_position, 1);
        }
     
        return $formatted_number;
    }else{
        return $number;
    }
    
    // if(strlen($euro) > 3){
    //     return substr_replace($euro, ' ', -3, 0);
    // }
    // return $euro;
}

function formatNumberVal($number){
    if($number && is_numeric($number)){
        $formatted_number = number_format($number, 0, '', ' ');
        
        // Find the position of the last space character
        $last_space_position = strrpos($formatted_number, ' ');
    
        // If a space is found, replace it with a non-breaking space character
        if ($last_space_position !== false) {
            $formatted_number = substr_replace($formatted_number, ' ', $last_space_position, 1);
        }
   
        return $formatted_number;
    }else{
        return '';
    }
    
    // if(strlen($euro) > 3){
    //     return substr_replace($euro, ' ', -3, 0);
    // }
    // return $euro;
}

// function checkDuplicateEntry($primary_tax){
//     $status = []; 

//     if($primary_tax){ 
//         $all_tax = \App\Models\CRM\LeadTax::where('id', '!=', $primary_tax->id)->with('getLead')->where('primary', 'yes')->get();
//         if($primary_tax){
//             if($primary_tax->same_as_work_address == 'no'){
//                 foreach($all_tax as $tax){ 
//                     if($tax->getLead && $tax->getLead->lead_deleted_status == 0){
//                         if($tax->same_as_work_address == 'no'){
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->Adresse_Travaux || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[]= $tax->id;
//                             }
//                         }else{
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[]= $tax->id;
//                             }
//                         }
//                     }
//                 }
//             }else{
//                 foreach($all_tax as $tax){ 
//                     if($tax->getLead && $tax->getLead->lead_deleted_status == 0){
//                         if($tax->same_as_work_address == 'no'){
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[] = $tax->id;
//                             }
//                         }else{
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->address2 == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[] = $tax->id;
//                             }
//                         }
//                     }
//                 }
//             }
//             return $status;
//         }else{
//             return false;
//         }
//     }else{
//         return false;
//     }
// }
function checkDuplicateEntry($lead){
    $status = false;  
    if($lead->Nom || $lead->Adresse || $lead->phone){
        $similar_leads = \App\Models\CRM\LeadClientProject::where('lead_deleted_status', 0)->where(function($query) use($lead){
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
        })->count(); 
        if($similar_leads > 1){
            $status = true;
        }
    }

    return $status; 

}

function checkClientDuplicateEntry($client){
    $status = false;  
    if($client->Nom || $client->Adresse || $client->phone){
        $similar_clients = \App\Models\CRM\NewClient::where('deleted_status', 0)->where(function($query) use($client){
            if($client->Nom && $client->Adresse && $client->phone){
                $query->where('Nom', $client->Nom)->orWhere('Adresse', $client->Adresse)->orWhere('phone', $client->phone);
            }elseif($client->Nom && $client->Adresse){
                $query->where('Nom', $client->Nom)->orWhere('Adresse', $client->Adresse);
            }elseif($client->Nom && $client->phone){
                $query->where('Nom', $client->Nom)->orWhere('phone', $client->phone);
            }elseif($client->Adresse && $client->phone){
                $query->where('Adresse', $client->Adresse)->orWhere('phone', $client->phone);
            }elseif($client->Nom){
                $query->where('Nom', $client->Nom);
            }elseif($client->Adresse){
                $query->where('Adresse', $client->Adresse);
            }elseif($client->phone){
                $query->where('phone', $client->phone);
            }
        })->count(); 
    
        if($similar_clients > 1){
            $status = true;
        }
    }

    return $status; 
}
// function checkClientDuplicateEntry($primary_tax){
//     $status = []; 

//     if($primary_tax){ 
//         $all_tax = \App\Models\CRM\ClientTax::where('id', '!=', $primary_tax->id)->with('getClient')->where('primary', 'yes')->get();
//         if($primary_tax){
//             if($primary_tax->same_as_work_address == 'no'){
//                 foreach($all_tax as $tax){ 
//                     if($tax->getClient && $tax->getClient->deleted_status == 0){
//                         if($tax->same_as_work_address == 'no'){
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->Adresse_Travaux || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[]= $tax->id;
//                             }
//                         }else{
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[]= $tax->id;
//                             }
//                         }
//                     }
//                 }
//             }else{
//                 foreach($all_tax as $tax){ 
//                     if($tax->getClient && $tax->getClient->deleted_status == 0){
//                         if($tax->same_as_work_address == 'no'){
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[] = $tax->id;
//                             }
//                         }else{
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->address2 == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[] = $tax->id;
//                             }
//                         }
//                     }
//                 }
//             }
//             return $status;
//         }else{
//             return false;
//         }
//     }else{
//         return false;
//     }
// }

// function checkProjectDuplicateEntry($primary_tax){
//     $status = []; 

//     if($primary_tax){ 
//         $all_tax = \App\Models\CRM\ProjectTax::where('id', '!=', $primary_tax->id)->where('primary', 'yes')->get();
//         if($primary_tax){
//             if($primary_tax->same_as_work_address == 'no'){
//                 foreach($all_tax as $tax){ 
//                     if($tax->getProject && $tax->getProject->deleted_status == 0){
//                         if($tax->same_as_work_address == 'no'){
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->Adresse_Travaux || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[]= $tax->id;
//                             }
//                         }else{
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[]= $tax->id;
//                             }
//                         }
//                     }
//                 }
//             }else{
//                 foreach($all_tax as $tax){ 
//                     if($tax->getProject && $tax->getProject->deleted_status == 0){
//                         if($tax->same_as_work_address == 'no'){
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->Adresse_Travaux == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[] = $tax->id;
//                             }
//                         }else{
//                             if(($tax->first_name == $primary_tax->first_name && $tax->last_name == $primary_tax->last_name) || $tax->address2 == $primary_tax->address2 || ($primary_tax->phone && $tax->phone == $primary_tax->phone)){
//                                 $status[] = $tax->id;
//                             }
//                         }
//                     }
//                 }
//             }
//             return $status;
//         }else{
//             return false;
//         }
//     }else{
//         return false;
//     }
// }
function checkProjectDuplicateEntry($project){
    $status = false;  
    if($project->Nom || $project->Adresse || $project->phone){
        $similar_projects = \App\Models\CRM\NewProject::where('deleted_status', 0)->where(function($query) use($project){
            if($project->Nom && $project->Adresse && $project->phone){
                $query->where('Nom', $project->Nom)->orWhere('Adresse', $project->Adresse)->orWhere('phone', $project->phone);
            }elseif($project->Nom && $project->Adresse){
                $query->where('Nom', $project->Nom)->orWhere('Adresse', $project->Adresse);
            }elseif($project->Nom && $project->phone){
                $query->where('Nom', $project->Nom)->orWhere('phone', $project->phone);
            }elseif($project->Adresse && $project->phone){
                $query->where('Adresse', $project->Adresse)->orWhere('phone', $project->phone);
            }elseif($project->Nom){
                $query->where('Nom', $project->Nom);
            }elseif($project->Adresse){
                $query->where('Adresse', $project->Adresse);
            }elseif($project->phone){
                $query->where('phone', $project->phone);
            }
        })->count(); 



        if($similar_projects > 1){
            $status = true;
        }
    }


    return $status;
}

function getCustomFieldData($index, $data){
    if($data){
        $data = json_decode($data);
        foreach($data as $key  => $value){
            if($key == $index){
                return trim($value);
            }
        } 
    }
    return '';
}

function planningView(){
    if(Auth::user()->getPlanningView){
        return Auth::user()->getPlanningView->view_type;
    }
    return 30;
}

function getAddressLocation($project_id1, $project_id2){ 

    $distanceSvgIcon = '<span class="distance-icon"></span>';
    $durationSvgIcon = '<span class="clock-icon"></span>';
    $project1 = \App\Models\CRM\NewProject::find($project_id1);
    $project2 = \App\Models\CRM\NewProject::find($project_id2);

    if($project1 && $project2 && $project1->latitude && $project2->latitude){  
        try{
            $original = $project1->latitude.','.$project1->longitude;
            $destinations = $project2->latitude.','.$project2->longitude;
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'query' => [
                    'origins' => $original,
                    'destinations' => $destinations,
                    'language'=> 'fr',
                    'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E',
                ],
            ]);
        
            $data = json_decode($response->getBody(), true);  
        }catch(Exception $e){
            return '';
        }

        if ($data['status'] === 'OK' && $data['rows'][0]['elements'][0]['status'] === 'OK') {
            $distance = $data['rows'][0]['elements'][0]['distance']['text'];
            $duration = $data['rows'][0]['elements'][0]['duration']['text'];
        return $distanceSvgIcon.' '.$distance.' '.$durationSvgIcon.' '.$duration; 
        }    
        return 'Emplacement introuvable';
    }else{
        return 'Emplacement introuvable';
    } 
}
function getPreviousLocation($user_interventions, $date, $intervention){ 

    $prev_intervention = null;
    $new_intervention = null;
    foreach($user_interventions as $intervention_item){
        if($intervention_item->id == $intervention->id){
            $new_intervention = $prev_intervention;
            break;
        }
        $prev_intervention = $intervention_item;
    }
    $data = $new_intervention;
 
    $distanceSvgIcon = '<span class="distance-icon"></span>';
    $durationSvgIcon = '<span class="clock-icon"></span>';
    if($data){ 
        if($data->Date_intervention > \Carbon\Carbon::parse($date)->subDays(3)){
            if($data->getProject->latitude){  
                try{
                    $original = $intervention->getProject->latitude.','.$intervention->getProject->longitude;
                    $destinations = $data->getProject->latitude.','.$data->getProject->longitude;
                    $client = new \GuzzleHttp\Client();
                    $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                        'query' => [
                            'origins' => $original,
                            'destinations' => $destinations,
                            'language'=> 'fr',
                            'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E',
                        ],
                    ]);
                
                    $data = json_decode($response->getBody(), true);  
                }catch(Exception $e){
                    return '';
                }
        
                if ($data['status'] === 'OK' && $data['rows'][0]['elements'][0]['status'] === 'OK') {
                    $distance = $data['rows'][0]['elements'][0]['distance']['text'];
                    $duration = $data['rows'][0]['elements'][0]['duration']['text'];
                return $distanceSvgIcon.' '.$distance.' '.$durationSvgIcon.' '.$duration; 
                }    
                return 'Emplacement introuvable';
            }else{
                return 'Emplacement introuvable';
            }
        }else{
            return 'Aucune d’intervention';
        }
    }
    return 'Aucune intervention';
}

function getNextLocation($user_interventions, $date, $intervention){  
    $next_intervention = false;
    $new_intervention = null;
    foreach($user_interventions as $intervention_item){
        if($next_intervention){
            $new_intervention = $intervention_item;
            break;
        }
        if($intervention_item->id == $intervention->id){
            $next_intervention = true;
        } 
    }
    $data = $new_intervention;

    $distanceSvgIcon = '<span class="distance-icon"></span>';
    $durationSvgIcon = '<span class="clock-icon"></span>';

    if($data){ 
        if($data->Date_intervention < \Carbon\Carbon::parse($date)->addDays(3)){
            if($data->getProject->latitude){ 
                try{
            $original = $intervention->getProject->latitude.','.$intervention->getProject->longitude;
            $destinations = $data->getProject->latitude.','.$data->getProject->longitude;
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'query' => [
                    'origins' => $original,
                    'destinations' => $destinations,
                    'language'=> 'fr',
                    'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E',
                ],
            ]);
        
            $data = json_decode($response->getBody(), true);  
            }catch(Exception $e){
                return '';
            }
    
            if ($data['status'] === 'OK' && $data['rows'][0]['elements'][0]['status'] === 'OK') {
                $distance = $data['rows'][0]['elements'][0]['distance']['text'];
                $duration = $data['rows'][0]['elements'][0]['duration']['text'];
            return $distanceSvgIcon.' '.$distance.' '.$durationSvgIcon.' '.$duration;
                // return [
                //     'distance' => $distance,
                //     'duration' => $duration,
                // ];
            }    
            return 'Emplacement introuvable';
            }else{
                return 'Emplacement introuvable';
            }
        }else{
            return 'Aucune d’intervention';
        }
    }
    return 'Aucune intervention';
}
function getPreviousLocation2($user_interventions, $date, $intervention){ 

    $prev_intervention = null;
    $new_intervention = null;
    foreach($user_interventions as $intervention_item){
        if($intervention_item->id == $intervention->id){
            $new_intervention = $prev_intervention;
            break;
        }
        $prev_intervention = $intervention_item;
    }
    $data = $new_intervention;
 
    $distanceSvgIcon = '<span class="distance-icon"></span>';
    $durationSvgIcon = '<span class="clock-icon"></span>';
    if($data){ 
        if($data->user_id == $intervention->user_id){
            if($data->getProject->latitude){  
                try{
                    $original = $intervention->getProject->latitude.','.$intervention->getProject->longitude;
                    $destinations = $data->getProject->latitude.','.$data->getProject->longitude;
                    $client = new \GuzzleHttp\Client();
                    $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                        'query' => [
                            'origins' => $original,
                            'destinations' => $destinations,
                            'language'=> 'fr',
                            'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E',
                        ],
                    ]);
                
                    $data = json_decode($response->getBody(), true);  
                }catch(Exception $e){
                    return '';
                }
        
                if ($data['status'] === 'OK' && $data['rows'][0]['elements'][0]['status'] === 'OK') {
                    $distance = $data['rows'][0]['elements'][0]['distance']['text'];
                    $duration = $data['rows'][0]['elements'][0]['duration']['text'];
                return $distanceSvgIcon.' '.$distance.' '.$durationSvgIcon.' '.$duration; 
            }    
            return 'Emplacement introuvable';
            }else{
                return 'Emplacement introuvable';
            }
        }else{
            return 'Aucune intervention';
        }
    }
    return 'Aucune intervention';
}

function getNextLocation2($user_interventions, $date, $intervention){  
    $next_intervention = false;
    $new_intervention = null;
    foreach($user_interventions as $intervention_item){
        if($next_intervention){
            $new_intervention = $intervention_item;
            break;
        }
        if($intervention_item->id == $intervention->id){
            $next_intervention = true;
        } 
    }
    $data = $new_intervention;

    $distanceSvgIcon = '<span class="distance-icon"></span>';
    $durationSvgIcon = '<span class="clock-icon"></span>';

    if($data){ 
        if($data->user_id == $intervention->user_id){
            if($data->getProject->latitude){ 
                try{
            $original = $intervention->getProject->latitude.','.$intervention->getProject->longitude;
            $destinations = $data->getProject->latitude.','.$data->getProject->longitude;
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                'query' => [
                    'origins' => $original,
                    'destinations' => $destinations,
                    'language'=> 'fr',
                    'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E',
                ],
            ]);
        
            $data = json_decode($response->getBody(), true);  
            }catch(Exception $e){
                return '';
            }
    
            if ($data['status'] === 'OK' && $data['rows'][0]['elements'][0]['status'] === 'OK') {
                $distance = $data['rows'][0]['elements'][0]['distance']['text'];
                $duration = $data['rows'][0]['elements'][0]['duration']['text'];
            return $distanceSvgIcon.' '.$distance.' '.$durationSvgIcon.' '.$duration;
                // return [
                //     'distance' => $distance,
                //     'duration' => $duration,
                // ];
            }    
            return 'Emplacement introuvable';
            }else{
                return 'Emplacement introuvable';
            }
        }else{
            return 'Aucune intervention';
        }
    }
    return 'Aucune intervention';
}


function getStatus($automatisation)
{
    $item = \App\Models\Automatise::find($automatisation);
    $status = explode('_', $item->status);

    if($item->automatisation_for == 'prospects')
    {
        if($status[0] == 'main')
        {
           return LeadStatus::find($status[1])->status;
        }
        else 
        {
            return LeadSubStatus::find($status[1])->name;
        }
    }
    if($item->automatisation_for == 'chantier') 
    {
        if($status[0] == 'main')
        {
            return  ProjectNewStatus::find($status[1])->status; 
        }
        else 
        {
            return ProjectSubStatus::find($status[1])->name;
        }   
    }


}

function replace_urls_with_links($text) {
    $url_pattern = '/\bhttps?:\/\/\S+/i';
    preg_match_all($url_pattern, $text, $urls);
    foreach ($urls[0] as $url) {
        $text = str_replace($url, '<a href="'.$url.'" target="_blank" style="word-break: break-all;">'.$url.'</a>', $text);
    }
    return $text;
}

function getClosestProject($current_project){
    $status = $current_project->project_label;

    $original = $current_project->latitude.','.$current_project->longitude;
    
    $distanceSvgIcon = '<i class="bi bi-geo-alt-fill"></i>';
    $durationSvgIcon = '<i class="bi bi-clock"></i>';

    $project_arr = [];
    $project_arr_new = [];
    $element_index = 0;

    $projects = \App\Models\CRM\NewProject::where('project_label', $status)->where('id', '<>', $current_project->id)->where('deleted_status', 0)->get();

    //  foreach($projects as $project_item){
    //     if($project_item->latitude){
    //         try{ 
    //             $destinations = $project_item->latitude.','.$project_item->longitude;
    //             $client = new \GuzzleHttp\Client();
    //             $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
    //                 'query' => [
    //                     'origins' => $original,
    //                     'destinations' => $destinations,
    //                     'language'=> 'fr',
    //                     'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E',
    //                 ],
    //             ]);
    //             $data = json_decode($response->getBody(), true);  
    //         }catch(Exception $e){
    //             return '';
    //         }
    //         if ($data['status'] === 'OK' && $data['rows'][0]['elements'][0]['status'] === 'OK') {
    //             $distance = $data['rows'][0]['elements'][0]['distance']['text'];
    //             $duration = $data['rows'][0]['elements'][0]['duration']['text'];
    //             $distance_value = $data['rows'][0]['elements'][0]['distance']['value'];

    //             $project_arr[$distance_value] = [
    //                 'id'            => $project_item->id,
    //                 'Nom'           => $project_item->Nom,
    //                 'Prenom'        => $project_item->Prenom, 
    //                 'Département'   => $project_item->Département, 
    //                 'phone'         => $project_item->phone, 
    //                 'latitude'      => $project_item->latitude, 
    //                 'longitude'     => $project_item->longitude, 
    //                 'status'        => $project_item->projectStatus->status ?? '',
    //                 'sub_status'    => $project_item->getSubStatus->name ?? '',
    //                 'tag'           => implode(',', $project_item->ProjectTravauxTags->pluck('tag')->toArray()),
    //                 'distance'      => $distanceSvgIcon.' '.$distance.' '.$durationSvgIcon.' '.$duration,
    //                 'color'         => $project_item->getSubStatus->background_color ?? '#8e27b3',
    //             ];
    //         }     
    //     }
    //  }

    
    // ksort($project_arr);
    // return array_slice($project_arr, 0, 10);

    ////////  New System  //////// 
    if($projects->count() > 0){
        foreach($projects->chunk(25) as $chunked_projects){
            $all_destination_point = [];
            foreach($chunked_projects as $project_item){
               if($project_item->latitude){
                   $all_destination_point[] = $project_item->latitude.','.$project_item->longitude;
                       $project_arr_new[] = [
                           'id'            => $project_item->id,
                           'Nom'           => $project_item->Nom,
                           'Prenom'        => $project_item->Prenom, 
                           'Département'   => $project_item->Département, 
                           'phone'         => $project_item->phone, 
                           'latitude'      => $project_item->latitude, 
                           'longitude'     => $project_item->longitude, 
                           'status'        => $project_item->projectStatus->status ?? '',
                           'sub_status'    => $project_item->getSubStatus->name ?? '',
                           'tag'           => implode(',', $project_item->ProjectTravauxTags->pluck('tag')->toArray()),
                           'color'         => $project_item->getSubStatus->background_color ?? '#8e27b3',
                           'distance'      => '',
                           'distance_value'=> '', 
                       ];
                   // }     
               }
            }
            
            $destinations = implode('|', $all_destination_point);
            try{  
               $client = new \GuzzleHttp\Client();
               $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                   'query' => [
                       'origins' => $original,
                       'destinations' => $destinations,
                       'language'=> 'fr',
                       'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E',
                   ],
               ]);
               $data = json_decode($response->getBody(), true);  
           }catch(Exception $e){
               return '';
           }
           if ($data['status'] === 'OK') {
               foreach ($data['rows'][0]['elements'] as $element) {
                   if ($element['status'] === 'OK' && $element['distance']['value']) {
                       $distance       = $element['distance']['text'];
                       $duration       = $element['duration']['text'];
                       $distance_value = $element['distance']['value'];
                       
                       $project_arr_new[$element_index]['distance']        = $distanceSvgIcon.' '.$distance.' '.$durationSvgIcon.' '.$duration;
                       $project_arr_new[$element_index]['distance_value']  = $distance_value;
                   }else{
                    unset($project_arr_new[$element_index]); 
                   }
                   $element_index++;
               }
           }
        }
    
         usort($project_arr_new, function ($item1, $item2) {
            return $item1['distance_value'] <=> $item2['distance_value'];
        });

         return array_slice($project_arr_new, 0, 10);  
    }else{
        return [];
    }

     
}
function getClosestProjectWithFilter($current_project,$number_count, $data){
    $radius = $data['radius'];
    $status = $current_project->project_label;

    $original = $current_project->latitude.','.$current_project->longitude;
    
    $distanceSvgIcon = '<i class="bi bi-geo-alt-fill"></i>';
    $durationSvgIcon = '<i class="bi bi-clock"></i>';

    $project_arr = [];
    $project_arr_new = [];
    $element_index = 0;
    // if($filter_status){
    //     $projects = \App\Models\CRM\NewProject::where('project_label', $status)->where('id', '<>', $current_project->id)->whereIn('project_sub_status', $filter_status)->where('deleted_status', 0)->get();
    // }else{
    //     $projects = \App\Models\CRM\NewProject::where('project_label', $status)->where('id', '<>', $current_project->id)->where('deleted_status', 0)->get();
    // }

    $project = NewProject::query();

    if($data['status']){
        $project->where('project_label', $data['status']);
    }

    if($data['sub_status']){
        $project->whereIn('project_sub_status', $data['sub_status']);
    }

    if($data['travaux']){
        $ids = \App\Models\CRM\ProjectTravaux::whereIn('travaux_id', request()->travaux)->pluck('project_id'); 
        $project->whereIn('id', $ids); 
    }

    if($data['type_de_contrat']){
        $project->where('Type_de_contrat', $data['type_de_contrat']);
    }
        
    if($data['bareme']){
        $ids = \App\Models\CRM\ProjectBareme::whereIn('barame_id', request()->bareme)->pluck('project_id'); 
        $project->whereIn('id', $ids);
    }

    
    $projects = $project->where('id', '<>', $current_project->id)->where('deleted_status', 0)->get();

    ////////  New System  //////// 
    if($projects->count() > 0){
        foreach($projects->chunk(25) as $chunked_projects){
            $all_destination_point = [];
            foreach($chunked_projects as $project_item){
               if($project_item->latitude){
                   $all_destination_point[] = $project_item->latitude.','.$project_item->longitude;
                       $project_arr_new[] = [
                           'id'            => $project_item->id,
                           'Nom'           => $project_item->Nom,
                           'Prenom'        => $project_item->Prenom, 
                           'Département'   => $project_item->Département, 
                           'phone'         => $project_item->phone, 
                           'latitude'      => $project_item->latitude, 
                           'longitude'     => $project_item->longitude, 
                           'status'        => $project_item->projectStatus->status ?? '',
                           'sub_status'    => $project_item->getSubStatus->name ?? '',
                           'tag'           => implode(',', $project_item->ProjectTravauxTags->pluck('tag')->toArray()),
                           'color'         => $project_item->getSubStatus->background_color ?? '#8e27b3',
                           'distance'      => '',
                           'distance_value'=> '', 
                       ];
                   // }     
               }
            }
            
            $destinations = implode('|', $all_destination_point);
            try{  
               $client = new \GuzzleHttp\Client();
               $response = $client->get('https://maps.googleapis.com/maps/api/distancematrix/json', [
                   'query' => [
                       'origins' => $original,
                       'destinations' => $destinations,
                       'language'=> 'fr',
                       'key' => 'AIzaSyDgjBuD_z2DYaMscUhT16yzCve_7n1CQ_E',
                   ],
               ]);
               $data = json_decode($response->getBody(), true);  
           }catch(Exception $e){
               return '';
           }
           if ($data['status'] === 'OK') {
               foreach ($data['rows'][0]['elements'] as $element) {
                   if ($element['status'] === 'OK' && $element['distance']['value']) {
                       $distance       = $element['distance']['text'];
                       $duration       = $element['duration']['text'];
                       $distance_value = $element['distance']['value'];
                       
                       $project_arr_new[$element_index]['distance']        = $distanceSvgIcon.' '.$distance.' '.$durationSvgIcon.' '.$duration;
                       $project_arr_new[$element_index]['distance_value']  = $distance_value;
                   }else{
                    unset($project_arr_new[$element_index]); 
                   }
                   $element_index++;
               }
           }
        }
    
         usort($project_arr_new, function ($item1, $item2) {
            return $item1['distance_value'] <=> $item2['distance_value'];
        }); 
        if($radius){ 
            $filteredData = array_filter($project_arr_new, function($item) use ($radius) { 
                return $item['distance_value'] < $radius * 1000;
            }); 
            return array_slice($filteredData, 0, $number_count); 
        }
         return array_slice($project_arr_new, 0, $number_count);  
    }else{
        return [];
    }

     
}