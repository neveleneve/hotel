<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
    <form wire:submit="save" enctype="multipart/form-data">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
            <div class="space-y-4 sm:space-y-5">
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Hotel Name</label>
                    <input type="text" wire:model="name" id="name" placeholder="Enter hotel name"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 transition duration-150 ease-in-out">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                    <select wire:model="country_id" id="country_id"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 transition duration-150 ease-in-out appearance-none bg-white">
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
                        <input type="number" wire:model="price" id="price" placeholder="0" step="50000"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 transition duration-150 ease-in-out">
                    </div>
                    @error('price')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <input type="number" wire:model="rating" id="rating" placeholder="0" step="0.1" max="5"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 transition duration-150 ease-in-out">
                    @error('rating')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="space-y-4 sm:space-y-5">
                <div>
                    <label for="image" class="block text-base sm:text-sm font-medium text-gray-700">
                        Foto Hotel</label>
                    <div class="border rounded-md">
                        <input type="file" wire:model="image" id="image"
                            class="ml-1 my-1 font-semibold block w-full file:mr-4 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-sm file:bg-[--primary] file:text-white hover:file:bg-[--primary-container]">
                    </div>
                    @error('image')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="description"
                        class="block text-base sm:text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea wire:model="description" id="description" rows="4"
                        class="mt-2 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-base sm:text-sm"></textarea>
                    @error('description')
                        <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                class="w-full sm:w-auto px-6 py-3 sm:py-2 border border-transparent rounded-md shadow-sm text-base sm:text-sm font-medium bg-[--primary] text-[--on-primary] hover:bg-[--primary-container] hover:text-[--on-primary-container]">
                Simpan
            </button>
        </div>
    </form>
</div>
