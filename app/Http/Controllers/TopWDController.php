<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TopUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopWDController extends Controller {
    public function paymentIndex() {
        $order = Order::where('user_id', Auth::user()->id)->where('status_bayar', 1)->get();
        return view('pages.member.transaksi.pembayaran.index', compact('order'));
    }

    public function topupIndex() {
        $topup = TopUp::where('user_id', Auth::user()->id)->where('type', 'deposit')->get();
        return view('pages.member.transaksi.topup.index', compact('topup'));
    }

    public function withdrawIndex() {
        $wd = TopUp::where('user_id', Auth::user()->id)->where('type', 'withdraw')->get();
        return view('pages.member.transaksi.withdraw.index', compact('wd'));
    }
}
