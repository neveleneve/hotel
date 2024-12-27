<div>
    <div class="flex space-x-1 mb-4">
        <button wire:click="changeData('all')"
            class="px-2 py-2 bg-[--primary{{ $select == 'all' ? '-container' : null }}] text-[--on-primary{{ $select == 'all' ? '-container' : null }}] rounded-lg font-extrabold text-xs">
            Semua
        </button>
        <button wire:click="changeData('top')"
            class="px-2 py-1 bg-[--primary{{ $select == 'top' ? '-container' : null }}] text-[--on-primary{{ $select == 'top' ? '-container' : null }}] rounded-lg font-extrabold text-xs">
            Top Deal
        </button>
        <button wire:click="changeData('popular')"
            class="px-2 py-1 bg-[--primary{{ $select == 'popular' ? '-container' : null }}] text-[--on-primary{{ $select == 'popular' ? '-container' : null }}] rounded-lg font-extrabold text-xs">
            Populer
        </button>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-8 gap-4" wire:loading.class="opacity-40">
        @foreach ($hotel as $item)
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
                    <img class="w-full aspect-square object-cover rounded-t-lg" src="{{ Storage::url($item->image) }}"
                        alt="Gambar Hotel {{ $item->name }}">
                </div>
                <div class="flex flex-col justify-between flex-1 p-4">
                    <div>
                        <h5 class="text-sm font-medium text-[--on-primary] min-h-[48px]">
                            {{ $item->name }}
                        </h5>
                        <div class="flex items-center mt-2">
                            <i class="h-4 w-4 fi fi-{{ $item->country->flag_code ?? 'default-flag' }}"></i>
                            <span class="text-xs text-[--on-primary] font-bold ml-3">
                                {{ $item->country->name ?? '-' }}
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
                                <span class="bg-[--error] text-[--on-error] text-xs px-2 py-0.5 rounded-full font-bold">
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
        @endforeach
    </div>
    @if ($hasMorePages)
        <div wire:loading.remove class="flex justify-center mt-4">
            <button wire:click="loadMore" class="px-4 py-2 bg-[--primary] text-[--on-primary] rounded-lg font-bold">
                Load More
            </button>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('scroll', function() {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                @this.loadMore();
            }
        });
    </script>
@endpush
