<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="mb-4">
        <div class="relative">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari withdraw..."
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
                        <th scope="col" class="px-6 py-3 text-center">Nama</th>
                        <th scope="col" class="px-6 py-3 text-center">Email</th>
                        <th scope="col" class="px-6 py-3 text-center">Jumlah</th>
                        <th scope="col" class="px-6 py-3 text-center">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($withdraws as $index => $withdraw)

                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $withdraws->firstItem() + $index }}</td>
                            <td class="px-6 py-4 text-center">{{ $withdraw->user->name }}</td>
                            <td class="px-6 py-4 text-center">{{ $withdraw->user->email }}</td>
                            <td class="px-6 py-4 text-center">Rp {{ number_format($withdraw->amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">{{ $withdraw->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center font-bold text-lg">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($withdraws->hasPages())
            <div class="flex justify-end mt-4">
                {{ $withdraws->links('layouts.pagination') }}
            </div>
        @endif
    </div>

    <div class="lg:hidden space-y-4">
        @forelse ($withdraws as $withdraw)
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div class="space-y-2">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold">{{ $withdraw->user->name }}</p>
                            <p class="text-sm text-gray-600">{{ $withdraw->user->email }}</p>
                        </div>
                        <span class="text-sm text-gray-500">{{ $withdraw->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-gray-600 text-sm">Jumlah Withdraw:</span>
                        <p class="font-medium">Rp {{ number_format($withdraw->amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-4">Tidak ada data</div>
        @endforelse
        @if ($withdraws->hasPages())
            <div class="flex justify-end mt-4">
                {{ $withdraws->links('layouts.pagination') }}
            </div>
        @endif
    </div>
</div>

