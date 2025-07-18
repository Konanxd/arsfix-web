<x-app-layout>
    <div class="p-8 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Tambah Transaksi</h1>

        {{-- Tampilkan error jika ada --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            {{-- Receipt ID --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1" for="receipt_id">ID Transaksi</label>
                <input type="text" name="receipt_id" id="receipt_id" class="w-full border rounded p-2" required>
            </div>

            {{-- Repair Order --}}
            <div>
                <label for="order_id" class="block font-semibold text-gray-700">Pesanan Perbaikan</label>
                <select name="order_id" id="order_id" class="w-full border-gray-300 rounded shadow-sm">
                    <option value="">-- Pilih Pesanan --</option>
                    @foreach ($repairOrders as $order)
                        <option value="{{ $order->order_id }}">
                            {{ $order->order_id }} - {{ $order->customer->name_customers ?? 'Pelanggan tidak ditemukan' }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Customer --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1" for="customers_id">Pelanggan</label>
                <select name="customers_id" id="customers_id" class="w-full border rounded p-2" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->customers_id }}">
                            {{ $customer->customers_id }} - {{ $customer->name_customers }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Total Harga --}}
            <div class="mb-4">
                <label class="block font-semibold mb-1" for="total_price">Total Harga</label>
                <input type="number" name="total_price" id="total_price" class="w-full border rounded p-2" required>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end">
                <a href="{{ route('transaksi.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
