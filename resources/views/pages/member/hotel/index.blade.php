@extends('layouts.app')

@section('content')
    <div class="my-[58px]">
        <div class="swiper">
            <div class="swiper-wrapper aspect-video">
                <div class="swiper-slide object-fill">
                    <img src="{{ asset('assets/img/hotel/' . $hotel->id . '.jpg') }}" alt="Shower Image 1">
                </div>
            </div>
            <div class="swiper-button-prev text-[--on-primary]"></div>
            <div class="swiper-button-next text-[--on-primary]"></div>
        </div>
        <h1 class="text-2xl font-bold text-[--on-primary] mx-4 mb-3">
            {{ $hotel->name }}
        </h1>
        <span class="font-bold text-[--on-primary]">
            <i class="mx-4 rounded-full fi fi-{{ $hotel->country->flag_code }} fis"></i>
            {{ $hotel->country->name }}
            <hr class="my-1">
        </span>
        <h1 class="text-lg font-bold text-[--on-primary] mx-4">
            Rp. {{ number_format($hotel->price, 0, ',', '.') }}
        </h1>
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[--on-primary] text-white p-2 flex justify-between items-center z-20 ">
        <a href="{{ route('landing') }}"
            class="flex items-center p-2 bg-[--primary] rounded-full border border-transparent hover:bg-transparent hover:border-[--primary]">
            <i class="material-icons font-bold">chevron_left</i>
        </a>

    </header>
@endpush

@push('tab')
    <nav class="fixed bottom-0 left-0 w-full bg-[--on-primary] text-white  justify-around py-4 rounded-top">
        <div class="px-4">
            <div class="grid grid-cols-4 gap-4">
                <a href="#"
                    class="bg-[--primary] text-[--on-primary] px-10 py-3 w-full rounded-full font-bold hover:bg-[--on-primary] hover:text-[--primary] hover:border hover:border-[--primary] border border-transparent col-span-3 text-center">
                    Pesan
                </a>
                <a href="#"
                    class="text-[--primary] border border-[--primary] px-3 py-2 w-full rounded-full font-bold hover:bg-[--primary] hover:border-transparent hover:text-[--on-primary] text-center">
                    <i class="material-icons  ">shopping_bag</i>
                </a>
            </div>
        </div>
    </nav>
@endpush
@push('customcss')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .swiper-button-prev,
        .swiper-button-next {
            color: var(--primary);
        }
    </style>
@endpush
@push('customjs')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endpush
{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Carousel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <style>
        .swiper-button-prev,
        .swiper-button-next {
            color: #000;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-md mx-auto bg-white shadow-md overflow-hidden md:max-w-2xl">
        <div class="md:flex">
            <div class="md:w-1/2 relative">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('assets/img/hotel/1.jpg') }}" class="h-full w-full object-cover" alt="Shower Image 1">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('assets/img/hotel/1.jpg') }}" class="h-full w-full object-cover" alt="Shower Image 2">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('assets/img/hotel/1.jpg') }}" class="h-full w-full object-cover" alt="Shower Image 3">
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('assets/img/hotel/1.jpg') }}" class="h-full w-full object-cover" alt="Shower Image 4">
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="p-8 md:w-1/2">
                <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Wall Shower Set Column 4 In 1
                    Shower Tiang Chrome</div>
                <p class="mt-2 text-gray-500">3 mode shower spray jarak drate mixer 15cm-17cm</p>
                <div class="mt-4">
                    <span class="text-gray-900 font-bold">Rp4,599,000</span>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-gray-600">3.5</span>
                    <span class="ml-2 text-gray-500">(197 jumlah ulasan)</span>
                </div>
                <div class="mt-4 flex items-center">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded mr-2">masuk keranjang</button>
                    <button class="bg-green-500 text-white px-4 py-2 rounded">beli sekarang</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
</body>

</html> --}}
