<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function blank(){
        return view('backoffice.blank');
    }

    public function dashboard(){
        return view('backoffice.dashboard');
    }
}


