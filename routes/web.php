<?php

use App\Http\Controllers\AdminCountryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminHotelController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\AdminOrderController;
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
Route::get('hotels', [LandingController::class, 'hotels'])->name('hotels');

Auth::routes();

// general route

// admin route

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['permission:dashboard'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
    Route::resource('member', AdminMemberController::class);
    Route::resource('hotel', AdminHotelController::class);
    Route::resource('country', AdminCountryController::class);
    Route::resource('order', AdminOrderController::class);
});

// user route

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('account', [ProfileController::class, 'account'])->name('account');
    });

    Route::resource('cart', MemberCartController::class);
    Route::resource('order', MemberOrderController::class);

    Route::prefix('country')->group(function () {
        Route::get('/{flag_code}', [MemberCountryController::class, 'index'])->name('member.country.index');
    });

    Route::prefix('hotel')->group(function () {
        Route::get('/{flag_code}/{id}', [MemberHotelController::class, 'index'])->name('member.hotel.index');
    });
});
