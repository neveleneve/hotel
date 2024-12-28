<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="mb-4">
        <div class="relative">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari negara..."
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
    <div class="hidden md:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-xs uppercase bg-[--primary] text-[--on-primary]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">Nama Negara</th>
                        <th scope="col" class="px-6 py-3 text-center">Kode Bendera</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($countries as $country)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $country->name }}</td>
                            <td class="px-6 py-4 text-center">{{ $country->flag_code }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($countries->hasPages())
            <div class="flex justify-end mt-4">
                {{ $countries->links('layouts.pagination') }}
            </div>
        @endif
    </div>
    <div class="md:hidden space-y-4">
        @forelse ($countries as $country)
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold">{{ $country->name }}</p>
                        <p class="text-sm text-gray-600">Kode: {{ $country->flag_code }}</p>
                    </div>

                </div>
            </div>
        @empty
            <div class="text-center py-4">Tidak ada data</div>
        @endforelse
        @if ($countries->hasPages())
            <div class="flex justify-end mt-4">
                {{ $countries->links('layouts.pagination') }}
            </div>
        @endif
    </div>
</div>
