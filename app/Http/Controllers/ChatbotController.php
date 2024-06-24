<?php

namespace App\Http\Controllers;

use App\Exports\DefaultExport;
use App\Models\ChatbotResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ChatbotController extends Controller
{
    public function index(){
        return view('frontend.chatbot');
    }

    public function optionClick(Request $request){
        // dd($request->all());
        $response = $request->response;
        $value = $request->value;
        $all_value = $request->selected_response; 

        $view = view('frontend.chatbot_option_change', compact('response', 'value', 'all_value'))->render();
        if($response == 2 && $all_value[$response] == 'Non'){
            return response()->json(['success' => $view, 'error' => 'not eligible']);
        }else{
            return response()->json(['success' => $view]);
        }
    }

    public function dataStore(Request $request){
        if(isset($request->selected_response['6'])){
            $response_6 = true;
        }else{ 
            $response_6 = false;
        } 
        ChatbotResponse::create([
            'response_1' => $request->selected_response['1'],
            'response_2' => $request->selected_response['2'],
            'response_3' => $request->selected_response['3'],
            'response_4' => $request->selected_response['4'],
            'response_5' => $request->selected_response['5'] . ($response_6 ? ($request->selected_response['6'] == 'Oui' ? ' + Chauffe-Eau Thermodynamique & Solaire':'') :''),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return response('success');
    }

    public function adminIndex(){
        $responses = ChatbotResponse::all();
        return view('super_admin.chatbot.index', compact('responses'));

    }

    public function responseDelete(Request $request){
        $response = ChatbotResponse::find($request->id);
        if($response){
            $response->delete();
        }
        return back()->with('success', 'Deleted Successfully');
    }

    
    public function deleteAllResponse(Request $request){
        ChatbotResponse::truncate();
        return back()->with('success', 'All Deleted Successfully');
    }

    public function chatbotBulkDownload(Request $request){

        if($request->is_all == '1'){
            $ids = ChatbotResponse::all()->pluck('id')->toArray() ; 
        }else{
            $ids = explode(',', $request->selected_id); 
        }
 
        
        if ($request->first_name != null) {
            $header [] = 'Prenom';
        }
        if ($request->last_name != null) {
            $header [] = 'Nom';
        }
        if ($request->email != null) {
            $header [] = 'Téléphone';
        }
        if ($request->phone != null) {
            $header [] = 'E-mail';
        }
        if ($request->response_1 != null) {
            $header [] = 'Question 1';
        }
        if ($request->response_2 != null) {
            $header [] = 'Question 2';
        }
        if ($request->response_3 != null) {
            $header [] = 'Question 3';
        }
        if ($request->response_4 != null) {
            $header [] = 'Question 4';
        }
        if ($request->response_5 != null) {
            $header [] = 'Question 5';
        }

        $data =  ChatbotResponse::whereIn('id',$ids)->get()->map(function($chatbot) use ($request){
            $field = [];  
            if ($request->first_name != null) {
                $field ['first_name'] = $chatbot->first_name;
            }  
            if ($request->last_name != null) {
                $field ['last_name'] = $chatbot->last_name;
            }  
            if ($request->email != null) {
                $field ['email'] = $chatbot->email;
            }  
            if ($request->phone != null) {
                $field ['phone'] = $chatbot->phone;
            }  
            if ($request->response_1 != null) {
                $field ['response_1'] = $chatbot->response_1;
            }  
            if ($request->response_2 != null) {
                $field ['response_2'] = $chatbot->response_2;
            }  
            if ($request->response_3 != null) {
                $field ['response_3'] = $chatbot->response_3;
            }  
            if ($request->response_4 != null) {
                $field ['response_4'] = $chatbot->response_4;
            }  
            if ($request->response_5 != null) {
                $field ['response_5'] = $chatbot->response_5;
            }  

            return $field;
        });

        return Excel::download(new DefaultExport($header,$data), 'download.xlsx');       
    }

    public function chatbotBulkDelete(Request $request){
        if($request->selected_id){
            $ids = explode(',', $request->selected_id); 
            ChatbotResponse::findMany($ids)->each->delete();
        }

        $header = [];

        return back()->with('success', __('Deleted Successfully'));
    }
    
}
