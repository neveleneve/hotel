@extends('layouts.app')

@section('content')
    <div class="my-16">
        <section class="px-4 py-2">
            @auth
                <h1 class="text-[--on-primary] font-bold text-xl md:text-2xl lg:text-3xl mb-2">Selamat datang kembali,
                    {{ Auth::user()->name }}</h1>
                <hr class="mb-4">
            @else
                <h1 class="text-[--on-primary] font-bold text-xl md:text-2xl lg:text-3xl mb-2">Selamat datang!</h1>
                <hr class="mb-4">
            @endauth
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
        @auth
            @role('member')
                @if ($activeProjects && $activeProjects->count() > 0)
                    <section class="px-4 py-2">
                        <h2 class="text-lg font-bold mb-1 text-[--on-primary]">Hot Sale</h2>
                        <hr class="mb-4">
                        <div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-8 gap-4">
                            @foreach ($activeProjects as $project)
                                <a class="max-w-xs h-full flex flex-col bg-white border border-gray-200 rounded-lg shadow lg:mb-3"
                                    href="{{ route('hot-sale.show', ['user_id' => Auth::user()->id, 'id' => $project->id]) }}">
                                    <div class="relative w-full">
                                        @if ($project->discount_status)
                                            <div class="absolute top-2 right-2 animate-pulse">
                                                <span
                                                    class="bg-[--error] text-[--on-error] text-xs font-bold px-2 py-1 rounded-full">
                                                    <i class="material-icons text-sm align-middle">local_offer</i>
                                                    Hot Sale
                                                </span>
                                            </div>
                                        @endif
                                        <img class="w-full aspect-square object-cover rounded-t-lg"
                                            src="{{ asset('assets/img/hotel/' . $project->hotel->image) }}"
                                            alt="Gambar Hotel {{ $project->hotel->name }}">
                                    </div>
                                    <div class="flex flex-col justify-between flex-1 p-4">
                                        <div>
                                            <h5 class="text-sm font-medium text-[--on-primary] min-h-[48px]">
                                                {{ $project->hotel->name }}
                                            </h5>
                                            <div class="flex items-center mt-2">
                                                <i
                                                    class="h-4 w-4 fi fi-{{ $project->hotel->country->flag_code ?? 'default-flag' }}"></i>
                                                <span class="text-xs text-[--on-primary] font-bold ml-3">
                                                    {{ $project->hotel->country->name ?? '-' }}
                                                </span>
                                            </div>
                                            <div class="flex items-center mt-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($project->hotel->rating))
                                                        <i class="material-icons text-yellow-500 text-sm align-middle">star</i>
                                                    @elseif ($i - 0.99 <= $project->hotel->rating)
                                                        <i class="material-icons text-yellow-500 text-sm align-middle">star_half</i>
                                                    @else
                                                        <i
                                                            class="material-icons text-yellow-500 text-sm align-middle">star_border</i>
                                                    @endif
                                                @endfor
                                                <span
                                                    class="ml-1 text-sm font-semibold text-gray-700">{{ number_format($project->hotel->rating, 1, '.', ',') }}</span>
                                            </div>
                                        </div>
                                        <hr class="border-t my-2">
                                        <div class="text-sm">
                                            @if ($project->discount_status)
                                                <div class="flex items-center gap-2">
                                                    <div class="text-[--on-error] text-xs line-through font-bold">
                                                        {{ 'Rp ' . number_format($project->price, 0, ',', '.') }}
                                                    </div>
                                                    <span
                                                        class="bg-[--error] text-[--on-error] text-xs px-2 py-0.5 rounded-full font-bold">
                                                        -{{ $project->discount }}%
                                                    </span>
                                                </div>
                                                <div class="font-extrabold text-[--on-primary] text-sm">
                                                    {{ 'Rp ' . number_format($project->price - ($project->price * $project->discount) / 100, 0, ',', '.') }}
                                                </div>
                                            @else
                                                <div class="font-bold text-[--on-primary] text-sm">
                                                    {{ 'Rp ' . number_format($project->price, 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif
            @endrole
        @endauth
        <section class="p-4">
            <div class="flex justify-between items-center mb-1">
                <h2 class="text-lg font-bold text-[--on-primary]">Project Reservasi</h2>
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
                <img class="inline-block h-8 w-8 rounded-sm ring-white" src="{{ asset('assets/img/logo.png') }}">
            </a>
            <a href="{{ route('landing') }}" class="ml-4 font-bold text-xl lg:text-2xl">{{ env('APP_NAME') }}</a>
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
