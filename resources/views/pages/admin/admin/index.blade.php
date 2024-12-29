@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <section class="mb-3">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-bold text-2xl text-[--primary-container]">Daftar Admin</h3>
            </div>
            <hr>
        </section>
        @livewire('admin-admin')
    </div>
@endsection
