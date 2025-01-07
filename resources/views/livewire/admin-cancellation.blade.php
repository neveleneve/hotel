<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="mb-4 flex flex-col xl:flex-row gap-2">
        <div class="relative w-full">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pembatalan..."
                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-[--primary] focus:border-[--primary]">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="material-icons text-gray-400">search</i>
            </div>
            @if ($search != '')
                <button wire:click="$set('search', '')" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                    <i class="material-icons text-gray-400 hover:text-gray-600">close</i>
                </button>
            @endif
        </div>
        <select wire:model.live="filterStatus"
            class="px-3 py-2 rounded-lg border border-gray-300 focus:ring-[--primary] focus:border-[--primary] xl:w-48">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="approve">Disetujui</option>
            <option value="reject">Ditolak</option>
        </select>
    </div>

    <div class="hidden xl:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-nowrap">
                <thead class="text-xs uppercase bg-[--primary] text-[--on-primary]">
                    <tr>
                        <th scope="col" class="py-3 text-center">Kode Pesanan</th>
                        <th scope="col" class="px-6 py-3 text-center">Nama Pemesan</th>
                        <th scope="col" class="py-3 text-center">Hotel</th>
                        <th scope="col" class="px-6 py-3 text-center">Check In</th>
                        <th scope="col" class="px-6 py-3 text-center">Check Out</th>
                        <th scope="col" class="py-3 text-center">Status Bayar</th>
                        <th scope="col" class="py-3 text-center">Status Pembatalan</th>
                        <th scope="col" class="py-3 text-center">Total</th>
                        <th scope="col" class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($cancellations as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 text-center">
                                {{ $order->order_code }}
                                @if ($order->is_hot_sale)
                                    <span
                                        class="text-xs px-2 py-1 rounded-full font-bold bg-orange-500 text-white ml-1">
                                        Hot Sale
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">{{ $order->user->name }}</td>
                            <td class="py-4 text-center">{{ $order->hotel->name }}</td>
                            <td class="px-6 py-4 text-center">{{ date('d M Y', strtotime($order->check_in)) }}</td>
                            <td class="px-6 py-4 text-center">{{ date('d M Y', strtotime($order->check_out)) }}</td>
                            <td class="py-4 text-center">
                                <span
                                    class="text-xs px-2 py-1 rounded-full font-bold {{ $order->status_bayar ? 'bg-[--primary] text-[--on-primary]' : 'bg-[--error] text-[--on-error]' }}">
                                    {{ $order->status_bayar ? 'Sudah Bayar' : 'Belum Bayar' }}
                                </span>
                            </td>
                            <td class="py-4 text-center">
                                <span
                                    class="text-xs px-2 py-1 rounded-full font-bold
                                    {{ $order->status_cancel === 'pending'
                                        ? 'bg-[--tertiary] text-[--on-tertiary]'
                                        : ($order->status_cancel === 'approve'
                                            ? 'bg-[--success] text-[--on-success]'
                                            : 'bg-[--error] text-[--on-error]') }}">
                                    {{ ucfirst($order->status_cancel) }}
                                </span>
                            </td>
                            <td class="py-4 text-center">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="py-4 text-center">
                                @if ($order->status_cancel === 'pending')
                                    <div class="flex gap-2 justify-center">
                                        <button wire:click="updateStatus({{ $order->id }}, 'approve')"
                                            class="px-2 py-1 bg-[--primary] text-[--on-primary] rounded-lg text-sm font-bold">
                                            Setuju
                                        </button>
                                        <button wire:click="updateStatus({{ $order->id }}, 'reject')"
                                            class="px-2 py-1 bg-[--error] text-[--on-error] rounded-lg text-sm font-bold">
                                            Tolak
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-center font-bold">Tidak ada data pembatalan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Cards -->
    <div class="xl:hidden space-y-4">
        @forelse ($cancellations as $order)
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <p class="font-bold text-gray-600">{{ $order->hotel->name }}</p>
                        <p class="font-semibold">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $order->order_code }}
                        </p>
                        <p class="text-sm">Check In: {{ date('d M Y', strtotime($order->check_in)) }}</p>
                        <p class="text-sm">Check Out: {{ date('d M Y', strtotime($order->check_out)) }}</p>
                        <div class="flex flex-wrap gap-2">

                            <span
                                class="text-xs px-2 py-1 rounded-full font-bold {{ $order->status_bayar ? 'bg-[--primary] text-[--on-primary]' : 'bg-[--error] text-[--on-error]' }}">
                                {{ $order->status_bayar ? 'Sudah Bayar' : 'Belum Bayar' }}
                            </span>
                            <span
                                class="text-xs px-2 py-1 rounded-full font-bold
                                {{ $order->status_cancel === 'pending'
                                    ? 'bg-[--tertiary] text-[--on-tertiary]'
                                    : ($order->status_cancel === 'approve'
                                        ? 'bg-[--primary] text-[--on-primary]'
                                        : 'bg-[--error] text-[--on-error]') }}">
                                {{ ucfirst($order->status_cancel) }}
                            </span>
                            @if ($order->is_hot_sale)
                                <span class="text-xs px-2 py-1 rounded-lg font-bold bg-[--error-container] text-white">
                                    Hot Sale
                                </span>
                            @endif
                        </div>
                        <p class="text-sm font-semibold mt-2">Total: Rp {{ number_format($order->total, 0, ',', '.') }}
                        </p>
                        @if ($order->status_cancel === 'pending')
                            <div class="flex gap-2 mt-2">
                                <button wire:click="updateStatus({{ $order->id }}, 'approve')"
                                    class="px-2 py-1 bg-[--primary] text-[--on-primary] rounded-lg text-sm font-bold">
                                    Setuju
                                </button>
                                <button wire:click="updateStatus({{ $order->id }}, 'reject')"
                                    class="px-2 py-1 bg-[--error] text-[--on-error] rounded-lg text-sm font-bold">
                                    Tolak
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-4 font-bold">Tidak ada data pembatalan</div>
        @endforelse
    </div>

    @if ($cancellations->hasPages())
        <div class="flex justify-end mt-4">
            {{ $cancellations->links('layouts.pagination') }}
        </div>
    @endif
</div>

@push('customjs')
    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('showAlert', (data) => {
                Swal.fire({
                    title: data[0].title,
                    text: data[0].text,
                    icon: data[0].icon,
                    confirmButtonText: 'Tutup',
                    customClass: {
                        popup: 'bg-white rounded-lg shadow-lg',
                        title: 'text-lg font-bold text-[--on-primary]',
                        text: 'text-semibold text-[--on-primary]',
                        confirmButton: 'bg-[--primary] text-[--on-primary] px-4 py-2 rounded-lg hover:bg-[-primary-container] focus:ring focus:ring-blue-300 font-semibold',
                    },
                });
            });
        });
    </script>

    @session('title')
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('text') }}",
                icon: "{{ session('icon') }}",
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'bg-white rounded-lg shadow-lg',
                    title: 'text-lg font-bold text-[--on-primary]',
                    text: 'text-semibold text-[--on-primary]',

                    confirmButton: 'bg-[--primary] text-[--on-primary] px-4 py-2 rounded-lg hover:bg-[-primary-container] focus:ring focus:ring-blue-300 font-semibold',
                },
            })
        </script>
    @endsession
@endpush
