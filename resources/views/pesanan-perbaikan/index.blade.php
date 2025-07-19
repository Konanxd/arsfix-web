<x-app-layout>
    <div class="p-8">
        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">Pesanan Perbaikan</h1>

        {{-- SEARCH BAR DAN TOMBOL --}}
        <div class="flex justify-between items-center mt-8">
            <input type="text" placeholder="Cari data pesanan" class="w-full max-w-md px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <a href="{{ route('pesanan.create') }}" class="inline-flex items-center px-5 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-4">
                + Tambah data
            </a>
        </div>

        {{-- DAFTAR PESANAN --}}
        <div class="mt-6 space-y-4">
            @forelse ($pesananPerbaikan as $pesanan)
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <a href="{{ route('pesanan.show', $pesanan->id) }}" class="flex items-center flex-1">
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024">
                                <path fill="currentColor" d="M192 128v768h640V128zm-32-64h704a32 32 0 0 1 32 32v832a32 32 0 0 1-32 32H160a32 32 0 0 1-32-32V96a32 32 0 0 1 32-32m160 448h384v64H320zm0-192h192v64H320zm0 384h384v64H320z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-500">#{{ str_pad($pesanan->id, 4, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $pesanan->customer->name ?? '-' }} | 
                                {{ $pesanan->sparePart->name ?? '-' }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $pesanan->customer->phone_number ?? '-' }} | {{ $pesanan->description }}
                            </p>
                            <div class="flex items-center space-x-2 mt-1">
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($pesanan->order_date)->format('d/m/y') }}</p>
                                <span class="px-2 py-1 rounded text-xs font-medium 
                                    {{ 
                                        $pesanan->status === 'Selesai' ? 'bg-green-100 text-green-800' : 
                                        ($pesanan->status === 'Dalam Proses' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') 
                                    }}">
                                    {{ $pesanan->status }}
                                </span>
                            </div>
                        </div>
                    </a>

                    {{-- Aksi tombol --}}
                    <div class="flex space-x-3 mt-4 lg:mt-0">
                        <a href="{{ route('pesanan.edit', ['id' => $pesanan->id]) }}" class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Edit data
                        </a>
                        <form action="{{ route('pesanan.destroy', ['id' => $pesanan->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-5 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-gray-500 text-center py-10">
                    Tidak ada data pesanan perbaikan ditemukan.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
