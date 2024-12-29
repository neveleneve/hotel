<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminOrderController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('pages.admin.order.index');
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
        $this->middleware('permission:order index')->only('index');
        $this->middleware('permission:order create')->only(['create', 'store']);
        $this->middleware('permission:order view')->only('show');
        $this->middleware('permission:order edit')->only(['edit', 'update']);
        $this->middleware('permission:order delete')->only('destroy');
    }
}
