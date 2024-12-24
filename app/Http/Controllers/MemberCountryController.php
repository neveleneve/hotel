<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;

class MemberCountryController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index($flag_code) {
        $country = country::where('flag_code', $flag_code)->first();
        $hotel = $country->hotel()->orderBy('rating', 'desc')->get();
        return view('pages.member.country.index', compact('hotel',  'country'));
    }
}
