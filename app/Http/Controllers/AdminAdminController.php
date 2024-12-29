<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminAdminController extends Controller {
    public function __construct() {
        $this->middleware('permission:admin index')->only('index');
        $this->middleware('permission:admin create')->only(['create', 'store']);
        $this->middleware('permission:admin view')->only('show');
        $this->middleware('permission:admin edit')->only(['edit', 'update']);
        $this->middleware('permission:admin delete')->only('destroy');
    }

    public function index() {
        return view('pages.admin.admin.index');
    }

    public function create() {
        return view('pages.admin.admin.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,super admin',
        ]);

        try {
            $admin = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $admin->assignRole($request->role);

            $admin->ownReff()->create([
                'reff_code' => strtoupper(substr($admin->name, 0, 3) . rand(1000, 9999))
            ]);

            return redirect()->route('admin.admin.index')->with([
                'title' => 'Berhasil',
                'text' => 'Admin berhasil ditambahkan!',
                'icon' => 'success',
            ]);
        } catch (\Exception $e) {
            return back()->with([
                'title' => 'Gagal',
                'text' => 'Gagal menambahkan admin!',
                'icon' => 'error',
            ])->withInput();
        }
    }

    public function show(User $admin) {
        return view('pages.admin.admin.show', compact('admin'));
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
