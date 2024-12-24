<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberCartController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.member.cart.index');
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
