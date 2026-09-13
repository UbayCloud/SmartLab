<x-app-layout>

    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Transaksi
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Pengembalian Alat
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
                                    bg-green-100 dark:bg-green-900/30
                                    flex items-center justify-center text-xl">
                            🔄
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Monitoring Pengembalian
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Kelola alat yang sedang dipinjam dan proses pengembaliannya.
                            </p>
                        </div>

                    </div>

                    <div class="flex items-center gap-2
                                px-3 py-2 rounded-xl
                                bg-blue-50 dark:bg-blue-900/20
                                text-blue-600 dark:text-blue-400
                                text-sm font-semibold">

                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                        {{ $peminjaman->where('status', 'dipinjam')->count() }} sedang dipinjam

                    </div>

                </div>

            </div>


            {{-- Table Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm overflow-hidden">

                {{-- Table Header --}}
                <div class="px-6 py-5
                            border-b border-gray-100 dark:border-gray-700">

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Data Pengembalian
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Daftar transaksi peminjaman dan status pengembaliannya.
                        </p>
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
                                    Peminjam
                                </th>

                                <th class="px-5 py-4">
                                    Alat
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Jumlah
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Tanggal Pinjam
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Rencana Kembali
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Status
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse($peminjaman as $p)

                                <tr class="hover:bg-gray-50
                                           dark:hover:bg-gray-700/40
                                           transition">

                                    {{-- No --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="text-gray-500 dark:text-gray-400">
                                            {{ $loop->iteration }}
                                        </span>

                                    </td>


                                    {{-- Peminjam --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-full
                                                        bg-blue-100 dark:bg-blue-900/30
                                                        flex items-center justify-center
                                                        text-blue-600 dark:text-blue-400
                                                        font-bold">

                                                {{ strtoupper(substr($p->user->name ?? 'U', 0, 1)) }}

                                            </div>

                                            <div>

                                                <p class="font-semibold
                                                          text-gray-800 dark:text-white">

                                                    {{ $p->user->name ?? 'User' }}

                                                </p>

                                                <p class="text-xs
                                                          text-gray-500 dark:text-gray-400">

                                                    Peminjam

                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Alat --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-lg
                                                        bg-gray-100 dark:bg-gray-700
                                                        overflow-hidden
                                                        flex items-center justify-center
                                                        flex-shrink-0">

                                                @if($p->alat && $p->alat->gambar)

                                                    <img src="{{ asset('storage/' . $p->alat->gambar) }}"
                                                        alt="{{ $p->alat->nama_alat }}"
                                                        class="w-full h-full object-cover">

                                                @else

                                                    <span>📦</span>

                                                @endif

                                            </div>

                                            <div>

                                                <p class="font-semibold
                                                          text-gray-800 dark:text-white">

                                                    {{ $p->alat->nama_alat ?? '-' }}

                                                </p>

                                                <p class="text-xs
                                                          text-gray-500 dark:text-gray-400">

                                                    {{ $p->alat->kode_alat ?? '-' }}

                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Jumlah --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="inline-flex items-center justify-center
                                                     min-w-[36px] px-2.5 py-1
                                                     rounded-lg
                                                     bg-gray-100 dark:bg-gray-700
                                                     text-gray-700 dark:text-gray-200
                                                     font-bold text-xs">

                                            {{ $p->jumlah }}

                                        </span>

                                    </td>


                                    {{-- Tanggal Pinjam --}}
                                    <td class="px-5 py-4 text-center">

                                        <p class="text-gray-700 dark:text-gray-300">

                                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}

                                        </p>

                                    </td>


                                    {{-- Rencana Kembali --}}
                                    <td class="px-5 py-4 text-center">

                                        <p class="text-gray-700 dark:text-gray-300">

                                            {{ \Carbon\Carbon::parse($p->tanggal_kembali_rencana)->format('d M Y') }}

                                        </p>

                                    </td>


                                    {{-- Status --}}
                                    <td class="px-5 py-4 text-center">

                                        @if($p->status === 'dipinjam')

                                            <span class="inline-flex items-center gap-2
                                                         px-3 py-1.5 rounded-full
                                                         bg-blue-100 dark:bg-blue-900/30
                                                         text-blue-700 dark:text-blue-400
                                                         text-xs font-semibold">

                                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                                                Dipinjam

                                            </span>

                                        @elseif($p->status === 'menunggu')

                                            <span class="inline-flex items-center gap-2
                                                         px-3 py-1.5 rounded-full
                                                         bg-yellow-100 dark:bg-yellow-900/30
                                                         text-yellow-700 dark:text-yellow-400
                                                         text-xs font-semibold">

                                                <span class="w-2 h-2 rounded-full bg-yellow-500"></span>

                                                Menunggu

                                            </span>

                                        @elseif($p->status === 'ditolak')

                                            <span class="inline-flex items-center gap-2
                                                         px-3 py-1.5 rounded-full
                                                         bg-red-100 dark:bg-red-900/30
                                                         text-red-700 dark:text-red-400
                                                         text-xs font-semibold">

                                                <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                                Ditolak

                                            </span>

                                        @elseif($p->status === 'selesai')

                                            <span class="inline-flex items-center gap-2
                                                         px-3 py-1.5 rounded-full
                                                         bg-green-100 dark:bg-green-900/30
                                                         text-green-700 dark:text-green-400
                                                         text-xs font-semibold">

                                                <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                                Selesai

                                            </span>

                                        @else

                                            <span class="inline-flex items-center
                                                         px-3 py-1.5 rounded-full
                                                         bg-gray-100 dark:bg-gray-700
                                                         text-gray-600 dark:text-gray-300
                                                         text-xs font-semibold">

                                                {{ ucfirst($p->status) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Aksi --}}
                                    <td class="px-5 py-4 text-center">

                                        @if($p->status === 'dipinjam')

                                            <form id="kembalikan-form-{{ $p->id }}"
                                                action="{{ route('admin.pengembalian.kembalikan', $p->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('PUT')

                                                <button type="button"
                                                    onclick="confirmKembalikan({{ $p->id }})"
                                                    class="inline-flex items-center gap-2
                                                           bg-green-600 hover:bg-green-700
                                                           text-white px-3 py-2
                                                           rounded-lg
                                                           text-xs font-semibold
                                                           transition">

                                                    <span>↩</span>
                                                    Kembalikan

                                                </button>

                                            </form>

                                        @elseif($p->status === 'menunggu')

                                            <span class="inline-flex items-center gap-1
                                                         text-xs text-yellow-600
                                                         dark:text-yellow-400
                                                         font-medium">

                                                ⏳ Menunggu persetujuan

                                            </span>

                                        @elseif($p->status === 'ditolak')

                                            <span class="inline-flex items-center gap-1
                                                         text-xs text-red-500
                                                         dark:text-red-400">

                                                ✕ Ditolak

                                            </span>

                                        @else

                                            <span class="inline-flex items-center gap-1
                                                         text-xs text-green-600
                                                         dark:text-green-400
                                                         font-medium">

                                                ✓ Sudah dikembalikan

                                            </span>

                                        @endif

                                    </td>

                                </tr>


                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="8" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div class="w-16 h-16 rounded-full
                                                        bg-gray-100 dark:bg-gray-700
                                                        flex items-center justify-center
                                                        text-3xl mb-4">

                                                🔄

                                            </div>

                                            <h3 class="font-semibold
                                                       text-gray-700 dark:text-gray-200">

                                                Belum ada data pengembalian

                                            </h3>

                                            <p class="text-sm
                                                      text-gray-500 dark:text-gray-400
                                                      mt-1">

                                                Tidak ada alat yang sedang dipinjam saat ini.

                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Footer --}}
                @if($peminjaman->count() > 0)

                    <div class="px-6 py-4
                                border-t border-gray-100 dark:border-gray-700
                                bg-gray-50/50 dark:bg-gray-700/20">

                        <p class="text-xs text-gray-500 dark:text-gray-400">

                            Menampilkan

                            <span class="font-semibold">
                                {{ $peminjaman->count() }}
                            </span>

                            transaksi pengembalian.

                        </p>

                    </div>

                @endif

            </div>


            {{-- Footer --}}
            <div class="text-center mt-8 text-xs text-gray-400">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>

        </div>
    </div>


    {{-- SweetAlert --}}
    <script>

        function confirmKembalikan(id) {

            Swal.fire({

                title: 'Kembalikan alat?',

                text: 'Pastikan alat sudah benar-benar dikembalikan!',

                icon: 'question',

                showCancelButton: true,

                confirmButtonColor: '#16a34a',

                cancelButtonColor: '#6b7280',

                confirmButtonText: 'Ya, kembalikan!',

                cancelButtonText: 'Batal',

                reverseButtons: true

            }).then((result) => {

                if (result.isConfirmed) {

                    document
                        .getElementById('kembalikan-form-' + id)
                        .submit();

                }

            });

        }

    </script>

</x-app-layout>