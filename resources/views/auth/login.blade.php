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
                <img class="w-8 h-8 mr-2" src="{{ asset('assets/img/logo.png') }}" alt="logo">
                {{ env('APP_NAME') }}
            </a>
            <div class="w-full bg-[--primary] rounded-lg shadow">
                <div class="py-8 px-6 space-y-12">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-[--on-primary] text-center">
                        Masuk
                    </h1>
                    <form method="POST" class="space-y-4" action="{{ route('login') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-bold text-[--on-primary]">Email</label>
                            <input type="email" name="email" id="email" placeholder="Email"
                                class="bg-[--on-primary-container] border border-[--on-primary] focus:ring-[--on-primary-container] text-[--on-primary] rounded-xl block w-full p-2"
                                required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-bold text-[--on-primary]">Kata
                                Sandi</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="Password"
                                    class="bg-[--on-primary-container] border border-[--on-primary] focus:ring-[--on-primary-container] text-[--on-primary] rounded-xl block w-full p-2 pr-10"
                                    required>
                                <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-2 flex items-center">
                                    <span class="material-icons text-[--on-primary]">visibility</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-[--on-primary] dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-[--on-primary]">Ingat saya</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="#" class="text-sm font-medium text-[--on-primary] hover:underline">
                                Lupa Kata Sandi?
                            </a>
                        </div>
                        <button type="submit"
                            class="w-full text-[--on-primary] bg-primary-600 border-2 border-[--on-primary] hover:bg-[--on-primary] hover:text-[--primary] font-medium rounded-lg text-sm px-5 py-2 text-center font-bold">Masuk</button>
                        <p class="text-sm text-center font-light text-[--on-primary]">
                            Belum punya akun? <a href="{{ route('register') }}"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Daftar</a>
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
    </script>
@endpush
