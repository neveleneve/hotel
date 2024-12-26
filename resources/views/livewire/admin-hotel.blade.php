<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <div class="relative flex-1">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari hotel..."
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
        @can('hotel create')
            <a href="{{ route('admin.hotel.create') }}"
                class="ml-4 px-4 py-2 bg-[--primary] text-[--on-primary] rounded-lg hover:bg-[--primary-container] hover:text-[--on-primary-container] flex items-center gap-2 font-bold">
                <i class="material-icons text-base">add</i>
                <span>Tambah Hotel</span>
            </a>
        @endcan
    </div>
    <div class="hidden md:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-xs uppercase bg-[--primary] text-[--on-primary]">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">No</th>
                        <th scope="col" class="px-6 py-3 text-center">Nama Hotel</th>
                        <th scope="col" class="px-6 py-3 text-center">Negara</th>
                        <th scope="col" class="px-6 py-3 text-center">Deskripsi</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($hotels as $hotel)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $hotel->id }}</td>
                            <td class="px-6 py-4 text-center">{{ $hotel->name }}</td>
                            <td class="px-6 py-4 text-center">{{ $hotel->country->name }}</td>
                            <td class="px-6 py-4 text-center">{{ Str::limit($hotel->description, 50) }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @can('hotel edit')
                                        <button title="Edit"
                                            class="p-2 rounded-lg hover:bg-[--primary] text-[--primary] hover:text-[--on-primary]">
                                            <i class="material-icons text-base">edit</i>
                                        </button>
                                    @endcan
                                    @can('hotel delete')
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
                            <td colspan="4" class="px-6 py-4 text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($hotels->hasPages())
            <div class="flex justify-end mt-4">
                {{ $hotels->links('layouts.pagination') }}
            </div>
        @endif
    </div>
    <div class="md:hidden space-y-4">
        @forelse ($hotels as $hotel)
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold">{{ $hotel->name }}</p>
                        <p class="text-sm text-gray-600">{{ Str::limit($hotel->description, 100) }}</p>
                    </div>
                    <div class="flex gap-2">
                        @can('hotel edit')
                            <button title="Edit"
                                class="p-2 rounded-lg hover:bg-[--primary] text-[--primary] hover:text-[--on-primary]">
                                <i class="material-icons text-base">edit</i>
                            </button>
                        @endcan
                        @can('hotel delete')
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
        @if ($hotels->hasPages())
            <div class="flex justify-end mt-4">
                {{ $hotels->links('layouts.pagination') }}
            </div>
        @endif
    </div>
</div>
