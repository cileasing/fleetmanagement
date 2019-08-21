<?php

namespace App\Http\Controllers;

use App\Assetutilization;
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
use DB;

class AssetutilizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($url)
    {
        $trimTitle = " ";
        $displayHeaderSum = "";
        $matchThese = ['module_url' => $url];
        $displayitems = Modules::where($matchThese)->value('module_display_items');
        $module_id = Modules::where($matchThese)->value('modules_id');
        $cid = Modules::where($matchThese)->value('cid');
        $advsearchitems = Modules::where($matchThese)->value('module_search_items');
        $Table = Modules::where($matchThese)->value('module_table');
        $table_name = Modules::where($matchThese)->value('module_db_table');
        $module_primary_key = Modules::where($matchThese)->value('module_primary_key');
        $module_order_by = Modules::where($matchThese)->value('module_order_by');
        $module_group_by = Modules::where($matchThese)->value('module_group_by');
        $moduleaddButtons = Modules::where($matchThese)->value('module_add_button');
        $moduleeditButtons = Modules::where($matchThese)->value('module_edit_button');
        $moduleHeaderSum = Modules::where($matchThese)->value('module_header_sum');
        $moduleHeaderItem = Modules::where($matchThese)->value('module_header_item');
        $moduleUnitappr = Modules::where($matchThese)->value('module_unit_approval');
        $moduleAppr = Modules::where($matchThese)->value('module_approval');
        $moduleRecreate = Modules::where($matchThese)->value('module_recreate');
        $must_set = Modules::where($matchThese)->value('must_set');
        $must_set = trim($must_set) != '' && trim($must_set) != '0' ? $must_set.' AND ' : '';
        $explodeModule_orderBy = explode(' ', $module_order_by);
        
         $matchmodcol = ['column_id' => $module_id];
         $getModuleColumns = Modulecolumns::where($matchmodcol)->get();
         
         $matchheadmod = ['modules_id' => $module_id];
         $getHeaderType = Modules::where($matchheadmod)->value('module_db_table');
         $getHeaderTypePK = Modules::where($matchheadmod)->value('module_primary_key');
         $getHeaderUniqueItem = Modules::where($matchheadmod)->value('modules_unique_item');
         
         $matchbutton = ['button_module_link' => $module_id];
         $getallbutton = Modulebutton::where($matchbutton)->get();
          
           if (isset($_SERVER['QUERY_STRING']) && trim($_SERVER['QUERY_STRING']) != '') {
               $expsql = '';
            //echo $_SERVER['QUERY_STRING'];
            $firstExplode = explode('&', $_SERVER['QUERY_STRING']);
            foreach ($firstExplode as $expItem) {
                $secExp = explode('=', trim($expItem));
                if(isset($secExp[1]) && trim($secExp[0]) != 'url' && trim($secExp[0]) != 'modroute' && trim($secExp[0]) != '_token' && trim($secExp[0]) != 'formID'){
                     $secExp1 = str_replace('%2B', '+', $secExp[0]);
                     $expsql .= (trim($secExp[1]) != '') ? '`'.$secExp1 .'` like ' . '"%' . str_replace('+', ' ', $secExp[1]) . '%" AND ' : '';
                     
                }else{
                    $expsql .= "";
                }
               
            }
         $formatexpsql = substr($expsql, 0, -4);
         $formatexpsql = trim($formatexpsql) != '' ? $formatexpsql.' AND ': '';
        // echo $formatexpsql;
        // exit();
        //$displayName = 'App\\' . $Table;
        //$displayitemsValues = $displayName::where($formatexpsql)->orderBy($explodeModule_orderBy[0], $explodeModule_orderBy[1])->groupBy($module_group_by)->get();
        $displayitemsValues = DB::table($table_name)
                            ->where(DB::raw($must_set.$formatexpsql.' del'), '=', '0')
                            ->orderBy($explodeModule_orderBy[0], $explodeModule_orderBy[1])
                            ->groupBy(DB::raw($module_group_by))->get();
                          
        } 
        else{
        
        $displayName = 'App\\' . $Table;
        $displayitemsValues = $displayName::orderBy($explodeModule_orderBy[0], $explodeModule_orderBy[1])
        ->where(DB::raw($must_set.' del'), '=', '0')
        ->groupBy($module_group_by)->get();
      
        }
        
        
      
        
        $countDisplayItemsValues = count($displayitemsValues);
      // ->select(DB::raw("COUNT($module_primary_key) as sumheader, ". $getHeaderUniqueItem ." as itemName"))
        if($moduleHeaderSum != '0'){
            if($moduleHeaderItem != '0'){
                $displayHeaderSum = DB::table($table_name)
                        ->join($getHeaderType, $table_name.'.'.$module_primary_key, '=', $getHeaderType.'.'.$getHeaderTypePK)
                        ->select(DB::raw("COUNT($module_primary_key) as sumheader, ". $getHeaderUniqueItem ." as itemName"))
                       ->where(DB::raw($must_set.' del'), '=', '0')
                        ->groupBY(DB::raw($moduleHeaderSum))->get();
            }
            else{
                $displayHeaderSum = DB::table($table_name)
                       // ->join($getHeaderType, $table_name.'.'.$module_primary_key, '=', $getHeaderType.'.'.$getHeaderTypePK)
                        ->select(DB::raw("COUNT($module_primary_key) as sumheader, ". $moduleHeaderSum ." as itemName"))
                        ->where(DB::raw($must_set.' del'), '=', '0')
                        ->groupBY(DB::raw($moduleHeaderSum))->get();
            }
             
        }   
              
        return view('modules')->with('displayitems', $displayitems)->with('displayitemsValues', $displayitemsValues)
                        ->with('url', $url)->with('advsearchitems', $advsearchitems)->with('module_primary_key', $module_primary_key)
            ->with('tablesql', 'vessel_assets')->with('primaryKey', $module_primary_key)
            ->with('columns', $getModuleColumns)->with('cid', ' AND cid = '.$cid)->with('module_id', $module_id)
                ->with('group', ' group by '.$module_group_by)->with('moduleaddButton', $moduleaddButtons)->with('moduleeditButton', $moduleeditButtons)
            ->with('moduleHeaderSum', $moduleHeaderSum)->with('moduleHeaderItem', $moduleHeaderItem)
            ->with('getallbutton', $getallbutton)->with('moduleRecreate', $moduleRecreate)
                ->with('moduleUnitappr', $moduleUnitappr)->with('moduleAppr', $moduleAppr)
            ->with('countDisplayItemsValues', $countDisplayItemsValues)->with('displayHeaderSum', $displayHeaderSum);
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
     * @param  \App\Assetutilization  $assetutilization
     * @return \Illuminate\Http\Response
     */
    public function show(Assetutilization $assetutilization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assetutilization  $assetutilization
     * @return \Illuminate\Http\Response
     */
    public function edit(Assetutilization $assetutilization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assetutilization  $assetutilization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assetutilization $assetutilization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assetutilization  $assetutilization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assetutilization $assetutilization)
    {
        //
    }
}
