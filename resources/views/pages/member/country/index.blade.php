@extends('layouts.app')

@section('content')
    <div class="mt-[56px]">
        <section class="p-4 mb-3 bg-[--primary]">
            <h3 class="text-center font-bold text-2xl text-[--primary-container]">{{ $country->name }}</h3>
        </section>
        @livewire('country-hotel', ['flag_code' => $country->flag_code])
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
