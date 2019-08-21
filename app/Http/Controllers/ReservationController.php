<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use App\ServiceType;
use App\AdditionalService;
use App\Http\Controllers\Functions;
use App\Office;
use DB;
use App\Companies;
use Session;
use Auth;
use App\Modules;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $success = 200;
       
    public function index($url)
    {
         $matchThese = ['module_url' => $url];
        $module_category = Modules::where($matchThese)->value('module_category');
         $module_user = Modules::where($matchThese)->value('module_user');
        
        if((!in_array($module_category, explode(', ', Auth::user()->category_access))  ||  (!in_array($module_user, array('0', Auth::user()->user_type))))){
                 Session::flash('info', 'You do not have access to that module');
                 return redirect()->back();
            }
            
        $data = [];
         if ($url == "new_reservation") {

              $matchThese = ['reservation' => '1'];
              $serviceType = ServiceType::where($matchThese)->get();

              $additionalService = AdditionalService::all();
              
              //Returns all Offices
              $office = Office::all();
              
               //Returns all Companies
              $companies = Companies::all();

              $data = ['sType' => $serviceType, 'comp'=>$companies, 'office' => $office,  'additionalService'=>$additionalService, 'url' => $url];
            return view('reservation.new_reservation', $data);
        }
    }
    
    
     public function listall($url)
    {
        $matchThese = ['module_url' => $url];
        $module_category = Modules::where($matchThese)->value('module_category');
         $module_user = Modules::where($matchThese)->value('module_user');
        
        if((!in_array($module_category, explode(', ', Auth::user()->category_access))  ||  (!in_array($module_user, array('0', Auth::user()->user_type))))){
                 Session::flash('info', 'You do not have access to that module');
                 return redirect()->back();
            }
            
        $data = [];
      
       //Get all the Reservation that have not been confirmed
      $pendingConfirmation = "SELECT * FROM reservations WHERE `task_no` = '0'"; 
      $collectPending =  collect(DB::select(DB::raw($pendingConfirmation)));
      
       $totalCount = ['task_no' => '0'];
       $rTotalCount = Reservation::where($totalCount)->get()->count();
       
       $countName = "Vehicle Confirmation";
       $fa_icon = "fa-car";
       
         $data = ['allpendingReservation' => $collectPending, 'd_icon'=>$fa_icon, 'vC'=>$countName, 'url' => $url, 'rTotal'=>$rTotalCount];
         return view('reservation.list_reservation', $data);
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
         if (!$request->ajax()) {
                $json = ["status" => 400, "msg" => "Request Type not Supported"];
         }else{
             
            $b = new Functions();
            $success = $b::insertoDB($request->all(), 'reservations');
            
             if ($success) {
               
                $json = ["status" => 200];
            } else {
                $json = ["status" => 400];
            }
         }

        return response()->json($json);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
