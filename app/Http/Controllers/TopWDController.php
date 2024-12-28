<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopWDController extends Controller {
    public function paymentIndex() {
        $order = Order::where('user_id', Auth::user()->id)->where('status_bayar', 1)->get();
        return view('pages.member.transaksi.pembayaran.index', compact('order'));
    }

    public function topupIndex() {
        $order = Order::where('user_id', Auth::user()->id)->where('status_bayar', 1)->get();
        return view('pages.member.transaksi.topup.index', compact('order'));
        //
    }

    public function withdrawIndex() {
        $order = Order::where('user_id', Auth::user()->id)->where('status_bayar', 1)->get();
        return view('pages.member.transaksi.withdraw.index', compact('order'));
        //
    }
}
