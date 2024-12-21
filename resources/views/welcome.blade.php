@extends('layouts.app')

@section('content')
    <div class="my-16">
        <div class="px-4 py-2">
            <div class="relative w-full">
                <input type="text" placeholder="Cari..."
                    class="w-full pl-10 pr-10 py-2 border-2 border-[--on-primary] rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 focus:outline-none"
                    id="search-input" oninput="toggleIcons()" />
                <span class="material-icons absolute left-3 top-1/2 transform -translate-y-1/2 text-[--on-primary]">
                    search
                </span>
                <span onclick="clearInput()" id="icon-times"
                    class="material-icons hidden absolute right-3 top-1/2 transform -translate-y-1/2 text-[--on-primary]">close</span>
            </div>
        </div>
        <section class="px-4 py-2">
            <h2 class="text-lg font-bold mb-1">Event Belanja</h2>
            <hr class="mb-2">
            <div class="bg-gray-200 h-32 flex items-center justify-center mb-4">Slide 1</div>
            <hr class="mb-2">
            <div class="grid grid-cols-4 gap-4 lg:grid-cols-8 lg:gap-2">
                @foreach ($country as $items)
                    <a class="flex flex-col items-center lg:mb-8"
                        href="{{ route('member.country.index', $items->flag_code) }}">
                        <i
                            class="w-full h-12 border-2 border-[--on-secondary] rounded-full fi fi-{{ $items->flag_code }} fis text-5xl"></i>
                        <span class="text-xs mt-2 text-center font-bold">{{ $items->name }}</span>
                    </a>
                @endforeach
            </div>
        </section>
        <section class="p-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="text-lg font-bold">Belanja Mall</h2>
                <a href="#" class="text-[--primary] text-xs font-bold">Lihat Semua</a>
            </div>
            <hr class="mb-2">
            <div class="flex space-x-4 mb-4">
                <button class="px-2 py-1 bg-[--on-primary] text-[--on-primary-container] rounded-lg font-bold text-xs">
                    Semua
                </button>
                <button class="px-2 py-1 bg-[--primary] text-[--primary-container] rounded-lg font-bold text-xs">
                    Top Deal
                </button>
                <button class="px-2 py-1 bg-[--primary] text-[--primary-container] rounded-lg font-bold text-xs">
                    Populer
                </button>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 lg:gap-2">
                @foreach ($hotel as $item)
                    <a class="max-w-xs h-full flex flex-col bg-white border border-gray-200 rounded-lg shadow lg:mb-3"
                        href="{{ route('member.hotel.index', ['flag_code' => $item->country->flag_code, 'id' => $item->id]) }}">
                        <div class="relative w-full">
                            <img class="w-full aspect-square object-cover rounded-t-lg"
                                src="{{ asset('assets/img/hotel/' . $item->id . '.jpg') }}"
                                alt="Gambar Hotel {{ $item->name }}">
                        </div>
                        <div class="flex flex-col justify-between flex-1 p-4">
                            <div>
                                <h5 class="text-sm font-medium text-[--on-primary] min-h-[48px]">
                                    {{ $item->name }}
                                </h5>
                                <div class="flex items-center mt-2">
                                    <i class="h-4 w-4 fi fi-{{ $item->country->flag_code ?? 'default-flag' }}"></i>
                                    <span class="text-xs text-[--on-primary] font-bold ml-3">
                                        {{ $item->country->name ?? 'Unknown Country' }}
                                    </span>
                                </div>
                                <div class="flex items-center mt-1">
                                    <i class="material-icons text-yellow-500 text-sm">star_half</i>
                                    <span class="ml-1 text-sm font-semibold text-gray-700">3.5</span>
                                </div>
                            </div>
                            <hr class="border-t border-gray-200 my-3">
                            <div class="text-xs font-bold text-[--on-primary]">
                                {{ 'Rp ' . number_format($item->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
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
@endpush
