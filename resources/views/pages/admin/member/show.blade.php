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
                </div>
            </div>
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
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
                                                class="px-2 py-1 rounded-full text-xs
                                                @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($order->status === 'completed') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ $order->status ? 'Sudah Bayar' : 'Belum Bayar' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
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
                                    class="px-2 py-1 rounded-full text-xs
                                    @if ($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $order->status ? 'Sudah Bayar' : 'Belum Bayar' }}
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
@endsection
