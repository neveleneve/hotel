<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\country;
use Illuminate\Http\Request;

class AdminHotelController extends Controller {
    public function __construct() {
        $this->middleware('permission:hotel index')->only('index');
        $this->middleware('permission:hotel create')->only(['create', 'store']);
        $this->middleware('permission:hotel view')->only('show');
        $this->middleware('permission:hotel edit')->only(['edit', 'update']);
        $this->middleware('permission:hotel delete')->only('destroy');
    }

    public function index() {
        return view('pages.admin.hotel.index');
    }

    public function create() {
        $countries = country::all();
        return view('pages.admin.hotel.create', compact('countries'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'          => 'required|string|max:255',
            'country_id'    => 'required|exists:countries,id',
            'price'         => 'required|numeric|min:0',
            'rating'        => 'required|numeric|min:0|max:5',
            'description'   => 'required|string',
            'image'         => 'required|image|max:2048',
            'is_promo'      => 'required|boolean',
            'discount'      => 'required_if:is_promo,1|nullable|numeric|min:0|max:100',
        ]);

        try {
            $uploadPath = public_path('assets/img/hotel');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move($uploadPath, $fileName);

            Hotel::create([
                'name'          => $request->name,
                'country_id'    => $request->country_id,
                'price'         => $request->price,
                'rating'        => $request->rating,
                'description'   => $request->description,
                'image'         => $fileName,
                'promo'         => $request->is_promo,
                'discount'      => $request->is_promo ? $request->discount : 0,
            ]);

            return redirect()
                ->route('admin.hotel.index')
                ->with([
                    'title' => 'Berhasil',
                    'text'  => 'Berhasil menambah data hotel!',
                    'icon'  => 'success',
                ]);
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput()
                ->with([
                    'title' => 'Gagal',
                    'text'  => 'Gagal menambah data hotel!',
                    'icon'  => 'error',
                ]);
        }
    }

    public function show($id) {
        $hotel = Hotel::withTrashed()->findOrFail($id);
        $countries = country::all();
        return view('pages.admin.hotel.show', compact('hotel', 'countries'));
    }

    public function edit(Hotel $hotel) {
        //
    }

    public function update(Request $request, Hotel $hotel) {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|exists:countries,id',
            'price' => 'required|numeric|min:0',
            'rating' => 'required|numeric|min:0|max:5',
            'description' => 'required|string',
            'is_promo' => 'required|boolean',
            'discount' => 'required_if:is_promo,1|nullable|numeric|min:0|max:100',
        ]);

        try {
            $hotel->update([
                'name' => $request->name,
                'country_id' => $request->country,
                'price' => $request->price,
                'rating' => $request->rating,
                'description' => $request->description,
                'promo' => $request->is_promo,
                'discount' => $request->is_promo ? $request->discount : 0,
            ]);

            return redirect()
                ->route('admin.hotel.show', $hotel)
                ->with([
                    'title' => 'Berhasil',
                    'text' => 'Data hotel berhasil diperbarui!',
                    'icon' => 'success',
                ]);
        } catch (\Exception $e) {
            return back()->with([
                'title' => 'Gagal',
                'text' => 'Gagal memperbarui data hotel: ' . $e->getMessage(),
                'icon' => 'error',
            ])->withInput();
        }
    }

    public function destroy($id) {
        $hotel = Hotel::withTrashed()->find($id);
        if ($hotel->deleted_at) {
            $restore = $hotel->restore();
            if ($restore) {
                return redirect(route('admin.hotel.show', ['hotel' => $id]))->with([
                    'title' => 'Berhasil',
                    'text' => 'Data hotel berhasil dikembalikan!',
                    'icon' => 'success',
                ]);
            }
        } else {
            $delete = $hotel->delete();
            if ($delete) {
                return redirect(route('admin.hotel.show', ['hotel' => $id]))->with([
                    'title' => 'Berhasil',
                    'text' => 'Data hotel berhasil dihapus!',
                    'icon' => 'success',
                ]);
            }
        }

        return back()->with([
            'title' => 'Gagal',
            'text' => 'Operasi gagal dilakukan!',
            'icon' => 'error',
        ]);
    }
}
