<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emailcontent;

class EmailController extends Controller
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
    
     public function notify()
    {
      
        //$getall = Emailcontent::whereId(1)->first();
         $assetNotification = Emailcontent::where('key', "asset_notify")->get()->first();
         $assetUtilization = Emailcontent::where('key', "asset_utilize")->get()->first();
         $assetDocumentation = Emailcontent::where('key', "documentation")->get()->first();
         $data = ['all' => $assetNotification, 'util'=>$assetUtilization, 'doc'=>$assetDocumentation];
         return view('setup.emailnotify' , $data);
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
    public function store(Request $request, $ar)
    {
       
       // $eContent = Emailcontent::find($ar);
        $eContent = Emailcontent::where('key', $ar)->first();
       
        $eContent->value = $request->get("editor1");
        $success = $eContent->save();
        
        if($success){
            $json = ['status' => 200, 'msg'=>'created']; // OK
         }else{
              $json = ['status' => 204, 'msg'=>'no cotent']; // No Content Sent
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
