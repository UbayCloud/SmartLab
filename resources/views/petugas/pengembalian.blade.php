<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem Manajemen Peminjaman Alat laboratorium
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Data Pengembalian Alat
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Hero --}}
            <div class="bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm">
                            Total Pengembalian
                        </p>
                        <h1 class="text-4xl font-bold">
                            {{ $pengembalian->count() }}
                        </h1>
                        <p class="text-green-100 mt-1">
                            Riwayat alat yang telah dikembalikan
                        </p>
                    </div>

                    <div class="hidden md:flex w-20 h-20 rounded-2xl bg-white/20 items-center justify-center text-4xl">
                        ✅
                    </div>
                </div>
            </div>

            {{-- Table Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">

                {{-- Header --}}
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-bold">
                                Riwayat Pengembalian
                            </h3>
                            <p class="text-sm text-gray-500">
                                Seluruh transaksi yang sudah selesai.
                            </p>
                        </div>

                        <div class="relative w-full md:w-72">
                            <input id="search"
                                type="text"
                                placeholder="Cari peminjam..."
                                class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-300 focus:ring-green-500 focus:border-green-500">

                            <span class="absolute left-3 top-2.5 text-gray-400">
                                🔍
                            </span>
                        </div>

                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm" id="kembaliTable">

                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left">Peminjam</th>
                                <th class="px-4 py-3 text-left">Alat</th>
                                <th class="px-4 py-3 text-center">Jumlah</th>
                                <th class="px-4 py-3 text-center">Pinjam</th>
                                <th class="px-4 py-3 text-center">Dikembalikan</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse ($pengembalian as $p)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                {{-- Peminjam --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        <div class="w-11 h-11 rounded-full bg-green-100 text-green-700 flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($p->user->name,0,1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold">
                                                {{ $p->user->name }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                ID #{{ $p->id }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- Alat --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        @if($p->alat->gambar)
                                        <img src="{{ asset('storage/'.$p->alat->gambar) }}"
                                            class="w-12 h-12 rounded-lg object-cover border">
                                        @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                            📦
                                        </div>
                                        @endif

                                        <div>
                                            <p class="font-medium">
                                                {{ $p->alat->nama_alat }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $p->alat->kode_alat }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- Jumlah --}}
                                <td class="px-4 py-4 text-center font-semibold">
                                    {{ $p->jumlah }}
                                </td>

                                {{-- Tanggal Pinjam --}}
                                <td class="px-4 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                                </td>

                                {{-- Tanggal Kembali --}}
                                <td class="px-4 py-4 text-center">
                                    {{ $p->updated_at->format('d M Y') }}
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        ✔ Selesai
                                    </span>
                                </td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500">

                                    <div class="flex flex-col items-center gap-3">

                                        <div class="text-6xl">
                                            📭
                                        </div>

                                        <h4 class="text-lg font-semibold">
                                            Belum Ada Pengembalian
                                        </h4>

                                        <p class="text-sm">
                                            Riwayat pengembalian akan muncul di sini.
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
            <div class="text-center mt-8 text-xs text-gray-400">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        const search = document.getElementById('search');
        const rows = document.querySelectorAll('#kembaliTable tbody tr');

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