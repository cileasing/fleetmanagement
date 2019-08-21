<?php

namespace App\Http\Controllers;

use App\Fueltype;
use Illuminate\Http\Request;

class FueltypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($value)
    {
        $json = [];
        $matchThese = ['fuel_name' => $value];
        $dRate = Fueltype::where($matchThese)->value('rate');
        
        $json = ['drate' => $dRate];
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
     * @param  \App\Fueltype  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function show(Fueltype $fueltype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fueltype  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function edit(Fueltype $fueltype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fueltype  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fueltype $fueltype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fueltype  $fueltype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fueltype $fueltype)
    {
        //
    }
}
