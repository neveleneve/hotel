@extends('layouts.admin')

@section('content')
    <div class="w-full">
        <section class="mb-3">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-2xl text-[--primary-container]">Tambah Data Hotel</h3>
                <a href="{{ route('admin.hotel.index') }}"
                    class="flex font-bold items-center py-2 px-3 rounded-lg bg-[--on-error-container] text-[--error-container] hover:text-[--on-error-container] hover:bg-[--error-container]">
                    <i class="material-icons">chevron_left</i>
                    <span>Kembali</span>
                </a>
            </div>
            <hr class="mt-3">
        </section>
        <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
            <form method="POST" action="{{ route('admin.hotel.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
                    <div class="space-y-4 sm:space-y-5">
                        <div class="form-group">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Hotel</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Enter hotel name" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            @error('name')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">Negara</label>
                            <select name="country_id" id="country_id"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300">
                                <option value="">Pilih Negara</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country_id')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-500 font-semibold">Rp</span>
                                <input type="number" name="price" id="price" value="{{ old('price') }}"
                                    placeholder="0" step="50000" min="0"
                                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300">
                            </div>
                            @error('price')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <input type="number" name="rating" id="rating" value="{{ old('rating') }}" placeholder="0"
                                step="0.1" min="0" max="5"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            @error('rating')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-4 sm:space-y-5">
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Hotel
                                <div class="inline-block relative group">
                                    <i class="material-icons text-xs">information</i>
                                    <div
                                        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block w-48 px-2 py-1 bg-gray-700 text-white text-sm rounded-lg">
                                        Maksimal ukuran file: 2MB
                                    </div>
                                </div>
                            </label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[--primary] file:text-[--on-primary] file:hover:bg-[--primary-container] file:hover:text-[--on-primary-container]">
                            @error('image')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-2 block w-full px-3 py-2 rounded-md border border-gray-300">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-6 border-t pt-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Promo</label>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" name="is_promo" id="promo_no" value="0"
                                        {{ old('is_promo') == '0' ? 'checked' : '' }}
                                        class="h-4 w-4 text-[--primary] border-gray-300 focus:ring-[--primary]">
                                    <label for="promo_no" class="ml-2 text-sm text-gray-700">Tidak Promo</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="is_promo" id="promo_yes" value="1"
                                        {{ old('is_promo') == '1' ? 'checked' : '' }}
                                        class="h-4 w-4 text-[--primary] border-gray-300 focus:ring-[--primary]">
                                    <label for="promo_yes" class="ml-2 text-sm text-gray-700">Promo</label>
                                </div>
                            </div>
                            @error('is_promo')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="discount" class="block text-sm font-medium text-gray-700 mb-2">Diskon (%)</label>
                            <input type="number" name="discount" id="discount" value="{{ old('discount') }}"
                                placeholder="0" min="0" max="100" step="1"
                                class="w-full px-4 py-2 rounded-lg border border-gray-300">
                            @error('discount')
                                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="px-6 py-2 font-bold bg-[--primary] text-[--on-primary] rounded-lg hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
