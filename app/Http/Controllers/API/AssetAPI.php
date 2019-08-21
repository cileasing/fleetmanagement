<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
//namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Modules;
use App\Asset;
use App\Moduletabs;
use App\Category;
use App\Modulecolumns;
use App\Moduletypes;
use App\Modulebutton;
use App\Assetdocument;
use App\Documentlist;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use App\MaintenanceItems;
use App\Files;

class AssetAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //echo 
    }

    public function getallasset(){
        
       $tables = DB::select('SHOW TABLES');
      
      // $dashboard_display =  collect(DB::select(DB::raw($dodashboardDisplay)));
      // $dashboard_display = Modules::where(DB::raw('dashboard_display != "0" AND del'), '=', '0')->get();
       return view('sets.blade')->with('tables', $tables);
    }
   
}
