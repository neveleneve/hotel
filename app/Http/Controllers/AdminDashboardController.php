<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller {
    public function index() {
        $hotels = Hotel::count();
        $countries = country::count();
        $members = User::role('member')->count();
        $payments = Order::sum('total');
        return view('pages.admin.dashboard.index', compact('hotels', 'countries', 'members', 'payments'));
    }
}
