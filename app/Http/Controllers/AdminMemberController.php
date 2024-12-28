<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminMemberController extends Controller {
    public function __construct() {
        $this->middleware('permission:member index')->only('index');
        $this->middleware('permission:member view')->only('show');
        $this->middleware('permission:member edit')->only('update');
        $this->middleware('permission:member delete')->only('destroy');
    }

    public function index() {

        return view('pages.admin.member.index');
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(User $member) {
        return view('pages.admin.member.show', compact('member'));
    }

    public function edit(string $id) {
        //
    }

    public function update(Request $request, User $member) {
        $request->validate([
            'type' => 'required|in:saldo,point',
            'amount' => 'required|numeric|min:0',
        ]);

        try {
            $saldo = $member->saldo ?? $member->saldo()->create(['saldo' => 0, 'point' => 0]);

            if ($request->type === 'saldo') {
                $saldo->saldo += $request->amount;
            } else {
                $saldo->point += $request->amount;
            }

            $saldo->save();

            return back()->with([
                'title' => 'Berhasil',
                'text' => 'Berhasil menambah ' . $request->type . '!',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'title' => 'Gagal',
                'text' => 'Gagal menambah ' . $request->type . '!',
                'icon' => 'error',
            ]);
        }
    }

    public function destroy(string $id) {
        //
    }
}
