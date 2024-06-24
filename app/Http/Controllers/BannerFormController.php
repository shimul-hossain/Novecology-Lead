<?php

namespace App\Http\Controllers;

use App\Exports\DefaultExport;
use App\Models\Banner;
use App\Models\BannerForm;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BannerFormController extends Controller
{

    public function index(){
        $data = BannerForm::latest()->get();
        return view('super_admin.banner_form.index', compact('data'));
    }
    public function store(Request $request){ 
        BannerForm::create($request->except('_token'));
        return response()->json(['success' => 'Merci de vos informations, un expert vous recontactera rapidement']);
    }

    public function delete(Request $request){
        BannerForm::find($request->id)->delete();
        return back()->with('success', 'Deleted Successfully');
    }

    public function deleteAll(Request $request){
        BannerForm::truncate();
        return back()->with('success', 'All Deleted Successfully');
    }

    public function bannerformBulkDownload(Request $request){

        if($request->is_all == '1'){
            $ids = BannerForm::all()->pluck('id')->toArray() ; 
        }else{
            $ids = explode(',', $request->selected_id); 
        }

        if ($request->name != null) {
            $header [] = __('First Name');
        } 
        
        if ($request->email != null) {
            $header [] = __('Email');
        }
        
        if ($request->phone != null) {
            $header [] = __('Phone');
        }
        if ($request->department != null) {
            $header [] = __('Department');
        }
        if ($request->travaux != null) {
            $header [] = __('Travaux');
        }
         

        $data =  BannerForm::whereIn('id',$ids)->get()->map(function($bannerform) use ($request){
 
            $field = []; 
 
            if ($request->name != null) {
                $field ['name'] = $bannerform->name;
            } 
            if ($request->email != null) {
                $field ['email'] = $bannerform->email;
            } 
            if ($request->phone != null) {
                $field ['phone'] = $bannerform->phone;
            }  
            if ($request->department != null) {
                $field ['department'] = $bannerform->department;
            }  
            if ($request->travaux != null) {
                $field ['travaux'] = $bannerform->getTravaux->travaux ?? ''; 
            }  

            return $field;
        });

        return Excel::download(new DefaultExport($header,$data), 'download.xlsx');
       
    }

    public function bannerformBulkDelete(Request $request){
        if($request->selected_id){
            $ids = explode(',', $request->selected_id); 
            BannerForm::findMany($ids)->each->delete();
        }

        $header = [];

        return back()->with('success', __('Deleted Successfully'));
    }
}
