<x-app-layout>
    <div class="p-8">
        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">Transaksi</h1>

        {{-- SEARCH BAR DAN TOMBOL --}}
        <div class="flex justify-between items-center mt-8">
            <input type="text" placeholder="Cari data transaksi" class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mt-6 space-y-4">
            @forelse ($transactions as $transaction)
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="text-gray-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024">
                                <path fill="currentColor" d="..." />
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-500">#{{ $transaction->id }}</p>
                            <p class="text-lg font-semibold text-gray-800">
                                {{ $transaction->repairOrder->customer->name ?? 'Nama tidak tersedia' }} |
                                INV/{{ str_pad($transaction->id, 3, '0', STR_PAD_LEFT) }}
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $transaction->repairOrder->customer->phone_number ?? '-' }} |
                                {{ $transaction->repairOrder->sparePart->price ?? '-' }} |
                                {{ $transaction->repairOrder->description ?? 'Deskripsi tidak tersedia' }}
                            </p>
                            <div class="flex items-center space-x-2 mt-1">
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3 self-end lg:self-auto">
                        <a href="{{ route('transaksi.detail', ['id' => $transaction->id]) }}" class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 flex-shrink-0">
                            Detail
                        </a>
                        <form method="POST" action="{{ route('transaksi.destroy', $transaction->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-5 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50 flex-shrink-0">
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
