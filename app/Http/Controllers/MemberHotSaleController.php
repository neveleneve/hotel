<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MemberMessage;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class MemberHotSaleController extends Controller {
    public function show($user_id, $id) {
        $hotSale = MemberMessage::where('user_id', $user_id)
            ->where('id', $id)
            ->where('active', 1)
            ->with(['hotel', 'user', 'hotel.reviews'])
            ->firstOrFail();

        return view('pages.member.hot-sale.show', [
            'hotSale' => $hotSale
        ]);
    }

    public function order(Request $request, $user_id, $id) {
        $validate = Validator::make($request->all(), [
            'user_id' => 'required',
            'room_hidden' => 'required|numeric|min:1',
            'check_in_hidden' => 'required|date|after_or_equal:today|before:check_out_hidden',
            'check_out_hidden' => 'required|date|after:check_in_hidden',
        ], [
            'user_id.required' => 'User tidak boleh kosong',
            'room_hidden.required' => 'Room tidak boleh kosong',
            'room_hidden.numeric' => 'Room harus berupa angka',
            'room_hidden.min' => 'Room tidak boleh kurang dari 1',
            'check_in_hidden.required' => 'Tanggal check in tidak boleh kosong',
            'check_in_hidden.date' => 'Tanggal check in harus berupa tanggal',
            'check_in_hidden.after_or_equal' => 'Tanggal check in tidak boleh kurang dari hari ini',
            'check_in_hidden.before' => 'Tanggal check in tidak boleh lebih dari tanggal check out',
            'check_out_hidden.required' => 'Tanggal check out tidak boleh kosong',
            'check_out_hidden.date' => 'Tanggal check out harus berupa tanggal',
            'check_out_hidden.after' => 'Tanggal check out tidak boleh kurang dari tanggal check in',
        ]);

        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate->errors())
                ->withInput()
                ->with([
                    'title' => 'Gagal',
                    'text' => 'Gagal membuat pesanan!',
                    'icon' => 'error',
                ]);
        } else {
            if ($request->action == 'pesan') {
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
                    'total' => $finalPrice * $request->room_hidden * (strtotime($request->check_out_hidden) - strtotime($request->check_in_hidden)) / (60 * 60 * 24),
                    'is_hot_sale' => 1,
                    'member_message_id' => $hotSale->id,
                ]);

                if ($order) {
                    $hotSale->update(['active' => 0]);
                    return redirect()->route('order.index', $order->id)
                        ->with([
                            'title' => 'Berhasil',
                            'text' => 'Pesanan berhasil dibuat',
                            'icon' => 'success'
                        ]);
                } else {
                    return back()->with([
                        'title' => 'Gagal',
                        'text' => 'Pesanan gagal dibuat',
                        'icon' => 'error'
                    ]);
                }
            } elseif ($request->action == 'keranjang') {
                $hotSale = MemberMessage::with('hotel')
                    ->where('user_id', $user_id)
                    ->where('id', $id)
                    ->where('active', 1)
                    ->firstOrFail();

                $finalPrice = $hotSale->discount_status ?
                    $hotSale->price - ($hotSale->price * $hotSale->discount / 100) :
                    $hotSale->price;

                $cart = Cart::create([
                    'user_id' => $request->user_id,
                    'hotel_id' => $hotSale->hotel_id,
                    'check_in' => $request->check_in_hidden,
                    'check_out' => $request->check_out_hidden,
                    'total_room' => $request->room_hidden,
                    'total' => $finalPrice * $request->room_hidden * (strtotime($request->check_out_hidden) - strtotime($request->check_in_hidden)) / (60 * 60 * 24),
                    'is_hot_sale' => 1,
                    'member_message_id' => $hotSale->id,
                ]);
                if ($cart) {
                    $hotSale->update(['active' => 0]);
                    return redirect(route('cart.index'))
                        ->with([
                            'title' => 'Berhasil',
                            'text' => 'Berhasil menambah ke keranjang!',
                            'icon' => 'success',
                        ]);
                } else {
                    return redirect()
                        ->back()
                        ->with([
                            'title' => 'Gagal',
                            'text' => 'Gagal menambah ke keranjang!',
                            'icon' => 'error',
                        ]);
                }
            }
        }
    }
}
