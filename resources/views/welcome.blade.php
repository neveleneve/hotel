@extends('layouts.app')

@section('content')
    <div class="my-16">
        <div class="px-4 py-2">
            <input type="text" placeholder="Pencarian"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
        </div>
        <section class="px-4 py-2">
            <h2 class="text-lg font-bold mb-1">Event Belanja</h2>
            <hr class="mb-2">
            <div class="bg-gray-200 h-32 flex items-center justify-center mb-4">Slide 1</div>
            <div class="grid grid-cols-4 gap-4">
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/600x400?text=Jam+Tangan" class="w-12 h-12 bg-gray-300 rounded-full">
                    <span class="text-sm mt-2 text-center">Jam Tangan</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/600x400?text=Tas" class="w-12 h-12 bg-gray-300 rounded-full">
                    <span class="text-sm mt-2 text-center">Tas</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/600x400?text=Perhiasan" class="w-12 h-12 bg-gray-300 rounded-full">
                    <span class="text-sm mt-2 text-center">Perhiasan</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/600x400?text=Digital" class="w-12 h-12 bg-gray-300 rounded-full">
                    <span class="text-sm mt-2 text-center">Digital</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/600x400?text=Bayi" class="w-12 h-12 bg-gray-300 rounded-full">
                    <span class="text-sm mt-2 text-center">Bayi</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/600x400?text=Furniture" class="w-12 h-12 bg-gray-300 rounded-full">
                    <span class="text-sm mt-2 text-center">Furniture</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/600x400?text=Kecantikan" class="w-12 h-12 bg-gray-300 rounded-full">
                    <span class="text-sm mt-2 text-center">Kecantikan</span>
                </div>
                <div class="flex flex-col items-center">
                    <img src="https://placehold.co/600x400?text=Sport" class="w-12 h-12 bg-gray-300 rounded-full">
                    <span class="text-sm mt-2 text-center">Sport</span>
                </div>
            </div>
        </section>
        <section class="p-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="text-lg font-bold">Belanja Mall</h2>
                <a href="#" class="text-blue-500 text-sm">Lihat Semua</a>
            </div>
            <hr class="mb-2">
            <div class="flex space-x-4 mb-4">
                <button
                    class="px-2 py-1 bg-[--on-primary] text-[--on-primary-container] rounded-lg font-bold">Semua</button>
                <button class="px-2 py-1 bg-[--primary] text-[--primary-container] rounded-lg font-bold">Top Deal</button>
                <button class="px-2 py-1 bg-[--primary] text-[--primary-container] rounded-lg font-bold">Populer</button>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <a class="max-w-xs bg-white border border-gray-200 rounded-lg shadow" href="#">
                    <div class="relative">
                        <img class="w-full rounded-t-lg" src="https://placehold.co/150" alt="Wall Shower Set" />
                        <div class="absolute top-2 right-2 p-1 rounded text-[--error-container]">
                            <i class="material-icons fill">favorite</i>
                        </div>
                    </div>
                    <div class="p-4">
                        <h5 class="text-sm font-medium text-[--on-primary]">Item 0</h5>
                        <div class="items-center mt-2">
                            <i class="inline-block h-4 w-4 rounded-full fi fi-vn"></i>
                            <span class="text-sm text-gray-700 font-bold">Vietnam</span>
                            <br>
                            <i class="material-icons text-yellow-500 text-sm">star_half</i>
                            <span class="ml-1 text-sm font-semibold text-gray-700">3.5</span>
                            <br>
                        </div>
                        <div class="mt-3 text-lg font-semibold text-gray-900">
                            Rp4,599,000
                        </div>
                    </div>
                </a>
            </div>
        </section>
    </div>
@endsection

@push('tab')
    @include('layouts.tab')
@endpush

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[#003060] text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                src="{{ asset('assets/img/user-default.jpg') }}">
            <span class="ml-4 font-bold">Belanja.com</span>
        </div>
        <div class="flex items-center space-x-4">
            <a href="#">
                <i class="material-icons">notifications</i>
            </a>
            <a href="#">
                <i class="material-icons">favorite</i>
            </a>
        </div>
    </header>
@endpush
