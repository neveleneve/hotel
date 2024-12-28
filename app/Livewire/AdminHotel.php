<?php

namespace App\Livewire;

use App\Models\Hotel;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class AdminHotel extends Component {
    use WithPagination;

    public $search = '';
    public $currentPage;

    public function render() {
        $hotels = Hotel::when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        })
            ->withTrashed()
            ->paginate(10);

        return view('livewire.admin-hotel', [
            'hotels' => $hotels
        ]);
    }

    public function updatingSearch() {
        $this->resetPage();
    }

    public function setPage($url) {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $params);
            if (isset($params['page'])) {
                $this->currentPage = $params['page'];
                Paginator::currentPageResolver(function () {
                    return $this->currentPage;
                });
            }
        }
    }
}
