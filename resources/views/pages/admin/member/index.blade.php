@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <section class="mb-3">
            <h3 class="font-bold text-2xl text-center lg:text-start mb-3 text-[--primary-container]">Daftar Member</h3>
            <hr>
        </section>
        @livewire('admin-member')
    </div>
@endsection
