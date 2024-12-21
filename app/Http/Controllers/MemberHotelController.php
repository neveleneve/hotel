<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\Hotel;
use Illuminate\Http\Request;

class MemberHotelController extends Controller {
    public function index($flag_code, $id) {
        $country = country::where('flag_code', $flag_code)->first();
        $data = $country->hotel->find($id);
        if ($data) {
            $hotel = Hotel::find($id);
            return view('pages.member.hotel.index', compact('hotel'));
        } else {
            return redirect()->route('landing');
        }
    }
}
