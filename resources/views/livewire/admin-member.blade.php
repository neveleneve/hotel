<div class="bg-white p-4 rounded-lg shadow-md">
    <div class="mb-4">
        <div class="relative">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari member..."
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
                        <th scope="col" class="px-6 py-3 text-center">Nama</th>
                        <th scope="col" class="px-6 py-3 text-center">Email</th>
                        <th scope="col" class="px-6 py-3 text-center">Saldo</th>
                        <th scope="col" class="px-6 py-3 text-center">Point</th>
                        <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($members as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-center">{{ $member->name }}</td>
                            <td class="px-6 py-4 text-center">{{ $member->email }}</td>
                            <td class="px-6 py-4 text-center">
                                Rp {{ number_format($member->saldo->saldo, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">{{ number_format($member->saldo->point, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    @can('member edit')
                                        <a title="Edit" href="{{ route('admin.member.show', $member->id) }}"
                                            class="p-2 rounded-lg hover:bg-[--primary] text-[--primary] hover:text-[--on-primary]">
                                            <i class="material-icons text-base">edit</i>
                                        </a>
                                    @endcan
                                    @can('member delete')
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
                            <td colspan="3" class="px-6 py-4 text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($members->hasPages())
            <div class="flex justify-end mt-4">
                {{ $members->links('layouts.pagination') }}
            </div>
        @endif
    </div>
    <div class="lg:hidden space-y-4">
        @forelse ($members as $member)
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-semibold">{{ $member->name }}</p>
                        <p class="text-sm text-gray-600">{{ $member->email }}</p>
                    </div>
                    <div class="flex gap-2">
                        @can('member edit')
                            <button title="Edit"
                                class="p-2 rounded-lg hover:bg-[--primary] text-[--primary] hover:text-[--on-primary]">
                                <i class="material-icons text-base">edit</i>
                            </button>
                        @endcan
                        @can('member delete')
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
        @if ($members->hasPages())
            <div class="flex justify-end mt-4">
                {{ $members->links('layouts.pagination') }}
            </div>
        @endif
    </div>
</div>
