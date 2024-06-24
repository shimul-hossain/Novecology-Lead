<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use Str;

class TokenController extends Controller
{
    public function index()
    {
        return view('super_admin.token.index', [
            'token' => Token::first()
        ]);
    }

    public function generate(Request $request)
    {
        $token = Str::random(60);
        Token::truncate();
        Token::create(['token' => $token]);
        return redirect()->back()->with('success', __('Token Generated Successfully'));
    }


    
}
