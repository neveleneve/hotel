<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemberOrderController extends Controller {
    public function index() {
        $orders = Order::with('hotel')
            ->where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();
        return view('pages.member.order.index', compact('orders'));
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        $validate = Validator::make($request->all(), [
            'hotel_id' => 'required',
            'user_id' => 'required',
            'room_hidden' => 'required|numeric|min:1',
            'check_in_hidden' => 'required|date|after_or_equal:today|before:check_out_hidden',
            'check_out_hidden' => 'required|date|after:check_in_hidden',
        ], [
            'hotel_id.required' => 'Hotel tidak boleh kosong',
            'user_id.required' => 'User tidak boleh kosong',
            'room_hidden.required' => 'Room tidak boleh kosong', // Perbaiki typo 'room_hidder'
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
                    'text' => 'Gagal menambah pesanan!',
                    'icon' => 'error',
                ]);
        } else {
            if ($request->action == 'pesan') {
                $hotel = Hotel::find($request->hotel_id);
                $total_day = (strtotime($request->check_out_hidden) - strtotime($request->check_in_hidden)) / (60 * 60 * 24);
                if ($hotel->promo) {
                    $total = ($hotel->price * $request->room_hidden * $total_day) - ($hotel->price * $request->room_hidden * $total_day * $hotel->discount / 100);
                } else {
                    $total = $hotel->price * $request->room_hidden * $total_day;
                }
                $order = Order::create([
                    'order_code' => strtoupper($hotel->country->flag_code) . '/' . date('ymdHi') . '/' . str_pad($request->user_id, 4, "0", STR_PAD_LEFT) . '/' . strtoupper(uniqid()),
                    'user_id' => $request->user_id,
                    'hotel_id' => $request->hotel_id,
                    'check_in' => $request->check_in_hidden,
                    'check_out' => $request->check_out_hidden,
                    'total_room' => $request->room_hidden,
                    'total' => $total,
                ]);
                if ($order) {
                    return redirect(route('order.index'))
                        ->with([
                            'title' => 'Berhasil',
                            'text' => 'Berhasil menambah pesanan!',
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
            } elseif ($request->action == 'keranjang') {
                $hotel = Hotel::find($request->hotel_id);
                $total_day = (strtotime($request->check_out_hidden) - strtotime($request->check_in_hidden)) / (60 * 60 * 24);
                if ($hotel->promo) {
                    $total = ($hotel->price * $request->room_hidden * $total_day) - ($hotel->price * $request->room_hidden * $total_day * $hotel->discount / 100);
                } else {
                    $total = $hotel->price * $request->room_hidden * $total_day;
                }
                $cart = Cart::create([
                    'user_id' => $request->user_id,
                    'hotel_id' => $request->hotel_id,
                    'check_in' => $request->check_in_hidden,
                    'check_out' => $request->check_out_hidden,
                    'total_room' => $request->room_hidden,
                    'total' => $total,
                ]);
                if ($cart) {
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

    public function show(Order $order) {
        //
    }

    public function edit(Order $order) {
        //
    }

    public function update(Request $request, Order $order) {
        if ($request->has('bayar')) {
            if (!$order->status_bayar && $order->status_pesan === 'pending' && in_array($order->status_cancel, ['none', 'reject'])) {

                $saldo = Saldo::where('user_id', Auth::user()->id)->first();

                if (!$saldo || $saldo->saldo < $order->total) {
                    return redirect()->back()->with([
                        'title' => 'Gagal',
                        'text' => 'Saldo tidak mencukupi untuk melakukan pembayaran!',
                        'icon' => 'error',
                    ]);
                }

                try {
                    $saldo->update(['saldo' => $saldo->saldo - $order->total]);
                    $order->update(['status_bayar' => true]);

                    return redirect()->route('order.index')->with([
                        'title' => 'Berhasil',
                        'text' => 'Pembayaran berhasil dilakukan!',
                        'icon' => 'success',
                    ]);
                } catch (\Exception $e) {
                    return redirect()->back()->with([
                        'title' => 'Gagal',
                        'text' => 'Terjadi kesalahan saat melakukan pembayaran!',
                        'icon' => 'error',
                    ]);
                }
            }
        } elseif ($request->has('batal')) {
            if (in_array($order->status_pesan, ['pending', 'done']) && in_array($order->status_cancel, ['none', 'reject'])) {
                try {
                    if ($order->status_bayar) {
                        $order->update(['status_cancel' => 'pending']);
                        $message = 'Permintaan refund berhasil diajukan!';
                    } else {
                        $order->update(['status_cancel' => 'pending']);
                        $message = 'Permintaan pembatalan berhasil diajukan!';
                    }

                    return redirect()->back()->with([
                        'title' => 'Berhasil',
                        'text' => $message,
                        'icon' => 'success',
                    ]);
                } catch (\Exception $e) {
                    return redirect()->back()->with([
                        'title' => 'Gagal',
                        'text' => 'Terjadi kesalahan saat mengajukan pembatalan!',
                        'icon' => 'error',
                    ]);
                }
            }
        }

        return redirect()->back()->with([
            'title' => 'Gagal',
            'text' => 'Aksi tidak valid!',
            'icon' => 'error',
        ]);
    }

    public function destroy(Order $order) {
        //
    }
}
