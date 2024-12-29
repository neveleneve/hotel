<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AdminAdmin extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $admins = User::role('admin')
            ->when($this->search, function($query) {
                $query->where(function($q) {

                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('reff_code', 'like', '%' . $this->search . '%');
                });
            })
            ->withTrashed()
            ->paginate(10);

        return view('livewire.admin-admin', [
            'admins' => $admins
        ]);
    }
}
