<?php

use App\Http\Controllers\AdminAdminController;
use App\Http\Controllers\AdminCancellationController;
use App\Http\Controllers\AdminCountryController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminHotelController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPointController;
use App\Http\Controllers\AdminTopupController;
use App\Http\Controllers\AdminWithdrawController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MemberCartController;
use App\Http\Controllers\MemberCountryController;
use App\Http\Controllers\MemberHotelController;
use App\Http\Controllers\MemberOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopWDController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('hotels', [LandingController::class, 'hotels'])->name('hotels');

Auth::routes();

// admin route

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['permission:dashboard'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    });
    Route::resource('admin', AdminAdminController::class);
    Route::resource('member', AdminMemberController::class);
    Route::resource('hotel', AdminHotelController::class);
    Route::resource('country', AdminCountryController::class);
    Route::resource('order', AdminOrderController::class);

    Route::resource('deposit', AdminTopupController::class);
    Route::resource('withdraw', AdminWithdrawController::class);
    Route::resource('point', AdminPointController::class);
    Route::resource('cancellation', AdminCancellationController::class);
});

Route::prefix('maintenance')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/down', function () {
        Artisan::call('down');
        return redirect()->back();
    });

    Route::get('/up', function () {
        Artisan::call('up');
        return redirect(route('landing'));
    });
});

// user route
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('account', [ProfileController::class, 'account'])->name('account');
    });

    Route::resource('cart', MemberCartController::class);
    Route::resource('order', MemberOrderController::class);

    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('pembayaran', [TopWDController::class, 'paymentIndex'])->name('pembayaran.index');
        Route::get('top-up', [TopWDController::class, 'topupIndex'])->name('topup.index');
        Route::get('withdraw', [TopWDController::class, 'withdrawIndex'])->name('wd.index');
    });

    Route::prefix('country')->group(function () {
        Route::get('/{flag_code}', [MemberCountryController::class, 'index'])->name('member.country.index');
    });

    Route::prefix('hotel')->group(function () {
        Route::get('/{flag_code}/{id}', [MemberHotelController::class, 'index'])->name('member.hotel.index');
    });
});
