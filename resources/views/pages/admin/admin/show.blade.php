@extends('layouts.admin')

@section('content')
    <div class="w-full">

        <section class="mb-3">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-[--primary-container]">Detail Admin</h3>
                <a href="{{ route('admin.admin.index') }}"
                    class="flex font-bold items-center py-2 px-3 rounded-lg bg-[--on-error-container] text-[--error-container] hover:text-[--on-error-container] hover:bg-[--error-container]">
                    <i class="material-icons">chevron_left</i>
                    <span>Kembali</span>
                </a>
            </div>
            <hr class="mt-3">
        </section>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Informasi Pribadi</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-medium">{{ $admin->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium">{{ $admin->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Role</p>
                        <p class="font-medium">{{ ucfirst($admin->role) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Bergabung Sejak</p>
                        <p class="font-medium">{{ $admin->created_at->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            {{ !$admin->deleted_at ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ !$admin->deleted_at ? 'Aktif' : 'Tidak Aktif' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Informasi Referral</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Kode Referral</p>
                        <p class="font-medium">{{ $admin->ownReff->reff_code }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Mereferral</p>
                        <p class="font-medium">{{ $admin->ownReff->reffBy->count() }} member</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
