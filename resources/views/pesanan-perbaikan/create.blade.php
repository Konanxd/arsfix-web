<x-app-layout>
    <div class="p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold">
            <a href="{{ route('pesanan.index') }}" class="text-gray-500 hover:text-gray-700">Data Pesanan</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-800">Tambah Data Pesanan</span>
        </div>

        {{-- PAGE TITLE --}}
        <div class="flex items-center mt-6">
            <a href="{{ route('pesanan.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Pesanan Perbaikan</h1>
        </div>

        {{-- FORM CARD --}}
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
            <form action="#" method="POST">
                @csrf
                <div class="space-y-6">
                    {{-- ID Pesanan --}}
                    <div>
                        <x-input-label for="id_pesanan" value="ID Pesanan" />
                        <x-text-input id="id_pesanan" class="block mt-1 w-full rounded-xl bg-gray-200 border-transparent" type="text" name="id_pesanan" value="OR0001" disabled />
                    </div>

                    {{-- ID Pelanggan --}}
                    <div>
                        <x-input-label for="id_pelanggan" value="ID Pelanggan" />
                        <div class="flex gap-4 mt-1">
                            <select id="id_pelanggan" name="id_pelanggan" class="w-1/2 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500">
                                <option>ID00001</option>
                            </select>
                            <x-text-input type="text" class="w-1/2 rounded-xl bg-gray-100 border-transparent" value="Nama pelanggan" disabled />
                        </div>
                    </div>

                    {{-- ID Teknisi --}}
                    <div>
                        <x-input-label for="id_teknisi" value="ID Teknisi" />
                        <div class="flex gap-4 mt-1">
                            <select id="id_teknisi" name="id_teknisi" class="w-1/2 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500">
                                <option>T00001</option>
                            </select>
                            <x-text-input type="text" class="w-1/2 rounded-xl bg-gray-100 border-transparent" value="Irfan Jaelani" disabled />
                        </div>
                    </div>

                    {{-- No. Telepon --}}
                    <div>
                        <x-input-label for="telepon" value="No. Telepon" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl bg-gray-100 border border-r-0 border-transparent text-gray-500 sm:text-sm">+62</span>
                            <input type="text" name="telepon" id="telepon" placeholder="Masukan nomor telepon"
                                   class="block w-full rounded-r-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400">
                        </div>
                    </div>

                    {{-- Handphone --}}
                    <div>
                        <x-input-label for="handphone" value="Handphone" />
                        <x-text-input id="handphone" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="handphone" placeholder="Merk handphone pelanggan" />
                    </div>

                    {{-- Tanggal Order --}}
                    <div>
                        <x-input-label for="tanggal" value="Tanggal Order" />
                        <x-text-input id="tanggal" class="block mt-1 w-full rounded-xl bg-gray-200 border-transparent" type="text" name="tanggal" value="01/01/2024" disabled />
                    </div>

                    {{-- Deskripsi Kerusakan --}}
                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi Kerusakan" />
                        <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full mt-1 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" placeholder="Masukan deskripsi kerusakan"></textarea>
                    </div>

                    {{-- Suku Cadang --}}
                    <div>
                        <x-input-label for="suku_cadang" value="Suku Cadang" />
                        <div class="flex gap-4 mt-1">
                            <select id="suku_cadang" name="suku_cadang" class="w-2/3 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500">
                                <option>Pilih suku cadang</option>
                            </select>
                            <input type="number" class="w-1/3 rounded-xl bg-gray-100 border-transparent" name="jumlah" value="0" min="0">
                        </div>
                    </div>

                    {{-- Estimasi Biaya --}}
                    <div>
                        <x-input-label for="biaya" value="Estimasi Biaya Layanan Perbaikan" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl bg-gray-100 border border-r-0 border-transparent text-gray-500">Rp.</span>
                            <input id="biaya" type="text" name="biaya" class="w-full rounded-r-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" placeholder="0">
                        </div>
                    </div>

                    {{-- SUBMIT BUTTON --}}
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
