@extends('layouts.app')

@section('content')
    <div class="my-[56px]">
        <section class="p-4">
            <h3 class="text-center font-bold text-2xl">{{ $country->name }}</h3>
            <hr class="mt-3">
        </section>
        <section class="p-4 pt-2">
            <div class="grid grid-cols-2 lg:grid-cols-6 gap-4 lg:gap-2">
                @forelse ($hotel as $item)
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
                                        {{ $item->country->name ?? 'xx' }}
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
                @empty
                    <h3 class="text-center col-span-2 text-lg font-bold">
                        Data Kosong
                    </h3>
                @endforelse
            </div>
        </section>
    </div>
@endsection

@push('nav')
    <header class="fixed top-0 left-0 w-full bg-[--on-primary] text-white p-2 flex justify-between items-center z-20">
        <div class="flex items-center">
            <a href="{{ route('landing') }}" class="flex items-center p-2 bg-[--error] rounded-full">
                <i class="material-icons font-bold">chevron_left</i>
            </a>
        </div>

    </header>
@endpush
