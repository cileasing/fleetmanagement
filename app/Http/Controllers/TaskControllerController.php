<?php

namespace App\Http\Controllers;

use App\TaskController;
use Illuminate\Http\Request;
use DB;
use App\Reservation;
use App\Trip;
use App\Modules;
use Session;
use Auth;
use App\AdditionalServiceTrip;

class TaskControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
   
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
       //Get all the Reservation that have not been confirmed
      $pendingConfirmation = "SELECT * FROM reservations WHERE `task_no` = '0'"; 
      $collectPending =  collect(DB::select(DB::raw($pendingConfirmation)));
      
       $totalCount = ['task_no' => '0'];
       $rTotalCount = Reservation::where($totalCount)->get()->count();
       
       $countName = "Vehicle Confirmation";
       $fa_icon = "fa-car";
       
         $data = ['allpendingReservation' => $collectPending, 'd_icon'=>$fa_icon, 'vC'=>$countName, 'url' => $url, 'rTotal'=>$rTotalCount];
         return view('task.list_task', $data);
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
     * @param  \App\TaskController  $taskController
     * @return \Illuminate\Http\Response
     */
    public function show(TaskController $taskController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TaskController  $taskController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id){
           
           $data = [];
        
           $url = "Reservation Details";
           //Use the random number to return the reservation ID
           $matchThese = ['reservation_id' => $id];
           $reservations = Reservation::where($matchThese)->get();
           $trips = Trip::where($matchThese)->get();
           $addService = AdditionalServiceTrip::where($matchThese)->get();
           
           $breadcrums = "UPDATE TASK</a>  >  $id ";
              
            $data = ['reservation' => $reservations, 'breadcrums'=>$breadcrums, 'url'=>$url, 'trips'=>$trips, 'additionalService'=>$addService];
            return view('task.edit_task', $data);
              
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskController  $taskController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskController $taskController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskController  $taskController
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskController $taskController)
    {
        //
    }
}
