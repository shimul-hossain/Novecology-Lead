<?php

namespace App\Http\Controllers;

use App\Models\CRM\PersonalNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalNoteController extends Controller
{
    
    public function store(Request $request){
        
        PersonalNote::create([
            'note' => $request->note,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', __("Created Successfully"));
    }

    public function delete(Request $request){
        $note = PersonalNote::find($request->id);
        if($note){
            $note->delete();
        }
        return back()->with('success', __('Deleted Succesfully'));
    }
}
