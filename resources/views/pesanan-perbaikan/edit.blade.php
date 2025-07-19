<x-app-layout>
    <div class="p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold">
            <a href="{{ route('pesanan.index') }}" class="text-gray-500 hover:text-gray-700">Data Pesanan</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-800">Ubah Data Pesanan</span>
        </div>

        {{-- PAGE TITLE --}}
        <div class="flex items-center mt-6">
            <a href="{{ route('pesanan.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Ubah Pesanan Perbaikan</h1>
        </div>

        {{-- FORM --}}
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
            <form action="{{ route('pesanan.update', $pesananPerbaikan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    {{-- Nama Pelanggan --}}
                <div>
                    <x-input-label for="nama_pelanggan" value="Nama Pelanggan" />
                    <input type="text" readonly disabled class="w-full mt-1 rounded-xl bg-gray-100 border-transparent" value="{{ $pesananPerbaikan->customer->name }}">
                    <input type="hidden" name="customer_id" value="{{ $pesananPerbaikan->customer_id }}">
                </div>

                {{-- Nama Teknisi --}}
                <div>
                    <x-input-label for="nama_teknisi" value="Teknisi" />
                    <input type="text" readonly disabled class="w-full mt-1 rounded-xl bg-gray-100 border-transparent" value="{{ $pesananPerbaikan->technician->name }}">
                    <input type="hidden" name="technician_id" value="{{ $pesananPerbaikan->technician_id }}">
                </div>

                {{-- Tanggal Order --}}
                    <div>
                        <x-input-label for="tanggal" value="Tanggal Order" />
                        <x-text-input
                            id="tanggal"
                            class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                            type="date"
                            name="order_date"
                            value="{{ now()->format('Y-m-d') }}"
                        />
                    </div>


                    {{-- Deskripsi --}}
                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi Kerusakan" />
                        <textarea id="deskripsi" name="description" rows="3" class="w-full mt-1 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500">{{ $pesananPerbaikan->description }}</textarea>
                    </div>

                    {{-- Suku Cadang --}}
                    <div>
                        <x-input-label for="sparepart_id" value="Suku Cadang" />
                        <div class="flex gap-4 mt-1">
                            <select id="sparepart_id" name="sparepart_id" class="w-2/3 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" onchange="updateMaxJumlah()">
                                @foreach($spareParts as $part)
                                    <option value="{{ $part->id }}" data-stock="{{ $part->stock }}" {{ $pesananPerbaikan->sparepart_id == $part->id ? 'selected' : '' }}>
                                        {{ $part->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="flex flex-col w-1/3">
                                <x-input-label for="jumlah" value="Jumlah" />
                                <input type="number" class="rounded-xl bg-gray-100 border-transparent mt-1" name="jumlah" id="jumlah" value="{{ $pesananPerbaikan->jumlah }}" min="1" max="100">
                            </div>
                        </div>
                    </div>

                    {{-- Estimasi Biaya --}}
                    <div>
                        <x-input-label for="biaya" value="Estimasi Biaya" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl bg-gray-100 border border-r-0 border-transparent text-gray-500">Rp.</span>
                            <input id="biaya" type="number" name="estimated_cost" class="w-full rounded-r-xl bg-gray-100 border-transparent" value="{{ $pesananPerbaikan->estimated_cost }}">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        <x-input-label for="status" value="Status Pesanan" />
                        <select id="status" name="status" class="block w-full mt-1 bg-gray-100 border-transparent rounded-xl">
                            <option value="Dalam Proses" {{ $pesananPerbaikan->status == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                            <option value="Selesai" {{ $pesananPerbaikan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Batal" {{ $pesananPerbaikan->status == 'Batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateMaxJumlah() {
            const select = document.getElementById('sparepart_id');
            const jumlahInput = document.getElementById('jumlah');
            const selectedOption = select.options[select.selectedIndex];
            const stock = selectedOption.getAttribute('data-stock') || 0;

            jumlahInput.max = stock;
            if (parseInt(jumlahInput.value) > stock) {
                jumlahInput.value = stock;
            }
            jumlahInput.disabled = stock == 0;
        }
    </script>
</x-app-layout>
