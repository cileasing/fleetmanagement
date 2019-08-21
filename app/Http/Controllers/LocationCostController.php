<?php

namespace App\Http\Controllers;

use App\LocationCost;
use Illuminate\Http\Request;

class LocationCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LocationCost  $locationCost
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
          $json = [];
        
        if($request->depature && $request->destination && $request->vehicle_type && $request->cid){
           
            $price = 0;
            $depature = trim(strtolower($request->depature));
            $destination = trim(strtolower($request->destination));
            $vehicle_type = trim(strtolower($request->vehicle_type));
            $cid = trim(strtolower($request->cid));
            
             $matchThese = ['departure' => $depature, 'destination' => $destination, 
                  'vehicle_type' => $vehicle_type, 'cid' => $cid];
              $pricemain = LocationCost::where($matchThese)->value('cost');
              
              
            if($cid == '' || $cid == '0'){
                 //Use the random number to return the reservation ID
              $matchThese = ['departure' => $depature, 'destination' => $destination, 
                  'vehicle_type' => $vehicle_type];
              $price = LocationCost::where($matchThese)->value('cost');
              
            }else if($cid && $pricemain == ''){
                 $matchThese = ['departure' => $depature, 'destination' => $destination, 
                  'vehicle_type' => $vehicle_type];
              $price = LocationCost::where($matchThese)->value('cost');
            }else{
             //Use the random number to return the reservation ID
              $matchThese = ['departure' => $depature, 'destination' => $destination, 
                  'vehicle_type' => $vehicle_type, 'cid' => $cid];
              $price = LocationCost::where($matchThese)->value('cost');
            }
            
              
              
             
             $json = ["status" => 200, "cost" => $price];
            
        }else{
            $json = ["status" => 400];
        }
        return response()->json($json);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LocationCost  $locationCost
     * @return \Illuminate\Http\Response
     */
    public function edit(LocationCost $locationCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LocationCost  $locationCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationCost $locationCost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LocationCost  $locationCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(LocationCost $locationCost)
    {
        //
    }
}
