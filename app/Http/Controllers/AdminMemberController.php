<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
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
        // $member = User::role('member')->with('ownReff', 'reffBy')->get();
        // $data = null;
        // foreach ($member as $key => $value) {
        //     $data[$key] = [
        //         'name' => $value->name,
        //         'email' => $value->email,
        //         'own_reff' => $value->ownReff->reff_code,
        //         'refferal_code' => $value->reffBy->ownReff->reff_code,
        //         'reff_by' => $value->reffBy->ownReff->user->name,
        //     ];
        // }
        // dd($data);
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
            'amount' => 'required|numeric',
        ]);

        try {
            $saldo = $member->saldo ?? $member->saldo()->create(['saldo' => 0, 'point' => 0]);

            if ($request->type === 'saldo') {
                $saldo->saldo += $request->amount;
                if ($request->amount < 0) {
                    TopUp::create([
                        'user_id' => $member->id,
                        'amount' => abs($request->amount),
                        'type' => 'withdraw',
                    ]);
                } else {
                    TopUp::create([
                        'user_id' => $member->id,
                        'amount' => $request->amount,
                        'type' => 'deposit',
                    ]);
                }
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
