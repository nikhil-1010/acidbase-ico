<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[SiteController::class,"getHome"]);
Route::get('/portfolio',[SiteController::class,"getPortfolio"]);
Route::get('/trasaction-notify',[SiteController::class,"getTransactionNotify"]);
Route::get('/get-past-events',[SiteController::class,"getPastEvents"]);

Route::post('/seed-trasaction-filter',[SiteController::class,"postSeedTransactionFilter"]);
Route::post('/private-trasaction-filter',[SiteController::class,"postPrivateTransactionFilter"]);
Route::post('/public-trasaction-filter',[SiteController::class,"postPublicTransactionFilter"]);
Route::post('/add-transaction',[SiteController::class,"postAddTransaction"]);
Route::post('/check-whitelist',[SiteController::class,"postCheckWhitelist"]);
Route::post('/add-whitelist',[SiteController::class,"postAddWhitelist"]);
Route::post('event/add-investor-event',[SiteController::class,"postAddInvestorEvent"]);

Route::get('/test',[SiteController::class,"postTest"]);
