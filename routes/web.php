<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SitevisitController;

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

//

Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('customer', CustomerController::class);
Route::match(['get', 'post'],'/scheduledate/{id}', [CustomerController::class,'scheduleDate']);

Route::match(['get','post'], '/sitevisitdata_form/{data}', [SitevisitController::class, 'sitevisitdata_form_func']);
Route::match(['get','post'], '/store_sitevisitdata_form', [SitevisitController::class, 'store_sitevisitdata_form_func']);



