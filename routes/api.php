<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::namespace ('Api')->middleware(['throttle'])->group(function () {
    
//});

//URL http://localhost:8081/api/v1/getUser
Route::group(['prefix' => 'v2'], function ()
{
   Route::get('/db', 'API\AssetAPI@getallasset')->name('db');
});



//URL http://localhost:8081/api/v1/getUser
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function ()
{
    Route::get('getUser', 'API\CardispatcherAPI@getUser');
});

Route::middleware('api')->group( function () {
    //return $request->user();
    //Route::get('/allasset', 'API\AssetAPI@getallasset')->name('allasset');
   // Route::post('/login', 'API\CardispatcherAPI@login')->name('login');
    Route::post('/mlogin', 'API\CardispatcherAPI@mlogin')->name('mlogin');
     Route::post('/anlogin', 'API\APIMobileWeb@anlogin')->name('anlogin');
   // Route::post('/logout', 'API\CardispatcherAPI@logout')->name('logout');
    
    //for mobile
     //Route::post('/mobilelogin', 'API\CardispatcherAPI@mobilelogin')->name('mobilelogin');
    //Route::get('/frontpage/{token}', 'API\CardispatcherAPI@frontpage')->name('frontpage.token');
    Route::get('/frontpage/{token}', 'API\CardispatcherAPI@frontpage')->name('frontpage.token');
    
});

  //Route::get('/frontpage/{token}', 'API\CardispatcherAPI@frontpage')->name('frontpage.token');
//Route::get('/aat', 'API\AssetAPI@getallasset');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

