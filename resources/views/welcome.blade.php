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
            <hr class="mb-2">
            <div class="grid grid-cols-4 gap-4">
                @foreach ($country as $items)
                    <div class="flex flex-col items-center">
                        <i class="w-full h-12 border border-[--primary] fi fi-{{ $items->flag_code }}"></i>
                        <span class="text-xs mt-2 text-center font-bold">{{ $items->name }}</span>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="p-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="text-lg font-bold">Belanja Mall</h2>
                <a href="#" class="text-[--primary] text-xs font-bold">Lihat Semua</a>
            </div>
            <hr class="mb-2">
            <div class="flex space-x-4 mb-4">
                <button
                    class="px-2 py-1 bg-[--on-primary] text-[--on-primary-container] rounded-lg font-bold text-xs">Semua</button>
                <button class="px-2 py-1 bg-[--primary] text-[--primary-container] rounded-lg font-bold text-xs">Top
                    Deal</button>
                <button
                    class="px-2 py-1 bg-[--primary] text-[--primary-container] rounded-lg font-bold text-xs">Populer</button>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach ($hotel as $item)
                    <a class="max-w-xs bg-white border border-gray-200 rounded-lg shadow" href="#">
                        <img class="w-full h-100 rounded-t-lg" src="{{ asset('assets/img/hotel/' . $item->id . '.jpg') }}">
                        <div class="p-4">
                            <h5 class="text-sm font-medium text-[--on-primary]">{{ $item->name }}</h5>
                            <div class="items-center mt-2 z-0">
                                <i class="h-4 w-4 fi fi-{{ $item->country->flag_code }}"></i>
                                <span class="text-xs text-[--on-primary] font-bold">{{ $item->country->name }}</span>
                                <br>
                                <i class="material-icons text-yellow-500 text-sm">star_half</i>
                                <span class="ml-1 text-sm font-semibold text-gray-700">3.5</span>
                                <br>
                            </div>
                            <div class="mt-3 text-xs font-bold text-gray-900">
                                Rp {{ number_format($item->price, 0, ',', '.') }} / Malam
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection

@push('tab')
    @include('layouts.tab')
@endpush

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[#003060] text-white p-4 flex justify-between items-center z-50">
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
