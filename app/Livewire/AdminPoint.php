<?php

namespace App\Livewire;

use App\Models\TopUp;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPoint extends Component {
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $currentPage = 1;

    public function updatingSearch() {
        $this->resetPage();
    }

    public function render() {
        $query = TopUp::query()->with('user')->where('type', 'point');

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

        return view('livewire.admin-point', [
            'points' => $query->latest()->paginate(10)
        ]);
    }

    public function setPage($url) {
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $params);
            if (isset($params['page'])) {
                $this->currentPage = $params['page'];

                $this->setPage($this->currentPage);
            }
        }
    }
}
