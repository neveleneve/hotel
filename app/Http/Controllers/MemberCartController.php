<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class MemberCartController extends Controller {
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
        $total_day = (strtotime($cart->check_out) - strtotime($cart->check_in)) / (60 * 60 * 24);
        if ($cart->hotel->promo) {
            $total = ($cart->hotel->price * $cart->total_room * $total_day) - ($cart->hotel->price * $cart->total_room * $total_day * $cart->hotel->discount / 100);
        } else {
            $total = $cart->hotel->price * $cart->total_room * $total_day;
        }
        $order = Order::create([
            'order_code' => strtoupper($cart->hotel->country->flag_code) . '/' . date('ymdHi') . '/' . str_pad($cart->user_id, 4, "0", STR_PAD_LEFT) . '/' . strtoupper(uniqid()),
            'user_id' => $cart->user_id,
            'hotel_id' => $cart->hotel_id,
            'check_in' => $cart->check_in,
            'check_out' => $cart->check_out,
            'total_room' => $cart->total_room,
            'total' => $total,
        ]);
        if ($order) {
            $cart->delete();
            return redirect()->route('order.index')->with([
                'title' => 'Berhasil',
                'text' => 'Berhasil menambah pesanan!',
                'icon' => 'success',
            ]);
        } else {
            return redirect()->back()->with([
                'title' => 'Gagal',
                'text' => 'Gagal menambah pesanan!',
                'icon' => 'error',
            ]);
        }
    }

    public function destroy(Cart $cart) {
        $delete = $cart->delete();
        if ($delete) {
            return redirect()->back()->with([
                'title' => 'Berhasil',
                'text' => 'Berhasil menghapus daftar keranjang!',
                'icon' => 'success',
            ]);
        } else {
            return redirect()->back()->with([
                'title' => 'Gagal',
                'text' => 'Gagal menghapus daftar keranjang!',
                'icon' => 'error',
            ]);
        }
    }
}
