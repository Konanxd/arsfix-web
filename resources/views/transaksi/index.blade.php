<x-app-layout>
    <div class="p-8">
        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">Transaksi</h1>

        {{-- SEARCH BAR DAN TOMBOL --}}
        <div class="flex justify-between items-center mt-8">
            <input type="text" placeholder="Cari data transaksi" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>


        <div class="mt-6 space-y-4">

            {{-- Data Dummy 1 --}}
            <div class="bg-white p-4 rounded-lg shadow-md flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <div class="flex items-center">
                    <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13M9 11l4-4m0 0l4 4m-4-4v12" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-500">#OR0001</p>
                        <p class="text-lg font-semibold text-gray-800">Dida Handika | INV/001</p>
                        <p class="text-sm text-gray-600">+62 812 3456 7890 | Huawei Nova 5T</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <p class="text-sm text-gray-500">01/07/24</p>
                        </div>
                    </div>
                </div>
                <div class="flex space-x-3 self-end lg:self-auto">
                    <a href="{{ route('transaksi.detail', ['id' => 1]) }}" class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 flex-shrink-0">
                    Detail
                    </a>
                    <button class="px-5 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50 flex-shrink-0">
                        Hapus data
                    </button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
