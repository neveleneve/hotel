@extends('layouts.admin')

@section('content')
    <div>
        <section class="mb-3">
            <h3 class="font-bold text-2xl text-center lg:text-start mb-3 text-[--primary-container]">Dashboard</h3>
            <hr>
        </section>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-[--primary] p-4 rounded-lg shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-[--primary-container] font-bold text-lg">Negara</h4>
                        <p class="text-[--primary-container] text-2xl font-bold">{{ $countries }}</p>
                    </div>
                    <i class="material-icons text-[--primary-container] text-opacity-20 text-6xl">public</i>
                </div>
            </div>
            <div class="bg-[--primary] p-4 rounded-lg shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-[--primary-container] font-bold text-lg">Hotel</h4>
                        <p class="text-[--primary-container] text-2xl font-bold">{{ $hotels }}</p>
                    </div>
                    <i class="material-icons text-[--primary-container] text-opacity-20 text-6xl">hotel</i>
                </div>
            </div>
            <div class="bg-[--primary] p-4 rounded-lg shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-[--primary-container] font-bold text-lg">Member</h4>
                        <p class="text-[--primary-container] text-2xl font-bold">{{ $members }}</p>
                    </div>
                    <i class="material-icons text-[--primary-container] text-opacity-20 text-6xl">people</i>
                </div>
            </div>
            <div class="bg-[--primary] p-4 rounded-lg shadow-md relative overflow-hidden">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-[--primary-container] font-bold text-lg">Profit</h4>
                        <p class="text-[--primary-container] text-2xl font-bold">Rp
                            {{ number_format($payments, 0, ',', '.') }}</p>
                    </div>
                    <i class="material-icons text-[--primary-container] text-opacity-20 text-6xl">payments</i>
                </div>
            </div>
        </div>
    </div>
@endsection
