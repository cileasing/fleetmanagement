<?php
namespace App\Http\Controllers;

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



class Modules_controller extends Controller {
    
    private $SMS_SENDER = "Sys Manager";
    private $RESPONSE_TYPE = 'json';
    private $SMS_USERNAME = 'cileasinginfotech@gmail.com';
    private $SMS_PASSWORD = 'flower12345';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
       // $this->middleware('auth');
    }
    
    
    public function index(){
         $matchThese = ['dashboard' => '1'];
       $dashboarditems = Modules::where($matchThese)->get(); 
       
       $dodashboardDisplay = "SELECT module_db_table, module_url, module_title, dashboard_display, module_order_by FROM modules WHERE dashboard_display != '0'"; 
       $dashboard_display =  collect(DB::select(DB::raw($dodashboardDisplay)));
       
      // $dashboard_display = Modules::where(DB::raw('dashboard_display != "0" AND del'), '=', '0')->get();
       return view('welcome')->with('dashboard', $dashboarditems)->with('displayItems', $dashboard_display);
        
    }

    public function display($url) {
       // require( 'Libraries/SSP.php' );
       //echo $_SERVER['REQUEST_URI'];exit();
       $json = [];
       $trimTitle = " ";
        $displayHeaderSum = "";
        $matchThese = ['module_url' => $url];
        $module_category = Modules::where($matchThese)->value('module_category');
        $module_user = Modules::where($matchThese)->value('module_user');
        $setapi = Modules::where($matchThese)->value('api');
        
        if(in_array('api', explode('/', $_SERVER['REQUEST_URI']))){
            echo '';
        }
        else{
            if((!in_array($module_category, explode(', ', Auth::user()->category_access))  ||  (!in_array($module_user, array('0', Auth::user()->user_type))))){
                 Session::flash('info', 'You do not have access to that module');
                 return redirect()->back();
            }
        }
        
       
        
        $displayitems = Modules::where($matchThese)->value('module_display_items');
        $module_joins = Modules::where($matchThese)->value('module_joins');
        $module_id = Modules::where($matchThese)->value('modules_id');
        $cid = Modules::where($matchThese)->value('cid');
        $direct_sql = Modules::where($matchThese)->value('direct_sql');
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
        $modulePayment = Modules::where($matchThese)->value('module_payment');
        $must_set = Modules::where($matchThese)->value('must_set');
        $setApi = Modules::where($matchThese)->value('api');
        $module_set_owner = Modules::where($matchThese)->value('module_set_owner');
        $all_companies = Modules::where($matchThese)->value('all_companies');
        $module_owner_item = Modules::where($matchThese)->value('module_owner_item');
        $must_set = trim($must_set) != '' && trim($must_set) != '0' ? $must_set.' AND ' : '';
        
        if(in_array('api', explode('/', $_SERVER['REQUEST_URI']))){
            $company_access = '';
        }
        elseif(Auth::user()->company_access == '0'){
            $company_access =  ' ';
        }
        elseif(Auth::user()->company_access != '0' && $all_companies == '1'){
            $company_access =  ' cid IN (0, '.Auth::user()->company_access.') AND ';
        }
        elseif(Auth::user()->company_access != '0' && $all_companies == '0'){
            $company_access =  ' cid IN ('.Auth::user()->company_access.') AND ';
        }
        
        $set_owner = trim($module_set_owner) != '' && trim($module_set_owner) != '0' ? $module_owner_item.' = "'.Auth::user()->id.'" AND ' : '';
        $set_owner = $set_owner.$company_access;
        $explodeModule_orderBy = explode(' ', $module_order_by);
        
         $matchmodcol = ['column_id' => $module_id];
         $getModuleColumns = Modulecolumns::where($matchmodcol)->get();
         
         $matchheadmod = ['modules_id' => $module_id];
         $getHeaderType = Modules::where($matchheadmod)->value('module_db_table');
         $getHeaderTypePK = Modules::where($matchheadmod)->value('module_primary_key');
         $getHeaderUniqueItem = Modules::where($matchheadmod)->value('modules_unique_item');
         
         $matchbutton = ['button_module_link' => $module_id];
         $getallbutton = Modulebutton::where($matchbutton)->get();
          
           if (isset($_SERVER['QUERY_STRING']) && trim($_SERVER['QUERY_STRING']) != ''){
               $expsql = '';
            //echo $_SERVER['QUERY_STRING'];
            $firstExplode = explode('&', $_SERVER['QUERY_STRING']);
            foreach ($firstExplode as $expItem) {
                $secExp = explode('=', trim($expItem));
                if(isset($secExp[1]) && trim($secExp[0]) != 'url' && trim($secExp[0]) != 'modroute' && trim($secExp[0]) != '_token' && trim($secExp[0]) != 'formID'){
                    $explode_exp1 = explode('_', trim($secExp[0]));
                    if(in_array('date', $explode_exp1) && ($explode_exp1[0] == 'start' || $explode_exp1[0] == 'end')){
                        $secExp1 = str_replace('%2B', '+', str_replace('start_', '', str_replace('end_', '', $secExp[0])));
                    }
                    else $secExp1 = str_replace('%2B', '+', $secExp[0]);
                     /*
                    if(in_array('equal', $secExp)){
                         $expsql .= (trim($secExp[1]) != '') ? '`'.$secExp1 .'` = ' . '"' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                     }
                     elseif(in_array('in', $secExp)){
                         $expsql .= (trim($secExp[1]) != '') ? '`'.$secExp1 .'` = ' . '"' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                     }
                     else                      
                     */
                     if(trim($secExp[1]) == 'cid'){
                         $expsql .= (trim($secExp[1]) != '') ? '`'.$secExp1 .'` = "' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                     }
                     elseif(in_array('date', $explode_exp1) && ($explode_exp1[0] == 'start')){
                         $expsql .= (trim($secExp[1]) != '') ? '`'.$secExp1 .'` >= ' . '"' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                     }
                     elseif(in_array('date', $explode_exp1) && ($explode_exp1[0] == 'end')){
                         $expsql .= (trim($secExp[1]) != '') ? '`'.$secExp1 .'` <= ' . '"' . str_replace('+', ' ', $secExp[1]) . '" AND ' : '';
                     }
                     else $expsql .= (trim($secExp[1]) != '') ? '`'.$secExp1 .'` like ' . '"%' . str_replace('+', ' ', $secExp[1]) . '%" AND ' : '';
                     
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
                            ->where(DB::raw($must_set.$set_owner.$formatexpsql.' del'), '=', '0')
                            ->orderBy($explodeModule_orderBy[0], $explodeModule_orderBy[1])
                            ->groupBy(DB::raw($module_group_by))->get();
                          
        } 
        else{
        
        $displayName = 'App\\' . $Table;
        
        
       /*
        //SELECT v.vehicle_id, a.asset_name, a.utilization_type, v.vehicle_number, COUNT(a.asset_name) FROM vehicles v LEFT JOIN assetutilizations a ON v.vehicle_id = a.asset_name WHERE a.asset_name = 1950 GROUP BY v.vehicle_id, a.utilization_type
    
         $exp_module_joins = explode(',', $module_joins);
                $join = ' ';
                $selectitems = ' ';
                foreach($exp_module_joins as $exp_join){
                    $iexp_join = explode('-', trim($exp_join));
                    $iexp_join1 = $iexp_join[1];
                    $iexp_join0 = $iexp_join[0];
                    $iexp_join2 = $iexp_join[2];
                    $matchjoindb = ['modules_id' => $iexp_join1];
                    $getjoindb = Modules::where($matchjoindb)->value('module_db_table');
                    $getjoindbpk = Modules::where($matchjoindb)->value('module_primary_key');
                    $selectitems = isset($iexp_join2) && trim($iexp_join2) != '' ? $iexp_join2.', ' : $iexp_join0.', ';
                    $join .=  isset($iexp_join1) && trim($iexp_join1) != '' ? 'LEFT JOIN '.$getjoindb.' ON '.$table_name.'.'.$iexp_join0.' = '.$getjoindb.'.'.$getjoindbpk : '';
                }       
       */
           if($direct_sql != 'NULL' && $direct_sql != '0' && trim($direct_sql) != ''){
                //$displayitemsValues = $direct_sql;
                $displayitemsValues = collect(DB::select(DB::raw($direct_sql)));
           }else {
            $displayitemsValues = $displayName::orderBy($explodeModule_orderBy[0], $explodeModule_orderBy[1])
            ->where(DB::raw($must_set.$set_owner.' del'), '=', '0')
            ->groupBy($module_group_by)->get();
           }
      
        }
        
        $countDisplayItemsValues = count($displayitemsValues);
       
      // ->select(DB::raw("COUNT($module_primary_key) as sumheader, ". $getHeaderUniqueItem ." as itemName"))
        if($moduleHeaderSum != '0'){
            if($moduleHeaderItem != '0'){
                $displayHeaderSum = DB::table($table_name)
                        ->join($getHeaderType, $table_name.'.'.$module_primary_key, '=', $getHeaderType.'.'.$getHeaderTypePK)
                        ->select(DB::raw("COUNT($module_primary_key) as sumheader, ". $getHeaderUniqueItem ." as itemName"))
                       ->where(DB::raw($must_set.$set_owner.' del'), '=', '0')
                        ->groupBY(DB::raw($moduleHeaderSum))->get();
            }
            else{
                $displayHeaderSum = DB::table($table_name)
                       // ->join($getHeaderType, $table_name.'.'.$module_primary_key, '=', $getHeaderType.'.'.$getHeaderTypePK)
                        ->select(DB::raw("COUNT($module_primary_key) as sumheader, ". $moduleHeaderSum ." as itemName"))
                        ->where(DB::raw($must_set.$set_owner.' del'), '=', '0')
                        ->groupBY(DB::raw($moduleHeaderSum))->get();
            }
             
        }   
              
         
        /*
        $data = DB::table("click")
	    ->select(DB::raw("SUM(numberofclick) as count"))
	    ->orderBy("created_at")
	    ->groupBy(DB::raw("year(created_at)"))
	    ->get();
         * 
         */
        // $displayitemsValues = $displayName::groupBy($module_group_by)->get();
         // SQL server connection information
         /*   $sql_details = array(
                'user' => env('DB_USERNAME'),
                'pass' => env('DB_PASSWORD'),
                'db' => env('DB_DATABASE'),
                'host' => env('DB_HOST'),
            );
             $single = "";
          * 
          */
            
      /*  if (isset($_SERVER['QUERY_STRING'])) {
           
            $expsql = ' WHERE ';
            echo $_SERVER['QUERY_STRING'];
            $firstExplode = explode('&', $_SERVER['QUERY_STRING']);
            foreach ($firstExplode as $expItem) {
                $secExp = explode('=', $expItem);
                $expsql .= $secExp[0] . '=' . '"' . $secExp[1] . '" AND ';
            }
            //exit();
        } */
        
       /*
        *   require( 'Libraries/SSP.php' );
        $json =  simple($_GET, $sql_details, 'vessel_assets', $module_primary_key, $getModuleColumns, ' AND cid = '.$cid, 'vessel_assets', $single , ' group by '.$module_group_by );
        return response()->json($json);
        */
        if($setApi == '1'){
            //$displayitems = [];
            return response()->json(["resultContent" => $displayitemsValues]);
        }
        else{
            return view('modules')->with('displayitems', $displayitems)->with('displayitemsValues', $displayitemsValues)
                        ->with('url', $url)->with('advsearchitems', $advsearchitems)->with('module_primary_key', $module_primary_key)
            ->with('tablesql', 'vessel_assets')->with('primaryKey', $module_primary_key)
            ->with('columns', $getModuleColumns)->with('cid', ' AND cid = '.$cid)->with('module_id', $module_id)
                ->with('group', ' group by '.$module_group_by)->with('moduleaddButton', $moduleaddButtons)->with('moduleeditButton', $moduleeditButtons)
            ->with('moduleHeaderSum', $moduleHeaderSum)->with('moduleHeaderItem', $moduleHeaderItem)
            ->with('getallbutton', $getallbutton)->with('moduleRecreate', $moduleRecreate)->with('modulePayment', $modulePayment)
                ->with('moduleUnitappr', $moduleUnitappr)->with('moduleAppr', $moduleAppr)
            ->with('countDisplayItemsValues', $countDisplayItemsValues)->with('displayHeaderSum', $displayHeaderSum);            
        }
        
         
    }

    public function form($url) {
        $matchThese = ['module_url' => $url];
        $formitems = Modules::where($matchThese)->value('module_add_items');
        $moduleButtons = Modules::where($matchThese)->value('module_add_button');
        
        //$matchThese = ['module_url' => $url];
        $module_category = Modules::where($matchThese)->value('module_category');
        $module_user = Modules::where($matchThese)->value('module_user');
        $javascript = "";  
         
        if(!in_array($module_category, explode(', ', Auth::user()->category_access))  ||  (!in_array($module_user, array('0', Auth::user()->user_type)))){
         Session::flash('warning', 'You do not have access to that module');
         return redirect()->back();
        }

        //Displaying the Forms
        if ($formitems) {
            $iformitems = explode(',', $formitems);
        }
        
        if($url == 'fuel_requests'){
          $javascript = '<script src="https://sys.c-ileasing.com/js/checkcomponent.js") }}"></script>';  
        }else{
           $javascript = "";   
        }
       
        return view('setup.modules')->with('formitems', $formitems)->with('url', $url)
        ->with('formItems', $iformitems)->with('moduleButtons', $moduleButtons)->with('javascript', $javascript);
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
    public function store(Request $request, $id="") {
        $json = [];
        $matchThese = ['module_url' => $request->url];
        $formitems = Modules::where($matchThese)->value('module_add_items');
        $redirect = Modules::where($matchThese)->value('redirect');
        $Table = Modules::where($matchThese)->value('module_table');
        $DBTable = Modules::where($matchThese)->value('module_db_table');
        $unique_item = Modules::where($matchThese)->value('modules_unique_item');
        $module_primary_key = Modules::where($matchThese)->value('module_primary_key');
        $module_title = Modules::where($matchThese)->value('module_title');
        $setapi = Modules::where($matchThese)->value('api');
        $module_admin_fee = Modules::where($matchThese)->value('module_admin_fee');
        $alert_account = Modules::where($matchThese)->value('module_alert_account');
        $module_hidden_field = Modules::where($matchThese)->value('module_hidden_field');
      
        if($request->url == 'maintenance_requests'){
            $sql = 'SELECT vehicle_id, maint_status FROM '.$DBTable.' WHERE vehicle_id = "'.$request->vehicle_id[0].'" AND maint_status < 5';
          
          $dsql = collect(DB::select(DB::raw($sql)));
          
          if(count($dsql) > 1){
             Session::flash('warning', 'This Vehicle has a pending Job Order');
             return redirect()->back();
          }
        
        }
       
        $modelTableName = strtolower($Table);
        //$formitems = array('text-module_title', 'textarea-module_add_items', 'textarea-module_description', //'text-module_url', 'email-module_alert_account', 'number-module_value', 'on_off-module_status');
        $className = 'App\\' . $Table;
        $module = new $className;
        
       
        
        $lastid = $className::value($module_primary_key) + 1;
        $tab_item_id = isset($request->tab_item_id) && trim($request->tab_item_id) != '' ? 'text-'.$request->tab_item_id.', ' : '';
        $hidden = isset($module_hidden_field) &&  $module_hidden_field != 'NULL' ? ",". $module_hidden_field :  "";
        $formitems = $tab_item_id.$formitems.', number-logged_by, number-created_by';
        //$formitems = $formitems.', number-logged_by, number-created_by'. $hidden;
        //$formitems = $formitems.', number-logged_by, number-created_by';
        
        $expitem = explode(',', $formitems);
         $workdone = "";
         $filename = "";
         $alertcontent = '<html><head>
                            <title>SysManager '.$module_title.': New Item Added</title>
                            </head><body><table cellpadding="10" style="width:600px; font-family: Open Sans,sans-serif; font-size:14px">';
         $addsql = '';
         foreach ($expitem as $item) {
            $iitem = explode('-', trim($item));
            $xtritem = $iitem[1];
            if(in_array('disabled',  $iitem)){
                $module->$xtritem = '';
            }
            else{
                if($iitem[1] == 'logged_by' || $iitem[1] == 'created_by'){
                    $module->$xtritem = ($setapi == '1') ? '' : Auth::user()->id;
                   // $addsql .= $xtritem.' = "'.Auth::user()->id.'" AND ';
                }else if($iitem[0] == "password"){
                    $module->$xtritem = bcrypt($request->$xtritem);
                }else  if(is_array($request->$xtritem)){
                  $module->$xtritem = implode(", ", $request->$xtritem); 
                  // $addsql .= $xtritem.' = "'.implode(", ", $request->$xtritem).'" AND ';
                  $addsql .= '`'.$xtritem.'` = "'.implode(", ", $request->$xtritem).'" AND ';
                }else if($iitem[0] == "file" && isset($request->$xtritem)){
                //$request->$xtritem->store('public');
                
                $filename = pathinfo($request->$xtritem->getClientOriginalName(), PATHINFO_FILENAME);
                        
                $extension = $request->file($xtritem)->getClientOriginalExtension();
                 
                 //Filename to store
                $fileNameToStore = $filename.'_'.date('Ymd').time().'.'.$extension;  
                    
                //$request->$xtritem->storeAs('uploads', $request->$xtritem->getClientOriginalName());
                 $path = $request->file($xtritem)->storeAs('uploads', $fileNameToStore);
                //$module->$xtritem = implode(", ", $request->$xtritem); 
                $module->$xtritem = $fileNameToStore; 
                $addsql .= $xtritem.' = "'.$fileNameToStore.'" AND ';
                }
                else {
                    $module->$xtritem = $request->$xtritem;
                    $addsql .= $xtritem.' = "'.$request->$xtritem.'" AND ';
                }
                
                $workdone .= $iitem[1] .' = "'.$module->$xtritem.'"; ';
               
                if($iitem[0] == 'select' && is_numeric($module->$xtritem)){
                    $itemmatch = ['modules_id' => $iitem[2]];
                    $iTable = Modules::where($itemmatch)->value('module_table');
                    $iTablePk = Modules::where($itemmatch)->value('module_primary_key');
                    $iTableunique = Modules::where($itemmatch)->value('modules_unique_item');
                    $iclassName = 'App\\'.$iTable;
                    $itemmatchval = [$iTablePk => $module->$xtritem];
                    $itemvalue = $iclassName::where($itemmatchval)->value($iTableunique);
                }
                elseif($iitem[0] == 'select_multiple'){
                    $itemmatch = ['modules_id' => $iitem[2]];
                    $iTable = Modules::where($itemmatch)->value('module_table');
                    $iTablePk = Modules::where($itemmatch)->value('module_primary_key');
                    $iTableunique = Modules::where($itemmatch)->value('modules_unique_item');
                    $iclassName = 'App\\'.$iTable;
                    foreach(explode(', ', implode(", ", $request->$xtritem)) as $itemss){
                        $itemmatchval = [$iTablePk => $itemss];
                        $itemvalue .= $iclassName::where($itemmatchval)->value($iTableunique).', ';
                    }
                }
                elseif($iitem[1] == 'logged_by' || $iitem[1] == 'created_by'){
                    $itemmatchval = ['id' => $module->$xtritem];
                    $itemvalue = User::where($itemmatchval)->value('name');
                }
                elseif($iitem[0] == 'password'){
                    $itemvalue = $request->$xtritem;
                }
                else  $itemvalue = $module->$xtritem;
                
                $itemtitle = ($iitem[1] == 'cid') ? 'Company' : ucwords(str_replace('_', ' ', $iitem[1]));
                $alertcontent .= '<tr style="border-bottom:1px solid #ccc"><td style="width:40%; background-color:#ccc"><b>'.$itemtitle.'</b></td><td style="background-color:#f4f4f4">'.trim($itemvalue).'</td></tr>';
             
            }
            
        }
        $addsql = substr($addsql, 0, -4);
        $addcount = collect(DB::select(DB::raw('select * from '.$DBTable.' where '.$addsql)));
        $uniquecount = collect(DB::select(DB::raw('select * from '.$DBTable.' where '.$unique_item.' = "'.$request->$unique_item.'"')));
        // || ($unique_item != '0' && count($uniquecount) > 0)
         if(count($addcount) > 0){
            Session::flash('info', 'Item Already Exist.');
            return redirect()->route('form.url', ['url'=>$request->url]);
            //$success = '';
         }  
         else{
                $statement = DB::select("show table status like '".$DBTable."'");
                $id = $statement[0]->Auto_increment;
                
                  $success = $module->save();
                 //$copysql = "INSERT INTO $DBTable SET $addsql, `created_by` = ".Auth::user()->id.", `logged_by` = ".Auth::user()->id;
                 //$success = collect(DB::insert(DB::raw($copysql)));
                 
              if ($success) {
                $date = date('Y-m-d H:i:s');
                // alert account
                $to_email = isset($request->$alert_account) && trim($request->$alert_account) != '' ? $request->$alert_account : $alert_account;
                $subject = 'SysManager '.$module_title.': New Item Added';
                $body = $alertcontent.'</table></body></html>';
                $headers = "From: info@sys.c-ileasing.com" . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                $alert = trim($alert_account) != '0' ? mail($to_email, $subject, $body, $headers) : '';
                 //Capture audit trails
                $audit = "INSERT INTO modules_trails SET workdone = '".$workdone."', work_type = 'newitem', work_cost = '".$module_admin_fee."', item_id = '".$lastid."' ,  module_title = '".$module_title."' , workdate = '".$date."' , worked_by = '".Auth::user()->name."' , created_by = '".Auth::user()->id."' , logged_by = '".Auth::user()->id."' ";
                //echo $audit = "INSERT INTO modules_trails SET workdone = '".$workdone."' ";
               // exit();
                 $d = collect(DB::insert(DB::raw($audit)));
                 $message = isset($alert) && $alert != '' ? 'Successfully Added; Alert sent.' : 'Successfully Added';
                Session::flash('success', $message);
                //return redirect()->back();
                return redirect()->route($redirect, ['url'=>$request->url, $module_primary_key=>$id]);
               $json = ($setapi == '1') ? ['status' => 200, 'msg' => 'Created'] : ''; // OK
            } else {
                 Session::flash('error', 'Sorry there was an issue updating request');
                //$json = ['status' => 204, 'msg' => 'no cotent']; // No Content Sent
            }  
            return response()->json($json);
         } 
        
        // dd($success->$module_primary_key);
     
        
        

        
        //return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url, $id) {
        $json = [];
        $matchThese = ['module_url' => $url];
        $formitems = Modules::where($matchThese)->value('module_add_items');
        $setapi = Modules::where($matchThese)->value('api');
        $module_category = Modules::where($matchThese)->value('module_category');
        $module_user = Modules::where($matchThese)->value('module_user');
        
        if(!in_array($module_category, explode(', ', Auth::user()->category_access))  ||  (!in_array($module_user, array('0', Auth::user()->user_type)))){
         Session::flash('warning', 'You do not have access to that module');
         return redirect()->back();
        }

        $Table = Modules::where($matchThese)->value('module_table');
        $module_id = Modules::where($matchThese)->value('modules_id');
        $module_primary_key = Modules::where($matchThese)->value('module_primary_key');

       // $matchTab = ['tab_item' => $module_id];
        $matchTab = ['tab_module' => $module_id];
        
        $displayName = 'App\\' . $Table;
        $getID = [$module_primary_key => $id];
        $formValues = $displayName::where($getID)->get()->first();


        $getmoduletabs = Moduletabs::where($matchTab)->get();
        
        //Get all Module Types
      /*  $getModuleTypes = Moduletypes::all();
        if($getModuleTypes){
            foreach($getModuleTypes as $getName) {
                $dName = $get->module_type_name;
            }
        } */
        //Check Documentation table and get Result
        $matchforFleet = ['type' => "Fleet", 'asset_id' => $id];
        $matchforMarine = ['type' => "Marine", 'asset_id' => $id];
        if($url == 'vehicle_data'){
             $getDocument = Assetdocument::where($matchforFleet)->get();
        }else if($url == 'vessel_data'){
            $getDocument = Assetdocument::where($matchforMarine)->get();
        }else{
            $getDocument = "";
        }
      


        if ($formitems) {
            $iformitems = explode(',', $formitems);
        }

        if($setapi == '1'){
            return response()->json($formValues);
        }
        else{
            return view('modulesdistails')->with('formdata', $formValues)->with('url', $url)->with('formItems', $iformitems)
                        ->with('mp', $module_primary_key)->with('id', $id)->with('alltabs', $getmoduletabs)
            ->with('getDoc', $getDocument);
        }
        
            
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url, $id) {
        $matchThese = ['module_url' => $url];
        $formitems = Modules::where($matchThese)->value('module_add_items');
        $editButtons = Modules::where($matchThese)->value('module_edit_button');
        $copyButton = Modules::where($matchThese)->value('module_copy_button');
        $module_category = Modules::where($matchThese)->value('module_category');
        $module_user = Modules::where($matchThese)->value('module_user');
        
        if(!in_array($module_category, explode(', ', Auth::user()->category_access))  ||  (!in_array($module_user, array('0', Auth::user()->user_type)))){
         Session::flash('warning', 'You do not have access to that module');
         return redirect()->back();
        }
        
        $Table = Modules::where($matchThese)->value('module_table');
        $module_primary_key = Modules::where($matchThese)->value('module_primary_key');

        $displayName = 'App\\' . $Table;
        $getID = [$module_primary_key => $id];
        $formValues = $displayName::where($getID)->get()->first();

        if ($formitems) {
            $iformitems = explode(',', $formitems);
        }

        if($editButtons == 1){
             return view('setup.modules')->with('formdata', $formValues)->with('url', $url)->with('formItems', $iformitems)->with('copyButton', $copyButton)
                        ->with('mp', $module_primary_key)->with('id', $id);
        }else{
            return 'no access';
        }
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $json = [];
        $updatesql = "";
        $workdone = "";
        $date = date('Y-m-d H:i:s');
        $matchThese = ['module_url' => $request->url];
        $formitems = Modules::where($matchThese)->value('module_add_items');
        $Table = Modules::where($matchThese)->value('module_table');
        $module_title = Modules::where($matchThese)->value('module_title');
        $tablename = Modules::where($matchThese)->value('module_db_table');
        $unique_item = Modules::where($matchThese)->value('modules_unique_item');
        $module_primary_key = Modules::where($matchThese)->value('module_primary_key');
        $redirect = Modules::where($matchThese)->value('redirect');

        $modelTableName = strtolower($Table);
        //$formitems = array('text-module_title', 'textarea-module_add_items', 'textarea-module_description', //'text-module_url', 'email-module_alert_account', 'number-module_value', 'on_off-module_status');
        $className = 'App\\' . $Table;
        $module = new $className;
        $expitem = explode(',', $formitems);
        foreach ($expitem as $item) {
            $iitem = explode('-', trim($item));
            $xtritem = $iitem[1];
            
            
            if(is_array($request->$xtritem)){
                $xtritem1 = $iitem[2];
               $value = implode(", ", $request->$xtritem); 
                $matchNumber = ['modules_id' => $xtritem1];
                $matchNumberDB = Modules::where($matchNumber)->value('module_db_table');
                $matchNumberADDitems = Modules::where($matchNumber)->value('module_add_items');
                $matchNumber_PrimaryKey = Modules::where($matchNumber)->value('module_primary_key');
                
                  $displayitemsValues2 = DB::table($matchNumberDB)
                  ->where(
                      DB::raw($matchNumber_PrimaryKey.' IN ('.$value.') AND del'), '=', '0'
                      )->get();
                  $filling_station_phone_number = isset($displayitemsValues2->filling_station_phone_number) && trim($displayitemsValues2->filling_station_phone_number) != '' ? $displayitemsValues2->filling_station_phone_number : '';         
                  $driver_phone_number = isset($displayitemsValues2->phone_no) && trim($displayitemsValues2->phone_no) != '' ? $displayitemsValues2->phone_no : '';
            }
            else{
                $value = $request->$xtritem;
            }
            
            if((!in_array('disabled', $iitem) && $iitem[0] != "password")){
                $updatesql .= '`'.$iitem[1] . '` = "' . $value . '", ';
                $workdone .= $iitem[1] .' = "'.addslashes($value).'"; ';
            }
            else{
                $updatesql .= '';
                $workdone .= '';
            } 
            
            //$module->$xtritem = $request->$xtritem;
        }

        $updatesql = substr($updatesql, 0, -2);
        //echo $request->copyitem; exit();
        if($request->copyitem){
            $copysql = "INSERT INTO $tablename SET $updatesql, `created_by` = ".Auth::user()->id.", `logged_by` = ".Auth::user()->id;
            $success = collect(DB::insert(DB::raw($copysql)));
            $message = 'Succcessfully Added';  
            $mcolor = 'danger';
        }
        else{
            $success = DB::statement("UPDATE $tablename SET $updatesql, `logged_by` = ".Auth::user()->id." WHERE $module_primary_key =  $request->formID");
        //$success = DB::statement("UPDATE $modelTableName SET $updatesql WHERE $module_primary_key =  $request->formID");
            $message = 'Succcessfully Updated '; 
            $mcolor = 'success';
            
             if($request->url == "pending_fuel_request" && $request->fueling_status == array('1')){
                 
                 print_r($request);
                 return;
                 // $phone_number = $request->input('phone_number');
                $phone_number = $filling_station_phone_number;
                $phone_number .= ', '.$driver_phone_number;
                $message = "Submitted Fuel Request. Vehicle:".$request->vehicle_number." Liter:".$request->quantity_litre." Number: ".$phone_number;
                $smsSent = $this->initiateSmsActivation($phone_number, $message);
                //$this->initiateSmsGuzzle($phone_number, $message);
               //$message;
              // print_r($smsSent);
               //exit();
               
            }
            
        }
        if ($success) {
            $upaudit = "INSERT INTO modules_trails SET workdone = '".$workdone."', work_type = 'updateitem', item_id = '".$request->formID."',  module_title = '".$module_title."' , 
            workdate = '".$date."' , worked_by = '".Auth::user()->name."' , created_by = '".Auth::user()->id."' , logged_by = '".Auth::user()->id."' ";
             $d = collect(DB::insert(DB::raw($upaudit)));
              Session::flash($mcolor, $message);
            //return redirect()->back();
            if($redirect == 'back'){
                return redirect()->back();
                //return redirect(session('links')[4]);
               // $httpref = $_SERVER['HTTP_REFERER'];
                //return $_SERVER['HTTP_REFERER'];
            }
            else return redirect()->route('display.url', ['url'=>$request->url]);
            //$json = ['status' => 200, 'msg' => 'Updated']; // OK
        } else {
            $json = ['status' => 204, 'msg' => 'no cotent']; // No Content Sent
        }

        return response()->json($json);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
    
    public function showutilization($url, $assetID, $tabitem, $tabitemid){
        $matchThese = ['modules_id' => $tabitem];
        $Table = Modules::where($matchThese)->value('module_table');
        $tablename = Modules::where($matchThese)->value('module_db_table');
        
        $module_category = Modules::where($matchThese)->value('module_category');
        $module_user = Modules::where($matchThese)->value('module_user');
        
        if(!in_array($module_category, explode(', ', Auth::user()->category_access))  ||  (!in_array($module_user, array('0', Auth::user()->user_type)))){
         Session::flash('info', 'You do not have access to that module');
         return redirect()->back();
        }
       
       $displayName = 'App\\' . $Table; //We need to use the utilization table find a way to store the id in the utilization table
       $matchinothertable = [$tabitemid => $assetID];
      // $getResult = $displayName::where($matchinothertable)->get();
       
      
       //$getResult = 'SELECT utilization_type as title, start_date as start, end_date as end, "#00a65a" as backgroundColor, "#00a65a" as borderColor  FROM assetutilizations where '.$tabitemid.' = '.$assetID;
       $getResult = 'SELECT utilization_type as title, start_date as start, end_date as end, "#00a65a" as backgroundColor, "#00a65a" as borderColor  FROM assetutilizations where `asset_name` = '.$assetID;
        
       $d = collect(DB::select(DB::raw($getResult)));
          
       
       return response()->json($d);
    }
    
    
    
    public function createrequest(Request $request){
        
        if(isset($request->postCheck)){
             $date = date('Y-m-d H:i:s');
             $url = $request->url;
             $matchThese = ['module_url' => $url];
             $table_name = Modules::where($matchThese)->value('module_db_table');
             $Model = Modules::where($matchThese)->value('module_table');
             $module_title = Modules::where($matchThese)->value('module_title');
             $module_primary_key = Modules::where($matchThese)->value('module_primary_key');
             $renewal = Modules::where($matchThese)->value('renewal_must_set');
             $module_unit_approval = Modules::where($matchThese)->value('module_unit_approval');
             $module_approval = Modules::where($matchThese)->value('module_approval');
             $module_payment = Modules::where($matchThese)->value('module_payment');
             $renewal_add_items = Modules::where($matchThese)->value('module_add_items');
             
            $explodeRequest = implode(",", $request->postCheck);
           
           if(isset($_POST['moduleRecreate'])){
               
          $getResult = 'SELECT asset_name, asset_office, document_type, 
              DATE_ADD(MAX(issue_date), INTERVAL 1 year) as issue_date, 
              DATE_ADD(MAX(expiry_date), INTERVAL 1 year) as expiry_date, 
              document_cost, vendor FROM `assetdocuments` where '.$module_primary_key.' IN ('.$explodeRequest.') AND approval = 1 GROUP by asset_name, document_type';
          
          $d = collect(DB::select(DB::raw($getResult)));
          
             if($d){
                foreach ($d as $get){
                    if ($renewal_add_items){
                        $renewsql = ' INSERT INTO '.$table_name.' SET ';
                        $renewitem = explode(',', $renewal_add_items);
                        foreach($renewitem as $ritem){
                            $rritem = explode('-', trim($ritem));
                            $rritem1 = $rritem[1];
                            $renewsql .= '`'.$rritem[1].'` = "'.$get->$rritem1.'", ';
                        }
                        $renewsql = substr($renewsql, 0, -2);
                       // echo $renewsql;exit
                        $d = collect(DB::insert(DB::raw($renewsql)));
                        if($d){
                            $mrewaudit = "INSERT INTO modules_trails SET workdone = '".addslashes($renewsql)."', work_type = 'Renewitem', item_id = '".$explodeRequest."', module_title = '".$module_title."' , workdate = '".$date."' , worked_by = '".Auth::user()->name."' , created_by = '".Auth::user()->id."' , logged_by = '".Auth::user()->id."' ";
                            $daud = collect(DB::insert(DB::raw($mrewaudit)));
                        }
                      }
                }
             }
           }
           elseif(isset($_POST['moduleAppr'])){
               $moduleApprsql = 'UPDATE '.$table_name.' SET '.$module_approval.' = 1 where '.$module_primary_key.' IN ('.$explodeRequest.')';
               $d = collect(DB::update(DB::raw($moduleApprsql)));
               if($d){
                   $mappaudit = "INSERT INTO modules_trails SET workdone = '".addslashes($moduleApprsql)."', work_type = 'Approveditem', item_id = '".$explodeRequest."', module_title = '".$module_title."' , workdate = '".$date."' , worked_by = '".Auth::user()->name."' , created_by = '".Auth::user()->id."' , logged_by = '".Auth::user()->id."' ";
                   $daud = collect(DB::insert(DB::raw($mappaudit)));
               }
               $msg = 'Successfully Approved';
           }
          elseif(isset($_POST['modulePayment'])){
               $moduleApprsql = 'UPDATE '.$table_name.' SET '.$module_payment.' = 1 where '.$module_primary_key.' IN ('.$explodeRequest.')';
               $d = collect(DB::update(DB::raw($moduleApprsql)));
               if($d){
                   $mapdaudit = "INSERT INTO modules_trails SET workdone = '".addslashes($moduleApprsql)."', work_type = 'Paiditem', item_id = '".$explodeRequest."', module_title = '".$module_title."' , workdate = '".$date."' , worked_by = '".Auth::user()->name."' , created_by = '".Auth::user()->id."' , logged_by = '".Auth::user()->id."' ";
                   $daud = collect(DB::insert(DB::raw($mapdaudit)));
               }
               $msg = 'Successfully paid';
           }
           elseif(isset($_POST['moduleUnitappr'])){
                $moduleUnitapprsql = 'UPDATE '.$table_name.' SET '.$module_unit_approval.' = 1 where '.$module_primary_key.' IN ('.$explodeRequest.')';
                $d = collect(DB::update(DB::raw($moduleUnitapprsql)));
                if($d){
                   $muappaudit = "INSERT INTO modules_trails SET workdone = '".addslashes($moduleUnitapprsql)."', work_type = 'UnitApproveditem', item_id = '".$explodeRequest."', module_title = '".$module_title."' , workdate = '".$date."' , worked_by = '".Auth::user()->name."' , created_by = '".Auth::user()->id."' , logged_by = '".Auth::user()->id."' ";
                   $daud = collect(DB::insert(DB::raw($muappaudit)));
               }
               $msg = 'Successfully Approved';
           }
           else{
               $d = '';
               $daud = '';
               $msg = 'Successfully Created';
           }
             
             if($d){
              Session::flash('success', $msg);
              return redirect()->back();
             }else{
                 Session::flash('warning', 'No Content was Created'); 
             }
         
        }
    }
    
    
    
    
    
    public function multistore(Request $request){
        $input = $request->all();
       // dd($input);
        $matchThese = ['module_url' => $request->url];
        $formitems = Modules::where($matchThese)->value('module_add_items');
        $Table = Modules::where($matchThese)->value('module_table');
        $DBTable = Modules::where($matchThese)->value('module_db_table');
        $unique_item = Modules::where($matchThese)->value('modules_unique_item');
        $module_primary_key = Modules::where($matchThese)->value('module_primary_key');
       
        
        for($i=0; $i<= count($input['approved_cost']); $i++) {

            if(empty($input['approved_cost'][$i]) || !is_numeric($input['approved_cost'][$i])) continue;

            $data = [ 
              'maintenance_id' => $input['maintenance_id'],
              'type_name' => $input['type_name'][$i],
              'sub_type' => $input['sub_type'][$i],
              'description' => $input['description'][$i],
              'quantity' => $input['quantity'][$i],
              'estimated_cost' => $input['estimated_cost'][$i],
              'estimated_amount' => $input['estimated_amount'][$i], 
              'approved_cost' => $input['approved_cost'][$i], 
              'approved_amount' => $input['approved_amount'][$i], 
              'logged_by' => Auth::user()->id, 
              'created_by' => Auth::user()->id
            ];

             //$className = 'App\\' . $Table;
             //$module = new $className;
        
           $module =  MaintenanceItems::create($data);
          }
          
          //Update Maintenance Cost amount  appAmount
          
           $success = ($module) ? DB::statement("UPDATE $DBTable SET `estimated_cost` = '".$input['amount']."', `approved_cost` = '".$input['appAmount']."', `updated_at` = '".date('Y-m-d H:i:s')."' WHERE `$module_primary_key` =  '".$input['maintenance_id']."' ") : "";
          
          if($success){
            Session::flash('success', 'Maintenance Items Added Successfully'); 
              return redirect()->back();
          }else{
               Session::flash('warning', 'Error Adding Not Added');
                return redirect()->back();
          }
           
        
    }
    
    
    
    
     public function multiuploads(Request $request){
        $matchThese = ['module_url' => $request->url];
        $Table = Modules::where($matchThese)->value('module_table');
        $module_title = Modules::where($matchThese)->value('module_title');
        $tablename = Modules::where($matchThese)->value('module_db_table');
        $module_primary_key = Modules::where($matchThese)->value('module_primary_key');

        $this->validate($request, [
                'filenames' => 'required',
                'filenames.*' => 'mimes:doc,pdf,docx,zip,jpg,jpeg,msg,oct,png,txt,msg'
        ]); 
        
        if($request->hasfile('filenames')){
            
            foreach($request->file('filenames') as $file){
                  
                $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $org_filename = $file->getClientOriginalName();
                 //Filename to store
                $fileNameToStore = $filename.'_'.date('Ymd').time().'.'.$extension;  
                
                $file->move(public_path().'/storage/', $fileNameToStore); 
                $data[] = $filename. "<br/> - ". $fileNameToStore; 
                
                $requestID = $request->request_title;
                
                $data = [ 
                    'table_name' => $Table,
                    'table_pk' => $module_primary_key,
                    'document_title' => $request->document_title,
                    'request_id' => $request->$requestID,
                    'org_filenames' => $org_filename, 
                    'filenames' => $fileNameToStore, 
                    'logged_by' => Auth::user()->id, 
                    'created_by' => Auth::user()->id
                  ];
                
                $success =  Files::create($data);
                
            }

         } // End of  if($request->hasfile('filenames')){
       //echo  $file->filenames=json_encode($data);
         
         if($success){
             Session::flash('success', 'Files Successfully Uploaded');  
              return redirect()->back();
          }else{
               Session::flash('warning', 'Error Uploading Files');
                return redirect()->back();
          }
           
        
    }
    
    
    
    
    
    public function check ($url, $matchItem, Request $request){
        $json = [];
        $matchThese = ['module_url' => $url];
        $module_category = Modules::where($matchThese)->value('module_table');
        $module_Pk = Modules::where($matchThese)->value('module_primary_key');
        $vehicleName = $request->vehicleName;
        
        $matchThese2 = [$matchItem => $vehicleName];
        $checkTable = Modules::where($matchThese2)->value($module_Pk);
        
        if($checkTable){
            $json = ["status" => 200];
        }else{
            $json = ["status" => 400];
        }
        return response()->json($json);
    }
   
   
   
   public function initiateSmsActivation($phone_number, $message) {
        $isError = 0;
        $errorMessage = true;

        //Preparing post parameters
        $postData = array(
                    'username' => $this->SMS_USERNAME,
                    'password' => $this->SMS_PASSWORD,
                    'message' => $message,
                    'sender' => $this->SMS_SENDER,
                    'mobiles' => $phone_number,
                    'response' => $this->RESPONSE_TYPE
        );

        //$url = "http://portal.bulksmsnigeria.net/api/"; // portal.nigeriabulksms.com
         $url = "http://portal.nigeriabulksms.com/api/"; 
         
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);


        //Print error if any

        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);



        if ($isError) {

            return array('error' => 1, 'message' => $errorMessage);
        } else {

            return array('error' => 0);
        }
    }

    
    
   

}

