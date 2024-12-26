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
                        <th scope="col" class="px-6 py-3 text-center">Nama Pemesan</th>
                        <th scope="col" class="py-3 text-center">Hotel</th>
                        <th scope="col" class="px-6 py-3 text-center">Check In</th>
                        <th scope="col" class="px-6 py-3 text-center">Check Out</th>
                        <th scope="col" class="py-3 text-center">Status</th>
                        <th scope="col" class="py-3 text-center">Total</th>
                        <th scope="col" class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 text-center">{{ $order->order_code }}</td>
                            <td class="px-6 py-4 text-center">{{ $order->user->name }}</td>
                            <td class="py-4 text-center">{{ $order->hotel->name }}</td>
                            <td class="px-6 py-4 text-center">{{ date('d M Y', strtotime($order->check_in)) }}</td>
                            <td class="px-6 py-4 text-center">{{ date('d M Y', strtotime($order->check_out)) }}</td>
                            <td class="py-4 text-center">
                                <span
                                    class="font-bold px-2 py-1 rounded-full text-xs
                                    @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $order->status ? 'Sudah Bayar' : 'Belum Bayar' }}
                                </span>
                            </td>
                            <td class="py-4 text-center">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="py-4 text-center">
                                <div class="flex gap-2 items-center justify-center">
                                    @can('order edit')
                                        <button title="Edit"
                                            class="p-2 rounded-lg hover:bg-[--primary] text-[--primary] hover:text-[--on-primary]">
                                            <i class="material-icons text-base">edit</i>
                                        </button>
                                    @endcan
                                    @can('order delete')
                                        <button title="Hapus"
                                            class="p-2 rounded-lg hover:bg-[--error] text-[--error] hover:text-[--on-error]">
                                            <i class="material-icons text-base">delete</i>
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center">Tidak ada data</td>
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

    <!-- Mobile Cards -->
    <div class="xl:hidden space-y-4">
        @forelse ($orders as $order)
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <p class="font-bold text-gray-600">{{ $order->hotel->name }}</p>
                        <p class="font-semibold">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-600">{{ $order->order_code }}</p>
                        <p class="text-sm">Check In: {{ $order->check_in }}</p>
                        <p class="text-sm">Check Out: {{ $order->check_out }}</p>
                        <span
                            class="font-bold inline-block px-2 py-1 rounded-full text-xs
                            @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'completed') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $order->status ? 'Sudah Bayar' : 'Belum Bayar' }}
                        </span>
                        <p class="text-sm font-semibold">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex gap-2">
                        @can('order edit')
                            <button title="Edit"
                                class="p-2 rounded-lg hover:bg-[--primary] text-[--primary] hover:text-[--on-primary]">
                                <i class="material-icons text-base">edit</i>
                            </button>
                        @endcan
                        @can('order delete')
                            <button title="Hapus"
                                class="p-2 rounded-lg hover:bg-[--error] text-[--error] hover:text-[--on-error]">
                                <i class="material-icons text-base">delete</i>
                            </button>
                        @endcan
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
