<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

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

Route::get('/calendar',[CalendarController::class,'index'])->name('home');
Route::get('/calendar/{id}',[CalendarController::class,'find'])->name('find');
Route::post('/calendar/create',[CalendarController::class,'store'])->name('store');
Route::post('/calendar/update/{id}',[CalendarController::class,'update'])->name('update');
Route::delete('/calendar/{id}',[CalendarController::class,'delete'])->name('delete');


