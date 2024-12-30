<?php

namespace App\Livewire;

use App\Models\Hotel;
use Livewire\Component;

class HotelLanding extends Component {
    public $hotel;
    public $select = 'all';
    public $page = 1;
    public $hasMorePages = false;
    private $perPage = 8;

    public function mount() {
        $this->loadHotels();
    }

    private function getQuery() {
        return match ($this->select) {
            'top' => Hotel::where('promo', 1)->where('discount', '>', 0),
            'popular' => Hotel::orderBy('rating', 'desc'),
            default => Hotel::query(),
        };
    }

    private function checkMorePages($query) {
        return $query->skip($this->page * $this->perPage)
            ->take(1)
            ->exists();
    }

    public function loadHotels() {
        $query = $this->getQuery();
        $this->hotel = $query->take($this->perPage)->get();
        $this->hasMorePages = $this->checkMorePages($query);
    }

    public function loadMore() {
        $this->page++;
        $query = $this->getQuery();

        $nextHotels = $query->skip(($this->page - 1) * $this->perPage)
            ->take($this->perPage)
            ->get();

        if ($nextHotels->isNotEmpty()) {
            $this->hotel = $this->hotel->merge($nextHotels);
            $this->hasMorePages = $this->checkMorePages($query);
        } else {
            $this->hasMorePages = false;
        }
    }

    public function changeData($type) {
        $this->select = $type;
        $this->page = 1;
        $this->loadHotels();
    }


    public function render() {
        return view('livewire.hotel-landing');
    }
}
