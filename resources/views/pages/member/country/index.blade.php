@extends('layouts.app')

@section('content')
    <div class="mt-[56px]">
        <section class="p-4 mb-3 bg-[--primary]">
            <h3 class="text-center font-bold text-2xl text-[--primary-container]">{{ $country->name }}</h3>
        </section>
        <div class="px-4 pb-2">
            <div class="relative w-full">
                <input type="text" placeholder="Cari..."
                    class="w-full pl-10 pr-10 py-2 border-2 border-[--on-primary] rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                    id="search-input" oninput="toggleIcons()" />
                <span class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-[--on-primary]">
                    search
                </span>
                <span onclick="clearInput()" id="icon-times"
                    class="material-icons hidden absolute right-3 top-1/2 transform -translate-y-1/2 text-[--on-primary]">close</span>
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
                                src="{{ asset('assets/img/hotel/' . $item->id . '.jpg') }}"
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
                            {{-- <div class="text-xs font-bold text-[--on-primary]">
                                {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}
                            </div> --}}
                        </div>
                    </a>
                @empty
                    <div class="flex flex-col col-span-2 lg:col-span-6 items-center justify-center py-12">
                        <span class="material-icons text-6xl text-[--primary-container] mb-3">hotel</span>
                        <h3 class="text-xl font-bold text-[--primary-container]">Tidak ada hotel</h3>
                        <p class="text-[--primary-container] font-semibold text-center mt-2">Hotel belum tersedia untuk
                            negara ini</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[--on-primary] text-white p-2 flex justify-between items-center z-20">
        <div class="flex items-center">
            <a href="{{ route('landing') }}" class="font-bold flex items-center p-2 rounded-full">
                <i class="material-icons">chevron_left</i>
                Beranda
            </a>
        </div>

    </header>
@endpush
