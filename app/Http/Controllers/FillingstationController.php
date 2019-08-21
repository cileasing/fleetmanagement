<?php

namespace App\Http\Controllers;

use App\Fillingstation;
use Illuminate\Http\Request;

class FillingstationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trimTitle = "";
        $matchThese = ['module_url' => $url];
        $displayitems = Modules::where($matchThese)->value('module_display_items');
        $module_id = Modules::where($matchThese)->value('modules_id');
        $cid = Modules::where($matchThese)->value('cid');
        $advsearchitems = Modules::where($matchThese)->value('module_search_items');
        $Table = Modules::where($matchThese)->value('module_table');
        
        $module_primary_key = Modules::where($matchThese)->value('module_primary_key');
        $module_order_by = Modules::where($matchThese)->value('module_order_by');
        $module_group_by = Modules::where($matchThese)->value('module_group_by');
        
        $explodeModule_orderBy = explode(' ', $module_order_by);
        
        $matchmodcol = ['module_id' => $module_id];
        $getModuleColumns = Modulecolumns::where($matchmodcol)->get();
       
        $displayName = 'App\\'. $Table;
        //$displayitemsValues = $displayName::orderBy($explodeModule_orderBy[0], $explodeModule_orderBy[1])->groupBy($module_group_by)->get();
       // $displayitemsValues = Asset::groupBy($module_group_by)->get();
       //$displayitemsValues =  Asset::select('asset_id, vessel_Name, contract_type, price, purchase_date,
         //      vessel_Type, Client, Size')->latest()->limit(10)->get();
        $displayitemsValues = DB::statement("SELECT `asset_id`, `vessel_Name`, `contract_type`, `price`, `purchase_date`,
               `vessel_Type`, `Client`, `Size` FROM vessel_assets")->tosql();
         // SQL server connection information
            $sql_details = array(
                'user' => env('DB_USERNAME'),
                'pass' => env('DB_PASSWORD'),
                'db' => env('DB_DATABASE'),
                'host' => env('DB_HOST'),
            );
             $single = "";
            
       
        
       /* $json = [];
        
         $output = array(
                "draw"              =>  intval($_POST["draw"]),
                //"recordsTotal"      =>  $this->datatablemodels->get_all_data(),
                "recordsFiltered"   =>  $this->datatablemodels->get_filtered_data($_SESSION['email']),
                "data"              =>  $data
            );
           $this->output->set_content_type('application/json')->set_output(json_encode($output));
        */
        require( 'Libraries/SSP.php' );
        $json =  simple($_GET, $sql_details, 'vessel_assets', $module_primary_key, $getModuleColumns, ' AND cid = '.$cid, 'vessel_assets', $single , ' group by '.$module_group_by );
        return response()->json($json);
        //echo json_encode(  
           //     simple($_GET, $sql_details, 'vessel_assets', $module_primary_key, $getModuleColumns, ' AND cid = '.$cid, 'vessel_assets', $single , ' group by '.$module_group_by )
         //);
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
     * @param  \App\Fillingstation  $fillingstation
     * @return \Illuminate\Http\Response
     */
    public function show(Fillingstation $fillingstation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fillingstation  $fillingstation
     * @return \Illuminate\Http\Response
     */
    public function edit(Fillingstation $fillingstation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fillingstation  $fillingstation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fillingstation $fillingstation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fillingstation  $fillingstation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fillingstation $fillingstation)
    {
        //
    }
}
