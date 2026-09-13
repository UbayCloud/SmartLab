<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem & Monitoring
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Log Aktivitas
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm p-6 mb-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl
                                    bg-blue-100 dark:bg-blue-900/30
                                    flex items-center justify-center text-xl">
                            🕒
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Riwayat Aktivitas Sistem
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Pantau aktivitas pengguna yang terjadi di dalam SmartLab.
                            </p>
                        </div>

                    </div>
                </div>

            </div>


            {{-- Log Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm overflow-hidden">

                {{-- Card Header --}}
                <div class="px-6 py-5
                            border-b border-gray-100 dark:border-gray-700">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Aktivitas Terbaru
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Catatan aktivitas pengguna dan sistem.
                            </p>
                        </div>

                        <div class="hidden sm:flex items-center gap-2
                                    text-xs text-gray-500 dark:text-gray-400">

                            <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                            Monitoring

                        </div>

                    </div>

                </div>


                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 dark:bg-gray-700/50">

                            <tr class="text-left text-xs font-semibold
                                       uppercase tracking-wider
                                       text-gray-500 dark:text-gray-300">

                                <th class="px-5 py-4 text-center">
                                    No
                                </th>

                                <th class="px-5 py-4">
                                    User
                                </th>

                                <th class="px-5 py-4">
                                    Aktivitas
                                </th>

                                <th class="px-5 py-4">
                                    Keterangan
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Waktu
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse($logs as $log)

                                <tr class="hover:bg-gray-50
                                           dark:hover:bg-gray-700/40
                                           transition">

                                    {{-- No --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="text-gray-500 dark:text-gray-400">

                                            {{ ($logs->currentPage() - 1) * $logs->perPage() + $loop->iteration }}

                                        </span>

                                    </td>


                                    {{-- User --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-full
                                                        bg-blue-100 dark:bg-blue-900/30
                                                        flex items-center justify-center
                                                        text-blue-600 dark:text-blue-400
                                                        font-bold">

                                                {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}

                                            </div>

                                            <div>

                                                <p class="font-semibold
                                                          text-gray-800 dark:text-white">

                                                    {{ $log->user->name ?? 'System' }}

                                                </p>

                                                <p class="text-xs
                                                          text-gray-500 dark:text-gray-400">

                                                    {{ $log->user ? 'Pengguna' : 'Sistem' }}

                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Aktivitas --}}
                                    <td class="px-5 py-4">

                                        @php
                                            $aksi = strtolower($log->aksi);

                                            if (str_contains($aksi, 'tambah') || str_contains($aksi, 'buat')) {
                                                $icon = '＋';
                                                $badgeClass = 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400';
                                            } elseif (str_contains($aksi, 'edit') || str_contains($aksi, 'update') || str_contains($aksi, 'ubah')) {
                                                $icon = '✏️';
                                                $badgeClass = 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400';
                                            } elseif (str_contains($aksi, 'hapus') || str_contains($aksi, 'delete')) {
                                                $icon = '🗑️';
                                                $badgeClass = 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400';
                                            } elseif (str_contains($aksi, 'peminjaman') || str_contains($aksi, 'pinjam')) {
                                                $icon = '📋';
                                                $badgeClass = 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400';
                                            } elseif (str_contains($aksi, 'kembali')) {
                                                $icon = '↩';
                                                $badgeClass = 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400';
                                            } else {
                                                $icon = '•';
                                                $badgeClass = 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300';
                                            }
                                        @endphp

                                        <span class="inline-flex items-center gap-2
                                                     px-3 py-1.5 rounded-full
                                                     text-xs font-semibold
                                                     {{ $badgeClass }}">

                                            <span>
                                                {{ $icon }}
                                            </span>

                                            {{ $log->aksi }}

                                        </span>

                                    </td>


                                    {{-- Keterangan --}}
                                    <td class="px-5 py-4">

                                        <p class="text-gray-600 dark:text-gray-300 max-w-lg">

                                            {{ $log->keterangan ?? '-' }}

                                        </p>

                                    </td>


                                    {{-- Waktu --}}
                                    <td class="px-5 py-4 text-center">

                                        <div>

                                            <p class="font-medium
                                                      text-gray-700 dark:text-gray-300">

                                                {{ $log->created_at->format('d M Y') }}

                                            </p>

                                            <p class="text-xs
                                                      text-gray-500 dark:text-gray-400 mt-1">

                                                {{ $log->created_at->format('H:i') }} WIB

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div class="w-16 h-16 rounded-full
                                                        bg-gray-100 dark:bg-gray-700
                                                        flex items-center justify-center
                                                        text-3xl mb-4">

                                                🕒

                                            </div>

                                            <h3 class="font-semibold
                                                       text-gray-700 dark:text-gray-200">

                                                Belum ada aktivitas

                                            </h3>

                                            <p class="text-sm
                                                      text-gray-500 dark:text-gray-400
                                                      mt-1">

                                                Aktivitas pengguna akan muncul di sini.

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Footer --}}
                @if($logs->count() > 0)

                    <div class="px-6 py-4
                                border-t border-gray-100 dark:border-gray-700
                                bg-gray-50/50 dark:bg-gray-700/20">

                        <p class="text-xs text-gray-500 dark:text-gray-400">

                            Menampilkan

                            <span class="font-semibold">
                                {{ $logs->count() }}
                            </span>

                            aktivitas pada halaman ini.

                        </p>

                    </div>

                @endif

            </div>


            {{-- Pagination --}}
            @if($logs->hasPages())

                <div class="mt-5">

                    {{ $logs->links() }}

                </div>

            @endif


            {{-- Footer --}}
            <div class="text-center mt-8 text-xs text-gray-400">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>

        </div>
    </div>

</x-app-layout>