<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use App\Trip;
use Carbon\Carbon;

class APIMobileWeb extends Controller {

    //API for Mobile
    /////////////////////////////////////// PUSH LOGIN OTHER WITH BEARER AND EXPIRE/ /////////////////////////
    public $successStatus = 200;

    public function mlogin(Request $request) {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                        'message' => 'Unauthorized'
                             ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken($user);
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
                    'success' => $this->successStatus,
                    'Authorization' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                            $tokenResult->token->expires_at
                    )->toDateTimeString()
        ]);
    }

    ////////////////////////////////////// FRONT VIEW /////////////////////////////////////////////////////////////
    public function frontpage($token) {
        // break up the string to get just the token
        $auth_header = explode(' ', $token);


        $token = $auth_header[0];
        // break up the token into its three parts
        $token_parts = explode('.', $token);
        $token_header = $token_parts[0];

        // base64 decode to get a json string
        $token_header_json = base64_decode($token_header);
        // you'll get this with the provided token:
        // {"typ":"JWT","alg":"RS256","jti":"9fdb0dc4382f2833ce2d3993c670fafb5a7e7b88ada85f490abb90ac211802720a0fc7392c3f2e7c"}
        // then convert the json to an array
        $token_header_array = json_decode($token_header_json, true);

        $user_token = $token_header_array['jti'];

        // find the user ID from the oauth access token table
        // based on the token we just got
        $user_id = DB::table('oauth_access_tokens')->where('id', $user_token)->value('user_id');

        // then retrieve the user from it's primary key
        $user = User::findOrFail($user_id);

        //Get the Trip Information
        $trips = DB::table('trips')->where('logged_by', $user_id)->get();

        return response()->json(['success' => $user, 'trips' => $trips], $this->successStatus);
    }
    
    
    
 /////////////////////////////////////////////////// ANDRIOD LOGIN ////////////////////////////////////////////
    
    public function anlogin(Request $request) {
         $result['login'] = array();
         //$result['ltrip'] = array();
         
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([ 'success' => '0', 'message' => "error" ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken($user);
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
       
        $index['name'] =  User::where("email", $request->email)->value('name');
        $index['email'] =  User::where("email", $request->email)->value('email');
        
        //Get the Trip Information
        $trips = DB::table('trips')->where('email_address', $index['email'] )->get();
        $tripCount = count($trips);
        
        $trip_id = ""; $p_Name = "" ; $p_phone = ""; $departure = ""; $destination = "";
        $end_date_time = ""; $pick_up_date_time = ""; $service_type = ""; $driver = "";
        $vehicle_id = ""; $trip_status = "";  $email_address = "";
      //Get the Trip Information
        $latestTrips = Trip::select('*')->where('email_address', $index['email'])->latest()->limit(1)->get()->toArray();
        if($latestTrips){
            foreach($latestTrips as $get){
                $trip_id = $get->trip_id;
                $p_Name = $get->passenger_names;
                $p_phone = $get->passenger_phone_numbers;
                $departure = $get->departure;
                $destination = $get->destination;
                $end_date_time = $get->end_date_time;
                $pick_up_date_time = $get->pick_up_date_time;
                $service_type = $get->service_type;
                $driver = $get->driver;
                $vehicle_id = $get->vehicle_id;
                $trip_status = $get->trip_status;
                $email_address = $get->email_address;
            }
        }
        
       //array_push($result['ltrip'], $latestTrips);
       //print_r($latestTrips);
        //return;
        
        array_push($result['login'], $index);
        $result['success'] = 1;
        $result['tripcount'] = $tripCount;
        $result['Authorization'] = $tokenResult->accessToken;
         $result['message'] = "success";
         
         //The Trip Begins Here
         $result['tripID'] = $trip_id;
         $result['pName'] = $p_Name;
         $result['phone'] = $p_phone;
         $result['departure'] = $departure;
         $result['destination'] = $destination;
         $result['end_date'] = $end_date_time;
         $result['pick_up'] = $pick_up_date_time;
         $result['service_type'] = $service_type;
         $result['driver'] = $driver;
         $result['vehicle'] = $vehicle_id;
         $result['trip_status'] = $trip_status;
         $result['email_address'] = $email_address;
         
         
         
        echo json_encode($result);
         
        /* return response()->json([
            'success' => 1,
            'message' => "success",
            'name' => User::where("email", $request->email)->value('name'),
            'email' => User::where("email", $request->email)->value('name'),
            'login' => ["name" => User::where("email", $request->email)->value('name'), 'email' => User::where("email", $request->email)->value('name')],
            //'name' => User::where("email", $request->email)->value('name'),
            //'email' => $request->email,
            'Authorization' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]); 
        */
    }
    
////////////////////////////////////////////////// END OF ANDRIOD LOGIN ////////////////////////////////////////

}
