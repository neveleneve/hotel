@extends('layouts.app')

@section('content')
    <section class="bg-[--on-primary] h-screen flex justify-center p-0">
        <div
            class="absolute top-0 left-0 mx-3 mt-3 md:hidden text-[--primary-container] bg-[--on-primary-container] hover:text-[--on-primary-container] hover:bg-[--primary-container] hover:border hover:border-[--on-primary-container] rounded-full">
            <a href="{{ route('landing') }}" class="flex items-center p-2">
                <i class="material-icons font-bold">chevron_left</i>
            </a>
        </div>
        <div class="flex flex-col items-center justify-center w-full lg:w-96 mx-4">
            <a href="{{ route('landing') }}"
                class="fixed top-12 flex items-center mb-6 text-2xl font-bold text-[--on-primary-container]">
                <img class="w-8 h-8 mr-2 rounded-full" src="https://placehold.co/200?text=Belanja.com" alt="logo">
                {{ env('APP_NAME') }}
            </a>
            <div class="w-full bg-[--primary] rounded-lg shadow">
                <div class="py-8 px-6 space-y-12">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-[--on-primary] text-center">
                        Daftar
                    </h1>
                    <form method="POST" class="space-y-4" action="{{ route('register') }}">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-bold text-[--on-primary]">Nama</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Nama Lengkap"
                                class="bg-[--on-primary-container] border border-[--on-primary] focus:ring-[--on-primary-container] text-[--on-primary] rounded-xl block w-full p-2 @error('name') border-red-500 @enderror"
                                required autocomplete="name" autofocus>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-bold text-[--on-primary]">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="Email"
                                class="bg-[--on-primary-container] border border-[--on-primary] focus:ring-[--on-primary-container] text-[--on-primary] rounded-xl block w-full p-2 @error('email') border-red-500 @enderror"
                                required autocomplete="email">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-bold text-[--on-primary]">Kata
                                Sandi</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="Kata Sandi"
                                    class="bg-[--on-primary-container] border border-[--on-primary] focus:ring-[--on-primary-container] text-[--on-primary] rounded-xl block w-full p-2 pr-10 @error('password') border-red-500 @enderror"
                                    required autocomplete="new-password">
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-2 flex items-center">
                                    <span class="material-icons text-[--on-primary]">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block mb-2 text-sm font-bold text-[--on-primary]">Konfirmasi
                                Kata Sandi</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="Konfirmasi Kata Sandi"
                                    class="bg-[--on-primary-container] border border-[--on-primary] focus:ring-[--on-primary-container] text-[--on-primary] rounded-xl block w-full p-2 pr-10"
                                    required autocomplete="new-password">
                                <button type="button" id="toggleConfirmPassword"
                                    class="absolute inset-y-0 right-2 flex items-center">
                                    <span class="material-icons text-[--on-primary]">visibility</span>
                                </button>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full text-[--on-primary] bg-primary-600 border-2 border-[--on-primary] hover:bg-[--on-primary] hover:text-[--primary] font-medium rounded-lg text-sm px-5 py-2 text-center font-bold">
                            Daftar
                        </button>
                        <p class="text-sm text-center font-light text-[--on-primary]">
                            Sudah punya akun? <a href="{{ route('login') }}" class="font-medium hover:underline">Masuk</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

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
