<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'Modules_controller@index')->name('home');

Route::get('/maintenance/{url}', 'Galooli@index')->name('maintenance.url');
Route::post('/savejson/asobject', 'Galooli@galooliSave')->name('savejson.asobject');

Auth::routes();


Route::group(['middleware' => 'auth'], function(){

/////////////////////////////////////MODULES ROUTES - SOM///////////////////////

Route::get('/', 'Modules_controller@index')->name('');
Route::get('/maintenance/galooli/{url}', 'Galooli@maintenanceRequest')->name('maintenance.galooli.url');
Route::get('/reservation/{url}', 'ReservationController@index')->name('reservation.url');


///////////////////////////////////// END OF MODULES ROUTES - SOM///////////////////////


//////////////////////////////////////RESERVATION ///////////////////////////////////////
Route::get('/add/trips/{num}', 'TripsController@index')->name('add.trips');
Route::get('/all/{url}', 'ReservationController@listall')->name('all.url');
Route::get('/reservation/tripdetails/{id}', 'TripsController@show')->name('reservation.tripdetails');
Route::get('/reservation/edit/{id}', 'TaskControllerController@edit')->name('reservation.edit');


Route::post('/reserve/store', 'ReservationController@store')->name('reserve.store');
Route::post('/trip/save', 'TripsController@store')->name('trip.save');
Route::post('/get/clientdetails', 'OfficeController@get')->name('get.clientdetails');
Route::post('/get/contactname', 'OfficeController@getcontact')->name('get.contactname');
Route::post('/get/price', 'LocationCostController@show')->name('get.price');

///////////////////////////////////////END OF RESERVATION ////////////////////////////////

//////////////////////////////////////TASK ///////////////////////////////////////
Route::get('/populate/{url}', 'TaskControllerController@index')->name('populate');

///////////////////////////////////////END OF TASK ////////////////////////////////



















Route::get('/asset', 'AssetController@index')->name('asset');
Route::get('/asset/addnew', 'AssetController@create')->name('asset.addnew');
Route::get('/asset/edit/{id}/{slug}', 'AssetController@edit')->name('asset.edit');
Route::get('/asset/show/{id}/{slug}', 'AssetController@show')->name('asset.show');

Route::post('/asset/store', 'AssetController@store')->name('asset.store');
Route::post('/asset/update/{id}', 'AssetController@update')->name('asset.update');


/////////////////////////////////////ADMINISTRATIVE ROUTES///////////////////////
Route::get('/contract/type', 'ContractypeController@index')->name('contract.type');
Route::get('/contract/owner', 'OwnerController@index')->name('contract.owner');
Route::get('/contract/client', 'ClientController@index')->name('contract.client');
Route::get('/settings', 'Settings@index')->name('settings');
Route::get('/contract/client', 'ClientController@index')->name('contract.client');
Route::get('/display/{url}', 'Modules_controller@display')->name('display.url');
Route::get('/index/{url}', 'Modules_controller@index')->name('index.url');
Route::get('/vessel/{url}', 'AssetutilizationController@index')->name('vessel.url');


/////////////////////////////////////GALOOLI ROUTES///////////////////////
Route::post('/getVehicles/{url}/{matchItem}', 'Modules_controller@check')->name('getVehicles.url');



///////////////////////////MODULES DEFAULT SETTINGS ///////////////////////////////
Route::get('/form/{url}', 'Modules_controller@form')->name('form.url');
Route::get('/form/edit/{url}/{id}', 'Modules_controller@edit')->name('form.edit');
Route::get('/form/detail/{url}/{id}', 'Modules_controller@show')->name('form.detail');

Route::get('/utilize/{url}/{id}/{tabItem}/{tabItemID}', 'Modules_controller@showutilization')->name('utilize');


Route::get('/mail/config', 'Settings@mailconfig')->name('mail.config');
Route::post('/getfuel/{id}', 'FueltypeController@index')->name('getfuel');


Route::post('/modules/store/', 'Modules_controller@store')->name('modules.store');
Route::post('/modules/push', 'Modules_controller@createrequest')->name('modules.push');
//Route::post('/modules/edit/{id}', 'Modules_controller@update')->name('modules.edit');
Route::post('/modules/edit', 'Modules_controller@update')->name('modules.edit');
Route::post('/modules/multistore', 'Modules_controller@multistore')->name('modules.multistore');
Route::post('/modules/multiuploads', 'Modules_controller@multiuploads')->name('modules.multiuploads');

Route::post('/contract/store', 'ContractypeController@store')->name('contract.store');
Route::post('/owner/add', 'OwnerController@store')->name('owner.add');
Route::post('/client/add', 'ClientController@store')->name('client.add');

//Route::get('/help', 'WelcomeController@help')->name('help');
//Route::post('/transaction/store', 'TransactionController@store')->name('transaction.store');

//////////////////////////////////// EMAIL SETTINGS ADMIN /////////////////////////////////////
Route::get('/email/notify', 'EmailController@notify')->name('email.notify');
Route::post('/email/store/{key}', 'EmailController@store')->name('email.store');

Route::get('/getallgalaloolivehicles', 'Galooli@assetReport')->name('getallgalaloolivehicles');
Route::post('/postformaintenance', 'Galooli@store')->name('postformaintenance');

});
