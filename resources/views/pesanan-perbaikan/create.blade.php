<x-app-layout>
    <div class="p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold">
            <a href="{{ route('pesanan.index') }}" class="text-gray-500 hover:text-gray-700">Data Pesanan</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="text-gray-800">Tambah Data Pesanan</span>
        </div>

        {{-- PAGE TITLE --}}
        <div class="flex items-center mt-6">
            <a href="{{ route('pesanan.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Pesanan Perbaikan</h1>
        </div>

        {{-- FORM CARD --}}
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">

            {{-- ALERT UNTUK ERROR VALIDASI LARAVEL --}}
            @if ($errors->any())
                <div class="mb-6 p-4 text-red-700 bg-red-100 border border-red-200 rounded-lg">
                    <div class="flex items-center mb-2 font-bold">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        Terjadi kesalahan validasi:
                    </div>
                    <ul class="list-disc pl-7 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ALERT UNTUK ERROR STOK (Dari Controller) --}}
            @if (session('error'))
                <div class="mb-6 p-4 text-red-700 bg-red-100 border border-red-200 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf
                <div class="space-y-6">

                    {{-- ID Pelanggan --}}
                    <div>
                        <x-input-label for="id_pelanggan" value="ID Pelanggan" />
                        <div class="flex gap-4 mt-1">
                            <select id="id_pelanggan" name="customer_id"
                                class="w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                                onchange="updateDataPelanggan()" required>
                                {{-- <option disabled selected>Pilih Pelanggan</option> --}}
                                <option value="" disabled selected>Pilih Pelanggan</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        data-nama="{{ $customer->name }}"
                                        data-telepon="{{ $customer->phone_number }}"
                                        >{{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-text-input type="hidden" id="nama_pelanggan" disabled />
                        </div>
                    </div>

                    {{-- ID Teknisi --}}
                    <div>
                        <x-input-label for="id_teknisi" value="ID Teknisi" />
                        <div class="flex gap-4 mt-1">
                            <select id="id_teknisi" name="technician_id" class="w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" onchange="updateNamaTeknisi()" required>
                                {{-- <option disabled selected>Pilih Teknisi</option> --}}
                                <option value="" disabled selected>Pilih Teknisi</option>
                                @foreach($technicians as $technician)
                                    <option value="{{ $technician->id }}" data-nama="{{ $technician->name }}">
                                        {{ $technician->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-text-input type="hidden" id="nama_teknisi" disabled />
                        </div>
                    </div>

                    {{-- No. Telepon --}}
                    <div>
                        <x-input-label for="telepon" value="No. Telepon" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl bg-gray-100 border border-r-0 border-transparent text-gray-500 sm:text-sm">+62</span>
                            <input type="text" id="telepon" disabled class="block w-full rounded-r-xl bg-gray-100 border-transparent placeholder-gray-400" placeholder="Terisi otomatis" >
                            <input type="hidden" id="telepon_hidden" name="phone_number">
                        </div>
                    </div>

                    {{-- Gadget --}}
                    <div>
                        <x-input-label for="handphone" value="Gadget" />
                        <input id="handphone" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="handphone" value="{{ old('handphone') }}" required placeholder="Masukan gadget" />
                        <x-input-error :messages="$errors->get('handphone')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Tanggal Order --}}
                        <div>
                            <x-input-label for="tanggal" value="Tanggal Order" />
                            <x-text-input
                                id="tanggal"
                                class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                                type="date"
                                name="order_date"
                                value="{{ now()->format('Y-m-d') }}"
                                required
                            />
                        </div>

                        {{-- Estimasi Tanggal Selesai --}}
                        <div>
                            <x-input-label for="completion_date" value="Estimasi Tanggal Selesai" />
                            <input
                                id="completion_date"
                                type="date"
                                name="completion_date"
                                value="{{ old('completion_date') }}"
                                class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                                required
                            />
                        </div>
                    </div>

                    {{-- Deskripsi Kerusakan --}}
                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi Kerusakan" />
                        <textarea id="deskripsi" name="description" rows="3" class="block w-full mt-1 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" placeholder="Masukan deskripsi kerusakan" required>{{ old('description') }}</textarea>
                    </div>

                    {{-- Suku Cadang (Desain Clean) --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <x-input-label value="Suku Cadang & Jumlah" />
                        </div>
                        
                        <div id="sparepart-wrapper" class="space-y-3">
                            {{-- Kosong awalnya, diisi via template saat tambah ditekan --}}
                        </div>
                        
                        {{-- Tombol Tambah Elegan --}}
                        <button type="button" onclick="addSparepartInput()" class="mt-4 px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Baris Suku Cadang
                        </button>
                    </div>

                    {{-- Estimasi Biaya --}}
                    <div>
                        <x-input-label for="biaya" value="Estimasi Biaya Layanan Perbaikan" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl bg-gray-100 border border-r-0 border-transparent text-gray-500">Rp.</span>
                            <input id="biaya" min="0" type="number" name="estimated_cost" class="w-full rounded-r-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" placeholder="0" required>
                        </div>
                    </div>

                    {{-- Submit & Batal --}}
                    <div class="flex justify-end pt-4 space-x-3">
                        <a href="{{ route('pesanan.index') }}" class="inline-flex justify-center py-3 px-6 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Tambah Pesanan
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <template id="sparepart-template">
        <div class="sparepart-group flex items-center gap-3">
            <div class="flex-1">
                <select name="spare_part_id[]" class="sparepart-select w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 text-sm" onchange="updateMaxJumlah(this)" required>
                    {{-- <option disabled selected>Pilih suku cadang</option> --}}
                    <option value="" disabled selected>Pilih suku cadang</option>
                    @foreach($spareParts as $part)
                        <option value="{{ $part->id }}" data-stock="{{ $part->stock }}" {{ $part->stock < 1 ? 'disabled' : '' }}>
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
                    value="" min="1" max="1" 
                    placeholder="Qty"
                    disabled
                    required
                >
            </div>
            <button type="button" class="remove-sparepart flex items-center justify-center w-11 h-11 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition-colors focus:outline-none">
                <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </template>


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

        document.getElementById('nama_pelanggan').value = nama;
        
        // Buang awalan '0' agar cantik disandingkan dengan +62
        const cleanedTelepon = telepon.startsWith('0') ? telepon.substring(1) : telepon;
        document.getElementById('telepon').value = cleanedTelepon;

        // Update hidden inputs
        document.getElementById('telepon_hidden').value = telepon;
    }

    function updateMaxJumlah(selectElement) {
        const group = selectElement.closest('.sparepart-group');
        const jumlahInput = group.querySelector('.jumlah-input');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const stock = parseInt(selectedOption.getAttribute('data-stock')) || 0;

        // Note: Saya ubah dari < 2 menjadi < 1 (karena stok 1 pun masih bisa dipakai)
        if (stock < 1) {
            alert('Stok suku cadang ini habis (0), tidak bisa dipakai.');
            selectElement.selectedIndex = 0;
            jumlahInput.value = '';
            jumlahInput.disabled = true;
            return;
        }

        // Jika stok tersedia
        jumlahInput.disabled = false;
        jumlahInput.value = 1;
        jumlahInput.min = 1;
        
        // Max bisa diubah ke stock jika memang boleh pesan > 1 barang yg sama
        jumlahInput.max = 1; 

        if (parseInt(jumlahInput.value) > stock || parseInt(jumlahInput.value) < 1) {
            jumlahInput.value = 1;
        }
    }

    function addSparepartInput() {
        const wrapper = document.getElementById('sparepart-wrapper');
        const template = document.getElementById('sparepart-template');

        if (!template) {
            console.error('Template tidak ditemukan');
            return;
        }

        // Klon isi template (bukan elemen template-nya sendiri)
        const newGroup = template.content.cloneNode(true);
        
        // Memasukkan ke DOM agar bisa diselect event listenenrnya
        wrapper.appendChild(newGroup);
    }

    // Menggunakan Event Delegation untuk Hapus (agar berlaku untuk elemen yang baru ditambah)
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-sparepart')) {
            e.target.closest('.sparepart-group').remove();
        }
    });
</script>  
</x-app-layout>