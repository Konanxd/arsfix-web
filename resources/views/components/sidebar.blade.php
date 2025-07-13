{{-- File: resources/views/components/sidebar.blade.php --}}
<aside class="w-64 flex-shrink-0 bg-white shadow-md flex flex-col h-full">

    <div class="h-16 flex items-center justify-between p-4 md:p-6">
        <a href="{{ route('pelanggan.index') }}" class="text-3xl font-bold text-black">
            Arsfix.
        </a>
        <button class="md:hidden" @click="sidebarOpen = false">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    {{-- Menu Navigasi --}}
    <nav class="flex-grow md:mt-6">
        <a href="{{ route('pelanggan.index') }}" 
        class="flex items-center px-6 py-3 font-semibold {{ request()->routeIs('pelanggan.*') ? 'text-white bg-blue-600' : 'text-gray-500 hover:bg-gray-100' }}">
            Data Pelanggan
        </a>
        
        <a href="{{ route('suku-cadang.index') }}" 
        class="flex items-center px-6 py-3 font-semibold {{ request()->routeIs('suku-cadang.*') ? 'text-white bg-blue-600' : 'text-gray-500 hover:bg-gray-100' }}">
            Data Suku Cadang
        </a>
        
        <a href="{{ route('pesanan.index') }}" 
        class="flex items-center px-6 py-3 font-semibold {{ request()->routeIs('pesanan.*') ? 'text-white bg-blue-600' : 'text-gray-500 hover:bg-gray-100' }}">
            Pesanan Perbaikan
        </a>

        
        <a href="#" class="flex items-center px-6 py-3 font-semibold text-gray-500 hover:bg-gray-100">
            Transaksi
        </a>
    </nav>

    {{-- Tombol Logout di Bawah --}}
    <div class="p-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="flex items-center w-full px-4 py-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </a>
        </form>
    </div>
</aside>