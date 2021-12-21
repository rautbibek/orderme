<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Models\Theme;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');
Route::get('/checkout', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'checkoutAction'], )->middleware('auth')->name('checkout');

Route::get('/checkout-cart', function () {
    session()->put('checkout', 'cart_state');
    return redirect()->route('checkout');
})->name('checkout-cart');

Route::post('/confirm-order', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'addressAction'], )->middleware('auth')->name('confirm.order');
Route::get('/order-completed', [\App\Http\Controllers\FrontendWeb\FrontendController::class, 'orderCompleteAction'])->middleware('auth')->name('complete.order');

Route::get('/auth/google/redirect', function () {
    return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
})->name('google.signup');
Route::get('/google/signup', [AuthenticatedSessionController::class, 'googleSignup']);
Route::get('/auth/facebook/redirect', function () {
    return \Laravel\Socialite\Facades\Socialite::driver('facebook')->redirect();
})->name('facebook.signup');
Route::get('/facebook/signup', [AuthenticatedSessionController::class, 'facebookSignup']);

Route::get('/me', [\App\Http\Controllers\User\DashboardController::class, 'dashboard'])
    ->middleware('auth')->name('user.dashboard');
Route::get('/me/{path?}', [\App\Http\Controllers\User\DashboardController::class, 'dashboard'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
    Route::get('/reference-code', [\App\Http\Controllers\User\DashboardController::class, 'getReference']);
    Route::get('/all-orders', [\App\Http\Controllers\User\DashboardController::class, 'getOrders']);

});
