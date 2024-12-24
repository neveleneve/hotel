@extends('layouts.app')

@section('content')
    <div class="my-16">
        <div class="grid grid-cols-1 gap-4 px-4">
            @forelse ($orders as $order)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2">
                    <div class="flex">
                        <div class="w-1/4 md:w-1/4">
                            <img src="{{ asset('assets/img/hotel/' . $order->hotel->id . '.jpg') }}"
                                alt="{{ $order->hotel->name }}" class="w-full h-full object-cover aspect-[3/2]">
                        </div>
                        <div class="flex-1 p-4 pb-2">
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="text-lg font-bold text-[--on-primary]">
                                    {{ $order->hotel->name }}
                                </h5>
                            </div>
                            <div class="pb-2">
                                <h5 class="text-xs font-bold text-[--on-primary]">
                                    {{ $order->order_code }}
                                </h5>
                            </div>

                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <i class="material-icons text-sm mr-1">calendar_today</i>
                                    <span>Check in: {{ date('d M Y', strtotime($order->check_in)) }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="material-icons text-sm mr-1">calendar_today</i>
                                    <span>Check out: {{ date('d M Y', strtotime($order->check_out)) }}</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="material-icons text-sm mr-1">hotel</i>
                                    <span>{{ $order->total_room }} Kamar</span>
                                </div>
                                <div class="flex items-center">
                                    <span title="{{ $order->status_bayar ? 'Sudah bayar' : 'Belum bayar' }}"
                                        class="text-xs px-2 py-1 rounded-full font-bold {{ $order->status_bayar ? 'bg-green-100 text-green-800' : 'bg-[--error] text-[--on-error]' }}">
                                        {{ $order->status_bayar ? 'Sudah bayar' : 'Belum bayar' }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-1 pt-1 border-t">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600 font-bold">Total Pembayaran</span>
                                    <span class="text-lg font-bold text-[--on-primary]">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 font-extrabold">
                    <p class="text-gray-500">Tidak ada pesanan</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[#003060] text-white p-4 flex justify-center items-center">
        <div class="flex items-center">
            <h1 class="font-bold">Pesanan Saya</h1>
        </div>
    </header>
@endpush

@push('tab')
    @include('layouts.tab')
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
