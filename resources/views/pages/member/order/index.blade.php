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
                                    @if ($order->status_pesan === 'pending')
                                        @if (!$order->status_bayar)
                                            @if ($order->status_cancel === 'none')
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-bold bg-[--error] text-[--on-error]">
                                                    Belum Bayar
                                                </span>
                                                <button onclick="showPaymentInfo()"
                                                    class="w-5 h-5 rounded-full bg-[--on-primary-container] text-[--on-primary] flex items-center justify-center hover:bg-[--primary]">
                                                    <i class="material-icons text-sm">info</i>
                                                </button>
                                            @elseif ($order->status_cancel === 'pending')
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-bold bg-[--tertiary] text-[--on-tertiary]">
                                                    Menunggu Konfirmasi Pembatalan
                                                </span>
                                            @elseif ($order->status_cancel === 'approve')
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-bold bg-[--error] text-[--on-error]">
                                                    Pesanan Dibatalkan
                                                </span>
                                            @elseif ($order->status_cancel === 'reject')
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-bold bg-[--error] text-[--on-error]">
                                                    Belum Bayar
                                                </span>
                                                <button onclick="showPaymentInfo()"
                                                    class="w-5 h-5 rounded-full bg-[--on-primary-container] text-[--on-primary] flex items-center justify-center hover:bg-[--primary]">
                                                    <i class="material-icons text-sm">info</i>
                                                </button>
                                            @endif
                                        @else
                                            @if ($order->status_cancel === 'none')
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-bold bg-[--primary] text-[--on-primary]">
                                                    Sudah Bayar
                                                </span>
                                            @elseif ($order->status_cancel === 'pending')
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-bold bg-[--tertiary] text-[--on-tertiary]">
                                                    Proses Pembatalan & Refund
                                                </span>
                                            @elseif ($order->status_cancel === 'approve')
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-bold bg-[--error] text-[--on-error]">
                                                    Dibatalkan & Refund
                                                </span>
                                            @elseif ($order->status_cancel === 'reject')
                                                <span
                                                    class="text-xs px-2 py-1 rounded-full font-bold bg-[--primary] text-[--on-primary]">
                                                    Sudah Bayar
                                                </span>
                                            @endif
                                        @endif
                                    @elseif ($order->status_pesan === 'done')
                                        @if ($order->status_cancel === 'none')
                                            <span
                                                class="text-xs px-2 py-1 rounded-full font-bold bg-[--success] text-[--on-success]">Selesai</span>
                                        @elseif ($order->status_cancel === 'pending')
                                            <span
                                                class="text-xs px-2 py-1 rounded-full font-bold bg-[--tertiary] text-[--on-tertiary]">Pengajuan
                                                Refund</span>
                                        @elseif ($order->status_cancel === 'approve')
                                            <span
                                                class="text-xs px-2 py-1 rounded-full font-bold bg-[--success] text-[--on-success]">Refund
                                                Disetujui</span>
                                        @elseif ($order->status_cancel === 'reject')
                                            <span
                                                class="text-xs px-2 py-1 rounded-full font-bold bg-[--success] text-[--on-success]">Selesai</span>
                                        @endif
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
                        <div class="mt-auto p-0 border-t rounded-b-lg">
                            <form method="POST" action="{{ route('order.update', ['order' => $order->id]) }}"
                                class="flex items-center">
                                @csrf
                                @method('put')
                                @if (
                                    $order->status_pesan === 'pending' &&
                                        !$order->status_bayar &&
                                        in_array($order->status_cancel, ['none', 'reject']) &&
                                        strtotime(date($order->check_in)) >= strtotime(date('Y-m-d')))
                                    <button type="submit" name="bayar" value="1"
                                        class="h-full align-start bg-[--primary] text-[--on-primary] hover:bg-[--primary-container] hover:text-[--on-primary-container] px-2 py-1 w-full font-bold">
                                        Bayar Sekarang
                                    </button>
                                @endif

                                @if (
                                    ($order->status_pesan === 'pending' || $order->status_pesan === 'done') &&
                                        in_array($order->status_cancel, ['none', 'reject']) &&
                                        strtotime(date($order->check_in)) >= strtotime(date('Y-m-d')))
                                    <button type="submit" name="batal" value="1"
                                        onclick="return confirm('Batalkan pesanan {{ $order->order_code }}?')"
                                        class="h-full align-end bg-[--error] text-[--on-error] hover:bg-[--error-container] hover:text-[--on-error-container] px-2 py-1 w-full font-bold">
                                        Batalkan Pesanan
                                    </button>
                                @endif
                            </form>
                        </div>
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
