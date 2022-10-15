<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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