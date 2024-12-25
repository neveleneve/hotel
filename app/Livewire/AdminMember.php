<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class AdminMember extends Component {
    use WithPagination;

    public $search = '';
    public $currentPage;

    public function render() {
        $members = User::role('member')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
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
