<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Hotel;
use Illuminate\Http\Request;

class LandingController extends Controller {
    public function index() {
        $hotel = Hotel::orderBy('rating', 'desc')->get();
        $country = country::orderBy('name')->get();
        return view('welcome', compact('hotel', 'country'));
    }

    public function hotels() {
        $hotel = Hotel::orderBy('rating', 'desc')->get();
        return view('pages.hotel', compact('hotel'));
    }
}
