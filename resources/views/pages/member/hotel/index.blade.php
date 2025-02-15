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
                                <img src="{{ asset('assets/img/hotel/' . $hotel->image) }}" class="object-cover">
                            </div>
                            <div class="swiper-slide flex justify-center">
                                <img src="{{ asset('assets/img/hotel/' . $hotel->image) }}">
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
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($hotel->rating))
                                    <i class="material-icons text-sm text-yellow-500 align-middle">star</i>
                                @elseif ($i - 0.5 <= $hotel->rating)
                                    <i class="material-icons text-sm text-yellow-500 align-middle">star_half</i>
                                @else
                                    <i class="material-icons text-sm text-yellow-500 align-middle">star_border</i>
                                @endif
                            @endfor
                            <span class="ml-1 text-sm align-middle font-semibold">{{ $hotel->rating }}</span>
                        </div>
                    </div>
                    <hr class="border-t border-gray-200 my-3">
                    @if ($hotel->promo)
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <div class="text-[--on-error] line-through font-bold text-xs">
                                    {{ 'Rp ' . number_format($hotel->price, 0, ',', '.') }}
                                </div>
                                <span class="bg-[--error] text-[--on-error] text-xs px-2 py-0.5 rounded-full font-bold">
                                    -{{ $hotel->discount }}%
                                </span>
                            </div>
                            <div class="font-extrabold text-[--on-primary] text-lg">
                                {{ 'Rp ' . number_format($hotel->price - ($hotel->price * $hotel->discount) / 100, 0, ',', '.') }}
                            </div>
                        </div>
                    @else
                        <div class="font-extrabold text-[--on-primary] text-lg">
                            {{ 'Rp ' . number_format($hotel->price, 0, ',', '.') }}
                        </div>
                    @endif
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
                <div class="grid grid-cols-2 gap-x-0">
                    <div class="block flex-1">
                        <label for="check_in" class="font-bold text-md">Dari</label>
                        <input type="date" name="check_in" id="check_in" value="{{ date('Y-m-d') }}"
                            class="mt-2 w-full rounded-l-full py-2 px-3 border border-[--on-primary] focus:ring-primary focus:border-primary appearance-none">
                        @error('check_in_hidden')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="block flex-1">
                        <label for="check_out" class="font-bold text-md">Sampai</label>
                        <input type="date" name="check_out" id="check_out"
                            value="{{ date('Y-m-d', strtotime('+1 days')) }}"
                            class="mt-2 w-full rounded-r-full py-2 px-3 border border-[--on-primary] focus:ring-primary focus:border-primary appearance-none">
                        @error('check_out_hidden')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 px-3 text-[--on-primary]">
            <div class="w-full h-full flex flex-col bg-white border rounded-lg shadow-lg lg:mb-3 p-3 mt-6">
                <h3 class="font-bold text-xl">Review</h3>
                <hr class="my-2">
                <div class="grid grid-cols-1 gap-4">
                    @forelse ($hotel->reviews as $review)
                        <div class="border rounded-lg px-4 pt-4 pb-3">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <img src="{{ asset('assets/img/user-default.jpg') }}" alt="Avatar"
                                        class="w-10 h-10 rounded-full object-cover">
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between items-center">
                                        <div class="font-semibold text-lg">
                                            {{ $review->name }}
                                            <p class="mt-2 text-gray-600 font-normal">{{ $review->comment }}</p>
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($review->star))
                                                        <i
                                                            class="material-icons text-sm text-yellow-500 align-middle">star</i>
                                                    @elseif ($i - 0.5 <= $review->star)
                                                        <i
                                                            class="material-icons text-sm text-yellow-500 align-middle">star_half</i>
                                                    @else
                                                        <i
                                                            class="material-icons text-sm text-yellow-500 align-middle">star_border</i>
                                                    @endif
                                                @endfor
                                                <span class="ml-1 text-sm align-middle">{{ $review->star }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center p-4 text-gray-500">
                            <i class="material-icons text-4xl">rate_review</i>
                            <p class="mt-2">Belum ada review</p>
                        </div>
                    @endforelse
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
