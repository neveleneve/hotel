<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCountryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('pages.admin.country.index');
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
        $this->middleware('permission:country index')->only('index');
        $this->middleware('permission:country create')->only(['create', 'store']);
        $this->middleware('permission:country view')->only('show');
        $this->middleware('permission:country edit')->only(['edit', 'update']);
        $this->middleware('permission:country delete')->only('destroy');
    }
}
