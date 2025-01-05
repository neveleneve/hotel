<?php

namespace App\Livewire;

use App\Models\Hotel;
use App\Models\Order;
use App\Models\Saldo;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCancellation extends Component {
    use WithPagination;

    public $search = '';
    public $currentPage;
    public $filterStatus = '';

    public function render() {
        $cancellations = Order::where('status_cancel', '!=', 'none')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('order_code', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function ($query) {
                            $query->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status_cancel', $this->filterStatus);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin-cancellation', [
            'cancellations' => $cancellations
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

    public function updateStatus($orderId, $status) {
        $order = Order::find($orderId);
        if ($order) {
            try {
                $order->update(['status_cancel' => $status]);

                if ($status === 'approve' && $order->status_bayar) {
                    if ($order->hotel->promo) {
                        $hotel = Hotel::find($order->hotel_id);
                        $total_day = (strtotime($order->check_out) - strtotime($order->check_in)) / (60 * 60 * 24);
                        $increment = $hotel->price * $order->total_room * $total_day;
                        Saldo::where('user_id', $order->user_id)
                            ->increment('saldo', $increment);
                    } else {
                        Saldo::where('user_id', $order->user_id)
                            ->increment('saldo', $order->total);
                    }
                }

                $title = $status === 'approve' ? 'Disetujui' : 'Ditolak';
                $this->dispatch('showAlert', [
                    'title' => $title,
                    'text' => "Order $order->order_code $title!",
                    'icon' => 'success',
                ]);
            } catch (\Exception $e) {
                $this->dispatch('showAlert', [
                    'title' => 'Gagal',
                    'text' => 'Terjadi kesalahan saat memperbarui status!',
                    'icon' => 'error',
                ]);
            }
        }
    }
}
