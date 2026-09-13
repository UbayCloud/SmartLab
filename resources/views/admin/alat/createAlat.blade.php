<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Inventaris
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Tambah Data Alat
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-xl">
                            📦
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Tambah Inventaris Alat
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Masukkan data alat baru ke dalam SmartLab.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('tools.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="p-6 space-y-6">

                    @csrf

                    {{-- Kode & Nama --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Kode Alat
                            </label>

                            <input type="text"
                                name="kode_alat"
                                value="{{ old('kode_alat') }}"
                                placeholder="Contoh: ALT001"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('kode_alat')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Nama Alat
                            </label>

                            <input type="text"
                                name="nama_alat"
                                value="{{ old('nama_alat') }}"
                                placeholder="Contoh: Laptop Asus"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('nama_alat')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
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

                                <option value="">-- Pilih Kategori --</option>

                                @foreach($kategori as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                                @endforeach

                            </select>

                            @error('kategori_id')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Jumlah Tersedia
                            </label>

                            <input type="number"
                                name="jumlah_tersedia"
                                value="{{ old('jumlah_tersedia') }}"
                                min="0"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('jumlah_tersedia')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                            @enderror
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
                                {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                                Baik
                            </option>

                        </select>
                    </div>

                    {{-- FOTO ALAT --}}
                    <div class="md:col-span-2">
                        <label class="block text-white font-semibold mb-3">
                            Foto Alat
                        </label>

                        <label for="gambar"
                            class="flex flex-col items-center justify-center w-full h-52
               rounded-2xl border-2 border-dashed border-slate-500
               bg-slate-800 hover:border-blue-500 hover:bg-slate-700/50
               cursor-pointer transition">

                            <div id="previewArea" class="text-center">
                                <svg class="w-14 h-14 mx-auto text-slate-400 mb-3"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="1.5"
                                        d="M3 16.5V6a2 2 0 012-2h14a2 2 0 012 2v10.5M3 16.5l4.5-4.5a2 2 0 012.828 0L15 16.5m0 0l1.5-1.5a2 2 0 012.828 0L21 16.5M15 16.5H3" />
                                </svg>

                                <p class="text-white font-medium">
                                    Klik untuk memilih foto
                                </p>

                                <p class="text-sm text-slate-400 mt-1">
                                    JPG, JPEG, PNG, WEBP • Maks. 2 MB
                                </p>
                            </div>

                            <img id="previewImage"
                                class="hidden w-full h-full object-cover rounded-2xl">
                        </label>

                        <input id="gambar"
                            type="file"
                            name="gambar"
                            accept="image/jpeg,image/png,image/webp"
                            class="hidden"
                            onchange="previewFoto(event)">

                        @error('gambar')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
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
                    💾 Simpan Alat
                </button>

            </div>

            </form>

        </div>

    </div>
    </div>
</x-app-layout>
<script>
function previewFoto(event){
    const file = event.target.files[0];
    if(!file) return;

    const reader = new FileReader();

    reader.onload = function(e){
        document.getElementById('previewImage').src = e.target.result;
        document.getElementById('previewImage').classList.remove('hidden');
        document.getElementById('previewArea').classList.add('hidden');
    }

    reader.readAsDataURL(file);
}
</script>