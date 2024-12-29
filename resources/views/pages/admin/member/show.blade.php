@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <section class="mb-3">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-[--primary-container]">Detail Member</h3>
                <a href="{{ route('admin.member.index') }}"
                    class="flex font-bold items-center py-2 px-3 rounded-lg bg-[--on-error-container] text-[--error-container] hover:text-[--on-error-container] hover:bg-[--error-container]">
                    <i class="material-icons">chevron_left</i>
                    <span>Kembali</span>
                </a>
            </div>
            <hr class="mt-3">
        </section>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Informasi Pribadi</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-medium">{{ $member->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $member->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Bergabung Sejak</p>
                        <p class="font-medium">{{ $member->created_at->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ !$member->deleted_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ !$member->deleted_at ? 'Aktif' : 'Tidak Aktif' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Informasi Referral</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Kode Referral Sendiri</p>
                        <p class="font-medium">{{ $member->ownReff->reff_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Direferral Oleh</p>
                        <p class="font-medium">{{ $member->reffBy->ownReff->user->name }}</p>
                        <p class="text-xs text-gray-400">({{ $member->reffBy->ownReff->reff_code }})</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Mereferral</p>
                        <p class="font-medium">{{ $member->ownReff->reffBy->count() }} member</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Saldo & Point</h4>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-[--secondary-container] p-4 rounded-lg">
                        <p class="text-sm text-[--on-secondary-container] mb-1">Saldo</p>
                        <p class="font-bold text-lg text-[--on-secondary-container]">
                            Rp {{ number_format($member->saldo?->saldo ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-[--tertiary-container] p-4 rounded-lg">
                        <p class="text-sm text-[--on-tertiary-container] mb-1">Point</p>
                        <p class="font-bold text-lg text-[--on-tertiary-container]">
                            {{ number_format($member->saldo?->point ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @can('member edit')
                    <form method="POST" action="{{ route('admin.member.update', $member) }}" class="grid gap-4">
                        @csrf
                        @method('PUT')
                        <div class="col-span-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1">
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                                    <select name="type" id="type"
                                        class="w-full rounded-lg border border-gray-300 px-2 py-1">
                                        <option value="saldo">Saldo</option>
                                        <option value="point">Point</option>
                                    </select>
                                </div>
                                <div class="flex-1">
                                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                    <input type="number" id="amount" name="amount" value="0"
                                        class="w-full rounded-lg border border-gray-300 px-2 py-1">
                                </div>
                            </div>
                        </div>
                        <button type="submit"
                            class="col-span-2 px-4 py-2 bg-[--primary] text-[--on-primary] rounded-lg font-bold hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                            Tambah
                        </button>
                    </form>
                @endcan
            </div>

            <div class="lg:col-span-3 space-y-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="font-bold text-lg mb-4">Riwayat Top Up</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[--primary] text-[--on-primary]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Tipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($member->topup as $topUp)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">{{ $topUp->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 rounded-full text-xs {{ $topUp->type === 'deposit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $topUp->type === 'deposit' ? 'Deposit' : 'Withdraw' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">Rp {{ number_format($topUp->amount, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500">Belum ada riwayat top
                                            up</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="font-bold text-lg mb-4">Riwayat Pesanan</h4>
                    <div class="hidden md:block">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 text-nowrap">
                                <thead class="bg-[--primary] text-[--on-primary]">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Hotel</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Check In</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Check Out</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse($member->orders as $order)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4">{{ $order->hotel->name }}</td>
                                            <td class="px-6 py-4">{{ $order->check_in }}</td>
                                            <td class="px-6 py-4">{{ $order->check_out }}</td>
                                            <td class="px-6 py-4">
                                                <span
                                                    class="px-2 py-1 rounded-full text-xs {{ $order->status_bayar ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $order->status_bayar ? 'Sudah Bayar' : 'Belum Bayar' }}</span>
                                            </td>
                                            <td class="px-6
                                                    py-4">Rp
                                                {{ number_format($order->total, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada pesanan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="md:hidden space-y-4">
                        @forelse($member->orders as $order)
                            <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                                <div class="font-medium">{{ $order->hotel->name }}</div>
                                <div class="text-sm text-gray-600">
                                    <div>Check In: {{ $order->check_in }}</div>
                                    <div>Check Out: {{ $order->check_out }}</div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $order->status_bayar ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $order->status_bayar ? 'Sudah Bayar' : 'Belum Bayar' }}
                                    </span>
                                    <span class="font-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-gray-500">Belum ada pesanan</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
