<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Hotel;
use Illuminate\Http\Request;

class LandingController extends Controller {
    public function index() {
        $hotel = Hotel::get();
        $country = country::get();
        return view('welcome', compact('hotel', 'country'));
    }
}
