<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Settings extends Controller
{
   public function index()
    {
        return view('setup.sitesetting');
    }
    
    public function mailconfig(){
        
         return view('setup.mailconfig');
    }
}
