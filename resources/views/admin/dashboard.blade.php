<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Sistem Manajemen Peminjaman Alat laboratorium
                </p>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Dashboard Admin
                </h2>
            </div>

        </div>
    </x-slot>


    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- ========================= --}}
            {{-- HERO / WELCOME --}}
            {{-- ========================= --}}

            <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-blue-600 to-cyan-500 rounded-3xl shadow-xl mb-8">

                <div class="relative p-8 sm:p-10 text-white">

                    <p class="text-blue-100 text-sm font-medium mb-2">
                        SELAMAT DATANG 👋
                    </p>

                    <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                        SmartLab
                    </h1>

                    <p class="mt-3 max-w-2xl text-blue-50 leading-relaxed">
                        Kelola inventaris, peminjaman, persetujuan,
                        pengembalian, dan QR Code alat laboratorium
                        dalam satu sistem.
                    </p>

                </div>

                {{-- Dekorasi --}}
                <div class="absolute -right-16 -top-16 w-56 h-56 bg-white/10 rounded-full"></div>

                <div class="absolute -right-10 -bottom-24 w-72 h-72 bg-white/10 rounded-full"></div>



            </div>


            {{-- ========================= --}}
            {{-- STATISTIK --}}
            {{-- ========================= --}}

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 mb-8">


                {{-- TOTAL USER --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6
                            border border-gray-100 dark:border-gray-700
                            shadow-sm hover:shadow-md transition">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total User
                            </p>

                            <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">
                                {{ $totalUser }}
                            </h3>

                            <p class="text-xs text-gray-400 mt-2">
                                Pengguna terdaftar
                            </p>
                        </div>

                        <div class="w-12 h-12 flex items-center justify-center
                                    rounded-xl bg-blue-100 text-blue-600 text-xl">
                            👥
                        </div>

                    </div>

                </div>


                {{-- TOTAL ALAT --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6
                            border border-gray-100 dark:border-gray-700
                            shadow-sm hover:shadow-md transition">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total Alat
                            </p>

                            <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">
                                {{ $totalAlat }}
                            </h3>

                            <p class="text-xs text-gray-400 mt-2">
                                Inventaris tersedia
                            </p>
                        </div>

                        <div class="w-12 h-12 flex items-center justify-center
                                    rounded-xl bg-green-100 text-green-600 text-xl">
                            📦
                        </div>

                    </div>

                </div>


                {{-- TOTAL PEMINJAMAN --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6
                            border border-gray-100 dark:border-gray-700
                            shadow-sm hover:shadow-md transition">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Total Peminjaman
                            </p>

                            <h3 class="text-3xl font-bold text-gray-800 dark:text-white mt-1">
                                {{ $totalPeminjaman }}
                            </h3>

                            <p class="text-xs text-gray-400 mt-2">
                                Seluruh transaksi
                            </p>
                        </div>

                        <div class="w-12 h-12 flex items-center justify-center
                                    rounded-xl bg-indigo-100 text-indigo-600 text-xl">
                            📋
                        </div>

                    </div>

                </div>


                {{-- MENUNGGU --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6
                            border border-gray-100 dark:border-gray-700
                            shadow-sm hover:shadow-md transition">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Menunggu Persetujuan
                            </p>

                            <h3 class="text-3xl font-bold text-yellow-500 mt-1">
                                {{ $menunggu }}
                            </h3>

                            <p class="text-xs text-gray-400 mt-2">
                                Perlu ditindaklanjuti
                            </p>
                        </div>

                        <div class="w-12 h-12 flex items-center justify-center
                                    rounded-xl bg-yellow-100 text-yellow-600 text-xl">
                            ⏳
                        </div>

                    </div>

                </div>


                {{-- DIPINJAM --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6
                            border border-gray-100 dark:border-gray-700
                            shadow-sm hover:shadow-md transition">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Sedang Dipinjam
                            </p>

                            <h3 class="text-3xl font-bold text-red-500 mt-1">
                                {{ $dipinjam }}
                            </h3>

                            <p class="text-xs text-gray-400 mt-2">
                                Alat sedang Dipinjam
                            </p>
                        </div>

                        <div class="w-12 h-12 flex items-center justify-center
                                    rounded-xl bg-red-100 text-red-600 text-xl">
                            🔄
                        </div>

                    </div>

                </div>


                {{-- SELESAI --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6
                            border border-gray-100 dark:border-gray-700
                            shadow-sm hover:shadow-md transition">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Peminjaman Selesai
                            </p>

                            <h3 class="text-3xl font-bold text-emerald-600 mt-1">
                                {{ $selesai }}
                            </h3>

                            <p class="text-xs text-gray-400 mt-2">
                                Telah dikembalikan
                            </p>
                        </div>

                        <div class="w-12 h-12 flex items-center justify-center
                                    rounded-xl bg-emerald-100 text-emerald-600 text-xl">
                            ✓
                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- MENU CEPAT --}}
            {{-- ========================= --}}

            <div class="mb-8">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                            Menu Utama
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Akses cepat pengelolaan sistem
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">


                    <a href="{{ route('tools.index') }}"
                        class="group bg-white dark:bg-gray-800 p-5 rounded-2xl
                              border border-gray-100 dark:border-gray-700
                              shadow-sm hover:shadow-lg hover:-translate-y-1
                              transition duration-200">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-blue-100
                                        flex items-center justify-center text-xl">
                                📦
                            </div>

                            <div class="flex-1">

                                <h4 class="font-semibold text-gray-800 dark:text-white">
                                    Daftar Alat
                                </h4>

                                <p class="text-xs text-gray-500 mt-1">
                                    Kelola inventaris alat
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:text-blue-600">
                                →
                            </span>

                        </div>

                    </a>


                    <a href="{{ route('kategori.index') }}"
                        class="group bg-white dark:bg-gray-800 p-5 rounded-2xl
                              border border-gray-100 dark:border-gray-700
                              shadow-sm hover:shadow-lg hover:-translate-y-1
                              transition duration-200">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-purple-100
                                        flex items-center justify-center text-xl">
                                📂
                            </div>

                            <div class="flex-1">

                                <h4 class="font-semibold text-gray-800 dark:text-white">
                                    Kategori
                                </h4>

                                <p class="text-xs text-gray-500 mt-1">
                                    Kelola kategori alat
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:text-purple-600">
                                →
                            </span>

                        </div>

                    </a>


                    <a href="{{ route('user.index') }}"
                        class="group bg-white dark:bg-gray-800 p-5 rounded-2xl
                              border border-gray-100 dark:border-gray-700
                              shadow-sm hover:shadow-lg hover:-translate-y-1
                              transition duration-200">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-pink-100
                                        flex items-center justify-center text-xl">
                                👥
                            </div>

                            <div class="flex-1">

                                <h4 class="font-semibold text-gray-800 dark:text-white">
                                    Pengguna
                                </h4>

                                <p class="text-xs text-gray-500 mt-1">
                                    Kelola akun pengguna
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:text-pink-600">
                                →
                            </span>

                        </div>

                    </a>


                    <a href="{{ route('peminjaman.index') }}"
                        class="group bg-white dark:bg-gray-800 p-5 rounded-2xl
                              border border-gray-100 dark:border-gray-700
                              shadow-sm hover:shadow-lg hover:-translate-y-1
                              transition duration-200">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-indigo-100
                                        flex items-center justify-center text-xl">
                                📋
                            </div>

                            <div class="flex-1">

                                <h4 class="font-semibold text-gray-800 dark:text-white">
                                    Peminjaman
                                </h4>

                                <p class="text-xs text-gray-500 mt-1">
                                    Lihat seluruh transaksi
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:text-indigo-600">
                                →
                            </span>

                        </div>

                    </a>


                    <a href="{{ route('pengembalian.index') }}"
                        class="group bg-white dark:bg-gray-800 p-5 rounded-2xl
                              border border-gray-100 dark:border-gray-700
                              shadow-sm hover:shadow-lg hover:-translate-y-1
                              transition duration-200">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-emerald-100
                                        flex items-center justify-center text-xl">
                                🔁
                            </div>

                            <div class="flex-1">

                                <h4 class="font-semibold text-gray-800 dark:text-white">
                                    Pengembalian
                                </h4>

                                <p class="text-xs text-gray-500 mt-1">
                                    Kelola alat yang dikembalikan
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:text-emerald-600">
                                →
                            </span>

                        </div>

                    </a>


                    <a href="{{ route('logs.index') }}"
                        class="group bg-white dark:bg-gray-800 p-5 rounded-2xl
                              border border-gray-100 dark:border-gray-700
                              shadow-sm hover:shadow-lg hover:-translate-y-1
                              transition duration-200">

                        <div class="flex items-center gap-4">

                            <div class="w-12 h-12 rounded-xl bg-slate-100
                                        flex items-center justify-center text-xl">
                                🕒
                            </div>

                            <div class="flex-1">

                                <h4 class="font-semibold text-gray-800 dark:text-white">
                                    Log Aktivitas
                                </h4>

                                <p class="text-xs text-gray-500 mt-1">
                                    Pantau aktivitas sistem
                                </p>

                            </div>

                            <span class="text-gray-400 group-hover:text-slate-600">
                                →
                            </span>

                        </div>

                    </a>

                </div>

            </div>


            {{-- ========================= --}}
            {{-- AKTIVITAS TERBARU --}}
            {{-- ========================= --}}

            <div class="bg-white dark:bg-gray-800 rounded-2xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm overflow-hidden">

                <div class="p-6 border-b border-gray-100 dark:border-gray-700">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">
                                Aktivitas Terbaru
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Riwayat aktivitas pengguna dalam sistem
                            </p>

                        </div>

                        <a href="{{ route('logs.index') }}"
                            class="text-sm font-medium text-blue-600 hover:text-blue-700">
                            Lihat semua →
                        </a>

                    </div>

                </div>


                <div class="divide-y divide-gray-100 dark:divide-gray-700">

                    @forelse ($logs as $log)

                    <div class="p-5 flex items-center gap-4
                                    hover:bg-gray-50 dark:hover:bg-gray-700/40
                                    transition">

                        <div class="w-10 h-10 rounded-full bg-blue-100
                                        text-blue-600 flex items-center justify-center">
                            📝
                        </div>

                        <div class="flex-1 min-w-0">

                            <p class="text-sm font-semibold text-gray-800 dark:text-white">
                                {{ $log->user->name ?? 'User' }}
                            </p>

                            <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                {{ $log->aksi }}
                            </p>

                        </div>

                        <span class="text-xs text-gray-400 whitespace-nowrap">
                            {{ $log->created_at->diffForHumans() }}
                        </span>

                    </div>

                    @empty

                    <div class="p-10 text-center">

                        <div class="text-4xl mb-3">
                            🕒
                        </div>

                        <p class="text-gray-500 dark:text-gray-400">
                            Belum ada aktivitas
                        </p>

                    </div>

                    @endforelse

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="text-center mt-8 text-xs text-gray-400">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>


        </div>
    </div>

</x-app-layout>