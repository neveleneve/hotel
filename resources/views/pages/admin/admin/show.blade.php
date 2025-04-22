@extends('layouts.admin')

@section('content')
    <div class="w-full">
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="mb-3">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-[--primary-container]">Detail Admin</h3>
                <div class="flex gap-2">
                    <button onclick="toggleEdit()" id="editButton"
                        class="flex font-bold items-center py-2 px-3 rounded-lg bg-[--primary-container] text-[--on-primary-container] hover:opacity-90">
                        <i class="material-icons mr-1">edit</i>
                        <span>Edit</span>
                    </button>
                    <a href="{{ route('admin.admin.index') }}"
                        class="flex font-bold items-center py-2 px-3 rounded-lg bg-[--on-error-container] text-[--error-container] hover:text-[--on-error-container] hover:bg-[--error-container]">
                        <i class="material-icons">chevron_left</i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
            <hr class="mt-3">
        </section>

        <!-- Edit Form -->
        <form action="{{ route('admin.admin.update', ['admin' => $admin->id]) }}" method="POST" id="editForm"
            class="hidden">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-6">
                        <h4 class="font-bold text-lg text-gray-800">Informasi Pribadi</h4>
                        <span class="text-sm text-dark-500"><strong class="text-red-500">*</strong> Wajib diisi</span>
                    </div>

                    <div class="space-y-6">
                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="material-icons text-gray-400">person</i>
                                </span>
                                <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-[--primary] focus:border-[--primary]"
                                    required>
                            </div>
                        </div>

                        <div class="relative">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="material-icons text-gray-400">email</i>
                                </span>
                                <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-[--primary] focus:border-[--primary]"
                                    required>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-300">
                            <h5 class="font-medium text-gray-700 mb-4">Ubah Password</h5>
                            <div class="space-y-4">
                                <div class="relative">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="material-icons text-gray-400">lock</i>
                                        </span>
                                        <input type="password" name="password"
                                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-[--primary] focus:border-[--primary]"
                                            placeholder="Kosongkan jika tidak ingin mengubah password">
                                    </div>
                                </div>

                                <div class="relative">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi
                                        Password</label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="material-icons text-gray-400">lock_clock</i>
                                        </span>
                                        <input type="password" name="password_confirmation"
                                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-[--primary] focus:border-[--primary]"
                                            placeholder="Konfirmasi password baru">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Role <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="material-icons text-gray-400">badge</i>
                                    </span>
                                    <select name="role"
                                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-[--primary] focus:border-[--primary]">
                                        <option value="super admin"
                                            {{ old('role', $admin->roles[0]['id']) === 1 ? 'selected' : '' }}>
                                            Super Admin
                                        </option>
                                        <option value="admin"
                                            {{ old('role', $admin->roles[0]['id']) === 2 ? 'selected' : '' }}>Admin
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Status <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="material-icons text-gray-400">toggle_on</i>
                                    </span>
                                    <select name="status"
                                        class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-[--primary] focus:border-[--primary]">
                                        <option value="active" {{ !$admin->deleted_at ? 'selected' : '' }}>Aktif</option>
                                        <option value="inactive" {{ $admin->deleted_at ? 'selected' : '' }}>Tidak Aktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-[--primary] text-[--on-primary] rounded-lg hover:bg-[--primary-container] hover:text-[--on-primary-container] flex items-center justify-center gap-2 font-bold">
                                <i class="material-icons">save</i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Removed editable referral section, keeping it view-only -->
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
        </form>

        <!-- View Mode -->
        <div id="viewMode" class="grid grid-cols-1 lg:grid-cols-2 gap-4">
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
                            {{-- {{ $admin->roles[0]['name'] }} --}}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h4 class="font-bold text-lg mb-4">Informasi Referral</h4>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Kode Referral</p>
                        <div class="flex items-center gap-2">
                            <p class="font-medium" id="reffCode">{{ $admin->ownReff->reff_code }}</p>
                            <button onclick="copyReffCode()" class="text-blue-600 hover:text-blue-800">
                                <i class="material-icons text-sm">content_copy</i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Mereferral</p>
                        <p class="font-medium">{{ $admin->ownReff->reffBy->count() }} member</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('customjs')
        <script>
            function toggleEdit() {
                const viewMode = document.getElementById('viewMode');
                const editForm = document.getElementById('editForm');
                const editButton = document.getElementById('editButton');

                if (editForm.classList.contains('hidden')) {
                    editForm.classList.remove('hidden');
                    viewMode.classList.add('hidden');
                    editButton.querySelector('span').textContent = 'Batal';
                    editButton.querySelector('i').textContent = 'close';
                } else {
                    editForm.classList.add('hidden');
                    viewMode.classList.remove('hidden');
                    editButton.querySelector('span').textContent = 'Edit';
                    editButton.querySelector('i').textContent = 'edit';
                }
            }

            function copyReffCode() {
                const reffCode = document.getElementById('reffCode').textContent;

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(reffCode)
                        .then(() => {
                            showCopySuccess();
                        })
                        .catch(() => {
                            legacyCopy(reffCode);
                        });
                } else {
                    legacyCopy(reffCode);
                }
            }

            function legacyCopy(text) {
                try {
                    const textArea = document.createElement('textarea');
                    textArea.value = text;

                    textArea.style.position = 'fixed';
                    textArea.style.opacity = '0';

                    document.body.appendChild(textArea);
                    textArea.select();

                    const successful = document.execCommand('copy');
                    textArea.remove();

                    if (successful) {
                        showCopySuccess();
                    } else {
                        throw new Error('Copy failed');
                    }
                } catch (err) {
                    console.error('Failed to copy text:', err);
                    alert('Tidak dapat menyalin kode referral. Silakan coba lagi.');
                }
            }

            function showCopySuccess() {
                const toast = document.createElement('div');
                toast.className =
                    'fixed bottom-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md transition-opacity duration-300';
                toast.innerHTML = `
                <div class="flex items-center">
                    <i class="material-icons mr-2">check_circle</i>
                    <span>Kode referral berhasil disalin!</span>
                </div>
            `;

                document.body.appendChild(toast);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }
        </script>
    @endpush
@endsection
