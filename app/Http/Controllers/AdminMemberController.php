<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Models\User;
use App\Models\Hotel;
use App\Models\MemberMessage;
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
        if (auth()->user()->hasRole('admin')) {
            $isReferredMember = $member->reffBy()->whereHas('ownReff', function ($query) {
                $query->where('reff_code', auth()->user()->ownReff->reff_code);
            })->exists();

            if (!$isReferredMember) {
                return redirect()->route('admin.member.index')->with([
                    'title' => 'Akses Ditolak',
                    'text' => 'Anda tidak memiliki akses ke member ini!',
                    'icon' => 'error',
                ]);
            }
        }

        $hotels = Hotel::all();
        return view('pages.admin.member.show', compact('member', 'hotels'));
    }

    public function edit(string $id) {
        //
    }

    public function update(Request $request, User $member) {
        if ($request->has('action') && $request->action === 'toggle_project') {
            $request->validate([
                'project_id' => 'required|exists:member_messages,id'
            ]);

            try {
                $project = MemberMessage::findOrFail($request->project_id);
                $project->active = !$project->active;
                $project->save();

                return back()->with([
                    'title' => 'Berhasil',
                    'text' => 'Status project berhasil diubah!',
                    'icon' => 'success',
                ]);
            } catch (\Exception $e) {
                return back()->with([
                    'title' => 'Gagal',
                    'text' => 'Gagal mengubah status project!',
                    'icon' => 'error',
                ]);
            }
        }

        if ($request->has('assign_hotel')) {
            $request->validate([
                'hotel_id' => 'required|exists:hotels,id',
                'price' => 'required|numeric|min:0',
            ]);

            try {
                MemberMessage::create([
                    'user_id' => $member->id,
                    'hotel_id' => $request->hotel_id,
                    'price' => $request->price,
                ]);

                return back()->with([
                    'title' => 'Berhasil',
                    'text' => 'Project berhasil ditambahkan!',
                    'icon' => 'success',
                ]);
            } catch (\Exception $e) {
                return back()->with([
                    'title' => 'Gagal',
                    'text' => 'Gagal menambahkan project!',
                    'icon' => 'error',
                ]);
            }
        } elseif ($request->has('amount')) {
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
                    TopUp::create([
                        'user_id' => $member->id,
                        'amount' => $request->amount,
                        'type' => 'point',
                    ]);
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
    }

    public function destroy(string $id) {
        //
    }
}
