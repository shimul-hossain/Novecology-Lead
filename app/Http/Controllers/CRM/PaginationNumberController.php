<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\PaginationNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaginationNumberController extends Controller
{
    
    public function paginationNumberChange(Request $request){
        $item = PaginationNumber::where('module', $request->module)->where('user_id', Auth::id())->first();
        if($item){
            $item->update([
                'number' => $request->number
            ]);
        }else{
            PaginationNumber::create([
                'user_id'   => Auth::id(),
                'module'    => $request->module,
                'number'    => $request->number,
            ]);
        }

        return back()->with('success', __('Pagination Number Updated'));
    }

}
