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

    public function update(Request $request, string $id) {
        //
    }

    public function destroy(string $id) {
        //
    }
}
