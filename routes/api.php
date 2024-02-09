<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConsultationScheduleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GeneralConsultationController;
use App\Http\Controllers\EmployeeSheduleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(SpecieController::class)->prefix('specie')->group(function(){

    Route::get('/','index');
    Route::post('/','store');
    Route::patch('/{id}','update');
    Route::put('/{id}','put');
    Route::get('/{id}','show');
    Route::delete('/{id}','destroy');


});

Route::controller(PetController::class)->prefix('pet')->group(function(){

    Route::get('/','index');
    Route::post('/','store');
    Route::patch('/{id}','update');
    Route::put('/{id}','put');
    Route::get('/{id}','show');
    Route::delete('/{id}','destroy');


});

Route::controller(ClientController::class)->prefix('client')->group(function(){

    Route::get('/','index');
    Route::post('/','store');
    Route::patch('/{id}','update');
    Route::put('/{id}','put');
    Route::get('/{id}','show');
    Route::delete('/{id}','destroy');


});

Route::controller(ConsultationScheduleController::class)->prefix('consultationschedule')->group(function(){

    Route::get('/','index');
    Route::post('/','store');
    Route::patch('/{id}','update');
    Route::put('/{id}','put');
    Route::get('/{id}','show');
    Route::delete('/{id}','destroy');


});

Route::controller(EmployeeController::class)->prefix('employee')->group(function(){

    Route::get('/','index');
    Route::post('/','store');
    Route::patch('/{id}','update');
    Route::put('/{id}','put');
    Route::get('/{id}','show');
    Route::delete('/{id}','destroy');


});

Route::controller(GeneralConsultationController::class)->prefix('generalconsultation')->group(function(){

    Route::get('/','index');
    Route::post('/','store');
    Route::patch('/{id}','update');
    Route::put('/{id}','put');
    Route::get('/{id}','show');
    Route::delete('/{id}','destroy');


});



