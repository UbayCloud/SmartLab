<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem Manajemen Peminjaman Alat laboratorium
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Laporan Peminjaman Alat
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- HERO --}}
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-3xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-sm">Total Data Laporan</p>
                        <h1 class="text-4xl font-bold">{{ $laporan->count() }}</h1>
                        <p class="text-blue-100 mt-1">
                            Rekap seluruh transaksi peminjaman
                        </p>
                    </div>

                    <div class="hidden md:flex w-20 h-20 bg-white/20 rounded-2xl items-center justify-center text-4xl">
                        📊
                    </div>
                </div>
            </div>

            {{-- FILTER --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">

                <h3 class="text-lg font-bold mb-5">
                    Filter Laporan
                </h3>

                <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Peminjam
                        </label>

                        <select name="user_id"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Semua</option>

                            @foreach($users as $u)
                            <option value="{{ $u->id }}"
                                {{ request('user_id')==$u->id ? 'selected':'' }}>
                                {{ $u->name }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Status
                        </label>

                        <select name="status"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">Semua</option>
                            <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
                            <option value="dipinjam" {{ request('status')=='dipinjam'?'selected':'' }}>Dipinjam</option>
                            <option value="selesai" {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Dari
                        </label>

                        <input type="date"
                            name="tanggal_dari"
                            value="{{ request('tanggal_dari') }}"
                            class="w-full rounded-xl border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">
                            Sampai
                        </label>

                        <input type="date"
                            name="tanggal_sampai"
                            value="{{ request('tanggal_sampai') }}"
                            class="w-full rounded-xl border-gray-300">
                    </div>

                    <div class="flex items-end gap-2">

                        <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl font-medium transition">
                            🔍 Filter
                        </button>

                        <a href="{{ route('laporan.cetak', request()->query()) }}"
                            target="_blank"
                            class="flex-1 text-center bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-xl font-medium transition">
                            🖨 Cetak
                        </a>

                    </div>

                </form>
            </div>

            {{-- TABEL --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold">
                        Hasil Laporan
                    </h3>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left">Peminjam</th>
                                <th class="px-4 py-3 text-left">Alat</th>
                                <th class="px-4 py-3 text-center">Jumlah</th>
                                <th class="px-4 py-3 text-center">Pinjam</th>
                                <th class="px-4 py-3 text-center">Kembali</th>
                                <th class="px-4 py-3 text-center">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse($laporan as $l)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">

                                {{-- PEMINJAM --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        <div class="w-11 h-11 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($l->user->name ?? 'S',0,1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold">
                                                {{ $l->user->name ?? '-' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                ID #{{ $l->id }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- ALAT --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        @if($l->alat && $l->alat->gambar)
                                        <img src="{{ asset('storage/'.$l->alat->gambar) }}"
                                            class="w-12 h-12 rounded-lg object-cover border">
                                        @else
                                        <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                            📦
                                        </div>
                                        @endif

                                        <div>
                                            <p class="font-medium">
                                                {{ $l->alat->nama_alat ?? '-' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $l->alat->kode_alat ?? '' }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- JUMLAH --}}
                                <td class="px-4 py-4 text-center font-semibold">
                                    {{ $l->jumlah }}
                                </td>

                                {{-- TANGGAL --}}
                                <td class="px-4 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($l->tanggal_pinjam)->format('d M Y') }}
                                </td>

                                <td class="px-4 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($l->tanggal_kembali_rencana)->format('d M Y') }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-4 py-4 text-center">

                                    @if($l->status=='menunggu')
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                        Menunggu
                                    </span>

                                    @elseif($l->status=='dipinjam')
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                        Dipinjam
                                    </span>

                                    @else
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        Selesai
                                    </span>
                                    @endif

                                </td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500">

                                    <div class="flex flex-col items-center gap-3">

                                        <div class="text-6xl">📄</div>

                                        <h4 class="text-lg font-semibold">
                                            Tidak Ada Laporan
                                        </h4>

                                        <p class="text-sm">
                                            Coba ubah filter atau tambahkan data transaksi.
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
</x-app-layout>