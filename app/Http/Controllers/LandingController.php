<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Hotel;
use Illuminate\Http\Request;

class LandingController extends Controller {
    public function index() {
        $country = country::orderBy('name')->get();
        return view('welcome', compact('country'));
    }

    public function hotels() {
        return view('hotel');
    }
}
