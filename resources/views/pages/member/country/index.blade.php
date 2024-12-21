@extends('layouts.app')

@section('content')
    <div class="my-[56px]">
        <div class="p-6 text-center bg-[--primary] text-[--on-primary]">
            <div class="w-24 h-24 mx-auto rounded-full border-4 border-[--on-primary] overflow-hidden">
                <img src="{{ asset('assets/img/user-default.jpg') }}" alt="Profile Picture" class="w-full h-full object-cover">
            </div>
            <h2 class="mt-4 text-xl font-bold">{{ Auth::user()->name }}</h2>
            <p class="text-sm text-[--on-primary] font-semibold">{{ Auth::user()->email }}</p>
        </div>
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[--on-primary] text-white p-2 flex justify-between items-center z-20">
        <div class="flex items-center">
            <a href="{{ route('landing') }}" class="flex items-center p-2 bg-[--error] rounded-full">
                <i class="material-icons font-bold">chevron_left</i>
            </a>
        </div>

    </header>
@endpush
