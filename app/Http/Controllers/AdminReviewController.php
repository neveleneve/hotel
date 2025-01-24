<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
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
        $validated = $request->validate([
            'hotel_id' => 'required',
            'name' => 'required',
            'star' => 'required',
            'comment' => 'required'
        ]);
        if ($validated) {
            $review = Review::create($validated);
            if ($review) {
                $hotel = $review->hotel;
                $averageRating = $hotel->reviews()->avg('star');
                $hotel->update(['rating' => $averageRating]);
            }
            return redirect()->back()->with([
                'title' => 'Berhasil',
                'text' => 'Review berhasil ditambahkan',
                'icon' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'title' => 'Gagal',
                'text' => 'Review gagal ditambahkan',
                'icon' => 'error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review) {
        $hotel = $review->hotel;
        $review->delete();
        $averageRating = $hotel->reviews()->avg('star');
        $hotel->update(['rating' => $averageRating]);
        return redirect()->back()->with([
            'title' => 'Berhasil',
            'text' => 'Review berhasil dihapus',
            'icon' => 'success'
        ]);
    }
}
