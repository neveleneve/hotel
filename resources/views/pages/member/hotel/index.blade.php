@extends('layouts.app')

@section('content')
    <div class="mt-3 mb-[168px]">
        <div class="grid grid-cols-1 px-3">
            <div
                class="w-full h-full flex flex-col bg-white border border-[--primary-container] rounded-lg shadow-lg lg:mb-3">
                <div class="relative w-full rounded-t-lg">
                    <div class="swiper z-10 rounded-t-lg">
                        <div class="swiper-wrapper aspect-square lg:aspect-video">
                            <div class="swiper-slide flex justify-center">
                                <img src="{{ asset('assets/img/hotel/' . $hotel->id . '.jpg') }}" class="object-cover">
                            </div>
                            <div class="swiper-slide flex justify-center">
                                <img src="{{ asset('assets/img/hotel/' . $hotel->id . '.jpg') }}">
                            </div>
                        </div>
                        <div class="text-xs">
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
                            {{-- <i class="h-4 w-4 fi fi-{{ $hotel->country->flag_code ?? 'xx' }}"></i> --}}
                            <i class="material-icons text-md text-[--on-primary]">location_on</i>
                            <span class="text-md text-[--on-primary] font-semibold ml-1">
                                {{ $hotel->country->name ?? 'xx' }}
                            </span>
                        </div>
                        <div class="flex items-center mt-1">
                            <i class="material-icons text-yellow-500 text-sm">star_half</i>
                            <span class="ml-1 text-sm font-semibold text-gray-700">3.5</span>
                        </div>
                    </div>
                    <hr class="border-t border-gray-200 my-3">
                    <div class=" font-bold text-[--on-primary] text-xl">
                        {{ 'Rp ' . number_format($hotel->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 px-3">
            <div
                class="w-full h-full flex flex-col bg-white border border-[--primary-container] rounded-lg shadow-lg lg:mb-3 p-3 mt-3">
                <h3 class="font-bold text-xl">Jadwal</h3>
                <hr class="my-2">
                <div class="grid grid-cols-2">
                    <div class="block flex-1">
                        <label for="start_date" class="font-bold text-md">Dari</label>
                        <input type="date" name="start_date" id="start_date"
                            class="mt-2 w-full rounded-l-full py-2 px-3 border border-[--on-primary] focus:ring-primary focus:border-primary">
                    </div>
                    <div class="block flex-1">
                        <label for="start_date" class="font-bold text-md">Sampai</label>
                        <input type="date" name="start_date" id="start_date"
                            class="mt-2 w-full rounded-r-full py-2 px-3 border border-[--on-primary] focus:ring-primary focus:border-primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('tab')
    <nav class="fixed bottom-0 left-0 w-full bg-[--on-primary] text-white  justify-around py-4 rounded-top z-20">
        <div class="px-4">
            <div class="grid grid-cols-4 gap-4 mb-3">
                <a href="#"
                    class="bg-[--primary] text-[--on-primary] px-10 py-3 w-full rounded-full font-bold hover:bg-[--on-primary] hover:text-[--primary] hover:border hover:border-[--primary] border border-transparent col-span-3 text-center">
                    Pesan
                </a>
                <a href="#"
                    class="text-[--primary] border border-[--primary] px-3 py-2 w-full rounded-full font-bold hover:bg-[--primary] hover:border-transparent hover:text-[--on-primary] text-center">
                    <i class="material-icons ">shopping_bag</i>
                </a>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <a href="{{ url()->previous() ? url()->previous() : route('landing') }}"
                    class="bg-[--error] text-[--on-error] px-10 py-3 w-full rounded-full font-bold hover:bg-[--on-error] hover:text-[--error] hover:border hover:border-transparent border border-transparent text-center">
                    Kembali
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

        .swiper-button-prev::after,
        .swiper-button-next::after {
            font-size: 1.25rem;
            /* Atur ukuran font ikon */
        }
    </style>
    {{-- <style>
        </style> --}}
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
