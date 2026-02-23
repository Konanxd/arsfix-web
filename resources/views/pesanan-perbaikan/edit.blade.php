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

                {{-- Gadget --}}
                <div>
                    <x-input-label for="handphone" value="Gadget" />
                    <input id="handphone" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="handphone" value="{{ $pesananPerbaikan->handphone }}" required />
                    <x-input-error :messages="$errors->get('handphone')" class="mt-2" />
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
                
                {{-- Tanggal Selesai --}}
                    <div>
                        <x-input-label for="completion_date" value="Estimasi Tanggal Selesai" />
                        <input
                            id="completion_date"
                            type="date"
                            name="completion_date"
                            value="{{ old('completion_date', $pesananPerbaikan->completion_date ?? '') }}"
                            class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                            required
                        />
                    </div>


                    {{-- Deskripsi --}}
                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi Kerusakan" />
                        <textarea id="deskripsi" name="description" rows="3" class="w-full mt-1 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500">{{ $pesananPerbaikan->description }}</textarea>
                    </div>

                    {{-- Suku Cadang --}}
                    {{-- Suku Cadang --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <x-input-label value="Suku Cadang & Jumlah" />
                        </div>

                        <div id="sparepart-wrapper" class="space-y-3">
                            @forelse($selectedSpareparts as $index => $sparepart)
                                <div class="sparepart-group flex items-center gap-3">
                                    {{-- Dropdown Nama Suku Cadang --}}
                                    <div class="flex-1">
                                        <select name="spare_part_id[]" class="sparepart-select w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 text-sm" onchange="updateMaxJumlah(this)" required>
                                            <option disabled>Pilih suku cadang</option>
                                            @foreach($spareParts as $part)
                                                <option 
                                                    value="{{ $part->id }}" 
                                                    data-stock="{{ $part->stock }}"
                                                    {{ $part->id == $sparepart->id ? 'selected' : '' }}>
                                                    {{ $part->name }} (Stok: {{ $part->stock }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Input Jumlah --}}
                                    <div class="w-24">
                                        <input 
                                            type="number" 
                                            name="jumlah[]" 
                                            class="jumlah-input w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 text-center text-sm" 
                                            value="{{ $sparepart->pivot->jumlah ?? 1 }}" 
                                            min="1" 
                                            max="{{ $sparepart->stock > 0 ? $sparepart->stock : 1 }}" 
                                            {{ $sparepart->stock == 0 ? 'disabled' : '' }}
                                            placeholder="Qty"
                                            required
                                        >
                                    </div>

                                    {{-- Tombol Hapus (Icon SVG yang Clean) --}}
                                    <button type="button" class="remove-sparepart flex items-center justify-center w-11 h-11 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-colors focus:outline-none">
                                        <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            @empty
                                {{-- Jika kosong, tampilkan 1 baris input --}}
                                <div class="sparepart-group flex items-center gap-3">
                                    <div class="flex-1">
                                        <select name="spare_part_id[]" class="sparepart-select w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 text-sm" onchange="updateMaxJumlah(this)" required>
                                            <option disabled selected>Pilih suku cadang</option>
                                            @foreach($spareParts as $part)
                                                <option value="{{ $part->id }}" data-stock="{{ $part->stock }}">
                                                    {{ $part->name }} (Stok: {{ $part->stock }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-24">
                                        <input 
                                            type="number" 
                                            name="jumlah[]" 
                                            class="jumlah-input w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 text-center text-sm" 
                                            value="1" 
                                            min="1" 
                                            max="1" 
                                            placeholder="Qty"
                                            required
                                        >
                                    </div>

                                    <button type="button" class="remove-sparepart flex items-center justify-center w-11 h-11 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-colors focus:outline-none">
                                        <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            @endforelse
                        </div>

                        {{-- Tombol Tambah yang Lebih Elegan --}}
                        <button type="button" onclick="addSparepartInput()" class="mt-4 px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Baris Suku Cadang
                        </button>

                        <template id="sparepart-template">
                            <div class="sparepart-group flex items-center gap-3 mt-3">
                                <div class="flex-1">
                                    <select name="spare_part_id[]" class="sparepart-select w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 text-sm" onchange="updateMaxJumlah(this)" required>
                                        <option disabled selected>Pilih suku cadang</option>
                                        @foreach($spareParts as $part)
                                            <option value="{{ $part->id }}" data-stock="{{ $part->stock }}">
                                                {{ $part->name }} (Stok: {{ $part->stock }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-24">
                                    <input type="number" name="jumlah[]" class="jumlah-input w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 text-center text-sm" value="1" min="1" max="1" placeholder="Qty" required>
                                </div>
                                <button type="button" class="remove-sparepart flex items-center justify-center w-11 h-11 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-colors focus:outline-none">
                                    <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </template>
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
                        <input
                            type="text"
                            id="status"
                            name="status"
                            value="Dalam Proses"
                            readonly
                            class="block w-full mt-1 bg-gray-100 border-transparent rounded-xl"
                        />
                    </div>


                    {{-- Submit --}}
                    {{-- Submit & Batal --}}
                    <div class="flex justify-end pt-4 space-x-3">
                        <a href="{{ route('pesanan.index') }}" class="inline-flex justify-center py-3 px-6 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
    function updateNamaTeknisi() {
        const select = document.getElementById('id_teknisi');
        const selectedOption = select.options[select.selectedIndex];
        const namaTeknisi = selectedOption.getAttribute('data-nama') || '';
        document.getElementById('nama_teknisi').value = namaTeknisi;
    }

    function updateDataPelanggan() {
        const select = document.getElementById('id_pelanggan');
        const selectedOption = select.options[select.selectedIndex];

        const nama = selectedOption.getAttribute('data-nama') || '';
        const telepon = selectedOption.getAttribute('data-telepon') || '';
        const handphone = selectedOption.getAttribute('data-handphone') || '';

        document.getElementById('nama_pelanggan').value = nama;
        document.getElementById('telepon').value = telepon;
        document.getElementById('handphone').value = handphone;

        // Update hidden inputs supaya data terkirim saat submit
        document.getElementById('telepon_hidden').value = telepon;
        document.getElementById('handphone_hidden').value = handphone;
    }

    function updateMaxJumlah(selectElement) {
        const group = selectElement.closest('.sparepart-group');
        const jumlahInput = group.querySelector('.jumlah-input');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const stock = parseInt(selectedOption.getAttribute('data-stock')) || 0;

        // Set max jumlah jadi 1 (bukan berdasarkan stok)
        jumlahInput.max = 1;

        // Jika jumlah sekarang lebih dari 1, set ke 1
        if (parseInt(jumlahInput.value) > 1 || parseInt(jumlahInput.value) < 1) {
            jumlahInput.value = 1;
        }

        if (stock === 0) {
            alert('Stok suku cadang ini kosong, tidak bisa diinputkan.');
            // Reset pilihan supaya user memilih yang lain
            selectElement.selectedIndex = 0;
            jumlahInput.value = 0;
            jumlahInput.max = 0;
            jumlahInput.disabled = true;
            return;
        }

        jumlahInput.max = stock;
        jumlahInput.disabled = false;

        if (parseInt(jumlahInput.value) > stock) {
            jumlahInput.value = stock;
        }
        
    }

    function addSparepartInput() {
        const wrapper = document.getElementById('sparepart-wrapper');
        const template = document.getElementById('sparepart-template');
        
        // Mengkloning isi dari dalam tag <template>
        const newGroup = template.content.cloneNode(true);
        
        // Memasukkan hasil kloningan ke dalam wrapper
        wrapper.appendChild(newGroup);
    }

    // Hapus baris
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-sparepart')) {
            // Langsung hapus elemen tanpa perlu mengecek jumlah minimal
            e.target.closest('.sparepart-group').remove();
        }
    });
</script>
</x-app-layout>
