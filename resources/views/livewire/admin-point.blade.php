<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="mb-4">
        <div class="relative">
            <input type="text" wire:model.live="search" placeholder="Cari transaksi..."
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

    <div class="hidden lg:block">
        <div class="overflow-x-auto">
            <table class="min-w-[800px] w-full text-sm">
                <thead class="text-xs uppercase bg-[--primary] text-[--on-primary]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">No</th>
                        <th scope="col" class="px-6 py-3 text-center">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-center">Pengguna</th>
                        <th scope="col" class="px-6 py-3 text-center">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($points as $point)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-center">{{ $point->created_at->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 text-center">{{ $point->user->name }}</td>
                            <td class="px-6 py-4 text-center">{{ number_format($point->amount, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center font-bold text-lg">Data tidak tersedia</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($points->hasPages())
            <div class="flex justify-end mt-4">
                {{ $points->links('layouts.pagination') }}
            </div>
        @endif
    </div>

    <div class="lg:hidden space-y-4">
        @forelse ($points as $point)
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div class="space-y-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">{{ $point->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $point->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <p class="font-medium">{{ number_format($point->amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-4">Data tidak tersedia</div>
        @endforelse
        @if ($points->hasPages())
            <div class="flex justify-end mt-4">
                {{ $points->links('layouts.pagination') }}
            </div>
        @endif
    </div>
</div>
