<x-app-layout>
    <div class="p-4 sm:p-8">
        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">Data Suku Cadang</h1>

        {{-- SEARCH BAR DAN TOMBOL (SUDAH RESPONSIF) --}}
        <form method="GET" action="{{ route('suku-cadang.index') }}" class="w-full">
            <div class="flex flex-col sm:flex-row justify-between items-center mt-8 space-y-4 sm:space-y-0">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data suku cadang"
                    class="w-full max-w-md px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" name="image">
                
                <a href="{{ route('suku-cadang.create') }}"
                    class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    + Tambah Suku Cadang
                </a>
            </div>
        </form>



        {{-- GRID DAFTAR SUKU CADANG --}}
        <div class="mt-8 grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @if ($sukuCadang->isEmpty())
                <div class="col-span-full text-center text-gray-500 mt-8">
                    @if(request('search'))
                        <p>Tidak ada suku cadang yang cocok dengan pencarian "<strong>{{ request('search') }}</strong>".</p>
                    @else
                        <p>Belum ada data suku cadang yang tersedia.</p>
                    @endif
                </div>
            @else
                @foreach ($sukuCadang as $item)
                    <div class="bg-white rounded-lg border border-gray-100 p-4 text-left hover:shadow-lg transition-shadow duration-300 flex flex-col">
                        <div class="flex-grow">
                            <div class="bg-gray-50 rounded-md p-4">
                                <img src="https://img.gkbcdn.com/p/2016-05-18/uart-ttl-serial-camera-module-640x480-pixels-for-arduino-1572312083423._w500_p1_.jpg" 
                                    alt="Suku Cadang" class="w-full h-28 object-contain mx-auto">
                            </div>
                            <div class="mt-4">
                                <p class="mt-1 font-semibold text-gray-800">{{ $item->name }}</p>
                            </div>
                            <div class="mt-2 text-left text-sm text-gray-600">
                                <p>Harga: <span class="font-semibold text-gray-800">Rp {{ number_format($item->price, 0, ',', '.') }}</span></p>
                                <p>Stok: <span class="font-semibold text-gray-800">{{ $item->stock }} unit</span></p>
                            </div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-center space-x-3">
                            <a href="{{ route('suku-cadang.edit', ['id' => $item->id]) }}" class="px-4 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Edit
                            </a>
                            
                            <form id="delete-form-1" action="{{ route('suku-cadang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete('delete-form-1')" class="px-4 py-1.5 text-xs font-medium text-red-600 border border-red-600 rounded-md hover:bg-red-50">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>                   
                @endforeach
            @endif
            
            {{-- Loop untuk menampilkan data dinamis dari $sukuCadang --}}
            @foreach ($sukuCadang as $item)
                <div class="bg-white rounded-lg border border-gray-100 p-4 text-left hover:shadow-lg transition-shadow duration-300 flex flex-col">
                    <div class="flex-grow">
                        <div class="bg-gray-50 rounded-md p-4">
                            <img src="{{ asset($item->image ?? 'images/default.jpg') }}" alt="Suku Cadang" class="w-full h-28 object-contain mx-auto">

                        </div>
                        <div class="mt-4">
                            <p class="mt-1 font-semibold text-gray-800">{{ $item->name }}</p>
                        </div>
                        <div class="mt-2 text-left text-sm text-gray-600">
                            <p>Harga: <span class="font-semibold text-gray-800">Rp {{ number_format($item->price, 0, ',', '.') }}</span></p>
                            <p>Stok: <span class="font-semibold text-gray-800">{{ $item->stock }} unit</span></p>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-center space-x-3">
                        <a href="{{ route('suku-cadang.edit', ['id' => $item->id]) }}" class="px-4 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Edit
                        </a>
                        
                        <form action="{{ route('suku-cadang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-1.5 text-xs font-medium text-red-600 border border-red-600 rounded-md hover:bg-red-50">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
            
        </div>
    </div>
</x-app-layout>
