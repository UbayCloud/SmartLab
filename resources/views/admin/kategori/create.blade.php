<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Inventaris
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Tambah Kategori
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-xl">
                            📂
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Tambah Kategori Baru
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Buat kategori untuk mengelompokkan alat laboratorium.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('kategori.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Nama Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="nama_kategori"
                            value="{{ old('nama_kategori') }}"
                            placeholder="Contoh: Laptop, Kamera, Proyektor"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        @error('nama_kategori')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Keterangan
                        </label>

                        <textarea
                            name="keterangan"
                            rows="4"
                            placeholder="Tuliskan deskripsi singkat kategori..."
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 resize-none">{{ old('keterangan') }}</textarea>

                        @error('keterangan')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">

                        <a href="{{ route('kategori.index') }}"
                            class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow">
                            💾 Simpan Kategori
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>