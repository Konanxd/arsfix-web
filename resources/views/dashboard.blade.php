{{-- File: resources/views/dashboard.blade.php --}}
<x-app-layout>
    <div class="p-8">
        {{-- HEADER --}}
        <h1 class="text-3xl font-bold text-gray-800">Data Pelanggan</h1>

        {{-- SEARCH BAR DAN TOMBOL --}}
        <div class="flex justify-between items-center mt-8">
            <input type="text" placeholder="Cari data pelanggan" class="w-full max-w-md px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <x-primary-button class="py-3 px-5 ml-4">+ Tambah data</x-primary-button>
        </div>

        {{-- DAFTAR PELANGGAN --}}
        <div class="mt-6 space-y-4">

            {{-- Anda akan me-looping data dari controller di sini. Ini hanya contoh statis. --}}
            
            <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-500">#000001</p>
                        <p class="text-lg font-semibold text-gray-800">Dida Handika</p>
                        <p class="text-sm text-gray-600">+62 845 9980 876 | Huawei Nova 5T</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Edit data</button>
                    <button class="px-5 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50">Hapus data</button>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-500">#000002</p>
                        <p class="text-lg font-semibold text-gray-800">Shobrina Naila</p>
                        <p class="text-sm text-gray-600">+62 845 9980 876 | Samsung A50</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Edit data</button>
                    <button class="px-5 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50">Hapus data</button>
                </div>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-md flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-500">#000003</p>
                        <p class="text-lg font-semibold text-gray-800">Kayla Softha</p>
                        <p class="text-sm text-gray-600">+62 845 9980 876 | iPhone Xs</p>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <button class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">Edit data</button>
                    <button class="px-5 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-50">Hapus data</button>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
