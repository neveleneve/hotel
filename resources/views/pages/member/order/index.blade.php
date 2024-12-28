@extends('layouts.app')

@section('content')
    <div class="my-16">
        <div class="grid grid-cols-1 gap-4 px-4">
            @forelse ($orders as $order)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2">
                    <div class="flex flex-col h-full">
                        <div class="flex">
                            <div class="w-1/4">
                                <img src="{{ asset('assets/img/hotel/' . $order->hotel->id . '.jpg') }}"
                                    alt="{{ $order->hotel->name }}" class="w-full h-full object-cover aspect-square">
                            </div>
                            <div class="flex-1 p-4">
                                <div class="flex items-center justify-between mb-1">
                                    <h5 class="text-lg font-extrabold text-[--on-primary]">
                                        {{ $order->hotel->name }}
                                    </h5>
                                </div>
                                <div class="pb-2">
                                    <h5 class="text-xs font-bold text-[--on-primary]">
                                        ID : {{ $order->order_code }}
                                    </h5>
                                </div>
                                <div class="space-y-2 text-sm text-[--on-primary] font-semibold mb-3">
                                    <div class="flex items-center">
                                        <i class="material-icons text-sm mr-1">event_available</i>
                                        <span>Check in: {{ date('d M Y', strtotime($order->check_in)) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="material-icons text-sm mr-1">event_busy</i>
                                        <span>Check out: {{ date('d M Y', strtotime($order->check_out)) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="material-icons text-sm mr-1">hotel</i>
                                        <span>{{ $order->total_room }} Kamar</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span title="{{ $order->status_bayar ? 'Sudah bayar' : 'Belum bayar' }}"
                                        class="text-xs px-2 py-1 rounded-full font-bold {{ $order->status_bayar ? 'bg-[--primary] text-[--on-primary]' : 'bg-[--error] text-[--on-error]' }}">
                                        {{ $order->status_bayar ? 'Sudah bayar' : 'Belum bayar' }}
                                    </span>
                                    @if (!$order->status_bayar)
                                        <button onclick="showPaymentInfo()"
                                            class="w-5 h-5 rounded-full bg-[--on-primary-container] text-[--on-primary] flex items-center justify-center hover:bg-[--primary]">
                                            <i class="material-icons text-sm">info</i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mt-auto p-4 border-t">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-[--on-primary] font-bold">Total Pembayaran</span>
                                <span class="text-lg font-bold text-[--on-primary]">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        @if (!$order->status_bayar)
                            <div class="mt-auto p-0 border-t">
                                <form method="POST" action="{{ route('order.update', ['order' => $order->id]) }}"
                                    class="flex items-center gap-2">
                                    @csrf
                                    @method('put')
                                    <button name="bayar"
                                        class="h-full align-end bg-[--primary] text-[--on-primary] hover:bg-[--primary-container] hover:text-[--on-primary-container] rounded-b-lg px-2 py-1 w-full font-bold">
                                        Bayar
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="flex flex-col col-span-2 lg:col-span-6 items-center justify-center py-12">
                    <span class="material-icons text-6xl text-[--primary-container] mb-3">shopping_cart</span>
                    <h3 class="text-xl font-bold text-[--primary-container]">Pesanan Kosong</h3>
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
    <script>
        function showPaymentInfo() {
            Swal.fire({
                title: 'Informasi Pembayaran',
                html: `
                    <p class="mb-4">Silahkan hubungi admin untuk melakukan pembayaran:</p>
                    <div class="text-center space-y-2">
                        <p><i class="material-icons align-middle">phone</i> +62 812-3456-7890</p>
                        <p><i class="material-icons align-middle">mail</i> admin@example.com</p>
                        <p><i class="material-icons align-middle">call</i> +62 812-3456-7890</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'bg-white rounded-lg shadow-lg',
                    title: 'text-lg font-bold text-[--on-primary]',
                    htmlContainer: 'text-semibold text-[--on-primary]',
                    confirmButton: 'bg-[--primary] text-[--on-primary] px-4 py-2 rounded-lg hover:bg-[-primary-container] focus:ring focus:ring-blue-300 font-bold',
                }
            });
        }
    </script>
@endpush
