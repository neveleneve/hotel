<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class MemberCartController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $carts = Cart::with('hotel')
            ->where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.member.cart.index', compact('carts'));
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(Cart $cart) {
        //
    }

    public function edit(Cart $cart) {
        //
    }

    public function update(Request $request, Cart $cart) {
        //
    }

    public function destroy(Cart $cart) {
        dd($cart);
    }
}
