<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;
use Carbon\Carbon;

class CardispatcherAPI extends Controller {

    public $successStatus = 200;

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('AppName')->accessToken;
        return response()->json(['success' => $success], $this->successStatus);
    }

    public function login() {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            
            $success['token'] = $user->createToken($user)->accessToken;
            
            
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function getUser() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
        //return response()->json(['success' => 'OK']);
    }
    
    
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        
      $accessToken = Auth::user()->token();

        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        //$request->user()->token()->revoke();
       /* $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate(); */
        return response()->json([
            'message' => 'Successfully logged out'
        ]); 
    }
    
    
/////////////////////////////////////// PUSH LOGIN OTHER WITH BEARER AND EXPIRE/ /////////////////////////
    
 public function mlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
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
    
    
    public function mobilelogin(){
        
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    
     protected function respondWithToken($token)
    {
        return response()->json([
            'Authorization' => $token,
            'token_type'   => 'bearer',
            //'expires_in'   => auth()->factory()->getTTL() * 60
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    
    
    
    
    public function frontpage($token){
      
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
  
  
  
}
