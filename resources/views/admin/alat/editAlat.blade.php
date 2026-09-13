<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Inventaris
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Edit Data Alat
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                {{-- Header Card --}}
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-xl">
                            ✏️
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Edit Informasi Alat
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Perbarui data inventaris laboratorium.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('tools.update', $alat->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="p-6 space-y-6">

                    @csrf
                    @method('PUT')

                    {{-- Kode & Nama --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Kode Alat
                            </label>

                            <input type="text"
                                name="kode_alat"
                                value="{{ old('kode_alat',$alat->kode_alat) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('kode_alat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Nama Alat
                            </label>

                            <input type="text"
                                name="nama_alat"
                                value="{{ old('nama_alat',$alat->nama_alat) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('nama_alat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>


                    {{-- Kategori & Jumlah --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Kategori
                            </label>

                            <select name="kategori_id"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                                @foreach($kategori as $k)

                                <option value="{{ $k->id }}"
                                    {{ old('kategori_id',$alat->kategori_id)==$k->id ? 'selected':'' }}>

                                    {{ $k->nama_kategori }}

                                </option>

                                @endforeach

                            </select>

                        </div>


                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Jumlah Tersedia
                            </label>

                            <input type="number"
                                name="jumlah_tersedia"
                                value="{{ old('jumlah_tersedia',$alat->jumlah_tersedia) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        </div>

                    </div>


                    {{-- Kondisi --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Kondisi
                        </label>

                        <select name="kondisi"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="baik"
                                {{ old('kondisi',$alat->kondisi)=='baik' ? 'selected':'' }}>
                                Baik
                            </option>

                        </select>
                    </div>


                    {{-- FOTO --}}
                    <div>
                        <label class="block text-sm font-semibold mb-3">
                            Foto Alat
                        </label>

                        <div class="border-2 border-dashed border-gray-300 rounded-2xl p-5">

                            @if($alat->gambar)

                            <div class="mb-5">

                                <p class="text-sm text-gray-500 mb-3">
                                    Foto saat ini
                                </p>

                                <img src="{{ asset('storage/'.$alat->gambar) }}"
                                    class="w-44 h-44 object-cover rounded-xl border shadow">

                            </div>

                            @endif

                            <input type="file"
                                name="gambar"
                                accept="image/jpeg,image/png,image/webp"
                                class="block w-full text-sm
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-lg file:border-0
                                       file:bg-blue-600 file:text-white
                                       hover:file:bg-blue-700">

                            <p class="text-xs text-gray-500 mt-2">
                                JPG, PNG, WEBP • Maksimal 2 MB
                            </p>

                            @error('gambar')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                            @enderror

                        </div>
                    </div>


                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">

                        <a href="{{ route('tools.index') }}"
                            class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow">
                            💾 Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>