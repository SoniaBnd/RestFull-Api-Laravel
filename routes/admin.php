<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
 /*Route::group([
  'middleware' => 'web',
]
  , function () {*/
/*Route::get('admin/login','App\Http\Controllers\Auth\AdminAuthController@getLogin')->name('adminLogin');
Route::post('admin/login', 'App\Http\Controllers\Auth\AdminAuthController@postLogin')->name('adminLoginPost');
Route::get('admin/logout', 'App\Http\Controllers\Auth\AdminAuthController@logout')->name('adminLogout');
// });
Route::group(['prefix' => 'admin','middleware' => 'adminauth'], function () {
	// Admin Dashboard
	Route::get('dashboard','AdminController@dashboard')->name('dashboard');	
});*/