<?php

use App\Http\Controllers\ActividadController;
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
Route::get('/actividades/{actividad}',[ActividadController::class,'show']);

Route::get('/{any}',function (){
    return view('app');
})->where('any','.*');

