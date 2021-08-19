<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;

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

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


Route::get('admin/login',[Auth\AdminAuthController::class, 'getLogin'])->name('adminLogin');
Route::post('admin/login', [Auth\AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('admin/logout', [Auth\AdminAuthController::class, 'logout'])->name('adminLogout');

Route::group(['prefix' => 'admin','middleware' => 'adminauth'], function () {
	// Admin Dashboard
	Route::get('dashboard',[AdminController::class, 'dashboard'])->name('dashboard');	
	Route::get('tickets', [TicketController::class, 'index'])->name('listticket');
	Route::get('comments', [CommentController::class, 'index'])->name('listcomment');
	
});
