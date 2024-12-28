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
                    class="px-2 py-2 bg-[--primary-container] text-[--on-primary-container] rounded-lg font-extrabold text-xs">
                    Top Up
                </a>
                <a href="{{ route('transaksi.wd') }}"
                    class="px-2 py-2 bg-[--primary] text-[--on-primary] rounded-lg font-extrabold text-xs">
                    Penarikan
                </a>
            </div>
            <h1 class="text-2xl font-bold mb-6">Riwayat Pembayaran</h1>
            @if ($order->count() > 0)
                <div class="space-y-4">
                    @foreach ($order as $item)
                        <div class="bg-white rounded-lg shadow p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-lg">{{ $item->hotel->name }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $item->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-medium
                                    @if ($item->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($item->status == 'success')
                                        bg-green-100 text-green-800
                                    @elseif($item->status == 'failed')
                                        bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <div class="text-gray-700">
                                    <p>Total Pembayaran:</p>
                                    <p class="font-bold text-lg">Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                                </div>
                                @if ($item->status == 'pending')
                                    <a href="{{ route('payment.show', $item->id) }}"
                                        class="px-4 py-2 bg-[--primary] text-[--on-primary] rounded-lg hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                                        Bayar Sekarang
                                    </a>
                                @endif
                            </div>

                            @if ($item->status == 'success')
                                <div class="mt-4 pt-4 border-t">
                                    <h4 class="font-medium mb-2">Detail Transaksi:</h4>
                                    <div class="grid grid-cols-2 gap-4 text-sm">
                                        <div>
                                            <p class="text-gray-600">Metode Pembayaran</p>
                                            <p class="font-medium">{{ $item->payment_method }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">ID Transaksi</p>
                                            <p class="font-medium">{{ $item->transaction_id }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-4">
                        <i class="material-icons text-6xl">receipt_long</i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">Belum ada transaksi</h3>
                    <p class="text-gray-600 mt-1">Anda belum melakukan transaksi apapun</p>
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
