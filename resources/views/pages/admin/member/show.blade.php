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
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-3">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Informasi Pribadi</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Nama</p>
                        <p class="font-semibold">{{ $member->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Email</p>
                        <p class="font-semibold">{{ $member->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Bergabung Sejak</p>
                        <p class="font-semibold">{{ $member->created_at->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Status</p>
                        <p
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ !$member->deleted_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ !$member->deleted_at ? 'Aktif' : 'Tidak Aktif' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Kode Referral Sendiri</p>
                        <p class="font-semibold">{{ $member->ownReff->reff_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Direferral Oleh</p>
                        <p class="font-semibold">
                            {{ $member->reffBy->ownReff->user->name }}
                            <span class="text-xs text-gray-500">
                                ({{ $member->reffBy->ownReff->reff_code }})
                            </span>
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Mereferral</p>
                        <p class="font-semibold">{{ $member->ownReff->reffBy->count() }} member</p>
                    </div>
                    <div>
                        @can('member edit')
                            <form method="POST" action="{{ route('admin.member.update', $member) }}"
                                class="mt-4 border-t-2 pt-4">
                                @csrf
                                @method('PUT')
                                <div class="space-y-3">
                                    <label for="password" class="text-sm text-gray-500 font-bold">Password Baru</label>
                                    <div class="relative">
                                        <input type="password" name="password" id="password" placeholder="Masukkan password baru"
                                            class="w-full rounded-lg border border-gray-300 px-2 py-1">
                                        <span class="absolute right-2 top-2 cursor-pointer" id="togglePassword">
                                            <i class="material-icons text-gray-500">visibility</i>
                                        </span>
                                    </div>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password baru" class="w-full rounded-lg border border-gray-300 px-2 py-1 mb-2">
                                        <span class="absolute right-2 top-2 cursor-pointer" id="toggleConfirmPassword">
                                            <i class="material-icons text-gray-500">visibility</i>
                                        </span>
                                    </div>
                                    <button type="submit" name="change_password"
                                        class="px-4 py-2 bg-[--primary] text-[--on-primary] rounded-lg font-bold hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                                        Ubah Password
                                    </button>
                                </div>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Saldo & Point</h4>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-[--primary-container] p-4 rounded-lg col-span-2 lg:col-span-1">
                        <p class="text-sm text-[--on-primary-container] mb-1">Saldo</p>
                        <p class="font-bold text-lg text-[--on-primary-container]">
                            Rp {{ number_format($member->saldo?->saldo ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-[--tertiary-container] p-4 rounded-lg col-span-2 lg:col-span-1">
                        <p class="text-sm text-[--on-tertiary-container] mb-1">Point</p>
                        <p class="font-bold text-lg text-[--on-tertiary-container]">
                            {{ number_format($member->saldo?->point ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                @can('member edit')
                    <form method="POST" action="{{ route('admin.member.update', $member) }}"
                        class="grid grid-cols-2 gap-4 border-t-2">
                        @csrf
                        @method('PUT')
                        <div class="col-span-2 lg:col-span-1">
                            <div class="flex-1">
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                                <select name="type" id="type"
                                    class="w-full rounded-lg border border-gray-300 px-2 py-1">
                                    <option value="saldo">Saldo</option>
                                    <option value="point">Point</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-2 lg:col-span-1">
                            <div class="flex-1">
                                <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                <input type="number" id="amount" name="amount" value="0"
                                    class="w-full rounded-lg border border-gray-300 px-2 py-1">
                            </div>
                        </div>
                        <button type="submit" name="saldo"
                            class="col-span-2 px-4 py-2 bg-[--primary] text-[--on-primary] rounded-lg font-bold hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                            Tambah
                        </button>
                    </form>
                @endcan
                @can('member edit')
                    <form method="POST" action="{{ route('admin.member.update', $member) }}" class="mt-4 border-t-2">
                        @csrf
                        @method('PUT')
                        <div class="space-y-2">
                            <label for="hotel_id" class="text-sm text-gray-500 font-bold">Pilih Hotel Hot Sale</label>
                            <select name="hotel_id" id="hotel_id" class="w-full rounded-lg border border-gray-300 px-2 py-1">
                                <option value="">Pilih Hotel Hot Sale</option>
                                @foreach ($hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                @endforeach
                            </select>
                            <label for="price" class="text-sm text-gray-500 font-bold">Harga Hot Sale</label>
                            <input type="number" name="price" id="price" placeholder="Harga Penawaran"
                                class="w-full rounded-lg border border-gray-300 px-2 py-1" min="0">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_discount" id="is_discount" class="rounded">
                                <label for="is_discount" class="text-sm text-gray-500 font-bold">Aktifkan Diskon</label>
                            </div>
                            <div>
                                <label for="discount" class="text-sm text-gray-500 font-bold">Jumlah Diskon (%)</label>
                                <input type="number" name="discount" id="discount" placeholder="Masukkan jumlah diskon"
                                    class="w-full rounded-lg border border-gray-300 px-2 py-1" max="100" min="0">
                            </div>
                            <button type="submit" name="assign_hotel"
                                class="px-4 py-2 w-full bg-[--primary] text-[--on-primary] rounded-lg font-bold hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                                Tambah Hot Sale Member
                            </button>
                        </div>
                    </form>
                @endcan
            </div>
        </div>
        <div class="grid grid-cols-1 gap-4 mb-3">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Daftar Hot Sale Member</h4>
                <div class="hidden md:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-nowrap">
                            <thead class="bg-[--primary] text-[--on-primary]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Hotel</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Harga Normal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Diskon</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Harga Akhir</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($member->memberMessages as $project)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">{{ $project->hotel->name }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($project->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            @if ($project->discount_status)
                                                <span class="text-green-600">{{ $project->discount }}%</span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($project->discount_status)
                                                Rp
                                                {{ number_format($project->price - ($project->price * $project->discount) / 100, 0, ',', '.') }}
                                            @else
                                                Rp {{ number_format($project->price, 0, ',', '.') }}
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 rounded-full text-xs {{ $project->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $project->active ? 'Aktif' : 'Nonaktif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form method="POST" action="{{ route('admin.member.update', $member) }}"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="project_id" value="{{ $project->id }}">
                                                <input type="hidden" name="action" value="toggle_project">
                                                <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                                                    {{ $project->active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada project yang ditugaskan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md:hidden space-y-4">
                    @forelse($member->memberMessages as $project)
                        <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                            <div class="font-medium">{{ $project->hotel->name }}</div>
                            <div class="text-sm text-gray-600">
                                <div>Harga Normal: Rp {{ number_format($project->price, 0, ',', '.') }}</div>
                                @if ($project->discount_status)
                                    <div>Diskon: <span class="text-green-600">{{ $project->discount }}%</span></div>
                                    <div>Harga Akhir: Rp
                                        {{ number_format($project->price - ($project->price * $project->discount) / 100, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="px-2 py-1 rounded-full text-xs {{ $project->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $project->active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                                <form method="POST" action="{{ route('admin.member.update', $member) }}"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <input type="hidden" name="action" value="toggle_project">
                                    <button type="submit" class="text-sm text-blue-600 hover:text-blue-800">
                                        {{ $project->active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">Belum ada project yang ditugaskan</div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-3">
            <div class="bg-white p-6 rounded-lg shadow-md order-0 ">
                <h4 class="font-bold text-lg mb-4">Riwayat Top Up</h4>
                <div class="hidden md:block">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-[--primary] text-[--on-primary]">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Tipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase">Aksi</th>
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
                                        <td class="px-6 py-4">Rp {{ number_format($topUp->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('admin.deposit.destroy', $topUp->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ auth()->user()->can('deposit delete') ? '4' : '3' }}"
                                            class="px-6 py-4 text-center text-gray-500">
                                            Belum ada riwayat top up
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="md:hidden space-y-4">
                    @forelse($member->topup as $topUp)
                        <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                            <div class="text-sm text-gray-600">
                                <div>Tanggal: {{ $topUp->created_at->format('d M Y H:i') }}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="px-2 py-1 rounded-full text-xs {{ $topUp->type === 'deposit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $topUp->type === 'deposit' ? 'Deposit' : 'Withdraw' }}
                                </span>
                                <span class="font-medium">Rp
                                    {{ number_format($topUp->amount, 0, ',', '.') }}</span>
                            </div>
                            @can('deposit delete')
                                <div class="mt-2 border-t pt-2">
                                    <form action="{{ route('admin.top-up.destroy', $topUp->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">Belum ada riwayat top up</div>
                    @endforelse
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md order-1 ">
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
                                        <td class="px-6 py-4">{{ date('d M Y', strtotime($order->check_in)) }}
                                        </td>
                                        <td class="px-6 py-4">{{ date('d M Y', strtotime($order->check_out)) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 rounded-full text-xs {{ $order->status_bayar ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $order->status_bayar ? 'Sudah Bayar' : 'Belum Bayar' }}</span>
                                        </td>
                                        <td class="px-6
                                                py-4">
                                            Rp
                                            {{ number_format($order->total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada
                                            pesanan
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
                                <div>Check In: {{ date('d F Y', strtotime($order->check_in)) }}</div>
                                <div>Check Out: {{ date('d F Y', strtotime($order->check_out)) }}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span
                                    class="px-2 py-1 rounded-full text-xs {{ $order->status_bayar ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $order->status_bayar ? 'Sudah Bayar' : 'Belum Bayar' }}
                                </span>
                                <span class="font-medium">Rp
                                    {{ number_format($order->total, 0, ',', '.') }}</span>
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

@push('customjs')
    @if (session('title') || $errors->any())
        <script>
            Swal.fire({
                title: "{{ session('title') ?? 'Gagal' }}",
                text: "{{ session('text') ?? $errors->first() }}",
                icon: "{{ session('icon') ?? 'error' }}",
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'bg-white rounded-lg shadow-lg',
                    title: 'text-lg font-bold text-[--on-primary]',
                    text: 'text-semibold text-[--on-primary]',
                    confirmButton: 'bg-[--primary] text-[--on-primary] px-4 py-2 rounded-lg hover:bg-[-primary-container] focus:ring focus:ring-blue-300 font-semibold',
                },
            })
        </script>
    @endif
@endpush
@push('customjs')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            const icon = this.querySelector('.material-icons');
            icon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            const icon = this.querySelector('.material-icons');
            icon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
        });
    </script>
@endpush
