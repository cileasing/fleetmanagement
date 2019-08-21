<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //$allOwner = Contractype::all();
        $allOwner = Owner::select('*')->latest()->limit(4)->get();
        $data = ['setupOwner' => $allOwner];
        return view('setup.owner', $data);
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
        $json = [];
         $this->validate($request, [
            'ownerName' => 'required|max:255',
            'dStatus' => 'required',
          ]);
         
        /* $validatedData = $request->validate([
        'contractName' => 'required|unique:posts|max:255',
        'status' => 'required',
        ]); */
         
         $contractOwner = new Owner;
         $contractOwner->name = $request->ownerName;
         $contractOwner->type = $request->dStatus;
         
         if($request->ownerName == "" || $request->dStatus == ""){
             $json = ['status' => 204, 'msg'=>'no cotent']; // No Content Sent
         }else{
             
            $success = $contractOwner->save();
            
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
