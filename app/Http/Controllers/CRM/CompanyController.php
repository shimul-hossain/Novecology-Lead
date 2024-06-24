<?php

namespace App\Http\Controllers\CRM;

use App\Events\PannelLog;
use Carbon\Carbon;
use App\Models\User;
use App\Models\CRM\Company;
use Illuminate\Http\Request;
use App\Models\CRM\CompanyFilter;
use App\Http\Controllers\Controller;
use App\Models\CRM\LeadClientProject;
use App\Models\CRM\PannelLogActivity;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

class CompanyController extends Controller
{

    // save Company 
    public function companyAdd(Request $request){ 
        // dd($request->all());
        $company = Company::create($request->except('_token') + ['created_at' => Carbon::now()]); 
        $company->company_title = ['en' => $request->company_title, 'fr' =>$request->company_title ];
        $company->save();
        return back();
        // return redirect()->route('leads.index', $company->id)->with('success', __('Compnay Added Successfully'));
    }
    // Update Company 
    public function companyUpdate(Request $request){
        $request->validate([
            'company_name'  => 'required', 
            'company_email' => 'required',
            'company_phone' => 'required'
        ],[
            'company_name.required'     => __('Company name is required'),
            'company_email.required'    => __('Company email is required'),
            'company_phone.required'    => __('Company phone number is required'),
        ]);

        $company = Company::findOrFail($request->id);
        $company->update($request->except('_token') + ['updated_at' => Carbon::now()]);
        return back()->with('success', __('Updated Successfully'));
    }

    // search company 
    public function searchCompany(Request $request){

        $search = $request->search;
        if ($search != '') {
            $company = Company::where('company_name', 'LIKE',  '%'.$search.'%')->get();
        } else {
            $company = Company::all();
        } 
     
        $view = view('includes.crm.company-list', compact('company')); 
        $response = $view->render(); 
        return response()->json(['response' => $response]);
    }

    public function loadMore(Request $request){
        $company = Company::latest()->paginate(10+$request->length);
        $totalCompany = Company::all();

        $view = view('includes.crm.company-list', compact('company')); 
        $response = $view->render(); 

        $current_count = $company->count();

        return response()->json(['response' => $response, 'current_count' => $current_count]);

    }

    // Create Lead From all leads page with company 
    public function createLeadIndex(){
        if (checkAction(Auth::id(), 'lead', 'create') || role() == 's_admin'){
            $lead = LeadClientProject::create([
                'lead_label'    => 1,
                'lead_status'   => 1,
                'company_id'    => 1, 
                'lead_user_id'  => Auth::id(),
            ]);

            if(role() == 'telecommercial' || role() == 'telecommercial_externe'){
                $lead->lead_telecommercial = Auth::id();
                $lead->lead_label = 2;
                $lead->save();
            }

            if(role() == 'sales_manager' || role() == 'sales_manager_externe'){
                $lead->import_regie = Auth::user()->getRegieTelecommercial->id ?? null;
                $lead->save();
            }
            
            $pannel_activity = PannelLogActivity::create([
                'key'           => 'new_prospect__create',
                'feature_id'    => $lead->id,
                'feature_type'  => 'lead',
                'user_id'       => Auth::id(), 
            ]);

            event(new PannelLog($pannel_activity->id));


            return redirect()->route('leads.index', [1, $lead->id]);
        }else{
            return redirect('/');
        }
        // $filter_company= CompanyFilter::where('user_id', Auth::id())->first();
        // if($filter_company){ 
        //      return redirect()->route('leads.index', $filter_company->company_id);
        // }else{
        // }
        // $company = Company::latest()->paginate(10);
        // $totalCompany = Company::all();
        // $user = User::where('id', Auth::id())->first();
        // $message = __('to create a Lead');
        // return view('admin.home', compact('user', 'company', 'totalCompany','message'));
    }



    


    //END
}
