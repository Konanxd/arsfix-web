<x-app-layout>
    @php
        // function formatPhoneNumber($phone_number) {
        // if (!$phone_number) return '-';
        // // Hapus semua karakter bukan angka
        // $digits = preg_replace('/\D/', '', $phone_number);

        // // Ambil 4 angka pertama, lalu 4 angka berikutnya, lalu sisanya
        // $part1 = substr($digits, 0, 3);
        // $part2 = substr($digits, 3, 4);
        // $part3 = substr($digits, 7);

        // $result = $part1;
        // if ($part2) $result .= '-' . $part2;
        // if ($part3) $result .= '-' . $part3;

        // return $result;
        // }
    @endphp

    <div class="p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold mb-4">
            <a href="{{ route('pesanan.index') }}" class="text-gray-500 hover:text-gray-700">Data Pesanan</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="text-gray-800">Detail Pesanan</span>
        </div>

        {{-- HEADER --}}
        <div class="flex items-center mt-6 mb-6">
            <a href="{{ route('pesanan.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Detail Pesanan</h1>
        </div>

        {{-- CARD --}}
        <div class="bg-white p-8 rounded-lg shadow-md space-y-6">
            <div>
                <p class="text-sm text-gray-500 font-medium">Pelanggan</p>
                <p class="text-lg font-semibold text-gray-800">
                    {{ $pesananPerbaikan->customer->name }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 font-medium">No. Telepon</p>
                    <p class="text-base text-gray-800 font-semibold">
                        +62 {{ formatPhoneNumber($pesananPerbaikan->customer->phone_number) ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Tanggal Order</p>
                    <p class="text-base text-gray-800 font-semibold">
                        {{ \Carbon\Carbon::parse($pesananPerbaikan->order_date)->translatedFormat('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Gadget</p>
                    <p class="text-base text-gray-800 font-semibold">
                        {{ $pesananPerbaikan->customer->handphone ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Teknisi</p>
                    <p class="text-base text-gray-800 font-semibold">
                        {{ $pesananPerbaikan->technician->name }}
                    </p>
                </div>
            </div>

            <div>
                <p class="text-sm text-gray-500 font-medium">Deskripsi Kerusakan</p>
                <p class="text-base text-gray-800 font-semibold">
                    {{ $pesananPerbaikan->description }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500 font-medium">Suku Cadang Digunakan</p>
                <ul class="list-disc list-inside text-gray-800 font-semibold">
                    @foreach ($pesananPerbaikan->spareparts as $sparepart)
                        <li>{{ $sparepart->name }} (Jumlah: {{ $sparepart->pivot->jumlah }})</li>
                    @endforeach
                </ul>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Estimasi Biaya</p>
                    <p class="text-base text-gray-800 font-semibold">
                        Rp {{ number_format($pesananPerbaikan->estimated_cost, 0, ',', '.') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Status Pesanan</p>
                    <p class="text-base text-gray-800 font-semibold">
                        {{ $pesananPerbaikan->status }}
                    </p>
                </div>
            </div>

            @if (!in_array($pesananPerbaikan->status, ['Selesai', 'Dibatalkan']))
                <div class="mt-6 pt-6 border-t flex items-center space-x-4 justify-end">
                    {{-- Tombol Batal --}}
                    <form id="cancel-form-{{ $pesananPerbaikan->id }}"
                        action="{{ route('pesanan.cancel', ['id' => $pesananPerbaikan->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="button"
                            onclick="confirmAction('cancel-form-{{ $pesananPerbaikan->id }}', 'Anda yakin ingin membatalkan pesanan ini?')"
                            class="inline-flex items-center px-5 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-red-700">
                            Batal Pesanan
                        </button>
                    </form>
                    {{-- Tombol Selesaikan Pesanan (BARU) --}}
                    <form action="{{ route('transaksi.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="repair_id" value="{{ $pesananPerbaikan->id }}">
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-green-700">
                            Selesaikan Pesanan
                        </button>
                    </form>

                    {{-- Tombol Edit --}}
                    {{-- <a href="{{ route('pesanan.edit', ['id' => $pesananPerbaikan->id]) }}" class="inline-flex items-center px-5 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700">
                Edit Pesanan
                </a> --}}

                </div>
            @endif


        </div>
    </div>
</x-app-layout>
