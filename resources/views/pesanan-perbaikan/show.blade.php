<x-app-layout>
    <div class="p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold mb-4">
            <a href="{{ route('pesanan.index') }}" class="text-gray-500 hover:text-gray-700">Data Pesanan</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-800">Detail Pesanan</span>
        </div>

        {{-- HEADER --}}
         <div class="flex items-center mt-6 mb-6">
             <a href="{{ route('pesanan.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan</h1>
        </div>

        {{-- CARD --}}
        <div class="bg-white p-8 rounded-lg shadow-md space-y-6">
            <div>
                <p class="text-sm text-gray-500 font-medium">Pelanggan</p>
                <p class="text-lg font-semibold text-gray-800">Dida Handika (00001)</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 font-medium">No. Telepon</p>
                    <p class="text-base text-gray-800 font-semibold">+62 812 3456 7890</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Tanggal Order</p>
                    <p class="text-base text-gray-800 font-semibold">01/07/2024</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Handphone</p>
                    <p class="text-base text-gray-800 font-semibold">Huawei Nova 5T</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Teknisi</p>
                    <p class="text-base text-gray-800 font-semibold">Irfan Jaelani (T00001)</p>
                </div>
            </div>

            <div>
                <p class="text-sm text-gray-500 font-medium">Deskripsi Kerusakan</p>
                <p class="text-base text-gray-800">LCD retak parah dan touchscreen tidak responsif</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 font-medium">Suku Cadang Digunakan</p>
                <ul class="list-disc ml-5 text-gray-800">
                    <li>LCD Huawei Nova 5T (1 unit)</li>
                </ul>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Estimasi Biaya</p>
                    <p class="text-base text-gray-800 font-semibold">Rp 350.000</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
