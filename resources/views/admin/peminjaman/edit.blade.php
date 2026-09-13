<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Transaksi
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Edit Peminjaman
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-xl">
                            ✏️
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Edit Transaksi Peminjaman
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Perbarui data peminjaman alat laboratorium.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('peminjaman.update', $peminjaman->id) }}"
                      method="POST"
                      class="p-6 space-y-6">

                    @csrf
                    @method('PUT')

                    {{-- Peminjam --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Peminjam
                        </label>

                        <select name="user_id"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @foreach($users as $u)
                                <option value="{{ $u->id }}"
                                    {{ old('user_id', $peminjaman->user_id) == $u->id ? 'selected' : '' }}>
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

                            @foreach($alat as $a)
                                <option value="{{ $a->id }}"
                                    {{ old('alat_id', $peminjaman->alat_id) == $a->id ? 'selected' : '' }}>
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

                            <input
                                type="number"
                                name="jumlah"
                                value="{{ old('jumlah', $peminjaman->jumlah) }}"
                                min="1"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('jumlah')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Tanggal Kembali
                            </label>

                            <input
                                type="date"
                                id="tanggal"
                                name="tanggal_kembali_rencana"
                                value="{{ old('tanggal_kembali_rencana', $peminjaman->tanggal_kembali_rencana) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('tanggal_kembali_rencana')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Info --}}
                    <div class="rounded-xl bg-yellow-50 dark:bg-yellow-900/20 p-4">
                        <div class="flex gap-3">
                            <div class="text-yellow-600 text-lg">📅</div>

                            <div>
                                <p class="font-semibold text-yellow-700 dark:text-yellow-300">
                                    Batas Pengembalian
                                </p>

                                <p class="text-sm text-yellow-600 dark:text-yellow-400 mt-1">
                                    Tanggal hanya dapat dipilih mulai hari ini hingga maksimal 14 hari ke depan.
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
                            💾 Update Peminjaman
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

        document.getElementById("tanggal").min = today;
        document.getElementById("tanggal").max = maxDate.toISOString().split('T')[0];
    </script>
    @endpush

</x-app-layout>