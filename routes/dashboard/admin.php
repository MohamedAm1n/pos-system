<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group([
	'prefix' =>LaravelLocalization::setLocale() .'/dashboard' ,
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ,'auth'],

],function(){

    Route::get('/admin',[DashboardController::class,'index'])->name('dashboard.index');

    // Users Route 
    Route::resource('/users',UserController::class)->except('show');

    // Categories Route
    Route::resource('/categories',CategoryController::class)->except('show');
});

