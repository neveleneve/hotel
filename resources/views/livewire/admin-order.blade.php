<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="mb-4">
        <div class="relative">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pesanan..."
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
    </div>

    <!-- Desktop Table -->
    <div class="hidden xl:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-nowrap">
                <thead class="text-xs uppercase bg-[--primary] text-[--on-primary]">
                    <tr>
                        <th scope="col" class="py-3 text-center">Kode Pesanan</th>
                        <th scope="col" class="px-6 py-3 text-center">Email Pemesan</th>
                        <th scope="col" class="py-3 text-center">Hotel</th>
                        <th scope="col" class="px-6 py-3 text-center">Check In</th>
                        <th scope="col" class="px-6 py-3 text-center">Check Out</th>
                        <th scope="col" class="py-3 text-center">Status</th>
                        <th scope="col" class="py-3 text-center">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 text-center">{{ $order->order_code }}</td>
                            <td class="px-6 py-4 text-center">{{ $order->user->email }}</td>
                            <td class="py-4 text-center">
                                {{ $order->hotel->name }}
                                @if ($order->is_hot_sale)
                                    <span
                                        class="inline-block bg-[--error] text-[--on-error] px-2 py-0.5 text-xs font-bold rounded-full ml-1">
                                        Hot Sale
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">{{ date('d M Y', strtotime($order->check_in)) }}</td>
                            <td class="px-6 py-4 text-center">{{ date('d M Y', strtotime($order->check_out)) }}</td>
                            <td class="py-4 text-center">
                                @if (!$order->status_bayar && !$order->deleted_at)
                                    <span title="Belum Bayar"
                                        class="text-xs px-2 py-1 rounded-full font-bold bg-[--error] text-[--on-error]">
                                        Belum Bayar
                                    </span>
                                @elseif ($order->status_bayar && !$order->deleted_at)
                                    <span title="Belum Bayar"
                                        class="text-xs px-2 py-1 rounded-full font-bold bg-[--primary] text-[--on-primary]">
                                        Sudah Bayar
                                    </span>
                                @else
                                    <span title="Belum Bayar"
                                        onclick="return confirm('Batalkan pesanan {{ $order->order_code }}?')"
                                        class="text-xs px-2 py-1 rounded-full font-bold bg-[--error-container] text-[--on-error-container]">
                                        Dibatalkan
                                    </span>
                                @endif
                            </td>
                            <td class="py-4
                                    text-center">Rp
                                {{ number_format($order->total, 0, ',', '.') }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($orders->hasPages())
            <div class="flex justify-end mt-4">
                {{ $orders->links('layouts.pagination') }}
            </div>
        @endif
    </div>

    <div class="xl:hidden space-y-4">
        @forelse ($orders as $order)
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <p class="font-bold text-gray-600">{{ $order->hotel->name }}</p>
                            @if ($order->is_hot_sale)
                                <span class="bg-[--error] text-[--on-error] px-2 py-0.5 text-xs font-bold rounded-full">
                                    Hot Sale
                                </span>
                            @endif
                        </div>
                        <p class="font-semibold">{{ $order->user->email }}</p>
                        <p class="text-sm text-gray-600">{{ $order->order_code }}</p>
                        <p class="text-sm">Check In: {{ $order->check_in }}</p>
                        <p class="text-sm">Check Out: {{ $order->check_out }}</p>
                        <span
                            class="font-bold inline-block px-2 py-1 rounded-full text-xs
                           {{ $order->status_bayar ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $order->status_bayar ? 'Sudah Bayar' : 'Belum Bayar' }}
                        </span>
                        <p class="text-sm font-semibold">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-4">Tidak ada data</div>
        @endforelse
        @if ($orders->hasPages())
            <div class="flex justify-end mt-4">
                {{ $orders->links('layouts.pagination') }}
            </div>
        @endif
    </div>
</div>
