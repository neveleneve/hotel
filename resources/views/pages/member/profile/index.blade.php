@extends('layouts.app')

@section('content')
    <div class="mt-[75px]">
        <div class="p-6 text-center bg-[--primary] text-[--on-primary]">
            <div class="w-24 h-24 mx-auto rounded-full border-4 border-[--on-primary] overflow-hidden">
                <img src="{{ asset('assets/img/user-default.jpg') }}" alt="Profile Picture" class="w-full h-full object-cover">
            </div>
            <h2 class="mt-4 text-xl font-bold">{{ Auth::user()->name }}</h2>
            <p class="text-sm text-[--on-primary] font-semibold">{{ Auth::user()->email }}</p>
        </div>
        <div class="grid grid-cols-2 my-2">
            <div
                class="flex flex-col items-center lg:mb-8 rounded-lg bg-[--on-primary] text-[--on-primary-container] m-4 p-4">
                <i class="w-12 h-12 material-icons text-5xl">credit_card</i>
                <span class="text-xs mt-2 text-center font-bold">Pembayaran</span>
            </div>
            <div
                class="flex flex-col items-center lg:mb-8 rounded-lg bg-[--on-primary] text-[--on-primary-container] m-4 p-4">
                <i class="w-12 h-12 material-icons text-5xl">history</i>
                <span class="text-xs mt-2 text-center font-bold">History</span>
            </div>
        </div>
        <hr>
        <div class="pb-4">
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
                    <span class="text-[--on-primary] text-sm font-bold">Akun dan Keamanan</span>
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

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden mt-10">
        <!-- Profile Section -->
        <div class="p-6 text-center">
            <div class="w-24 h-24 mx-auto rounded-full overflow-hidden border border-gray-300">
                <img src="https://via.placeholder.com/150" alt="Profile Picture" class="w-full h-full object-cover">
            </div>
            <h2 class="mt-4 text-xl font-bold">SRwIUB</h2>
            <p class="text-sm text-gray-600">Email: pandumahdanie@gmail.com</p>
            <p class="text-sm text-gray-600">User ID: 221186</p>
        </div>

        <!-- Order Status -->
        <div class="flex justify-around bg-gray-50 py-4 border-t border-b border-gray-200">
            <div class="text-center">
                <div class="w-8 h-8 mx-auto mb-1 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="text-gray-600">💳</i>
                </div>
                <p class="text-xs text-gray-700">Belum Bayar</p>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 mx-auto mb-1 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="text-gray-600">📦</i>
                </div>
                <p class="text-xs text-gray-700">Terkirim</p>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 mx-auto mb-1 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="text-gray-600">↩️</i>
                </div>
                <p class="text-xs text-gray-700">Pengembalian</p>
            </div>
            <div class="text-center">
                <div class="w-8 h-8 mx-auto mb-1 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="text-gray-600">✔️</i>
                </div>
                <p class="text-xs text-gray-700">Selesai</p>
            </div>
        </div>

        <!-- Menu Section -->
        <div class="py-4">
            <ul>
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                    <div class="flex items-center space-x-4">
                        <i class="text-gray-600">🔒</i>
                        <span class="text-gray-800 text-sm">Akun dan Keamanan</span>
                    </div>
                    <i class="text-gray-400">&gt;</i>
                </li>
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                    <div class="flex items-center space-x-4">
                        <i class="text-gray-600">👤</i>
                        <span class="text-gray-800 text-sm">Edit Profil</span>
                    </div>
                    <i class="text-gray-400">&gt;</i>
                </li>
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                    <div class="flex items-center space-x-4">
                        <i class="text-gray-600">🎟️</i>
                        <span class="text-gray-800 text-sm">Voucher</span>
                    </div>
                    <i class="text-gray-400">&gt;</i>
                </li>
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                    <div class="flex items-center space-x-4">
                        <i class="text-gray-600">📍</i>
                        <span class="text-gray-800 text-sm">Alamat Saya</span>
                    </div>
                    <i class="text-gray-400">&gt;</i>
                </li>
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 cursor-pointer">
                    <div class="flex items-center space-x-4">
                        <i class="text-gray-600">🌐</i>
                        <span class="text-gray-800 text-sm">Bahasa / Language</span>
                    </div>
                    <span class="text-gray-600 text-sm">Indonesia</span>
                </li>
            </ul>
        </div>
    </div>
</body>

</html> --}}
