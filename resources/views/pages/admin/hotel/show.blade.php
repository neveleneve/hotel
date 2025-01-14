@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <section class="mb-3">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-[--primary-container]">Detail Hotel</h3>
                <a href="{{ route('admin.hotel.index') }}"
                    class="flex font-bold items-center py-2 px-3 rounded-lg bg-[--on-error-container] text-[--error-container] hover:text-[--on-error-container] hover:bg-[--error-container]">
                    <i class="material-icons">chevron_left</i>
                    <span>Kembali</span>
                </a>
            </div>
            <hr class="mt-3">
        </section>
        <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
            <form action="{{ route('admin.hotel.update', ['hotel' => $hotel->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
                    <div class="space-y-4 sm:space-y-5">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Nama Hotel</h4>
                            @can('hotel edit')
                                <input type="text" name="name" class="border w-full py-1 px-2 rounded-lg"
                                    value="{{ $hotel->name }}">
                            @else
                                <p class="text-gray-900">{{ $hotel->name }}</p>
                            @endcan
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Negara</h4>
                            @can('hotel edit')
                                <select name="country" class="border w-full py-1 px-2 rounded-lg">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"
                                            {{ $country->id == $hotel->country_id ? 'selected' : null }}>
                                            {{ $country->name }}</option>
                                    @endforeach
                                </select>
                            @else
                                <p class="text-gray-900">{{ $hotel->country->name }}</p>
                            @endcan
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Harga</h4>
                            @can('hotel edit')
                                <input type="number" name="price" class="border w-full py-1 px-2 rounded-lg" min="0"
                                    step="50000" value="{{ $hotel->price }}">
                            @else
                                <p class="text-gray-900">Rp {{ number_format($hotel->price, 0, ',', '.') }}</p>
                            @endcan
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Rating</h4>
                            @can('hotel edit')
                                <input type="number" name="rating" class="border w-full py-1 px-2 rounded-lg" min="0"
                                    step="0.1" value="{{ $hotel->rating }}">
                            @else
                                <div class="flex items-center">
                                    <span class="text-gray-900">{{ $hotel->rating }}</span>
                                    <i class="material-icons text-yellow-400 ml-1">star</i>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="space-y-4 sm:space-y-5">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Foto Hotel</h4>
                            @if ($hotel->image)
                                <img src="{{ asset('assets/img/hotel/' . $hotel->image) }}" alt="{{ $hotel->name }}"
                                    class="w-full h-48 object-cover rounded-lg">
                            @else
                                <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500">Tidak ada foto</span>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Deskripsi</h4>
                            @can('hotel edit')
                                <textarea name="description" id="description" rows="4"
                                    class="mt-2 block w-full px-2 py-1 rounded-md border border-gray-300">{{ $hotel->description }}</textarea>
                            @else
                                <p class="text-gray-900">{{ $hotel->description ?: 'Tidak ada deskripsi' }}</p>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="mt-6 border-t pt-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Status Promo</h4>
                            @can('hotel edit')
                                <div class="form-group">
                                    <div class="space-y-2">
                                        <div class="flex items-center">
                                            <input type="radio" name="is_promo" id="promo_no" value="0"
                                                {{ $hotel->promo == '0' ? 'checked' : '' }}
                                                class="h-4 w-4 text-[--primary] border-gray-300 focus:ring-[--primary]">
                                            <label for="promo_no" class="ml-2 text-sm text-gray-700">Tidak Promo</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" name="is_promo" id="promo_yes" value="1"
                                                {{ $hotel->promo == '1' ? 'checked' : '' }}
                                                class="h-4 w-4 text-[--primary] border-gray-300 focus:ring-[--primary]">
                                            <label for="promo_yes" class="ml-2 text-sm text-gray-700">Promo</label>
                                        </div>
                                    </div>
                                    @error('is_promo')
                                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>
                            @else
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-medium
                                {{ $hotel->is_promo ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $hotel->is_promo ? 'Promo' : 'Tidak Promo' }}
                                </span>
                            @endcan
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Diskon</h4>
                            @can('hotel edit')
                                <input type="number" name="discount" id="discount" value="{{ $hotel->discount }}"
                                    placeholder="0" min="0" max="100" step="1"
                                    class="w-full px-2 py-1 rounded-lg border border-gray-300">
                            @else
                                <p class="text-gray-900">{{ $hotel->discount }}%</p>
                            @endcan
                        </div>
                    </div>
                </div>
            </form>

            <div class="mt-6 flex justify-end space-x-3">
                @can('hotel edit')
                    <a onclick="event.preventDefault(); this.closest('.bg-white').querySelector('form').submit()" href="#"
                        class="cursor-pointer px-6 py-2 font-bold bg-[--primary] text-[--on-primary] rounded-lg hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                        Edit
                    </a>
                @endcan
                @can('hotel delete')
                    <form action="{{ route('admin.hotel.destroy', $hotel->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                            class="px-6 py-2 font-bold bg-[--error-container] text-[--on-error-container] rounded-lg hover:bg-[--on-error-container] hover:text-[--error-container]">
                            {{ $hotel->deleted_at ? 'Kembalikan' : 'Hapus' }}
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>
@endsection

@push('customjs')
    @session('title')
        <script>
            Swal.fire({
                title: "{{ session('title') }}",
                text: "{{ session('text') }}",
                icon: "{{ session('icon') }}",
                confirmButtonText: 'Tutup',
                customClass: {
                    popup: 'bg-white rounded-lg shadow-lg',
                    title: 'text-lg font-bold text-[--on-primary]',
                    text: 'text-semibold text-[--on-primary]',
                    confirmButton: 'bg-[--primary] text-[--on-primary] px-4 py-2 rounded-lg hover:bg-[-primary-container] focus:ring focus:ring-blue-300 font-semibold',
                },
            })
        </script>
    @endsession
@endpush
