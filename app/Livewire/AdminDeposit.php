<?php

namespace App\Livewire;

use App\Models\TopUp;
use Livewire\Component;
use Illuminate\Pagination\Paginator;
use Livewire\WithPagination;

class AdminDeposit extends Component {
    use WithPagination;

    public $search = '';
    public $currentPage;

    public function updatingSearch() {
        $this->resetPage();
    }

    public function render() {
        $query = TopUp::query()->with('user')->where('type', 'deposit');

        if ($this->search) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if (auth()->user()->hasRole('admin')) {
            $query->whereHas('user.reffBy', function ($q) {
                $q->whereHas('ownReff', function ($q) {
                    $q->where('user_id', auth()->id());
                });
            });
        }

        return view('livewire.admin-deposit', [
            'topups' => $query->latest()->paginate(10)
        ]);
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
