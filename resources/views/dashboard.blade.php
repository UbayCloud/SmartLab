<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" class="flex gap-3 mb-4">
                        <select name="status" class="border p-2 rounded">
                            <option value="">-- Semua Status --</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="dipinjam">Dipinjam</option>
                            <option value="selesai">Selesai</option>
                        </select>

                        <input type="date" name="tanggal_dari" class="border p-2 rounded">
                        <input type="date" name="tanggal_sampai" class="border p-2 rounded">

                        <button class="bg-blue-600 text-white px-4 py-2 rounded">
                            Filter
                        </button>

                        <a href="{{ route('laporan.cetak', request()->query()) }}"
                            target="_blank"
                            class="bg-green-600 text-white px-4 py-2 rounded">
                            Cetak
                        </a>
                    </form>
                    <table class="w-full border text-sm">
                        <thead class="bg-gray-200">
                            <tr>
                                <th>No</th>
                                <th>Peminjam</th>
                                <th>Alat</th>
                                <th>Jumlah</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporan as $i => $l)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $l->user->name ?? '-' }}</td>
                                <td>{{ $l->alat->nama_alat ?? '-' }}</td>
                                <td>{{ $l->jumlah }}</td>
                                <td>{{ $l->tanggal_pinjam }}</td>
                                <td>{{ ucfirst($l->status) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>