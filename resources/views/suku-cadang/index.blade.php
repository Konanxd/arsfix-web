<x-app-layout>
    <div class="p-4 sm:p-8">
        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">Data Suku Cadang</h1>

        {{-- ALERT NOTIFICATION --}}
        @if(session('success'))
            <div class="mt-6 p-4 text-green-700 bg-green-100 border border-green-200 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mt-6 p-4 text-red-700 bg-red-100 border border-red-200 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- SEARCH BAR DAN TOMBOL (SUDAH RESPONSIF) --}}
        <form method="GET" action="{{ route('suku-cadang.index') }}" class="w-full">
            <div class="flex flex-col sm:flex-row justify-between items-center mt-6 space-y-4 sm:space-y-0">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data suku cadang"
                    class="w-full max-w-2xl px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                
                <a href="{{ route('suku-cadang.create') }}"
                    class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    + Tambah Suku Cadang
                </a>
            </div>
        </form>

        {{-- TABEL DAFTAR SUKU CADANG --}}
        <div class="mt-8 bg-white rounded-lg shadow-md overflow-x-auto border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Foto</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Suku Cadang</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if ($sukuCadang->isEmpty())
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                @if(request('search'))
                                    Tidak ada suku cadang yang cocok dengan pencarian "<strong>{{ request('search') }}</strong>".
                                @else
                                    Belum ada data suku cadang yang tersedia.
                                @endif
                            </td>
                        </tr>
                    @else
                        @foreach ($sukuCadang as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                {{-- Nomor Urut --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $index + 1 }}
                                </td>
                                
                                {{-- Thumbnail Foto --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-14 h-14 bg-gray-50 rounded border border-gray-200 overflow-hidden flex items-center justify-center p-1">
                                        <img src="{{ asset($item->image ?? 'images/default.jpg') }}" alt="{{ $item->name }}" class="w-full h-full object-contain">
                                    </div>
                                </td>
                                
                                {{-- Nama Suku Cadang --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-800">{{ $item->name }}</div>
                                    {{-- <div class="text-xs text-gray-500">ID: {{ $item->id }}</div> --}}
                                </td>
                                
                                {{-- Harga --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                
                                {{-- Stok dengan Badge dinamis --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $item->stock }} Unit
                                    </span>
                                </td>
                                
                                {{-- Tombol Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('suku-cadang.edit', ['id' => $item->id]) }}" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-md transition-colors">
                                            Edit
                                        </a>
                                        
                                        <form action="{{ route('suku-cadang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data suku cadang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            {{-- Pagination --}}
            @if ($sukuCadang->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $sukuCadang->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>