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
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Method untuk update --}}
                <div class="space-y-6">

                    <div>
                        <x-input-label for="id_sukucadang" value="ID Suku Cadang" />
                        <x-text-input id="id_sukucadang" class="block mt-1 w-full rounded-xl bg-gray-200 border-transparent" type="text" name="id_sukucadang" value="RC14PM" disabled />
                    </div>

                    <div>
                        <x-input-label for="nama_sukucadang" value="Nama Suku Cadang" />
                        <x-text-input id="nama_sukucadang" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="nama_sukucadang" value="Rear Camera - iPhone 14 Promax" required />
                    </div>

                    <div>
                        <x-input-label for="stok" value="Stok" />
                        <x-text-input id="stok" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="number" name="stok" value="25" min="0" required />
                    </div>

                    <div>
                        <x-input-label for="harga" value="Harga Satuan" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-transparent bg-gray-100 text-gray-500 sm:text-sm">Rp.</span>
                            <input type="number" name="harga" id="harga" value="1500000"
                                   class="block w-full rounded-r-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400">
                        </div>
                    </div>

                    <div>
                        <x-input-label for="foto" value="Foto Suku Cadang Saat Ini" />
                        <div class="mt-2 flex items-center space-x-4">
                            <img src="https://img.gkbcdn.com/p/2016-05-18/uart-ttl-serial-camera-module-640x480-pixels-for-arduino-1572312083423._w500_p1_.jpg" alt="Foto Saat Ini" class="w-24 h-24 object-contain rounded-md bg-gray-100 p-2 border">
                            <div>
                                <label for="foto_baru" class="cursor-pointer text-sm text-blue-600 hover:text-blue-800 font-semibold">
                                    Ganti foto
                                    <input id="foto_baru" name="foto_baru" type="file" class="sr-only">
                                </label>
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