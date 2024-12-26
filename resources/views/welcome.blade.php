@extends('layouts.app')

@section('content')
    <div class="my-16">
        <section class="px-4 py-2">
            <h2 class="text-lg font-bold mb-1 text-[--on-primary]">Event Belanja</h2>
            <hr class="mb-2">
            <div class="bg-gray-200 h-32 flex items-center justify-center mb-4">Slide 1</div>
            <hr class="mb-2">
            <div class="grid grid-cols-4 gap-4 lg:grid-cols-8 lg:gap-2">
                @foreach ($country as $items)
                    <a class="flex flex-col items-center lg:mb-8"
                        href="{{ route('member.country.index', $items->flag_code) }}">
                        <i
                            class="w-full h-12 border-2 border-[--on-secondary] rounded-full fi fi-{{ strtolower($items->flag_code) }} fis text-5xl"></i>
                        <span class="text-xs mt-2 text-center font-bold">{{ $items->name }}</span>
                    </a>
                @endforeach
            </div>
        </section>
        <section class="p-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="text-lg font-bold text-[--on-primary]">Belanja Mall</h2>
                <a href="{{ route('hotels') }}" class="text-[--on-primary] text-xs font-bold">Lihat Semua</a>
            </div>
            <hr class="mb-2">
            @livewire('hotel-landing')
        </section>
    </div>
@endsection

@push('tab')
    @include('layouts.tab')
@endpush

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[--on-primary] text-white p-4 flex justify-between items-center z-20">
        <div class="flex items-center">
            <a href="{{ route('profile.index') }}">
                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                    src="{{ asset('assets/img/user-default.jpg') }}">
            </a>
            <a href="{{ route('landing') }}" class="ml-4 font-bold">{{ env('APP_NAME') }}</a>
        </div>
        <div class="flex items-center space-x-4">
            <a href="#">
                <i class="material-icons">notifications</i>
            </a>
            <a href="#">
                <i class="material-icons">favorite</i>
            </a>
        </div>
    </header>
@endpush
{{--
@push('customjs')
    <script>
        function toggleIcons() {
            const input = document.getElementById('search-input');
            const iconTimes = document.getElementById('icon-times');

            if (input.value.trim() !== "") {
                iconTimes.classList.remove('hidden');
            } else {
                iconTimes.classList.add('hidden');
            }
        }

        function clearInput() {
            const input = document.getElementById('search-input');
            input.value = '';
            toggleIcons();
        }
    </script>
@endpush --}}
