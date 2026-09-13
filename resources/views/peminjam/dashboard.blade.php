<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem Manajemen Peminjaman Alat laboratorium
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Dashboard Peminjam
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- HERO --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-3xl p-8 text-white shadow-lg">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                    <div>
                        <p class="text-blue-100 text-sm">
                            Selamat datang,
                        </p>

                        <h1 class="text-3xl font-bold mt-1">
                            {{ auth()->user()->name }}
                        </h1>

                        <p class="mt-3 text-blue-100 max-w-lg">
                            Peminjaman alat laboratorium dengan mudah melalui
                            SmartLab. Scan QR, ajukan peminjaman, dan pantau status
                            pengajuan secara real-time.
                        </p>
                    </div>

                    <div class="hidden md:flex w-28 h-28 rounded-3xl bg-white/20 items-center justify-center text-6xl">
                        📚
                    </div>

                </div>
            </div>

            {{-- STATISTIK --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Menunggu</p>
                            <h2 class="text-3xl font-bold text-yellow-500 mt-1">
                                {{ $menunggu }}
                            </h2>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-yellow-100 flex items-center justify-center text-2xl">
                            ⏳
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Sedang Dipinjam</p>
                            <h2 class="text-3xl font-bold text-blue-600 mt-1">
                                {{ $dipinjam }}
                            </h2>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                            📦
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl p-5 shadow-sm border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Selesai</p>
                            <h2 class="text-3xl font-bold text-green-600 mt-1">
                                {{ $selesai }}
                            </h2>
                        </div>
                        <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center text-2xl">
                            ✅
                        </div>
                    </div>
                </div>

            </div>

            {{-- MENU --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">

                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-lg font-bold">
                            Menu Utama
                        </h3>
                        <p class="text-sm text-gray-500">
                            Pilih layanan yang ingin digunakan.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

                    {{-- Scan QR --}}
                    <a href="{{ route('scanner') }}"
                       class="group rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-blue-500 p-5 transition">

                        <div class="text-4xl mb-4">📷</div>

                        <h4 class="font-bold text-lg">
                            Scan QR
                        </h4>

                        <p class="text-blue-100 text-sm mt-1">
                            Scan QR Code alat untuk memulai peminjaman.
                        </p>

                    </a>

                    {{-- Daftar Alat --}}
                    <a href="{{ route('peminjam.alat.index') }}"
                        class="group rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-blue-500 p-5 transition">

                        <div class="text-4xl mb-4">🧰</div>

                        <h4 class="font-bold text-gray-800 dark:text-white">
                            Daftar Alat
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Lihat seluruh alat yang tersedia.
                        </p>

                    </a>

                    {{-- Riwayat --}}
                    <a href="{{ route('peminjam.riwayat') }}"
                        class="group rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-indigo-500 p-5 transition">

                        <div class="text-4xl mb-4">📝</div>

                        <h4 class="font-bold text-gray-800 dark:text-white">
                            Riwayat Pengajuan
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Pantau status peminjaman yang diajukan.
                        </p>

                    </a>

                    {{-- Pengembalian --}}
                    <a href="{{ route('peminjam.pengembalian') }}"
                        class="group rounded-2xl border border-gray-200 dark:border-gray-700 hover:border-green-500 p-5 transition">

                        <div class="text-4xl mb-4">🔁</div>

                        <h4 class="font-bold text-gray-800 dark:text-white">
                            Pengembalian
                        </h4>

                        <p class="text-sm text-gray-500 mt-1">
                            Lihat alat yang harus dikembalikan.
                        </p>

                    </a>

                </div>

            </div>

            {{-- TIPS --}}
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                <div class="flex gap-3">
                    <div class="text-2xl">💡</div>

                    <div>
                        <h4 class="font-semibold text-blue-800">
                            Cara Meminjam Alat
                        </h4>

                        <ol class="text-sm text-blue-700 mt-2 space-y-1 list-decimal list-inside">
                            <li>Tekan menu <b>Scan QR</b>.</li>
                            <li>Arahkan kamera ke QR Code pada alat.</li>
                            <li>Isi jumlah dan tanggal pengembalian.</li>
                            <li>Tunggu persetujuan dari petugas laboratorium.</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="text-center mt-8 text-xs text-gray-400">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>

        </div>
    </div>
</x-app-layout>