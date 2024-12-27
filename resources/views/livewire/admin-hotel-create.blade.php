<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
    <form method="POST" action="{{ route('admin.hotel.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
            <div class="space-y-4 sm:space-y-5">
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Hotel Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter hotel name"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <select name="country_id" id="country_id"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300">
                        <option value="">Select Country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                        <input type="number" name="price" id="price" placeholder="0" step="50000"
                            min="0" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300">
                    </div>
                    @error('price')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <input type="number" name="rating" id="rating" placeholder="0" step="0.1" min="0"
                        max="5" class="w-full px-4 py-2 rounded-lg border border-gray-300">
                    @error('rating')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="space-y-4 sm:space-y-5">
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Foto Hotel</label>
                    <input type="file" name="image" id="image"
                        class="mt-1 block w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-[--primary] file:text-[--on-primary] file:font-bold file:hover:bg-[--primary-container] file:hover:text-[--on-primary-container]">
                    @error('image')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="mt-2 block w-full px-3 py-2 rounded-md border border-gray-300"></textarea>
                    @error('description')
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
