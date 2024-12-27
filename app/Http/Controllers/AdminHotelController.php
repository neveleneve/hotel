<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;

class AdminHotelController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('pages.admin.hotel.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $countries = Country::all();
        return view('pages.admin.hotel.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'price' => 'required|numeric|min:0',
            'rating' => 'required|numeric|min:1|max:5',
            'description' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        try {
            $uploadPath = public_path('assets/img/hotel');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $fileName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move($uploadPath, $fileName);

            Hotel::create([
                'name' => $request->name,
                'country_id' => $request->country_id,
                'price' => $request->price,
                'rating' => $request->rating,
                'description' => $request->description,
                'image' => $fileName,
            ]);

            return redirect()
                ->route('admin.hotel.index')
                ->with('success', 'Hotel berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
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
}
