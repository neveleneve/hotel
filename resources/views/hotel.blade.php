@extends('layouts.app')

@section('content')
    <div class="my-16 mb-3">
        <div class="px-4">
            @livewire('hotel-landing')
        </div>
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
