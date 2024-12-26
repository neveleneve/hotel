<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class AdminOrder extends Component {
    use WithPagination;

    public $search = '';
    public $currentPage;

    public function render() {
        $orders = Order::when($this->search, function ($query) {
            $query->where(function ($q) {
                $q->where('order_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            });
        })
            ->latest()
            ->paginate(10);

        return view('livewire.admin-order', [
            'orders' => $orders
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
