<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MemberCartController;
use App\Http\Controllers\MemberCountryController;
use App\Http\Controllers\MemberHotelController;
use App\Http\Controllers\MemberOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Auth::routes();

// general route

// admin route


// user route

Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
});

Route::resource('cart', MemberCartController::class);
Route::resource('order', MemberOrderController::class);

Route::prefix('country')->group(function () {
    Route::get('/{flag_code}', [MemberCountryController::class, 'index'])->name('member.country.index');
});

Route::prefix('hotel')->group(function () {
    Route::get('/{flag_code}/{id}', [MemberHotelController::class, 'index'])->name('member.hotel.index');
});
