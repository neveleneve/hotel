<?php

namespace App\Livewire;

use App\Models\country;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCountry extends Component {
    use WithPagination;

    public $search = '';
    public $currentPage;

    public function render() {
        $countries = country::when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('flag_code', 'like', '%' . $this->search . '%');
            });
        })
            ->paginate(10);

        return view('livewire.admin-country', [
            'countries' => $countries
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
