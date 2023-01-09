<?php


use App\Http\Controllers\api\V1\AccountController;
use App\Http\Controllers\api\V1\AppointmentController;
use App\Http\Controllers\api\V1\BookingController;
use App\Http\Controllers\api\V1\counseling_ExpertController;
use App\Http\Controllers\api\V1\counselingController;
use App\Http\Controllers\api\V1\ExpertController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Login
Route::post('/login', [AuthController::class, 'login']);

// Register
Route::post('/register', [AuthController::class, 'register']);

//
Route::prefix('admin')->group(function (){
    // Expert Routes
    Route::prefix('expert')->group(function (){
        // All Experts
        Route::get('/',[ExpertController::class,'index']);
        // create Expert
        Route::post('/store',[ExpertController::class,'store']);
        // Show Expert Appointments
        Route::get('/show_my_appointment',[ExpertController::class,'show_MyAppointments']);
    });

    // Appointment Routes
    Route::prefix('appointment')->group(function (){
        // All Appointments
        Route::get('/',[AppointmentController::class,'index']);
        // create Appointment
        Route::post('/store',[AppointmentController::class,'store']);
    });

    // counseling Routes
    Route::prefix('counseling')->group(function (){
        // All Counselings
        Route::get('/',[counselingController::class,'index']);
        // create Counseling
        Route::post('/store',[counselingController::class,'store']);
    });

    // counseling_Expert Routes
    Route::prefix('counseling_expert')->group(function (){

        Route::get('/',[counseling_ExpertController::class,'index']);
        // Many Experts To Many Counseling
        Route::post('/store',[counseling_ExpertController::class,'store']);
    });

    // Average Evaluation
    Route::get('/average_evaluation/{id}',[ExpertController::class,'average']);

});


// User Routes
Route::prefix('user')->group(function (){
    // Search Expert_Name
    Route::get('/search/{expert_name}',[ExpertController::class,'Search_name']);

    // Search counseling_Name
    Route::get('/search/{counseling_name}',[counselingController::class,'Search_name']);

    // input = id_counseling => output = Experts
    Route::get('/show_experts/{id_counseling}',[counseling_ExpertController::class,'show_experts']);
    // input = id_expert => output = Counselings
    Route::get('/show_counselings/{id_expert}',[counseling_ExpertController::class,'show_counseling']);

    // input = id_expert => output = Appointment
    Route::get('/show_appointment/{id_expert}',[ExpertController::class,'show_Appointment']);

    // Booking Appointment
    Route::prefix('booking')->group(function (){
        Route::get('/',[BookingController::class,'index']);
        Route::post('/store',[BookingController::class,'store']);
    });

    // Payment
    Route::post('/payment',[AccountController::class,'Payment']);

    // Evaluation
    Route::get('/evaluation',[ExpertController::class,'Evaluation']);


});

// Account Route
Route::prefix('account')->group(function (){
    // All Accounts
    Route::get('/',[AccountController::class,'index']);
    // Create Account
    Route::post('/store',[AccountController::class,'store']);
});



