@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <section class="mb-3">
            <h3 class="font-bold text-2xl text-center md:text-start mb-3 text-[--primary-container]">Daftar Negara</h3>
            <hr>
        </section>
        @livewire('admin-country')
    </div>
@endsection
