<x-app-layout>
    <div class="p-4 sm:p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold">
            <a href="{{ route('suku-cadang.index') }}" class="text-gray-500 hover:text-gray-700">Data Suku Cadang</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <span class="text-gray-800">Tambah Data Suku Cadang</span>
        </div>

        {{-- PAGE TITLE --}}
        <div class="flex items-center mt-6">
             <a href="{{ route('suku-cadang.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Data Suku Cadang</h1>
        </div>
        
        {{-- FORM CARD --}}
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <x-input-label for="nama_sukucadang" value="Nama Suku Cadang" />
                        <x-text-input id="nama_sukucadang" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="name" :value="old('name')" required placeholder="Masukan suku cadang" />
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="stok" value="Stok" />
                        <x-text-input id="stok" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="number" name="stock" value="0" min="0" required />
                        @error('stock')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="harga" value="Harga Satuan" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-transparent bg-gray-100 text-gray-500 sm:text-sm">Rp.</span>
                            <input type="number" name="price" id="harga" placeholder="0"
                                   class="block w-full rounded-r-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400">
                        </div>
                        @error('price')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div x-data="{ fileName: '' }">
                        <x-input-label for="foto" value="Upload Foto Suku Cadang" name="image" />
                        <div class="mt-1 flex items-center justify-center w-full">
                            <label for="foto" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau seret file</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, atau WEBP</p>
                                </div>
                                <input id="foto" name="image" type="file" class="hidden" @change="fileName = $event.target.files[0] ? $event.target.files[0].name : ''">

                            </label>
                        </div> 
                        <p x-show="fileName" class="text-sm text-gray-500 mt-2">Nama file: <span x-text="fileName" class="font-semibold"></span></p>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Tambah data
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>