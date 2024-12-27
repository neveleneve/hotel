<div>
    <div class="px-4 pb-2">
        <div class="relative w-full">
            <input type="text" placeholder="Cari..." wire:model.live="search" id="search-input"
                class="w-full pl-10 pr-10 py-2 border-2 border-[--on-primary] rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none" />
            <span class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-[--on-primary]">
                search
            </span>
            <span wire:click='clearSearch'
                class="material-icons{{ $search === null ? ' hidden ' : ' ' }}absolute right-3 top-1/2 transform -translate-y-1/2 text-[--on-primary]">
                close
            </span>
        </div>
    </div>
    <section class="p-4 pt-2">
        <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 lg:gap-2">
            @forelse ($hotel as $item)
                <a class="max-w-xs h-full flex flex-col bg-white border border-gray-200 rounded-lg shadow lg:mb-3"
                    href="{{ route('member.hotel.index', ['flag_code' => $item->country->flag_code, 'id' => $item->id]) }}">
                    <div class="relative w-full">
                        @if ($item->promo)
                            <div class="absolute top-2 right-2 animate-pulse">
                                <span class="bg-[--error] text-[--on-error] text-xs font-bold px-2 py-1 rounded-full">
                                    <i class="material-icons text-sm align-middle">local_offer</i>
                                    Promo
                                </span>
                            </div>
                        @endif
                        <img class="w-full aspect-square object-cover rounded-t-lg"
                            src="{{ Storage::url($item->image) }}" alt="Gambar Hotel {{ $item->name }}">
                    </div>
                    <div class="flex flex-col justify-between flex-1 p-4">
                        <div>
                            <h5 class="text-sm font-medium text-[--on-primary] min-h-[48px]">
                                {{ $item->name }}
                            </h5>
                            <div class="flex items-center mt-2">
                                <i class="h-4 w-4 fi fi-{{ $item->country->flag_code ?? 'default-flag' }}"></i>
                                <span class="text-xs text-[--on-primary] font-bold ml-3">
                                    {{ $item->country->name ?? 'xx' }}
                                </span>
                            </div>
                            <div class="flex items-center mt-1">
                                <i class="material-icons text-yellow-500 text-sm">star_half</i>
                                <span class="ml-1 text-sm font-semibold text-gray-700">{{ $item->rating ?? '-' }}</span>
                            </div>
                        </div>
                        <hr class="border-t my-2">
                        <div class="text-sm">
                            @if ($item->promo)
                                <div class="flex items-center gap-2">
                                    <div class="text-[--on-error] text-xs line-through font-bold">
                                        {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}
                                    </div>
                                    <span
                                        class="bg-[--error] text-[--on-error] text-xs px-2 py-0.5 rounded-full font-bold">
                                        -{{ $item->discount }}%
                                    </span>
                                </div>
                                <div class="font-extrabold text-[--on-primary]">
                                    {{ 'Rp ' . number_format($item->price - ($item->price * $item->discount) / 100, 0, ',', '.') }}
                                </div>
                            @else
                                <div class="font-bold text-[--on-primary]">
                                    {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                @if ($search === '')
                    <div class="flex flex-col col-span-2 lg:col-span-6 items-center justify-center py-12">
                        <span class="material-icons text-6xl text-[--primary-container] mb-3">hotel</span>
                        <h3 class="text-xl font-bold text-[--primary-container]">Tidak ada hotel</h3>
                        <p class="text-[--primary-container] font-semibold text-center mt-2">
                            Hotel belum tersedia untuk negara ini
                        </p>
                    </div>
                @else
                    <div class="flex flex-col col-span-2 lg:col-span-6 items-center justify-center py-12">
                        <span class="material-icons text-6xl text-[--primary-container] mb-3">hotel</span>
                        <h3 class="text-xl font-bold text-[--primary-container]">Tidak ada hotel</h3>
                        <p class="text-[--primary-container] font-semibold text-center mt-2">
                            Hotel dengan kata kunci "{{ $search }}" tidak ditemukan
                        </p>
                    </div>
                @endif
            @endforelse
        </div>
    </section>
</div>
