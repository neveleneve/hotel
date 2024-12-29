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

        // Jika user adalah admin (bukan super admin), tampilkan hanya member dengan reff_code yang sama
        if (Auth::user()->hasRole('admin')) {
            $query->where('reff_code', Auth::user()->reff_code);
        }

        $members = $query->withTrashed()->paginate(10);

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
