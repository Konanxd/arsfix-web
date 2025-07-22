<x-app-layout>
    @php
        function formatPhoneNumber($phone_number) {
            if (!$phone_number) return '-';

            // Ubah +62 jadi 0 jika ada
            $digits = preg_replace('/\D/', '', $phone_number);
            if (str_starts_with($digits, '62')) {
                $digits = '0' . substr($digits, 2);
            }

            // Format nomor jadi potongan 3-4-4 atau sesuai panjang
            $part1 = substr($digits, 0, 3);
            $part2 = substr($digits, 3, 4);
            $part3 = substr($digits, 7);

            return trim(implode('-', array_filter([$part1, $part2, $part3])));
        }
    @endphp

    <div class="p-8">
        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">Transaksi</h1>

        {{-- SEARCH --}}
        <form method="GET" action="{{ route('transaksi.index') }}" class="mt-6">
            <input type="text" name="search" placeholder="Cari data transaksi" value="{{ request('search') }}"
                class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </form>

        {{-- DAFTAR TRANSAKSI --}}
        <div class="mt-6 space-y-4">
            @forelse ($transactions as $transaction)
                @php
                    $repairOrder = $transaction->repairOrder;
                    $customer = $repairOrder?->customer;
                    $spareparts = $repairOrder?->spareparts ?? collect();

                    // Hitung total harga sparepart (jumlah * price)
                    $totalSparepartPrice = $spareparts->reduce(function($carry, $item) {
                        return $carry + ($item->price * ($item->pivot->jumlah ?? 1));
                    }, 0);

                    // Total pembayaran = total harga sparepart + estimated_cost
                    $totalPayment = $totalSparepartPrice + ($repairOrder?->estimated_cost ?? 0);

                    // Format nomor telepon tanpa +62 dobel
                    $phoneFormatted = $customer ? formatPhoneNumber($customer->phone_number) : '-';
                @endphp

                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="512" cy="512" r="400" stroke="currentColor" stroke-width="50"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-500">#{{ $transaction->id }}</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $customer->name ?? 'Nama tidak tersedia' }} |
                                INV/{{ str_pad($transaction->id, 3, '0', STR_PAD_LEFT) }}
                            </p>
                            <p class="text-sm text-gray-600">
                                @if($customer)
                                    0{{ $phoneFormatted }} |
                                @else
                                    -
                                @endif
                                Rp {{ number_format($totalPayment, 0, ',', '.') }} |
                                {{ $repairOrder->description ?? 'Deskripsi tidak tersedia' }}
                            </p>
                            <div class="flex items-center space-x-2 mt-1">
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3 self-end lg:self-auto">
                        <a href="{{ route('transaksi.detail', ['id' => $transaction->id]) }}"
                            class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 flex-shrink-0">
                            Detail
                        </a>
                        <form method="POST" action="{{ route('transaksi.destroy', $transaction->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-5 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50 flex-shrink-0"
                                onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                Hapus data
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-gray-600">Tidak ada transaksi ditemukan.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>
