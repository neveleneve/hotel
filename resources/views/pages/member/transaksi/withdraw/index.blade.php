@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-3">
        <div class="pt-16 pb-20">
            <div class="flex space-x-1 mb-4">
                <a href="{{ route('transaksi.pembayaran') }}"
                    class="px-2 py-2 bg-[--primary] text-[--on-primary] rounded-lg font-extrabold text-xs">
                    Pembayaran
                </a>
                <a href="{{ route('transaksi.topup') }}"
                    class="px-2 py-2 bg-[--primary] text-[--on-primary] rounded-lg font-extrabold text-xs">
                    Top Up
                </a>
                <a href="{{ route('transaksi.wd') }}"
                    class="px-2 py-2 bg-[--primary-container] text-[--on-primary-container] rounded-lg font-extrabold text-xs">
                    Penarikan
                </a>
            </div>
            <h1 class="text-2xl font-bold mb-6">Riwayat Withdraw</h1>
            @if ($wd->count() > 0)
                <div class="space-y-4">
                    @foreach ($wd as $item)
                        <div
                            class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 p-5 border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">Withdraw Saldo</h3>
                                    <p class="text-gray-500 text-sm mt-1">{{ $item->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            <div class="mt-5 flex justify-between items-center">
                                <div class="text-gray-800">
                                    <p class="text-sm">Nominal Withdraw:</p>
                                    <p class="font-bold text-xl mt-1">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-4">
                        <i class="material-icons text-6xl">account_balance_wallet</i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada riwayat top up</h3>
                    <p class="text-gray-600 mt-1">Anda belum melakukan top up saldo</p>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[--on-primary] text-white p-2 flex justify-between items-center z-20">
        <div class="flex items-center">
            <a href="{{ route('profile.index') }}" class="font-bold flex items-center p-2 rounded-full">
                <i class="material-icons">chevron_left</i>
                Kembali
            </a>
        </div>
    </header>
@endpush
