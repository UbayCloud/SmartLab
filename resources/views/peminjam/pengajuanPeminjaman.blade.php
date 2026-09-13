<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-slate-400">SmartLab • Peminjam</p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Ajukan Peminjaman
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">

            {{-- CARD FORM --}}
            <div class="bg-[#1E293B] rounded-3xl border border-slate-700 shadow-2xl overflow-hidden">

                {{-- Header --}}
                <div class="p-6 border-b border-slate-700">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-blue-600 flex items-center justify-center text-2xl">
                            📦
                        </div>

                        <div>
                            <h3 class="text-2xl font-bold text-white">
                                Form Peminjaman Alat
                            </h3>
                            <p class="text-slate-300">
                                Lengkapi data untuk mengajukan peminjaman SmartLab.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Isi Form --}}
                <div class="p-8">

                    @if ($errors->any())
                        <div class="mb-6 rounded-xl bg-red-100 border border-red-300 p-4">
                            <p class="font-semibold text-red-700 mb-2">
                                Terjadi kesalahan:
                            </p>
                            <ul class="list-disc ml-5 text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pengajuan.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Pilih Alat --}}
                            <div class="md:col-span-2">
                                <label class="block text-white font-semibold mb-2">
                                    Pilih Alat
                                </label>

                                <select name="alat_id" required
                                    class="w-full rounded-xl bg-white border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500">
                                    <option value="">-- Pilih Alat --</option>

                                    @foreach($alat as $a)
                                        <option value="{{ $a->id }}" {{ old('alat_id') == $a->id ? 'selected' : '' }}>
                                            {{ $a->nama_alat }} • Stok {{ $a->jumlah_tersedia }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Jumlah --}}
                            <div>
                                <label class="block text-white font-semibold mb-2">
                                    Jumlah Pinjam
                                </label>

                                <input type="number"
                                    name="jumlah"
                                    min="1"
                                    value="{{ old('jumlah',1) }}"
                                    required
                                    class="w-full rounded-xl bg-white border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500">

                                <p class="text-xs text-slate-400 mt-2">
                                    Minimal 1 unit.
                                </p>
                            </div>

                            {{-- Tanggal --}}
                            <div>
                                <label class="block text-white font-semibold mb-2">
                                    Rencana Kembali
                                </label>

                                <input type="date"
                                    id="tanggal"
                                    name="tanggal_kembali_rencana"
                                    value="{{ old('tanggal_kembali_rencana') }}"
                                    required
                                    class="w-full rounded-xl bg-white border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500">

                                <p class="text-xs text-slate-400 mt-2">
                                    Maksimal 14 hari.
                                </p>
                            </div>

                        </div>

                        {{-- Info --}}
                        <div class="mt-7 rounded-xl bg-blue-500/10 border border-blue-500/30 p-4">
                            <div class="flex gap-3">
                                <div class="text-xl">ℹ️</div>

                                <div>
                                    <p class="font-semibold text-blue-300">
                                        Informasi
                                    </p>

                                    <p class="text-sm text-slate-300 mt-1">
                                        Pengajuan akan berstatus
                                        <span class="font-semibold text-yellow-300">
                                            Menunggu Persetujuan
                                        </span>
                                        hingga diverifikasi oleh petugas laboratorium.
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="flex justify-end gap-3 mt-8">
                            <a href="{{ route('peminjam.alat.index') }}"
                                class="px-5 py-3 rounded-xl bg-slate-600 hover:bg-slate-500 text-white transition">
                                Batal
                            </a>

                            <button type="submit"
                                class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-lg transition">
                                📩 Ajukan Peminjaman
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            {{-- Footer --}}
            <div class="text-center mt-6 text-xs text-slate-500">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>

        </div>
    </div>

    <script>
        let today = new Date().toISOString().split('T')[0];

        let nextWeek = new Date();
        nextWeek.setDate(nextWeek.getDate() + 14);
        nextWeek = nextWeek.toISOString().split('T')[0];

        document.getElementById("tanggal").min = today;
        document.getElementById("tanggal").max = nextWeek;
    </script>
</x-app-layout>