<?php

namespace App\Http\Controllers;

use App\Models\MemberMessage;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MemberHotSaleController extends Controller {
    public function show($user_id, $id) {
        $hotSale = MemberMessage::where('user_id', $user_id)
            ->where('id', $id)
            ->where('active', 1)
            ->with(['hotel', 'user'])
            ->firstOrFail();

        return view('pages.member.hot-sale.show', [
            'hotSale' => $hotSale
        ]);
    }

    public function order(Request $request, $user_id, $id) {
        // dd($request->all(), $user_id, $id);
        $hotSale = MemberMessage::with('hotel')
            ->where('user_id', $user_id)
            ->where('id', $id)
            ->where('active', 1)
            ->firstOrFail();

        $finalPrice = $hotSale->discount_status ?
            $hotSale->price - ($hotSale->price * $hotSale->discount / 100) :
            $hotSale->price;

        $order = Order::create([
            'order_code' => strtoupper($hotSale->hotel->country->flag_code) . '/' . date('ymdHi') . '/' . str_pad($request->user_id, 4, "0", STR_PAD_LEFT) . '/' . strtoupper(uniqid()),
            'user_id' => $request->user_id,
            'hotel_id' => $hotSale->hotel_id,
            'check_in' => $request->check_in_hidden,
            'check_out' => $request->check_out_hidden,
            'total_room' => $request->room_hidden,
            'total' => $finalPrice * $request->room_hidden,
            'is_hot_sale' => 1,
        ]);

        if ($order) {
            $hotSale->update(['active' => 0]);
            return redirect()->route('order.index', $order->id)
                ->with([
                    'title' => 'Berhasil',
                    'text' => 'Pesanan berhasil dibuat',
                    'icon' => 'success'
                ]);
        }


        return back()->with([
            'title' => 'Gagal',
            'text' => 'Pesanan gagal dibuat',
            'icon' => 'error'
        ]);
    }
}
