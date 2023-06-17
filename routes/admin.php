<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
//get route
Route::get('/login/{sec_token}',[AdminController::class,"getLogin"]);
Route::get('/dashboard',[AdminController::class,'getDashboard']);
Route::get('/profile',[AdminController::class,'getProfile']);
Route::get('/settings',[AdminController::class,'getSettings']);
Route::get('logout',[AdminController::class,'getLogout']);

// //post route
Route::post('/login',[AdminController::class,"postLogin"]);
Route::post('/change-password',[AdminController::class,"postChangePassword"]);
Route::post('/update-profile',[AdminController::class,"postUpdateProfile"]);
Route::post('/save-settings',[AdminController::class,'postSaveSettings']);
