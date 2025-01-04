<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\TopUp;
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
            $payments = TopUp::where('type', 'deposit')->sum('amount') - TopUp::where('type', 'withdraw')->sum('amount');
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
            $payments = TopUp::whereIn('user_id', $memberIds)
                        ->where('type', 'deposit')
                        ->sum('amount') - 
                      TopUp::whereIn('user_id', $memberIds)
                        ->where('type', 'withdraw')
                        ->sum('amount');
        }

        return view('pages.admin.dashboard.index', compact(
            'hotels',
            'countries',
            'members',
            'payments'
        ));
    }
}
