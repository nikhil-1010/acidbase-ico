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
Route::get('/whitelist-account',[AdminController::class,'getWhitelistAccount']);
Route::get('/profile',[AdminController::class,'getProfile']);
Route::get('/transaction',[AdminController::class,'getTransaction']);
Route::get('/faq',[AdminController::class,'getFaq']);
Route::get('/settings',[AdminController::class,'getSettings']);
Route::get('/contacts',[AdminController::class,'getContacts']);
Route::get('/site-content',[AdminController::class,'getSiteContent']);
Route::get('logout',[AdminController::class,'getLogout']);

// //post route
Route::post('/login',[AdminController::class,"postLogin"]);
Route::post('/change-password',[AdminController::class,"postChangePassword"]);
Route::post('/update-profile',[AdminController::class,"postUpdateProfile"]);
Route::post('/save-settings',[AdminController::class,'postSaveSettings']);
Route::post('/whitelist-filter',[AdminController::class,'postWhitelistFilter']);
Route::post('/transaction-filter',[AdminController::class,'postTransactionFilter']);
Route::post('/faq-filter',[AdminController::class,'postFaqFilter']);
Route::post('/contact-filter',[AdminController::class,'postContactFilter']);
Route::post('/add-faq',[AdminController::class,'postAddFaq']);
Route::post('/site-content-filter',[AdminController::class,'postSiteContentFilter']);
Route::post('/change-maintenance-mode',[AdminController::class,'postChangeMaintenanceMode']);
Route::post('/get-content',[AdminController::class,'postGetContent']);
Route::post('/set-content',[AdminController::class,'postSetContent']);
