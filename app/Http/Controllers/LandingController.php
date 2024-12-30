<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller {
    public function index() {
        $country = country::orderBy('name')->get();
        $activeProjects = null;

        if (Auth::check() && Auth::user()->hasRole('member')) {
            $activeProjects = Auth::user()->memberMessages()
                ->where('active', true)
                ->with('hotel.country')
                ->get();
        }

        return view('welcome', compact('country', 'activeProjects'));
    }

    public function hotels() {
        return view('hotel');
    }
}
