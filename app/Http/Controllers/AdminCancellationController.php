<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCancellationController extends Controller {
    public function __construct() {
        $this->middleware('permission:cancellation index')->only(['index']);
        $this->middleware('permission:cancellation update')->only(['update']);
    }

    public function index() {
        return view('pages.admin.cancellation.index');
    }

    public function create() {
        //
    }

    public function store(Request $request) {
        //
    }

    public function show(string $id) {
        //
    }

    public function edit(string $id) {
        //
    }

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }
}
