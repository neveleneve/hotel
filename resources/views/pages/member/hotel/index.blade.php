@extends('layouts.app')

@section('content')
    <div class="mt-[66px] mb-[108px]">
        <div class="grid grid-cols-1 px-3 text-[--on-primary]">
            <div class="w-full h-full flex flex-col bg-white border rounded-lg shadow-lg lg:mb-3">
                <div class="relative w-full rounded-t-lg">
                    @if ($hotel->promo)
                        <div class="absolute top-2 right-2 animate-pulse z-50">
                            <span class="bg-[--error] text-[--on-error] text-xs font-bold px-2 py-1 rounded-full">
                                <i class="material-icons text-sm align-middle">local_offer</i>
                                Promo
                            </span>
                        </div>
                    @endif
                    <div class="swiper z-10 rounded-t-lg">
                        <div class="swiper-wrapper aspect-[3/2] md:aspect-[16/6]">
                            <div class="swiper-slide flex justify-center">
                                <img src="{{ asset('assets/img/hotel/' . $hotel->id . '.jpg') }}" class="object-cover">
                            </div>
                            <div class="swiper-slide flex justify-center">
                                <img src="{{ asset('assets/img/hotel/' . $hotel->id . '.jpg') }}">
                            </div>
                        </div>
                        <div class="swiper-button-prev text-[--on-primary]"></div>
                        <div class="swiper-button-next text-[--on-primary]"></div>
                    </div>
                </div>
                <hr>
                <div class="flex flex-col justify-between flex-1 p-4">
                    <div>
                        <h5 class="text-2xl font-bold text-[--on-primary] min-h-[48px]">
                            {{ $hotel->name }}
                        </h5>
                        <div class="flex items-center mt-2">
                            <i class="material-icons text-md">location_on</i>
                            <span class="text-md  font-semibold ml-1">
                                {{ $hotel->country->name ?? 'xx' }}
                            </span>
                        </div>
                        <div class="flex items-center mt-1">
                            <i class="material-icons text-sm text-yellow-500">star_half</i>
                            <span class="ml-1 text-sm font-semibold">{{ $hotel->rating }}</span>
                        </div>
                    </div>
                    <hr class="border-t border-gray-200 my-3">
                    <div class=" font-bold text-[--on-primary] text-xl">
                        {{ 'Rp ' . number_format($hotel->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 px-3 text-[--on-primary]">
            <div class="w-full h-full flex flex-col bg-white border rounded-lg shadow-lg lg:mb-3 p-3 mt-3">
                <h3 class="font-bold text-xl">Detail Pesan</h3>
                <hr class="my-2">
                <div class="grid grid-cols-1 mb-3">
                    <div class="block flex-1">
                        <label for="room" class="font-bold text-md">Jumlah Kamar</label>
                        <input type="number" name="room" id="room" placeholder="Jumlah Kamar" value="1"
                            min="1"
                            class="mt-2 w-full rounded-full py-2 px-3 border border-[--on-primary] focus:ring-primary focus:border-primary">
                        @error('room_hidden')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2">
                    <div class="block flex-1">
                        <label for="check_in" class="font-bold text-md">Dari</label>
                        <input type="date" name="check_in" id="check_in" value="{{ date('Y-m-d') }}"
                            class="mt-2 w-full rounded-l-full py-2 px-3 border border-[--on-primary] focus:ring-primary focus:border-primary">
                        @error('check_in_hidden')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="block flex-1">
                        <label for="check_out" class="font-bold text-md">Sampai</label>
                        <input type="date" name="check_out" id="check_out"
                            value="{{ date('Y-m-d', strtotime('+1 days')) }}"
                            class="mt-2 w-full rounded-r-full py-2 px-3 border border-[--on-primary] focus:ring-primary focus:border-primary">
                        @error('check_out_hidden')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tab')
    <nav class="fixed bottom-0 left-0 w-full bg-[--on-primary] text-white  justify-around py-4 rounded-top z-20">
        <div class="px-4">
            <form method="POST" action="{{ route('order.store') }}" class="grid grid-cols-4 gap-4" onsubmit="getData()">
                @csrf
                <input type="hidden" name="hotel_id" value="{{ $hotel->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="room_hidden" id="room_hidden">
                <input type="hidden" name="check_in_hidden" id="check_in_hidden">
                <input type="hidden" name="check_out_hidden" id="check_out_hidden">
                <button type="submit" name="action" value="pesan"
                    class="bg-[--primary] text-[--on-primary] px-10 py-3 w-full rounded-full font-bold hover:bg-[--on-primary] hover:text-[--primary] hover:border hover:border-[--primary] border border-transparent col-span-3 text-center">
                    Pesan
                </button>
                <button type="submit" name="action" value="keranjang"
                    class="text-[--primary] border border-[--primary] px-3 py-2 w-full rounded-full font-bold hover:bg-[--primary] hover:border-transparent hover:text-[--on-primary] text-center">
                    <i class="material-icons ">shopping_bag</i>
                </button>
            </form>
        </div>
    </nav>
@endpush

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

@push('customcss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
        .swiper-button-prev,
        .swiper-button-next {
            color: var(--primary);
        }

        .swiper-button-prev::after,
        .swiper-button-next::after {
            font-size: 1.25rem;
        }
    </style>
@endpush

@push('customjs')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
    <script>
        function getData() {
            document.getElementById('room_hidden').value = document.getElementById('room').value;
            document.getElementById('check_in_hidden').value = document.getElementById('check_in').value;
            document.getElementById('check_out_hidden').value = document.getElementById('check_out').value;
        }
    </script>
    @session('title')
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('text') }}",
                icon: "{{ session('icon') }}",
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'bg-white rounded-lg shadow-lg',
                    title: 'text-lg font-bold text-[--on-primary]',
                    text: 'text-semibold text-[--on-primary]',
                    confirmButton: 'bg-[--primary] text-[--on-primary] px-4 py-2 rounded-lg hover:bg-[-primary-container] focus:ring focus:ring-blue-300 font-semibold',
                },
            })
        </script>
    @endsession
@endpush
