<x-app-layout>
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
                    $isCanceled = $repairOrder?->status === 'Batal';
                @endphp

                {{-- CARD INI SEKARANG BISA DIKLIK --}}
                <div 
                    class="bg-white p-4 rounded-lg shadow-md flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0 cursor-pointer hover:shadow-xl transition-shadow duration-300"
                    onclick="window.location.href='{{ route('transaksi.show', ['id' => $transaction->id]) }}'"
                >
                    {{-- Sisi Kiri (Info) --}}
                    <div class="flex items-center flex-1">
                        {{-- Icon --}}
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            @if($isCanceled)
                                <svg class="text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12 2C6.47 2 2 6.47 2 12s4.47 10 10 10s10-4.47 10-10S17.53 2 12 2m4.3 14.3a.996.996 0 0 1-1.41 0L12 13.41L9.11 16.3a.996.996 0 1 1-1.41-1.41L10.59 12L7.7 9.11A.996.996 0 1 1 9.11 7.7L12 10.59l2.89-2.89a.996.996 0 1 1 1.41 1.41L13.41 12l2.89 2.89c.38.38.38 1.03 0 1.41"/></svg>
                            @else
                                <svg class="text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024"><path fill="currentColor" d="M192 128v768h640V128zm-32-64h704a32 32 0 0 1 32 32v832a32 32 0 0 1-32-32H160a32 32 0 0 1-32-32V96a32 32 0 0 1 32-32m160 448h384v64H320zm0-192h192v64H320zm0 384h384v64H320z"/></svg>
                            @endif
                        </div>
                        {{-- Detail Teks --}}
                        <div>
                            <p class="font-bold text-gray-500">INV/{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</p>
                            <p class="text-lg font-semibold text-gray-800">{{ $customer->name ?? 'Nama tidak tersedia' }}</p>
                            <p class="text-sm text-gray-600">
                                @if($isCanceled)
                                    Pesanan ini telah dibatalkan.
                                @else
                                    Rp {{ number_format($transaction->total_payment, 0, ',', '.') }} | {{ $repairOrder->customer->handphone ?? '-' }}
                                @endif
                            </p>
                            <div class="flex items-center space-x-2 mt-1">
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y') }}</p>
                                <span class="px-2 py-1 rounded text-xs font-medium 
                                    {{ $isCanceled ? 'bg-red-100 text-red-800' : ($repairOrder->status === 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    {{ $repairOrder->status ?? 'Status Tidak Diketahui' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- Tombol Detail sudah dihapus dari sini --}}
                </div>
            @empty
                <div class="text-gray-600 text-center py-10">Tidak ada transaksi ditemukan.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>