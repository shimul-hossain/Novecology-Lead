<?php

namespace App\Http\Controllers;

use App\Exports\DefaultExport;
use App\Models\UserMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = UserMessage::get();

        return view('super_admin.user_message.index',compact('message'));
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

        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email',
            'phone'    => 'required',
            'address'  => 'required',
            'message'  => 'required',
        ],[
            'name.required'     => __('Name is required'),
            'email.required'    => __('Email is required'),
            'email.email'       => 'Entrez une adresse mail valide',
            'phone.required'    => __('Phone Number is required'),
            'address.required'  => __('Address is required'),
            'message.required'  => __('Message is required'), 
        ]);

        $data =  UserMessage::create($request->except('_token') + ['created_at' => Carbon::now()]);
         
        return back()->with('success', __('Message Submitted Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function show(UserMessage $userMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMessage $userMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMessage $userMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UserMessage::find($id)->delete();

        return back()->with('delete', __('Deleted Successfully'));
    }

    public function messageBulkDownload(Request $request){

        if($request->is_all == '1'){
            $ids = UserMessage::all()->pluck('id')->toArray() ; 
        }else{
            $ids = explode(',', $request->selected_id); 
        }

        if ($request->name != null) {
            $header [] = __('User Name');
        }
        
        if ($request->email != null) {
            $header [] = __('Email');
        }
        
        if ($request->message != null) {
            $header [] = __('Message');
        }
       
        $data =  UserMessage::whereIn('id',$ids)->get()->map(function($message) use ($request){
 
 
 
            $field = []; 
 
            if ($request->name != null) {
                $field ['name'] = $message->name;
            } 
            if ($request->email != null) {
                $field ['email'] = $message->email;
            } 
            if ($request->message != null) {
                $field ['message'] = $message->message;
            } 
            
            return $field;
        });

        return Excel::download(new DefaultExport($header,$data), 'download.xlsx');
       
    }

    public function messageBulkDelete(Request $request){
        if($request->selected_id){
            $ids = explode(',', $request->selected_id); 
            UserMessage::findMany($ids)->each->delete();
        }

        $header = [];

        return back()->with('success', __('Deleted Successfully'));
    }
}
