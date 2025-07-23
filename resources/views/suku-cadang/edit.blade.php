<x-app-layout>
    <div class="p-4 sm:p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold">
            <a href="{{ route('suku-cadang.index') }}" class="text-gray-500 hover:text-gray-700">Data Suku Cadang</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <span class="text-gray-800">Ubah Data Suku Cadang</span>
        </div>

        {{-- PAGE TITLE --}}
        <div class="flex items-center mt-6">
             <a href="{{ route('suku-cadang.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Ubah Data Suku Cadang</h1>
        </div>

        {{-- FORM CARD --}}
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
            <form enctype="multipart/form-data" action="{{ route('suku-cadang.update', $sukuCadang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <x-input-label for="name" value="Nama Suku Cadang" />
                    <x-text-input 
                        id="name" 
                        class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $sukuCadang->name) }}" 
                        required />
                    @error('name')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="stock" value="Stok" />
                    <x-text-input 
                        id="stock" 
                        class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" 
                        type="number" 
                        name="stock" 
                        value="{{ old('stock', $sukuCadang->stock) }}" 
                        min="0" 
                        required />
                    @error('stock')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <x-input-label for="price" value="Harga Satuan" />
                    <div class="flex mt-1">
                        <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-transparent bg-gray-100 text-gray-500 sm:text-sm">Rp.</span>
                        <input 
                            type="number" 
                            name="price" 
                            id="price" 
                            value="{{ old('price', $sukuCadang->price) }}" 
                            class="block w-full rounded-r-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400" 
                            min="0" 
                            required>
                    </div>
                    @error('price')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gambar --}}
                    <div
                        x-data="{
                            imagePreview: '{{ asset($sukuCadang->image ?? 'images/default.jpg') }}',
                            handleDrop(e) {
                                e.preventDefault();
                                const file = e.dataTransfer.files[0];
                                if (file && file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = (event) => {
                                        this.imagePreview = event.target.result;
                                    };
                                    reader.readAsDataURL(file);

                                    // Buat input[type=file] dapat 'menerima' file dari drop
                                    const dt = new DataTransfer();
                                    dt.items.add(file);
                                    $refs.imageInput.files = dt.files;
                                }
                            }
                        }"
                        @dragover.prevent
                        @drop="handleDrop"
                        class="mt-2"
                    >
                        <input id="image" name="image" type="file" class="sr-only" x-ref="imageInput"
                            @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        imagePreview = e.target.result;
                                    };
                                    reader.readAsDataURL(file);
                                }
                            ">

                        <div class="flex items-center space-x-4 p-2 border border-dashed rounded-md hover:bg-gray-50 transition-all cursor-pointer"
                            @click="$refs.imageInput.click()"
                        >
                            <img :src="imagePreview"
                                alt="Preview Foto"
                                class="w-24 h-24 object-contain rounded-md bg-gray-100 p-2 border">

                            <div>
                                <p class="text-sm text-blue-600 hover:text-blue-800 font-semibold">Ganti Foto</p>
                                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                            </div>
                        </div>
                    </div>




                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>

        </div>

    </div>
</x-app-layout>