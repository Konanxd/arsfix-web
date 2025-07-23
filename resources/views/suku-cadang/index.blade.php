<x-app-layout>
    <div class="p-4 sm:p-8">
        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">Data Suku Cadang</h1>

        {{-- SEARCH BAR DAN TOMBOL (SUDAH RESPONSIF) --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mt-8 space-y-4 sm:space-y-0">
            <input type="text" placeholder="Cari data suku cadang" class="w-full max-w-md px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <a href="{{ route('suku-cadang.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                + Tambah Suku Cadang
            </a>
        </div>

        {{-- GRID DAFTAR SUKU CADANG --}}
        <div class="mt-8 grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            
            {{-- Loop untuk menampilkan data. --}}
            @for ($i = 0; $i < 8; $i++)
            {{-- CARD SUKU CADANG DENGAN TOMBOL EDIT & DELETE --}}
            <div class="bg-white rounded-lg border border-gray-100 p-4 text-left hover:shadow-lg transition-shadow duration-300 flex flex-col">
                {{-- Konten utama card --}}
                <div class="flex-grow">
                    <div class="bg-gray-50 rounded-md p-4">
                        <img src="https://img.gkbcdn.com/p/2016-05-18/uart-ttl-serial-camera-module-640x480-pixels-for-arduino-1572312083423._w500_p1_.jpg" alt="Suku Cadang" class="w-full h-28 object-contain mx-auto">
                    </div>
                    <div class="mt-4">
                        <p class="text-xs font-semibold text-gray-500">RC14PM</p>
                        <p class="mt-1 font-semibold text-gray-800">Rear Camera - iPhone 14 Promax</p>
                    </div>
                    <div class="mt-2 text-left text-sm text-gray-600">
                        <p>Harga: <span class="font-semibold text-gray-800">Rp 450.000</span></p>
                        <p>Stok: <span class="font-semibold text-gray-800">12 unit</span></p>
                    </div>
                </div>

                {{-- Bagian Tombol (BARU) --}}
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-center space-x-3">
                    <a href="{{ route('suku-cadang.edit', ['id' => 1]) }}" class="px-4 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Edit
                    </a>

                    <form id="delete-form-1" action="#" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                onclick="confirmDelete('delete-form-1')"
                                class="px-4 py-1.5 text-xs font-medium text-red-600 border border-red-600 rounded-md hover:bg-red-50">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endfor
            
        </div>
    </div>
</x-app-layout>