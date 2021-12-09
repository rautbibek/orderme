<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'homeIndex'])->name('welcome');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::get('/product/{slug}', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'productDetail'])->name('product.detail');

Route::get('/category/{slug}', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'categoryPage'])->name('category');

Route::get('/collection/{slug}', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'collectionPage'])->name('collection');

Route::get('/page/{slug}', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'pageView'])->name('page');
Route::get('/service/{slug}', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'serviceView'])->name('service');
Route::get('/brand/{slug}', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'brandView'])->name('brand');


Route::get('/search', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'searchPage'])->name('search');
Route::get('/cart', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'cartAction'])->name('cart');
Route::post('/add-to-cart', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'addToCartAction'])->name('addToCart');
Route::post('/update-cart', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'updateCartAction'])->name('update.cart');
Route::get('/experts/{slug}', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'expertView'])->name('experts.detail');

Route::get('/logout',function(){
    auth()->logout();
});