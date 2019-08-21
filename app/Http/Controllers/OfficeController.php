<?php

namespace App\Http\Controllers;

use App\Office;
use Illuminate\Http\Request;
use App\Companies;
use DB;

class OfficeController extends Controller
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
    
    
    public function get(Request $request)
    {
        $json = [];
        if(isset($request->clientName)){
            $requestCompany = trim($request->clientName);
            
            
             $getResult = "SELECT * FROM company_client_contactdetail WHERE Client_Id = $requestCompany"; 
             $collectResult =  collect(DB::select(DB::raw($getResult)));
              
             $json["result"] = $collectResult;
        }
         return response()->json($json);
    }

    
    public function getcontact(Request $request){
         $json = [];
        if(isset($request->contactName)){
            $requestContactName = trim($request->contactName);
            
            
             $getResult = "SELECT * FROM company_client_contactdetail WHERE `ID` = $requestContactName"; 
             $collectResult =  collect(DB::select(DB::raw($getResult)));
              
            
        $json{"result"} = $collectResult;
        }
         return response()->json($json);
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
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Office $office)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        //
    }
}
