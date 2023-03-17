<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
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


Route::get('/',[CalendarController::class,'index'])->name('home');
Route::get('/store',[CalendarController::class,'store'])->name('store');
Route::get('/{id}',[CalendarController::class,'find'])->name('find');

