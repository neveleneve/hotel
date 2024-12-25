<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;

class MemberCountryController extends Controller {
    public function index($flag_code) {
        $country = country::where('flag_code', $flag_code)->first();

        return view('pages.member.country.index', compact('country'));
    }
}
