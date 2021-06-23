<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Route::middleware(['guest:admin'])->group(function() {
        Route::view('/login', 'auth.login')->name('login');
        Route::post('/login', [AuthController::class, 'store']);
    });


Route::middleware(['auth:admin'])->group(function(){
    
    Route::view('/', 'home')->name('dashboard');
    Route::view('/home', 'home')->name('home');

    //Category controller 
    Route::resource('/category',CategoryController::class)->except('show','create');

    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});


