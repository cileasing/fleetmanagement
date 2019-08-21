<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reservation;
use App\ServiceType;
use App\AdditionalService;
use App\AdditionalServiceTrip;
use App\Companies;
use DB;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($num="")
    {
          $data = [];
        
              //Use the random number to return the reservation ID
              $matchThese = ['random_num' => $num];
              $reservationId = Reservation::where($matchThese)->value('reservation_id');
              
              //Based on the reservation id return client name
              $matchTheseAll = ['reservation_id' => $reservationId];
              $client_name = Reservation::where($matchTheseAll)->value('client_name');
              $client_full_name = Companies::where("companies_id", $client_name)->value('company_name');
             
              //Return service type where reservation = 1 for all service type like pickup/drop-off and daily rental
              $matchThese_service = ['reservation' => '1'];
              $serviceType = ServiceType::where($matchThese_service)->get();
              
              //Returns the trip details
              $matchThese_trip = ['reservation_id' => $reservationId];
              $trip_details = Trip::where($matchThese_trip)->get();
              
             
              //Return the service type associated with the trips
              $trip_service = "SELECT * FROM additional_service_trip WHERE reservation_id = @$reservationId"; 
              
              $display_tripService =  collect(DB::select(DB::raw($trip_service)));
       
              
              $additionalService = AdditionalService::all();
              
              $getVehicleTypes = "SELECT vehicle_id, service_type, vehicle_type, `vehicle_make+model`, vehicle_status, office, COUNT(vehicle_id) As dCount FROM `vehicles` wHERE vehicle_status='Active' GROUP BY vehicle_type";
              $vehicleCategory = collect(DB::select(DB::raw($getVehicleTypes)));
              
              $getAllLocations = "SELECT location_id, location_name FROM `locations`";
              $dStates = collect(DB::select(DB::raw($getAllLocations)));

            $data = ['rId' => $reservationId, 'dStates'=>$dStates, 'vCat'=>$vehicleCategory, 'service_trip_type'=>$display_tripService, 'tripDetails' => $trip_details, 'comp_full_name'=>$client_full_name, 'cl_name'=>$client_name, 'sType' => $serviceType, 'additionalService'=>$additionalService];
            return view('reservation.trip_reservations', $data);
        
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
        $trip = new Trip;
        $trip->service_type = $request->service_type;
        $trip->passenger_names = $request->passengerName;
        $trip->number_of_passengers = $request->nof_passenger;
        $trip->email_address = $request->passengers_email;
        $trip->passenger_phone_numbers = $request->passengers_phone;
        $trip->departure = $request->depature;
        $trip->destination = $request->destination;
        $trip->pick_up_date = $request->pick_up_date;
        $trip->pickup_time = $request->pick_up_time;
        $trip->end_date = $request->end_date;
        $trip->end_time = $request->end_date_time;
        $trip->vehicle_type = $request->vehicle_type;
        $trip->number_of_days = $request->number_of_days;
        $trip->price = $request->price_per_day;
        $trip->reservation_id = $request->reservation_id;
        $trip->additional_cost = $request->additional_cost;
        $trip->total_cost = $request->total_cost;
        $trip->_token = $request->_token;
        $trip->trip_status = "submitted";
        $trip->logged_by = Auth::user()->id;
        $trip->created_by = Auth::user()->id;
        $trip->cid = $request->client_id;
        //$trip->total_cost = $request->number_of_days * $request->price_per_day;
        
       // $trip_total_cost = $request->no_of_days * $request->price_per_day;
        
        $tripAdd = $trip->save();     
        
        $lastID = $trip->id;
         
        
        //Add Trip Additional Service
        if($request->additional_service != "" || $request->quantity !="" ){
            $sum = 0;
            for($i=0; $i < count($request->additional_service); $i++){
               
                $matchThese = ['id' => $request->additional_service[$i]];
                 
                $answer = AdditionalServiceTrip::create([
                    'reservation_id' => $request->reservation_id,
                    'trip_id' => $lastID,
                    'cid' => $request->client_id,
                    'service' => $request->additional_service[$i],
                   // 'service_cost' => AdditionalService::where($matchThese)->value('unit_price'),
                    'service_cost' => $request->add_cost[$i],
                    'quantity' => $request->quantity[$i],
                    //'total_cost' => $request->quantity[$i] * AdditionalService::where($matchThese)->value('unit_price'),
                    'total_cost' => $request->quantity[$i] * $request->add_cost[$i],
                ]); 
                $sum +=  ((int)$request->quantity[$i] * (int)$request->add_cost[$i]);
            }
        }
       
        $Total = $sum + $request->total_cost;
        
        if($tripAdd && $answer){
           $json = ["status" => 200]; 
        }
        return response()->json($json);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id){
           
           $data = [];
        
           $url = "Reservation Details";
           //Use the random number to return the reservation ID
           $matchThese = ['reservation_id' => $id];
           $reservations = Reservation::where($matchThese)->get();
           $trips = Trip::where($matchThese)->get();
           $addService = AdditionalServiceTrip::where($matchThese)->get();
           
           $breadcrums = "<a href='http://".request()->getHttpHost()."/all/list_of_reservation'>LIST OF RESERVATIONS</a>  > VIEW RESERVATIONS > $id  <a href=''>EDIT</a>";
              
            $data = ['reservation' => $reservations, 'breadcrums'=>$breadcrums, 'url'=>$url, 'trips'=>$trips, 'additionalService'=>$addService];
            return view('reservation.view_trips_details', $data);
              
        }
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, trips $trips)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\trips  $trips
     * @return \Illuminate\Http\Response
     */
    public function destroy(trips $trips)
    {
        //
    }
}
