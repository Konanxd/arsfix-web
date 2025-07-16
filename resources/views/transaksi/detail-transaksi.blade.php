<x-app-layout>
    <div class="p-8">
        {{-- BREADCRUMB --}}
       <div class="flex items-center text-sm font-semibold">
            <a href="{{ route('transaksi.index') }}" class="text-gray-500 hover:text-gray-700">Data Transaksi</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-800">Detail Transaksi</span>
        </div>

        {{-- TITLE --}}
        <div class="flex justify-between items-center mt-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detail Transaksi</h1>
            <button class="flex items-center px-5 py-3 border border-blue-600 text-blue-600 rounded-xl hover:bg-blue-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="mr-3" viewBox="0 0 20 20">
                    <g fill="currentColor"><rect width="18" height="11" x="2" y="7.5" opacity="0.2" rx="3"/><path d="M5 6.5H4V2.1C4 1.234 4.612.5 5.417.5h9.166C15.388.5 16 1.234 16 2.1v4.4h-1V2.1c0-.35-.209-.6-.417-.6H5.417c-.208 0-.417.25-.417.6z"/><path fill-rule="evenodd" d="M16 6H4a3 3 0 0 0-3 3v5a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V9a3 3 0 0 0-3-3M2 9a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2z" clip-rule="evenodd"/><path d="M15 11.969h1v5.25c0 .97-.588 1.812-1.417 1.812H5.417C4.588 19.031 4 18.19 4 17.22v-5.25h1v5.25c0 .479.233.812.417.812h9.166c.184 0 .417-.333.417-.812z"/><path d="M13.5 15.5a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1zm0-2a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1z"/></g></svg>
                Cetak Struk Pembayaran
            </button>
        </div>

        {{-- CARD --}}
        <div class="bg-white rounded-xl shadow-md p-8">
            <div class="flex justify-between mb-6">
                <div>
                    <p class="text-sm text-gray-500 font-medium">ID Transaksi</p>
                    <p class="text-base font-semibold">TR0001</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-blue-600 font-medium">Tanggal Transaksi</p>
                    <p class="text-base text-gray-800 font-semibold">04/01/24</p>
                </div>
            </div>

            {{-- Informasi --}}
            <div class="mb-6">
                <p class="text-sm text-blue-600 font-semibold mb-2">Informasi</p>
                <div class="space-y-2">
                    <div class="flex justify-between border-b pb-1">
                        <p class="text-gray-500">Nama Pelanggan</p>
                        <p class="text-gray-800 font-medium">Dida Handika</p>
                    </div>
                    <div class="flex justify-between border-b pb-1">
                        <p class="text-gray-500">Nama Teknisi</p>
                        <p class="text-gray-800 font-medium">Irfan Jaelani</p>
                    </div>
                    <div class="flex justify-between border-b pb-1">
                        <p class="text-gray-500">No. Telp</p>
                        <p class="text-gray-800 font-medium">+62 845 9980 876</p>
                    </div>
                    <div class="flex justify-between border-b pb-1">
                        <p class="text-gray-500">Handphone</p>
                        <p class="text-gray-800 font-medium">Huawei Nova 5T</p>
                    </div>
                </div>
            </div>

            {{-- Pembayaran --}}
            <div class="mb-6">
                <p class="text-sm text-blue-600 font-semibold mb-2">Pembayaran</p>
                <div class="space-y-2">
                    <div class="flex justify-between border-b pb-1">
                        <p class="text-gray-500">Suku Cadang</p>
                        <p class="text-gray-800 font-medium">Rp. 150.000</p>
                    </div>
                    <div class="flex justify-between border-b pb-1">
                        <p class="text-gray-500">Biaya Layanan</p>
                        <p class="text-gray-800 font-medium">Rp. 100.000</p>
                    </div>
                </div>
            </div>

            {{-- Total --}}
            <div>
                <p class="text-sm text-blue-600 font-semibold mb-2">Total</p>
                <div class="flex justify-between">
                    <p class="text-gray-800 font-semibold">Total Pembayaran</p>
                    <p class="text-gray-800 font-semibold">Rp. 250.000</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
