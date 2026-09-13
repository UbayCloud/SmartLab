<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                SmartLab • Petugas
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Daftar Alat Laboratorium
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Inventaris Alat
                        </h3>
                        <p class="text-sm text-gray-500">
                            Total {{ $alat->count() }} alat tersedia di laboratorium.
                        </p>
                    </div>

                    {{-- Pencarian --}}
                    <div class="relative w-full md:w-72">
                        <input
                            type="text"
                            id="search"
                            placeholder="Cari alat..."
                            class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        <span class="absolute left-3 top-2.5 text-gray-400">
                            🔍
                        </span>
                    </div>

                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full text-sm" id="alatTable">

                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left">Alat</th>
                                <th class="px-4 py-3 text-left">Kategori</th>
                                <th class="px-4 py-3 text-center">Stok</th>
                                <th class="px-4 py-3 text-center">Kondisi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse($alat as $alt)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                {{-- Foto + Nama --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        @if($alt->gambar)
                                        <img src="{{ asset('storage/'.$alt->gambar) }}"
                                            class="w-14 h-14 rounded-xl object-cover border">
                                        @else
                                        <div class="w-14 h-14 rounded-xl bg-gray-100 flex items-center justify-center text-2xl">
                                            📦
                                        </div>
                                        @endif

                                        <div>
                                            <p class="font-semibold text-gray-800 dark:text-white">
                                                {{ $alt->nama_alat }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $alt->kode_alat }}
                                            </p>
                                        </div>

                                    </div>
                                </td>

                                {{-- Kategori --}}
                                <td class="px-4 py-4">
                                    {{ $alt->kategori->nama_kategori ?? '-' }}
                                </td>

                                {{-- Stok --}}
                                <td class="px-4 py-4 text-center">
                                    @if($alt->jumlah_tersedia > 0)
                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-semibold text-xs">
                                        {{ $alt->jumlah_tersedia }} Unit
                                    </span>
                                    @else
                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold text-xs">
                                        Habis
                                    </span>
                                    @endif
                                </td>

                                {{-- Kondisi --}}
                                <td class="px-4 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                        {{ ucfirst($alt->kondisi) }}
                                    </span>
                                </td>

                            </tr>
                            @empty

                            <tr>
                                <td colspan="4" class="text-center py-10 text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="text-5xl">📦</div>
                                        <p>Belum ada data alat.</p>
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
        const rows = document.querySelectorAll('#alatTable tbody tr');

        search.addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();

            rows.forEach(row => {
                row.style.display = row.innerText.toLowerCase().includes(keyword)
                    ? ''
                    : 'none';
            });
        });
    </script>
    @endpush

</x-app-layout>