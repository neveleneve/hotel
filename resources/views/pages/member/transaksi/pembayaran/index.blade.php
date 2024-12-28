@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-3">
        <div class="pt-16 pb-20">
            <div class="flex space-x-1 mb-4">
                <a href="{{ route('transaksi.pembayaran') }}"
                    class="px-2 py-2 bg-[--primary-container] text-[--on-primary-container] rounded-lg font-extrabold text-xs">
                    Pembayaran
                </a>
                <a href="{{ route('transaksi.topup') }}"
                    class="px-2 py-2 bg-[--primary] text-[--on-primary] rounded-lg font-extrabold text-xs">
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
                        <div
                            class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 p-5 border border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $item->hotel->name }}</h3>
                                    <p class="text-gray-500 text-sm mt-1">{{ $item->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                <span
                                    class="px-4 py-1.5 rounded-full text-sm font-semibold tracking-wide
                                    @if ($item->status == 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                    @elseif($item->status == 'success')
                                        bg-green-50 text-green-700 border border-green-200
                                    @elseif($item->status == 'failed')
                                        bg-red-50 text-red-700 border border-red-200 @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>

                            <div class="mt-5 flex justify-between items-center">
                                <div class="text-gray-800">
                                    <p class="text-sm">Total Pembayaran:</p>
                                    <p class="font-bold text-xl mt-1">Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                                </div>
                                @if ($item->status == 'pending')
                                    <a href="{{ route('payment.show', $item->id) }}"
                                        class="px-6 py-2.5 bg-[--primary] text-[--on-primary] rounded-lg hover:bg-[--primary-container] hover:text-[--on-primary-container] transition-colors duration-300 font-semibold text-sm">
                                        Bayar Sekarang
                                    </a>
                                @endif
                            </div>

                            @if ($item->status == 'success')
                                <div class="mt-5 pt-5 border-t border-gray-100">
                                    <h4 class="font-semibold mb-3 text-gray-800">Detail Transaksi:</h4>
                                    <div class="grid grid-cols-2 gap-6 text-sm">
                                        <div>
                                            <p class="text-gray-500 mb-1">Metode Pembayaran</p>
                                            <p class="font-medium text-gray-800">{{ $item->payment_method }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 mb-1">ID Transaksi</p>
                                            <p class="font-medium text-gray-800">{{ $item->transaction_id }}</p>
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
                    <h3 class="text-lg font-medium text-gray-900">Belum ada transaksi pembayaran</h3>
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
@push('customjs')
    @session('title')
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('text') }}",
                icon: "{{ session('icon') }}",
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'bg-white rounded-lg shadow-lg',
                    title: 'text-lg font-bold text-[--on-primary]',
                    text: 'text-semibold text-[--on-primary]',
                    confirmButton: 'bg-[--primary] text-[--on-primary] px-4 py-2 rounded-lg hover:bg-[-primary-container] focus:ring focus:ring-blue-300 font-semibold',
                },
            })
        </script>
    @endsession
@endpush
