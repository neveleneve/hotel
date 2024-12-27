<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Hotel;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminHotelCreate extends Component {
    use WithFileUploads;

    public $name;
    public $country_id;
    public $price;
    public $rating;
    public $description;
    public $image;
    public $countries;

    public function mount() {
        $this->countries = Country::all();
    }

    public function save() {
        try {
            $this->validate([
                'name'          => 'required|string|max:255',
                'country_id'    => 'required|exists:countries,id',
                'price'         => 'required|numeric|min:0',
                'rating'        => 'required|numeric|min:1|max:5',
                'description'   => 'required|string',
                'image'         => 'required|image|max:2048',
            ]);

            if (!$this->image) {
                session()->flash('error', 'Please select an image.');
                return;
            }

            $imagePath = $this->image->store('hotel', 'public');

            if (!$imagePath) {
                session()->flash('error', 'Failed to upload image.');
                return;
            }

            Hotel::create([
                'name'          => $this->name,
                'country_id'    => $this->country_id,
                'price'         => $this->price,
                'rating'        => $this->rating,
                'description'   => $this->description,
                'image'         => $imagePath,
            ]);

            session()->flash('message', 'Hotel berhasil ditambahkan.');
            return redirect()->route('admin.hotel.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function render() {
        return view('livewire.admin-hotel-create');
    }
}
