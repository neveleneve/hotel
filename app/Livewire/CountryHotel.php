<?php

namespace App\Livewire;

use App\Models\country;
use Livewire\Component;

class CountryHotel extends Component {
    public $flag_code;
    public $search = '';

    public function render() {
        if ($this->search == '') {
            $hotel = country::where('flag_code', $this->flag_code)
                ->first()
                ->hotel()
                ->orderBy('rating', 'desc')
                ->get();
        } else {
            $hotel = country::where('flag_code', $this->flag_code)
                ->first()
            ->hotel()
                ->where('name', 'like', '%' . $this->search . '%')
                ->orderBy('rating', 'desc')
                ->get();
        }
        return view('livewire.country-hotel', [
            'hotel' => $hotel
        ]);
    }

    public function clearSearch() {
        $this->search = null;
    }
}
