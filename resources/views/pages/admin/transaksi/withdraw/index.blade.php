@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <section class="mb-3">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-[--primary-container]">Riwayat Withdraw</h3>
            </div>
            <hr class="mt-3">
        </section>
        @livewire('admin-withdraw')
    </div>
@endsection
