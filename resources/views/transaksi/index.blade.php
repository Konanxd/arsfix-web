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
                        <svg class="text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" d="M688 312v-48c0-4.4-3.6-8-8-8H296c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h384c4.4 0 8-3.6 8-8m-392 88c-4.4 0-8 3.6-8 8v48c0 4.4 3.6 8 8 8h184c4.4 0 8-3.6 8-8v-48c0-4.4-3.6-8-8-8zm376 116c-119.3 0-216 96.7-216 216s96.7 216 216 216s216-96.7 216-216s-96.7-216-216-216m107.5 323.5C750.8 868.2 712.6 884 672 884s-78.8-15.8-107.5-44.5S520 772.6 520 732s15.8-78.8 44.5-107.5S631.4 580 672 580s78.8 15.8 107.5 44.5S824 691.4 824 732s-15.8 78.8-44.5 107.5M761 656h-44.3c-2.6 0-5 1.2-6.5 3.3l-63.5 87.8l-23.1-31.9a7.92 7.92 0 0 0-6.5-3.3H573c-6.5 0-10.3 7.4-6.5 12.7l73.8 102.1c3.2 4.4 9.7 4.4 12.9 0l114.2-158c3.9-5.3.1-12.7-6.4-12.7M440 852H208V148h560v344c0 4.4 3.6 8 8 8h56c4.4 0 8-3.6 8-8V108c0-17.7-14.3-32-32-32H168c-17.7 0-32 14.3-32 32v784c0 17.7 14.3 32 32 32h272c4.4 0 8-3.6 8-8v-56c0-4.4-3.6-8-8-8"/></svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-500">#TR0001</p>
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
