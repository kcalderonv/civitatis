<?php

use App\Http\Controllers\ActividadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservaController;
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

Route::get('/actividades',[ActividadController::class,'index']);
Route::get('/actividades/{id}',[ActividadController::class,'show']);
Route::post('/search',[ActividadController::class,'search']);

Route::get('/user',[AuthController::class,'user']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/registro',[AuthController::class,'registro']);


Route::middleware(['auth'])->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/reservar',[ReservaController::class,'store']);
    Route::post('/reservas',[ReservaController::class,'index']);
});


Route::get('/{any}',function (){
    return view('app');
})->where('any','.*');

