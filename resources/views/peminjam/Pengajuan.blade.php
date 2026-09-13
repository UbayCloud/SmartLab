<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem Manajemen Peminjaman Alat laboratorium
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Riwayat Pengajuan Peminjaman
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- HERO --}}
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-indigo-100 text-sm">
                            Total Pengajuan
                        </p>
                        <h1 class="text-4xl font-bold">
                            {{ $peminjaman->count() }}
                        </h1>
                        <p class="text-indigo-100 mt-1">
                            Semua riwayat peminjaman yang pernah diajukan.
                        </p>
                    </div>

                    <div class="hidden md:flex w-20 h-20 bg-white/20 rounded-2xl items-center justify-center text-4xl">
                        📝
                    </div>
                </div>
            </div>

            {{-- HEADER TABLE --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">

                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <a href="{{ route('pengajuan.create') }}"
                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-medium transition">
                            ➕ Ajukan Peminjaman
                        </a>

                        <div class="relative w-full md:w-72">
                            <input
                                id="search"
                                type="text"
                                placeholder="Cari alat..."
                                class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                            <span class="absolute left-3 top-2.5 text-gray-400">
                                🔍
                            </span>
                        </div>

                    </div>
                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm" id="riwayatTable">

                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left">Alat</th>
                                <th class="px-4 py-3 text-center">Jumlah</th>
                                <th class="px-4 py-3 text-center">Pinjam</th>
                                <th class="px-4 py-3 text-center">Kembali</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse($peminjaman as $p)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                {{-- ALAT --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        @if($p->alat && $p->alat->gambar)
                                            <img src="{{ asset('storage/'.$p->alat->gambar) }}"
                                                class="w-12 h-12 rounded-lg object-cover border">
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                                📦
                                            </div>
                                        @endif

                                        <div>
                                            <p class="font-semibold text-gray-800 dark:text-white">
                                                {{ $p->alat->nama_alat }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $p->alat->kode_alat }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- JUMLAH --}}
                                <td class="px-4 py-4 text-center font-semibold">
                                    {{ $p->jumlah }}
                                </td>

                                {{-- PINJAM --}}
                                <td class="px-4 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                                </td>

                                {{-- KEMBALI --}}
                                <td class="px-4 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal_kembali_rencana)->format('d M Y') }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-4 py-4 text-center">

                                    @if($p->status=='menunggu')
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                            ⏳ Menunggu
                                        </span>

                                    @elseif($p->status=='dipinjam')
                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                            ✔ Disetujui
                                        </span>

                                    @elseif($p->status=='selesai')
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                            ✅ Selesai
                                        </span>

                                    @elseif($p->status=='ditolak')
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                            ✖ Ditolak
                                        </span>
                                    @endif

                                </td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-gray-500">

                                    <div class="flex flex-col items-center gap-3">

                                        <div class="text-6xl">📭</div>

                                        <h4 class="text-lg font-semibold">
                                            Belum Ada Pengajuan
                                        </h4>

                                        <p class="text-sm">
                                            Tekan tombol <b>Ajukan Peminjaman</b> untuk mulai meminjam alat.
                                        </p>

                                    </div>

                                </td>
                            </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

             {{-- FOOTER --}}
            <div class="text-center mt-6 text-xs text-gray-400">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>


        </div>
    </div>

    @push('scripts')
    <script>
        const search = document.getElementById('search');
        const rows = document.querySelectorAll('#riwayatTable tbody tr');

        search?.addEventListener('keyup', function () {
            const key = this.value.toLowerCase();

            rows.forEach(row => {
                row.style.display =
                    row.innerText.toLowerCase().includes(key) ? '' : 'none';
            });
        });
    </script>
    @endpush

</x-app-layout>