@extends('layouts.app')

@section('content')
    <div class="mt-[75px]">
        <div class="p-6 text-center bg-[--primary] text-[--on-primary]">
            <div class="w-24 h-24 mx-auto rounded-full border-4 border-[--on-primary] overflow-hidden">
                <img src="{{ asset('assets/img/user-default.jpg') }}" alt="Profile Picture" class="w-full h-full object-cover">
            </div>
            <h2 class="mt-4 text-xl font-bold">{{ Auth::user()->name }}</h2>
            <p class="text-sm text-[--on-primary] font-semibold">{{ Auth::user()->email }}</p>
            <div class="mt-4 border-t px-3 pt-3">
                <p class="text-md font-semibold">Saldo Anda</p>
                <p class="text-xl font-bold">Rp {{ number_format(Auth::user()->saldo->saldo ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>
        {{-- <div class="grid grid-cols-2 my-2">
            <div class="flex flex-col items-center lg:mb-8 rounded-lg bg-[--primary] text-[--on-primary] m-4 p-4">
                <i class="w-12 h-12 material-icons text-5xl">add_card</i>
                <span class="text-xs mt-2 text-center font-bold">Deposit</span>
            </div>
            <div class="flex flex-col items-center lg:mb-8 rounded-lg bg-[--primary] text-[--on-primary] m-4 p-4">
                <i class="w-12 h-12 material-icons text-5xl">account_balance_wallet</i>
                <span class="text-xs mt-2 text-center font-bold">Withdraw</span>
            </div>
        </div> --}}
        <div class="pb-4 mt-2">
            <hr>
            <a href="{{ route('transaksi.pembayaran') }}"
                class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                <span class="flex items-center space-x-4">
                    <i class="material-icons">payments</i>
                    <span class="text-[--on-primary] text-sm font-bold">Transaksi</span>
                </span>
                <i class="material-icons">chevron_right</i>
            </a>
            <hr>
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                <span class="flex items-center space-x-4">
                    <i class="material-icons">lock</i>
                    <span class="text-[--on-primary] text-sm font-bold">Akun dan Keamanan</span>
                </span>
                <i class="material-icons">chevron_right</i>
            </a>
            <hr>
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                <span class="flex items-center space-x-4">
                    <i class="material-icons">person</i>
                    <span class="text-[--on-primary] text-sm font-bold">Atur Profile</span>
                </span>
                <i class="material-icons">chevron_right</i>
            </a>
            <hr>
            <a href="#" class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                <span class="flex items-center space-x-4">
                    <i class="material-icons">info</i>
                    <span class="text-[--on-primary] text-sm font-bold">Pusat Bantuan</span>
                </span>
                <i class="material-icons">chevron_right</i>
            </a>
            <hr>
            <a onclick="document.getElementById('logout').submit();"
                class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer text-[--error-container] ">
                <span class="flex items-center space-x-4">
                    <i class="material-icons">logout</i>
                    <span class="text-[--error-container] text-sm font-bold">Keluar</span>
                </span>
            </a>
            <hr>
            <form action="{{ route('logout') }}" method="post" class="hidden" id="logout">
                @csrf
            </form>
        </div>

    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[#003060] text-white p-4 flex justify-between items-center">
        <div class="flex items-center">
            <h1 class="font-bold text-2xl">Profil</h1>
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
