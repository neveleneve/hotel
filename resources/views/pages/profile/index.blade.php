@extends('layouts.app')

@section('content')
    <div class="my-16">
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[#003060] text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <img class="inline-block h-12 w-12 rounded-full ring-2 ring-white"
                src="{{ asset('assets/img/user-default.jpg') }}">
        </div>
        <div class="flex items-center space-x-4">
            <a href="#">
                <i class="material-icons text-4xl">support_agent</i>
            </a>
        </div>
    </header>
@endpush

@push('tab')
    @include('layouts.tab')
@endpush
