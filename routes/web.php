<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;

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


Route::get('/', [App\Http\Controllers\User::class, 'home'])->name('home');
Route::get('/home', [App\Http\Controllers\User::class, 'home']);
Route::post('/store', [App\Http\Controllers\User::class, 'store'])->name('store');
Route::get('/cekdok-lp', [App\Http\Controllers\AuthController::class, 'login'])->middleware('guest')->name('login');

Route::get('/pdf', [App\Http\Controllers\User::class, 'generatePDF'])->name('pdf');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'log'])->name('log');
Route::get('/data/{reg}/{doc}', [App\Http\Controllers\User::class, 'data'])->name('data');
Route::get('/dok/{formulir}', [App\Http\Controllers\FormulirController::class, 'show'])->name('dok');
Route::get('/data-formulir/{val}', [App\Http\Controllers\User::class, 'formulir'])->name('qr');
Route::get('/reload-captcha', [App\Http\Controllers\AuthController::class, 'reloadCaptcha']);

Route::group(['middleware' => 'auth'], function() {    
    Route::post('/village', [App\Http\Controllers\User::class, 'village'])->name('village');
    Route::get('/filter', [App\Http\Controllers\User::class, 'sort'])->name('filter');    
    Route::resource('formulir', App\Http\Controllers\FormulirController::class);        
});

Route::group(['middleware' => ['auth','user']], function() {    
    Route::group(['prefix'=>'user'],function(){
        Route::get('/', [App\Http\Controllers\User::class, 'index'])->name('user');                
        Route::get('/edit/{id}', [App\Http\Controllers\user::class, 'edit'])->name('userEdit');
        Route::post('/update/{id}', [App\Http\Controllers\user::class, 'update'])->name('userUpdate');        
    });
});

Route::group(['middleware' => ['auth','admin']], function() {    
    Route::group(['prefix'=>'dashboard'],function(){
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');                                                
        Route::resource('user', App\Http\Controllers\UserController::class);     
        Route::resource('district', App\Http\Controllers\DistrictController::class);    
        Route::resource('village', App\Http\Controllers\VillageController::class);                                                        
        Route::get('/export', [App\Http\Controllers\DashboardController::class, 'export'])->name('export');    
        Route::post('/import', [App\Http\Controllers\DashboardController::class, 'import'])->name('import');     
    });
});
