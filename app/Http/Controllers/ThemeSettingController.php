<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Auth;

class ThemeSettingController extends Controller
{
    public function color()
    {
       $data = ThemeSetting::where('user_id', Auth::id())->first(); 
       if($data){
           if($data->theme == 'light-layout')
           {
               $data->theme = 'dark-layout'; 
           }
    
           else if($data->theme == 'dark-layout')
           {
               $data->theme = 'light-layout'; 
           }
           $data->save(); 
       }else{
        ThemeSetting::create([
            'user_id' => Auth::id(),
            'theme' => 'dark-layout',
            'nav' => 'expanded',
        ]);
       }




        die();
    }

    public function toggle()
    {
       $data = ThemeSetting::where('user_id', Auth::id())->first(); 

        if($data){
            if($data->nav == 'expanded')
            {
                $data->nav = 'collapsed'; 
            }
    
            else if($data->nav == 'collapsed')
            {
                $data->nav = 'expanded'; 
            }
    
            $data->save();  
        }else{
            ThemeSetting::create([
                'user_id' => Auth::id(),
                'theme' => 'light-layout',
                'nav' => 'collapsed',
            ]);
        }
        die();
    }
}
