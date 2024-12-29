<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AdminMember extends Component {
    use WithPagination;

    public $search = '';
    public $currentPage;

    public function render() {
        $query = User::role('member')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            });

        if (Auth::user()->hasRole('admin')) {
            $query->whereHas('reffBy.ownReff', function ($q) {
                $q->where('reff_code', Auth::user()->ownReff->reff_code);
            });
        }

        $members = $query->withTrashed()
            ->with(['ownReff', 'reffBy.ownReff']) // eager load semua relasi yang dibutuhkan
            ->paginate(10);

        return view('livewire.admin-member', [
            'members' => $members
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
