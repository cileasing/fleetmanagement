<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asset;
use App\Client;
use App\Owner;
use App\Contractype;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allAsset = Asset::select('*')->latest()->limit(10)->get();
        //$allOwner = Contractype::all();
        
        $data = ['assetContract' => $allAsset];
        return view('asset', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allAsset = Asset::select('*')->latest()->limit(10)->get();
        $matchThese = ['type' => "active"];
        $allclients = Client::where($matchThese)->get();
        $allOwner = Owner::where($matchThese)->get();
        $allContractype = Contractype::where($matchThese)->get();
        $data = ['assetContract' => $allAsset, 'client'=>$allclients, 'own'=>$allOwner, 'cntype' =>$allContractype];
        return view('addnew', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = [];
         $this->validate($request, [
            'assetName' => 'required|max:255',
            'vesseType' => 'required',
            'owner' => 'required',
            'client' => 'required'
          ]);
         
        /* $validatedData = $request->validate([
        'contractName' => 'required|unique:posts|max:255',
        'status' => 'required',
        ]); */
         
         $addnewAssets = new Asset;
         $addnewAssets->vessel_Name = $request->assetName;
         $addnewAssets->vessel_Type = $request->vesseType;
         $addnewAssets->IMO_Number = $request->imoNumber;
         $addnewAssets->Owner_vessel_manager = $request->owner;
         $addnewAssets->Client = $request->client;
         $addnewAssets->Gross_Tonnage = $request->grosstonnage;
         $addnewAssets->TEU_Capacity = $request->TEUcapacity;
         $addnewAssets->Deadweight = $request->deadweight;
         $addnewAssets->Length = $request->length;
         $addnewAssets->Beam = $request->beam;
         $addnewAssets->Age_of_vessel = $request->ageofvessel;
         $addnewAssets->Engine_power = $request->enginepower;
         $addnewAssets->Built = $request->built;
         $addnewAssets->Size = $request->size;
         $addnewAssets->Draught = $request->draught;
         $addnewAssets->Builder = $request->builder;
         $addnewAssets->Place_of_build = $request->placeOfBuild;
         $addnewAssets->Net_Tonnage = $request->netTonnage;
         $addnewAssets->Crude = $request->crude;
         $addnewAssets->status = "active";
         $addnewAssets->vessel_Ex_Name = str_slug($request->assetName);
         $addnewAssets->contract_type = $request->whichContract; 
         
         
         if($request->assetName == "" || $request->vesseType == "" || $request->owner == "" || $request->client == ""){
             $json = ['status' => 204, 'msg'=>'no cotent']; // No Content Sent
         }else{
             
            $success = $addnewAssets->save();
            $json = ['status' => 200, 'msg'=>'created']; // OK
         }
          
         return response()->json($json);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        return view('assetdetails');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $slug)
    {
        $matchTheseA = ['id' => $id, 'vessel_Ex_Name' => $slug];
        $dAsset = Asset::where($matchTheseA)->get()->first();
        
         //$exchange = Asset::find($id);
        
        $matchThese = ['type' => "active"];
        
        $allclients = Client::where($matchThese)->get();
        $allOwner = Owner::where($matchThese)->get();
        $allContractype = Contractype::where($matchThese)->get();
        
        return view('assetedit')->with('myassets', $dAsset)->with('client', $allclients)
                ->with('own', $allOwner)->with('cntype', $allContractype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
         $addnewAssets = Asset::find($id);
         $addnewAssets->vessel_Name = $request->assetName;
         $addnewAssets->IMO_Number = $request->imoNumber;
         $addnewAssets->Owner_vessel_manager = $request->owner;
         $addnewAssets->Client = $request->client;
         $addnewAssets->Gross_Tonnage = $request->grosstonnage;
         $addnewAssets->TEU_Capacity = $request->TEUcapacity;
         $addnewAssets->Deadweight = $request->deadweight;
         $addnewAssets->Length = $request->length;
         $addnewAssets->Beam = $request->beam;
         $addnewAssets->Age_of_vessel = $request->ageofvessel;
         $addnewAssets->Engine_power = $request->enginepower;
         $addnewAssets->Built = $request->built;
         $addnewAssets->Size = $request->size;
         $addnewAssets->Draught = $request->draught;
         $addnewAssets->Builder = $request->builder;
         $addnewAssets->Place_of_build = $request->placeOfBuild;
         $addnewAssets->Net_Tonnage = $request->netTonnage;
         $addnewAssets->Crude = $request->crude;
         $addnewAssets->vessel_Ex_Name = str_slug($request->assetName);
         $addnewAssets->contract_type = $request->whichContract; 

         $success =  $addnewAssets->save();
     
          if($success){
            $json = ['status' => 200, 'msg'=>'created']; // OK
         }else{
              $json = ['status' => 204, 'msg'=>'no cotent']; // No Content Sent
         }
          
         return response()->json($json);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    
    public function getallasset(){
        //$getall = Asset::all();
        $getall = Asset::select('*')->latest()->limit(10)->get();
        $json = ['basicInfo' => $getall];
        
        //return $data;
         return response()->json($json);
    }
    
    
}
