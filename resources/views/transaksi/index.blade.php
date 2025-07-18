<x-app-layout>
    <div class="p-8">
        
        <div class="p-8">
        {{-- HEADER --}}
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Transaksi</h1>
            <a href="{{ route('transaksi.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                + Tambah Transaksi
            </a>
        </div>

        {{-- TABEL TRANSAKSI --}}
        {{-- lanjutkan dengan tabelmu di sini --}}
    </div>

        <table class="mt-4 w-full table-auto">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Receipt ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $t->receipt_id }}</td>
                        <td>{{ $t->customer->name_customers ?? '-' }}</td>
                        <td>{{ $t->total_price }}</td>
                        <td>
                            <a href="{{ route('transaksi.edit', $t->receipt_id) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('transaksi.destroy', $t->receipt_id) }}" method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus transaksi?')" class="text-red-500">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Tidak ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
