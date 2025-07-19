<x-app-layout>
    <div class="p-8">
        {{-- BREADCRUMB --}}
        <div class="flex items-center text-sm font-semibold">
            <a href="{{ route('customers.index') }}" class="text-gray-500 hover:text-gray-700">Data Customer</a>
            <svg class="w-5 h-5 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>
            <span class="text-gray-800">Tambah Data Customer</span>
        </div>

        {{-- PAGE TITLE --}}
        <div class="flex items-center mt-6">
            <a href="{{ route('customers.index') }}" class="flex items-center text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Data Customer</h1>
        </div>

        {{-- FORM CARD --}}
        <div class="mt-8 bg-white p-8 rounded-lg shadow-md">
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf
                <div class="space-y-6">


                    {{-- Nama --}}
                    <div>
                        <x-input-label for="name" value="Nama Customer" />
                        <x-text-input id="name" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="name" value="{{ old('name') }}" required placeholder="Masukan nama customer" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <x-input-label for="phone_number" value="No. Telepon" />
                        <div class="flex mt-1">
                            <span class="inline-flex items-center px-4 rounded-l-xl border border-r-0 border-transparent bg-gray-100 text-gray-500 sm:text-sm">+62</span>
                            <input type="text" name="phone_number" id="phone_number" placeholder="Masukan nomor telepon"
                                   class="block w-full rounded-r-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
                                   value="{{ old('phone_number') }}">
                        </div>
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                    {{-- Handphone --}}
                    <div>
                        <x-input-label for="handphone" value="Handphone" />
                        <x-text-input id="handphone" class="block mt-1 w-full rounded-xl bg-gray-100 border-transparent focus:ring-2 focus:ring-blue-500" type="text" name="handphone" value="{{ old('handphone') }}" required placeholder="Masukan merk handphone" />
                        <x-input-error :messages="$errors->get('handphone')" class="mt-2" />
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end pt-4">
                        <button type="submit" class="inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Tambah Data
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
