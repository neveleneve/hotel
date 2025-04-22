<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    private function generateRandomString($length = 6) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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
                'reff_code' => $this->generateRandomString()
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

    public function show($admin) {
        $admin = User::withTrashed()->findOrFail($admin);
        return view('pages.admin.admin.show', compact('admin'));
    }

    public function edit(string $id) {
        //
    }

    public function update(Request $request, $admin) {
        $admin = User::withTrashed()->findOrFail($admin);

        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'role' => 'required|in:admin,super admin',
            'status' => 'required|in:active,inactive',
        ];

        if ($request->filled('password')) {
            $validationRules['password'] = 'required|string|min:8|confirmed';
        }

        $validated = $request->validate($validationRules);

        try {
            DB::beginTransaction();

            $updateData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
            ];

            if (isset($validated['password'])) {
                $updateData['password'] = bcrypt($validated['password']);
            }

            $admin->update($updateData);

            $admin->roles()->detach();
            $admin->assignRole($validated['role']);

            if ($validated['status'] === 'inactive' && !$admin->deleted_at) {
                $admin->delete();
            } elseif ($validated['status'] === 'active' && $admin->deleted_at) {
                $admin->restore();
            }

            DB::commit();
            return redirect()
                ->route('admin.admin.show', $admin)
                ->with('success', 'Data admin berhasil diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data admin: ' . $e->getMessage());
        }
    }

    public function destroy(string $id) {
        //
    }
}
