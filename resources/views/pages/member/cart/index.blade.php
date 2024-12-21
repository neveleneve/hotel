@extends('layouts.app')

@section('content')
    <div class="my-16">
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[#003060] text-white p-4 flex justify-center items-center">
        <div class="flex items-center">
            <h1 class="font-bold">Keranjang</h1>
        </div>
    </header>
@endpush

@push('tab')
    @include('layouts.tab')
@endpush
