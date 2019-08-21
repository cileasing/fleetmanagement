<?php

namespace App\Http\Controllers;

//use App\c;
use Illuminate\Http\Request;
use DB;
use App\Galoolidata;
use Auth;

class Galooli extends Controller {

    /* public function __construct() {
         $this->middleware('auth');
     }
    /**
     * ONLY RUN FOR CRON JOBS 
     *
     * @return FOR GALOOLI
     */
    
    public function index($url) {
      //$matchThese = ['module_url' => $url];
        
        if ($url == "request_maintenance") {
            return view('galooliserver')->with('url', $url);
        } else if ($url == "trip_maintenance_report") {
            return view('galooliservertrip')->with('url', $url);
        } 
        
    }
    
    
    
     /**
     * RUNS ON THE SYSTEM
     *
     * @return from the system
     */
    
    public function maintenanceRequest($url) {
        $this->middleware('auth');
       if ($url == "request_maintenance_galooli") {
           $title = "Maintenance";
            return view('galooli_maintenance')->with('url', $url)->with('title', $title);
        }else if($url == "fueling_request_galooli"){
            $title = "Fueling";
            return view('galooli_maintenance')->with('url', $url)->with('title', $title);
        }
    }

    /**
     * Fetch Galooli Result
     *
     * @return \Illuminate\Http\Response
     */
    public function galooliSave(Request $request) {
        $json = [];
        $jsonDate = $request->data;
        $mainUrl = $request->mainUrl;
        
        $replaceDate = str_replace('"', "'", $jsonDate);

        if ($mainUrl == "request_maintenance") {
            $module = "UPDATE `galoolidata` SET json = '" . $jsonDate . "' WHERE id =  1";
            $d = collect(DB::update(DB::raw($module)));
        } else if ($mainUrl == "trip_maintenance_report") {
            $module = 'UPDATE `galoolidata` SET `json` = "'. $replaceDate.'" WHERE `id` =  3';
            $d = collect(DB::update(DB::raw($module)));
        }

        if ($d) {
            $json = ['status' => 200];
        } else {
            $json = ['status' => 400];
        }

        return response()->json($json);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $json = [];
        $vehicleName = $request->vehic_name;
        $explode = explode("-", $vehicleName);
       
        $vehicle_name = $explode[0];
        $vehicle_millage = $explode[1];
        $vehicle_fuel_size = $explode[2];
        $userEmail = Auth::user()->email;
        $type = $request->dType;
        
        $module = "INSERT INTO `galooli_maintenance_request` (`vehicle_name`, `millage`, `fuel_level`, `logged_by`, `dtype`) VALUES ( '" . $vehicle_name . "', '" . $vehicle_millage . "', '" . $vehicle_fuel_size . "',  '" . $userEmail . "', '".$type."')";
        $d = collect(DB::update(DB::raw($module)));
        
        if ($d) {
            $json = ['status' => 200, 'vehicle_name'=>$vehicle_name, 'milleage_km'=>$vehicle_millage, 'fuel_level'=>$vehicle_fuel_size];
        } else {
            $json = ['status' => 400];
        }

        return response()->json($json);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show(c $c) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(c $c) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, c $c) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(c $c) {
        //
    }

    
     public function assetReport() {
        $matchThese = ['id' => 1];
        $module = Galoolidata::where($matchThese)->value('json');
        
        //$module = "SELECT json FROM `galoolidata` WHERE id = 1";
       // $d = collect(DB::select(DB::raw($module)));
      
       
        echo $module;
       // return response()->json($json);
    }
    
}
