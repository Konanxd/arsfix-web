{{-- File: resources/views/components/sidebar.blade.php --}}
<aside class="w-64 flex-shrink-0 bg-white shadow-md flex flex-col h-full">

    <div class="h-16 flex items-center justify-between p-4 md:p-6 border-b border-gray-100">
        <a href="{{ route('pesanan.index') }}" class="text-3xl font-bold text-blue-600 tracking-wider">
            Arsfix<span class="text-gray-800">.</span>
        </a>
        <button class="md:hidden text-gray-500 hover:text-gray-800 focus:outline-none" @click="sidebarOpen = false">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    {{-- Menu Navigasi --}}
    <nav class="flex-grow py-6 space-y-1">
        
        {{-- Menu Pesanan Perbaikan --}}
        <a href="{{ route('pesanan.index') }}" 
        class="flex items-center px-6 py-3 font-medium transition-colors duration-200 {{ request()->routeIs('pesanan.*') ? 'text-white bg-blue-600 shadow-md' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            Pesanan Perbaikan
        </a>

        {{-- Menu Data Suku Cadang --}}
        <a href="{{ route('suku-cadang.index') }}" 
        class="flex items-center px-6 py-3 font-medium transition-colors duration-200 {{ request()->routeIs('suku-cadang.*') ? 'text-white bg-blue-600 shadow-md' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            Data Suku Cadang
        </a>

        {{-- Menu Data Pelanggan --}}
        <a href="{{ route('pelanggan.index') }}" 
        class="flex items-center px-6 py-3 font-medium transition-colors duration-200 {{ request()->routeIs('pelanggan.*') ? 'text-white bg-blue-600 shadow-md' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Data Pelanggan
        </a>

        {{-- Menu Transaksi --}}
        <a href="{{ route('transaksi.index') }}" 
        class="flex items-center px-6 py-3 font-medium transition-colors duration-200 {{ request()->routeIs('transaksi.*') ? 'text-white bg-blue-600 shadow-md' : 'text-gray-500 hover:bg-gray-50 hover:text-blue-600' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Transaksi
        </a>
    </nav>

    {{-- Tombol Logout di Bawah --}}
    <div class="p-4 md:p-6 border-t border-gray-100">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="flex items-center w-full px-4 py-3 text-red-500 hover:text-red-700 hover:bg-red-50 transition-colors rounded-xl font-medium">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </a>
        </form>
    </div>
</aside>