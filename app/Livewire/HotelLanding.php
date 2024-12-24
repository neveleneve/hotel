<?php

namespace App\Livewire;

use App\Models\Hotel;
use Livewire\Component;

class HotelLanding extends Component {
    public $hotel;
    public $select = 'all';
    public function render() {
        return view('livewire.hotel-landing');
    }

    public function mount() {
        $this->changeData($this->select);
    }

    public function changeData($value) {
        if ($value == 'all') {
            $this->hotel = Hotel::orderBy('rating', 'desc')->get();
            $this->select = 'all';
        } elseif ($value == 'top') {
            $this->hotel = Hotel::orderBy('rating', 'desc')->get();
            $this->select = 'top';
        } elseif ($value == 'popular') {
            $this->hotel = Hotel::orderBy('rating', 'desc')->get();
            $this->select = 'popular';
        }
    }
}
