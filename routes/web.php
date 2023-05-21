<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailVerifyController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\RealtorListingAcceptOfferController;
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

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listing', ListingController::class)->only(['index','show']);
Route::resource('listing.offer', ListingOfferController::class)->middleware('auth')->only(['store']);

// Notification
Route::resource('notification', NotificationController::class)->middleware('auth')->only(['index']);
Route::put('notification/{notification}/seen', NotificationSeenController::class)->middleware('auth')->name('notification.seen');

// User
Route::resource('user-account', UserAccountController::class)->only(['create','store']);

// Authentication
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');


// Email Verification
Route::get('/email/verify', [EmailVerifyController::class, 'notVerifiedYet'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}',[EmailVerifyController::class, 'verifiedEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerifyController::class, 'resendEmailVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Realtor listing
Route::prefix('realtor')
    ->name('realtor.')
    ->middleware(['auth','verified'])
    ->group(function () {
      Route::name('listing.restore')->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->withTrashed();
      Route::resource('listing', RealtorListingController::class)
      // ->only(['index','destroy','edit','update','create','store','show'])
      ->withTrashed();

      Route::name('offer.accept')
            ->put(
              'offer/{offer}/accept', 
              RealtorListingAcceptOfferController::class
            );

      Route::resource('listing.image', RealtorListingImageController::class)->only(['create','store','destroy']);
});