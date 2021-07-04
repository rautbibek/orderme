<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
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
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    //Category controller
    Route::resource('/categories',CategoryController::class)->except('show','create');

    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

});
//Route::view('{path}', 'home')->where('path', '([A-z\d\-\/_.]+)?');


