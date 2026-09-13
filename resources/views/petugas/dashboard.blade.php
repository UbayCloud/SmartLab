<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem Manajemen Peminjaman Alat laboratorium
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Dashboard Petugas
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Hero --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-lg">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <p class="text-blue-100 text-sm mb-2">
                            Selamat Datang 👋
                        </p>

                        <h1 class="text-3xl font-bold">
                            {{ Auth::user()->name }}
                        </h1>

                        <p class="text-blue-100 mt-2">
                            Kelola persetujuan peminjaman dan laporan peminjaman.
                        </p>
                    </div>

                   
                </div>
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow border border-gray-100 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">
                                Menunggu
                            </p>
                            <h3 class="text-3xl font-bold mt-1 text-yellow-500">
                                {{ $menunggu }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center text-2xl">
                            ⏳
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow border border-gray-100 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">
                                Dipinjam
                            </p>
                            <h3 class="text-3xl font-bold mt-1 text-blue-600">
                                {{ $dipinjam }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                            📦
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow border border-gray-100 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm text-gray-500">
                                Selesai
                            </p>
                            <h3 class="text-3xl font-bold mt-1 text-green-600">
                                {{ $selesai }}
                            </h3>
                        </div>

                        <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center text-2xl">
                            ✅
                        </div>
                    </div>
                </div>

            </div>

            {{-- Menu --}}
            <div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">
                    Menu Petugas
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <a href="{{ route('petugas.menyetujuiPeminjaman') }}"
                        class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow hover:shadow-xl border border-gray-100 dark:border-gray-700 transition">

                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-2xl">
                                ✔️
                            </div>
                            <span class="text-blue-600 group-hover:translate-x-1 transition">
                                →
                            </span>
                        </div>

                        <h4 class="font-bold text-lg">
                            Persetujuan Peminjaman
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Setujui atau tolak pengajuan dari siswa.
                        </p>
                    </a>

                    <a href="{{ route('petugas.pengembalian') }}"
                        class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow hover:shadow-xl border border-gray-100 dark:border-gray-700 transition">

                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center text-2xl">
                                🔄
                            </div>
                            <span class="text-green-600 group-hover:translate-x-1 transition">
                                →
                            </span>
                        </div>

                        <h4 class="font-bold text-lg">
                            Data Pengembalian
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Proses alat yang sudah dikembalikan.
                        </p>
                    </a>

                    <a href="{{ route('laporan.index') }}"
                        class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow hover:shadow-xl border border-gray-100 dark:border-gray-700 transition">

                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center text-2xl">
                                📄
                            </div>
                            <span class="text-indigo-600 group-hover:translate-x-1 transition">
                                →
                            </span>
                        </div>

                        <h4 class="font-bold text-lg">
                            Cetak Laporan
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Unduh laporan peminjaman dalam bentuk PDF.
                        </p>
                    </a>

                    <a href="{{ route('petugas.daftaralat') }}"
                        class="group bg-white dark:bg-gray-800 rounded-2xl p-6 shadow hover:shadow-xl border border-gray-100 dark:border-gray-700 transition">

                        <div class="flex items-center justify-between mb-4">
                            <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center text-2xl">
                                🧰
                            </div>
                            <span class="text-emerald-600 group-hover:translate-x-1 transition">
                                →
                            </span>
                        </div>

                        <h4 class="font-bold text-lg">
                            Daftar Alat
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Lihat inventaris alat laboratorium.
                        </p>
                    </a>

                </div>
            </div>
            
            {{-- FOOTER --}}
            <div class="text-center mt-8 text-xs text-gray-400">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>

        </div>
    </div>
</x-app-layout>