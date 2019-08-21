<?php

namespace App\Http\Controllers\Auth;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function credentials(Request $request)
    {
        //$match = ['email'=>$request->{$this->username()}];
        //$updateID = App\User::where($match)->value('id');
        $lastLogin = "UPDATE users SET last_logged_in = NOW() WHERE email = '".$request->{$this->username()}."'  AND password = '".bcrypt($request->password)."' AND user_status = 1";
        $lastLogin =  collect(DB::update(DB::raw($lastLogin)));
        //return $request->only($this->username(), 'password');
        return ['email'=>$request->{$this->username()}, 'password' =>$request->password, 'user_status' => '1'];
    }
    
}
