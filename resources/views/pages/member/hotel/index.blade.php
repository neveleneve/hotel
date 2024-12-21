@extends('layouts.app')

@section('content')
    <div class="my-[56px]">
        <div class="flex justify-center">
            <img src="{{ asset('assets/img/hotel/' . $hotel->id . '.jpg') }}"
                class="sm:aspect-square aspect-w-16 aspect-video items-center" alt="Gambar Hotel {{ $hotel->name }}">
        </div>
        <h1 class="text-2xl font-bold text-[--on-primary] mx-4 mb-3">
            {{ $hotel->name }}
        </h1>
        {{-- <hr class="my-1"> --}}
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
        <div class="flex items-center">
            <a href="{{ route('landing') }}" class="flex items-center p-2 bg-[--error] rounded-full">
                <i class="material-icons font-bold">chevron_left</i>
            </a>
        </div>

    </header>
@endpush

@push('tab')
    <nav class="fixed bottom-0 left-0 w-full bg-[--on-primary] text-white  justify-around py-4 rounded-top">
        <div class="px-4">
            <button
                class="bg-[--primary] px-10 py-2 w-full rounded-full font-bold hover:bg-[--on-primary] hover:border hover:border-[--primary]">
                Pesan
            </button>
        </div>
    </nav>
@endpush
