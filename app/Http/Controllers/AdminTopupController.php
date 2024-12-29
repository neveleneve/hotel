<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //
    }

    public function __construct() {
        $this->middleware('permission:deposit index')->only('index');
        $this->middleware('permission:deposit update')->only(['update']);
    }
}
