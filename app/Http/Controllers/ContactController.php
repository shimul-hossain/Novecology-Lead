<?php

namespace App\Http\Controllers;

use App\Exports\DefaultExport;
use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('super_admin.contact.index',compact('contacts'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', __('Deleted Successfully'));
    }

    public function contactBulkDownload(Request $request){

        if($request->is_all == '1'){
            $ids = Contact::all()->pluck('id')->toArray() ; 
        }else{
            $ids = explode(',', $request->selected_id); 
        }

        if ($request->first_name != null) {
            $header [] = __('First Name');
        }
        
        if ($request->second_name != null) {
            $header [] = __('Second Name');
        }
        
        if ($request->email != null) {
            $header [] = __('Email');
        }
        
        if ($request->phone != null) {
            $header [] = __('Phone');
        }
        
        if ($request->postal_code != null) {
            $header [] = __('Postal Code');
        }

        $data =  Contact::whereIn('id',$ids)->get()->map(function($contact) use ($request){
 
 
 
            $field = []; 
 
            if ($request->first_name != null) {
                $field ['first_name'] = $contact->first_name;
            } 
            if ($request->second_name != null) {
                $field ['second_name'] = $contact->second_name;
            } 
            if ($request->email != null) {
                $field ['email'] = $contact->email;
            } 
            if ($request->phone != null) {
                $field ['phone'] = $contact->phone;
            } 
            if ($request->postal_code != null) {
                $field ['postal_code'] = $contact->postal_code;
            }  

            return $field;
        });

        return Excel::download(new DefaultExport($header,$data), 'download.xlsx');
       
    }

    public function contactBulkDelete(Request $request){
        if($request->selected_id){
            $ids = explode(',', $request->selected_id); 
            Contact::findMany($ids)->each->delete();
        }

        $header = [];

        return back()->with('success', __('Deleted Successfully'));
    }
    
}
