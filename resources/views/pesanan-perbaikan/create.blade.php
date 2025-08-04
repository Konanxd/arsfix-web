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
            <form action="{{ route('pesanan.store') }}" method="POST">
                @csrf
                <div class="space-y-6">

                    {{-- ID Pelanggan --}}
                <div>
                    <x-input-label for="id_pelanggan" value="ID Pelanggan" />
                    <div class="flex gap-4 mt-1">
                        <select id="id_pelanggan" name="customer_id"
                            class="w-full mt-1 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500"
                            onchange="updateDataPelanggan()">
                            <option disabled selected>Pilih Pelanggan</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}"
                                    data-nama="{{ $customer->name }}"
                                    data-telepon="{{ $customer->phone_number }}"  {{-- Pastikan field phone_number di model Customer --}}
                                    >{{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-text-input type="hidden"
                            id="nama_pelanggan" disabled />
                    </div>
                </div>

                    {{-- ID Teknisi --}}
                    <div>
                        <x-input-label for="id_teknisi" value="ID Teknisi" />
                        <div class="flex gap-4 mt-1">
                            <select id="id_teknisi" name="technician_id" class="w-full mt-1 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" onchange="updateNamaTeknisi()">
                                <option disabled selected>Pilih Teknisi</option>
                                @foreach($technicians as $technician)
                                    <option value="{{ $technician->id }}" data-nama="{{ $technician->name }}">
                                        {{ $technician->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-text-input type="hidden"id="nama_teknisi" disabled />
                        </div>
                    </div>

                    {{-- No. Telepon --}}
                    <div>
                        <x-input-label for="telepon" value="No. Telepon" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl bg-gray-100 border border-r-0 border-transparent text-gray-500 sm:text-sm">+62</span>
                            <input type="text" id="telepon" disabled class="block w-full rounded-r-xl bg-gray-100 border-transparent placeholder-gray-400" >
                            <input type="hidden" id="telepon_hidden">
                        </div>
                    </div>

                    {{-- Gadget --}}
                    <div>
                        <x-input-label for="handphone" value="Gadget" />
                        <input id="handphone" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="handphone" value="{{ old('handphone') }}" required placeholder="Masukan gadget" />
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

                    {{-- Estimasi Tanggal Selesai --}}
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


                    {{-- Deskripsi Kerusakan --}}
                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi Kerusakan" />
                        <textarea id="deskripsi" name="description" rows="3" class="block w-full mt-1 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" placeholder="Masukan deskripsi kerusakan">{{ old('description') }}</textarea>
                    </div>

                    {{-- Suku Cadang --}}
                    <div>
                        <x-input-label value="Suku Cadang" />
                        <div id="sparepart-wrapper">
                            {{-- kosong awalnya --}}
                        </div>
                        <button type="button" onclick="addSparepartInput()" 
                            class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            + Tambah Suku Cadang
                        </button>
                    </div>

                    {{-- Estimasi Biaya --}}
                    <div>
                        <x-input-label for="biaya" value="Estimasi Biaya Layanan Perbaikan" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl bg-gray-100 border border-r-0 border-transparent text-gray-500">Rp.</span>
                            <input id="biaya" min="0" type="number" name="estimated_cost" class="w-full rounded-r-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" placeholder="0">
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Tambah data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Template sparepart baris -->
    <template id="sparepart-template">
        <div class="sparepart-group flex gap-4 mt-2">
            <select name="spare_part_id[]" class="sparepart-select w-2/3 rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" onchange="updateMaxJumlah(this)">
                <option disabled selected>Pilih suku cadang</option>
                @foreach($spareParts as $part)
                    <option value="{{ $part->id }}" data-stock="{{ $part->stock }}" {{ $part->stock < 2 ? 'disabled' : '' }}>
                        {{ $part->name }} (Stok: {{ $part->stock }})
                    </option>
                @endforeach
            </select>
            <div class="flex flex-col w-1/3">
                <x-input-label for="jumlah" value="Jumlah" />
                <input 
                    type="number" 
                    name="jumlah[]" 
                    class="jumlah-input rounded-xl bg-gray-100 border-transparent mt-1"
                    value="1" min="1" max="1" 
                    disabled
                >
            </div>
            <button type="button" class="remove-sparepart px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">×</button>
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
        document.getElementById('telepon').value = telepon;

        // Update hidden inputs supaya data terkirim saat submit
        document.getElementById('telepon_hidden').value = telepon;
    }

    function updateMaxJumlah(selectElement) {
        const group = selectElement.closest('.sparepart-group');
        const jumlahInput = group.querySelector('.jumlah-input');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const stock = parseInt(selectedOption.getAttribute('data-stock')) || 0;

        if (stock < 2) {
            alert('Stok suku cadang kurang dari 2, tidak bisa dipakai.');
            // reset pilihan ke default
            selectEl.selectedIndex = 0;
            jumlahInput.value = '';
            jumlahInput.disabled = true;
            return;
        }

        // jika valid stok >= 2, enable input jumlah dan set max 1
        jumlahInput.disabled = false;
        jumlahInput.value = 1;
        jumlahInput.min = 1;
        jumlahInput.max = 1;

        // Jika nilai sekarang di input jumlah lebih dari stok, set ke stok
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

        const newGroup = template.content.firstElementChild.cloneNode(true);

        // reset select dan jumlah input
        const select = newGroup.querySelector('select');
        const jumlah = newGroup.querySelector('input.jumlah-input');
        select.selectedIndex = 0;
        jumlah.value = '';
        jumlah.disabled = true;

        // Pasang event onchange
        select.addEventListener('change', function() {
            updateMaxJumlah(select);
        });

        // Pasang event hapus baris
        const btnRemove = newGroup.querySelector('.remove-sparepart');
        btnRemove.addEventListener('click', function() {
            newGroup.remove();
        });

        wrapper.appendChild(newGroup);
    }

    // Hapus baris
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-sparepart')) {
        e.target.closest('.sparepart-group').remove();
    }
    });
</script>  
</x-app-layout>
