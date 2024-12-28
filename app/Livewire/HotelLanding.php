<?php

namespace App\Livewire;

use App\Models\Hotel;
use Livewire\Component;

class HotelLanding extends Component {
    public $hotel;
    public $select = 'all';
    public $page = 1;
    public $hasMorePages = true;

    public function mount() {
        $this->hotel = Hotel::take(8)->get();
    }

    public function loadHotels() {
        $this->hotel = Hotel::take(8)->get();
    }

    public function loadMore() {
        $this->page++;
        $hotels = Hotel::skip(($this->page - 1) * 8)->take(8)->get();

        if ($hotels->isEmpty()) {
            $this->hasMorePages = false;
        } else {
            $this->hotel = $this->hotel->merge($hotels);
        }
    }

    public function changeData($type) {
        $this->select = $type;
        $this->page = 1;
        $this->hasMorePages = true;

        if ($type == 'all') {
            $this->hotel = Hotel::take(8)->get();
        } elseif ($type == 'top') {
            $this->hotel = Hotel::where('promo', 1)->where('discount', '>', 0)->take(8)->get();
        } elseif ($type == 'popular') {
            $this->hotel = Hotel::orderBy('rating', 'desc')->take(8)->get();
        }
    }

    public function render() {
        return view('livewire.hotel-landing');
    }
}
