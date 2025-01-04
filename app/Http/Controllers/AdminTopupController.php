<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTopupController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('pages.admin.transaksi.deposit.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        try {
            DB::beginTransaction();

            $topup = TopUp::findOrFail($id);
            $saldo = Saldo::where('user_id', $topup->user_id)->first();

            if (!$saldo) {
                throw new \Exception('Saldo user tidak ditemukan');
            }

            switch ($topup->type) {
                case 'deposit':
                    $saldo->saldo -= $topup->amount;
                    break;
                case 'withdraw':
                    $saldo->saldo += $topup->amount;
                    break;
                case 'point':
                    $saldo->point -= $topup->amount;
                    break;
            }

            $saldo->save();
            $topup->delete();

            DB::commit();

            return redirect()->back()->with([
                'title' => 'Berhasil',

                'text' => 'Data top up berhasil dihapus',
                'icon' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'title' => 'Gagal',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    public function __construct() {
        $this->middleware('permission:deposit index')->only('index');
        $this->middleware('permission:deposit update')->only(['update']);
    }
}
