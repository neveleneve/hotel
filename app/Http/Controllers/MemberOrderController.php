<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberOrderController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

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
            'room_hidder.required' => 'Room tidak boleh kosong',
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
            return redirect()->back()->withErrors($validate->errors())->withInput();
        } else {
            if ($request->action == 'pesan') {
                $hotel = Hotel::find($request->hotel_id);
                $total_day = (strtotime($request->check_out_hidden) - strtotime($request->check_in_hidden)) / (60 * 60 * 24);
                Order::create([
                    'order_code' => date('ymdHi') . '/' . strtoupper(uniqid()) . '/' . str_pad($request->user_id, 4, "0", STR_PAD_LEFT),
                    'user_id' => $request->user_id,
                    'hotel_id' => $request->hotel_id,
                    'check_in' => $request->check_in_hidden,
                    'check_out' => $request->check_out_hidden,
                    'total_room' => $request->room_hidden,
                    'total' => $hotel->price * $request->room_hidden * $total_day,
                ]);
                return redirect(route('order.index'))->with([
                    'title' => 'Berhasil',
                    'text' => 'Berhasil menambah pesanan!',
                    'icon' => 'success',
                ]);
            } elseif ($request->action == 'keranjang') {
                dd('Keranjang');
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
        //
    }

    public function destroy(Order $order) {
        //
    }
}
