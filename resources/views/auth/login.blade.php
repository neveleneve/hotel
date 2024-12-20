@extends('layouts.app')

@section('content')
    <section class="bg-[--on-primary] h-screen flex justify-center p-0">
        <div class="flex flex-col items-center justify-center ">
            <a href="{{ route('landing') }}"
                class="fixed top-12 flex items-center mb-6 text-2xl font-semibold text-[--on-primary-container]">
                <img class="w-8 h-8 mr-2 rounded-full" src="https://placehold.co/200?text=Belanja.com" alt="logo">
                Belanja.com
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
                            <input type="password" name="password" id="password" placeholder="Password"
                                class="bg-[--on-primary-container] border border-[--on-primary] focus:ring-[--on-primary-container] text-[--on-primary] rounded-xl block w-full p-2"
                                required>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" type="checkbox" required
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
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
                            class="w-full text-[--on-primary] bg-primary-600 border-2 border-[--on-primary] font-medium rounded-lg text-sm px-5 py-2 text-center font-bold">Masuk</button>
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
