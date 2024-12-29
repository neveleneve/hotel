<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller {
    public function __construct() {
        $this->middleware('permission:dashboard');
    }

    public function index() {
        if (auth()->user()->hasRole('super admin')) {
            $hotels = Hotel::count();
            $countries = country::count();
            $members = User::role('member')->count();
            $payments = Order::where('status_bayar', true)->sum('total');
        } else {
            $referralCode = auth()->user()->ownReff->reff_code;
            $memberIds = User::role('member')
                ->whereHas('reffBy', function ($query) use ($referralCode) {
                    $query->whereHas('ownReff', function ($q) use ($referralCode) {
                        $q->where('reff_code', $referralCode);
                    });
                })
                ->pluck('id');
            $hotels = Hotel::count();
            $countries = country::count();
            $members = count($memberIds);
            $payments = Order::whereIn('user_id', $memberIds)->where('status_bayar', true)->sum('total');
        }

        return view('pages.admin.dashboard.index', compact(
            'hotels',
            'countries',
            'members',
            'payments'
        ));
    }
}
