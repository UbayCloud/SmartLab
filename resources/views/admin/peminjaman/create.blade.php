<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Transaksi
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Tambah Peminjaman
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
                            📋
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Form Peminjaman Alat
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Tambahkan transaksi peminjaman baru.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('peminjaman.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Peminjam --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Peminjam
                        </label>

                        <select name="user_id"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">-- Pilih Peminjam --</option>

                            @foreach($users as $u)
                                <option value="{{ $u->id }}"
                                    {{ old('user_id') == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('user_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alat --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Alat
                        </label>

                        <select name="alat_id"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">-- Pilih Alat --</option>

                            @foreach($alat as $a)
                                <option value="{{ $a->id }}"
                                    {{ old('alat_id') == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama_alat }} • Stok {{ $a->jumlah_tersedia }}
                                </option>
                            @endforeach

                        </select>

                        @error('alat_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah & Tanggal --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Jumlah
                            </label>

                            <input type="number"
                                name="jumlah"
                                value="{{ old('jumlah') }}"
                                min="1"
                                placeholder="1"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('jumlah')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Tanggal Kembali
                            </label>

                            <input type="date"
                                id="tanggal"
                                name="tanggal_kembali_rencana"
                                value="{{ old('tanggal_kembali_rencana') }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('tanggal_kembali_rencana')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Info --}}
                    <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 p-4">
                        <div class="flex gap-3">
                            <div class="text-blue-600 text-lg">ℹ️</div>

                            <div>
                                <p class="font-semibold text-blue-700 dark:text-blue-300">
                                    Informasi
                                </p>

                                <p class="text-sm text-blue-600 dark:text-blue-400 mt-1">
                                    Tanggal pengembalian hanya dapat dipilih maksimal 14 hari dari hari ini.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">

                        <a href="{{ route('peminjaman.index') }}"
                            class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow">
                            💾 Simpan Peminjaman
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        const today = new Date().toISOString().split('T')[0];

        const maxDate = new Date();
        maxDate.setDate(maxDate.getDate() + 14);

        document.getElementById('tanggal').min = today;
        document.getElementById('tanggal').max = maxDate.toISOString().split('T')[0];
    </script>
    @endpush

</x-app-layout>