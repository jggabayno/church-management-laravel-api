<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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

Route::post('/login', 'LoginController@index');
Route::post('/register', 'RegisterController@index');
Route::put('/resetpassword/{user}', 'ResetPasswordController@index');

Route::group(['middleware' => 'auth:api'], function() {
    
    Route::post('imageupload', 'ImageUploadController@index');
    Route::post('fileupload', 'FileUploadController@index');


    Route::get('/usertypes', 'UserTypeController@index');

    Route::get('/profile', 'UserController@profile');

    Route::get('/users', 'UserController@index');
    Route::post('/users', 'UserController@store');
    Route::put('/users/{user}', 'UserController@update');
    Route::delete('/users/{user}', 'UserController@destroy');

    Route::get('/user/positions', 'UserPositionController@index');

    Route::get('/weddings', 'WeddingController@index');
    Route::post('/weddings', 'WeddingController@store');
    Route::put('/weddings/{wedding}', 'WeddingController@update');

    Route::get('/baptisms', 'BaptismController@index');
    Route::post('/baptisms', 'BaptismController@store');
    Route::put('/baptisms/{baptism}', 'BaptismController@update');

    Route::get('/activities', 'ActivityController@index');
    Route::post('/activities', 'ActivityController@store');
    Route::put('/activities/{activity}', 'ActivityController@update');
    Route::delete('/activities/{activity}', 'ActivityController@destroy');

    Route::get('/actofgivings', 'ActOfGivingController@index');
    Route::post('/actofgivings', 'ActOfGivingController@store');
    Route::put('/actofgivings/{act_of_giving}', 'ActOfGivingController@update');
    Route::delete('/actofgivings/{act_of_giving}', 'ActOfGivingController@destroy');

    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/activitylogs', 'ActivityLogController@index');

    Route::get('/servicefee', 'ServiceFeeController@index');
    Route::post('/servicefee', 'ServiceFeeController@store');
    Route::put('/servicefee/{service_fee}', 'ServiceFeeController@update');

    Route::get('/payments', 'PaymentDetailController@index');

    Route::get('/expenses', 'ExpenseController@index');
    Route::post('/expenses', 'ExpenseController@store');
    Route::put('/expenses/{expense}', 'ExpenseController@update');
    Route::delete('/expenses/{expense}', 'ExpenseController@destroy');

});