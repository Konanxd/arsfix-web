<x-app-layout>
    <div class="p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold">
            <a href="{{ route('pesanan.index') }}" class="text-gray-500 hover:text-gray-700">Data Pesanan</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            <span class="text-gray-800">Ubah Data Pesanan</span>
        </div>

        {{-- PAGE TITLE --}}
        <div class="flex items-center mt-6">
            <a href="{{ route('pesanan.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Ubah Data Pesanan</h1>
        </div>

        {{-- FORM --}}
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <x-input-label for="id_pesanan" value="ID Pesanan" />
                        <x-text-input id="id_pesanan" type="text" class="block w-full mt-1 bg-gray-200 rounded-xl" value="OR0001" disabled />
                    </div>

                    <div>
                        <x-input-label for="id_pelanggan" value="ID Pelanggan" />
                        <div class="flex gap-4 mt-1">
                            <select id="id_pelanggan" class="w-1/2 mt-1 bg-gray-100 border-transparent rounded-xl">
                                <option selected>000001</option>
                            </select>
                            <input type="text" class="w-1/2  mt-1 bg-gray-100 border-transparent rounded-xl" value="Dida Handika" disabled>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="id_teknisi" value="ID Teknisi" />
                        <div class="flex gap-4 mt-1">
                            <select id="id_teknisi" class="w-1/2  mt-1 bg-gray-100 border-transparent rounded-xl">
                                <option selected>T00001</option>
                            </select>
                            <input type="text" class="w-1/2  mt-1 bg-gray-100 border-transparent rounded-xl" value="Irfan Jaelani" disabled>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="telepon" value="No. Telepon" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 bg-gray-100 rounded-l-xl text-gray-500">+62</span>
                            <input id="telepon" type="text" class="w-full bg-gray-100 border-transparent rounded-r-xl" value="8459980876">
                        </div>
                    </div>

                    <div>
                        <x-input-label for="handphone" value="Handphone" />
                        <x-text-input id="handphone" type="text" class="block w-full mt-1 bg-gray-100 border-transparent rounded-xl" value="Huawei Nova 5T" />
                    </div>

                    <div>
                        <x-input-label for="tanggal" value="Tanggal Order" />
                        <x-text-input id="tanggal" type="text" class="block w-full mt-1 bg-gray-100 border-transparent rounded-xl" value="01/07/2024" disabled />
                    </div>

                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi Kerusakan" />
                        <textarea id="deskripsi" rows="3" class="block w-full mt-1 bg-gray-100 border-transparent rounded-xl">LCD retak parah dan touchscreen tidak responsif</textarea>
                    </div>

                    <div>
                        <x-input-label for="suku_cadang" value="Suku Cadang" />
                        <div class="flex gap-4 mt-1 border-transparent">
                            <select id="suku_cadang" class="w-2/3  mt-1 bg-gray-100 border-transparent rounded-xl">
                                <option selected>LCD Huawei Nova 5T</option>
                            </select>
                            <input type="number" class="w-1/3  mt-1 bg-gray-100 border-transparent rounded-xl" value="1" min="0">
                        </div>
                    </div>

                    <div>
                        <x-input-label for="biaya" value="Estimasi Biaya Layanan Perbaikan" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 bg-gray-100 rounded-l-xl border border-r-0 text-gray-500">Rp.</span>
                            <input id="biaya" type="text" class="w-full bg-gray-100 rounded-r-xl border-transparent" value="350000">
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
