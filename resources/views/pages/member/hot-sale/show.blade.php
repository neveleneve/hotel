@extends('layouts.app')

@section('content')
    <div class="mt-[66px] mb-[108px]">
        <div class="grid grid-cols-1 px-3 text-[--on-primary]">
            <div class="w-full h-full flex flex-col bg-white border rounded-lg shadow-lg lg:mb-3">
                <div class="relative w-full rounded-t-lg">
                    @if ($hotSale->discount_status)
                        <div class="absolute top-2 right-2 animate-pulse z-50">
                            <span class="bg-[--error] text-[--on-error] text-xs font-bold px-2 py-1 rounded-full">
                                <i class="material-icons text-sm align-middle">local_offer</i>
                                Hot Sale!
                            </span>
                        </div>
                    @endif
                    <div class="swiper z-10 rounded-t-lg">
                        <div class="swiper-wrapper aspect-[3/2] md:aspect-[16/6]">
                            <div class="swiper-slide flex justify-center">
                                <img src="{{ asset('assets/img/hotel/' . $hotSale->hotel->image) }}" class="object-cover">
                            </div>
                            <div class="swiper-slide flex justify-center">
                                <img src="{{ asset('assets/img/hotel/' . $hotSale->hotel->image) }}">
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
                            {{ $hotSale->hotel->name }}
                        </h5>
                        <div class="flex items-center mt-2">
                            <i class="material-icons text-md">location_on</i>
                            <span class="text-md font-semibold ml-1">
                                {{ $hotSale->hotel->country->name ?? 'xx' }}
                            </span>
                        </div>
                        <div class="flex items-center mt-1">
                            <i class="material-icons text-sm text-yellow-500">star_half</i>
                            <span class="ml-1 text-sm font-semibold">{{ $hotSale->hotel->rating }}</span>
                        </div>
                    </div>
                    <hr class="border-t border-gray-200 my-3">
                    @if ($hotSale->discount_status)
                        <div class="space-y-1">

                            <div class="flex items-center gap-2">
                                <div class="text-[--on-error] line-through font-bold text-xs">
                                    {{ 'Rp ' . number_format($hotSale->price, 0, ',', '.') }}
                                </div>
                                <span class="bg-[--error] text-[--on-error] text-xs px-2 py-0.5 rounded-full font-bold">
                                    -{{ $hotSale->discount }}%
                                </span>
                            </div>
                            <div class="font-extrabold text-[--on-primary] text-sm">
                                {{ 'Rp ' . number_format($hotSale->price - ($hotSale->price * $hotSale->discount) / 100, 0, ',', '.') }}
                            </div>
                        </div>
                    @else
                        <div class="font-extrabold text-[--on-primary] text-sm">
                            {{ 'Rp ' . number_format($hotSale->price, 0, ',', '.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[--on-primary] text-white p-2 flex justify-between items-center z-20">
        <div class="flex items-center">
            <a href="{{ route('landing') }}" class="font-bold flex items-center p-2 rounded-full">
                <i class="material-icons">chevron_left</i>
                Kembali
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
@endpush
