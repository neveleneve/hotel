<?php

namespace App\Livewire;

use App\Models\country;
use App\Models\Hotel;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Helpers\FileHelper;

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
        $this->countries = country::all();
    }

    public function render() {
        return view('livewire.admin-hotel-create');
    }
}
