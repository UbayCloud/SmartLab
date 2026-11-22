<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
               Sistem Manajemen Peminjaman Alat laboratorium
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Pengembalian Alat
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- HERO --}}
            <div class="bg-gradient-to-r from-emerald-600 to-green-600 rounded-3xl p-6 text-white shadow-lg">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-emerald-100 text-sm">
                            Alat Sedang Dipinjam
                        </p>
                        <h1 class="text-4xl font-bold">
                            {{ $peminjaman->count() }}
                        </h1>
                        <p class="text-emerald-100 mt-1">
                            Kembalikan alat setelah selesai digunakan.
                        </p>
                    </div>

                    <div class="hidden md:flex w-20 h-20 bg-white/20 rounded-2xl items-center justify-center text-4xl">
                        🔁
                    </div>
                </div>
            </div>

            {{-- TABLE CARD --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">

                {{-- Header --}}
                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-bold">
                                Daftar Alat Dipinjam
                            </h3>
                            <p class="text-sm text-gray-500">
                                Tekan tombol kembalikan jika alat sudah selesai digunakan.
                            </p>
                        </div>

                        <div class="relative w-full md:w-72">
                            <input id="search"
                                type="text"
                                placeholder="Cari alat..."
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
                                <th class="px-4 py-3 text-left">Alat</th>
                                <th class="px-4 py-3 text-center">Jumlah</th>
                                <th class="px-4 py-3 text-center">Tanggal Pinjam</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse($peminjaman as $p)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                {{-- ALAT --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        @if($p->alat && $p->alat->gambar)
                                            <img src="{{ 'https://smartlab-image.ubaidillahrahmann.workers.dev/' . $alt->gambar }}"
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

                                {{-- TANGGAL --}}
                                <td class="px-4 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                                </td>

                                {{-- STATUS --}}
                                <td class="px-4 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                        📦 Dipinjam
                                    </span>
                                </td>

                                {{-- AKSI --}}
                                <td class="px-4 py-4 text-center">

                                    <form id="kembali-form-{{ $p->id }}"
                                        action="{{ route('peminjam.pengembalian.kembalikan', $p->id) }}"
                                        method="POST">

                                        @csrf
                                        @method('PUT')

                                        <button type="button"
                                            onclick="confirmKembali({{ $p->id }})"
                                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl font-medium transition">
                                            🔁 Kembalikan
                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="5" class="text-center py-12 text-gray-500">

                                    <div class="flex flex-col items-center gap-3">

                                        <div class="text-6xl">
                                            🎉
                                        </div>

                                        <h4 class="text-lg font-semibold">
                                            Tidak Ada Alat Dipinjam
                                        </h4>

                                        <p class="text-sm">
                                            Semua alat sudah dikembalikan.
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
        const rows = document.querySelectorAll('#kembaliTable tbody tr');

        search?.addEventListener('keyup', function () {
            const key = this.value.toLowerCase();

            rows.forEach(row => {
                row.style.display =
                    row.innerText.toLowerCase().includes(key) ? '' : 'none';
            });
        });

        function confirmKembali(id) {
            Swal.fire({
                title: 'Kembalikan alat?',
                text: 'Pastikan alat sudah benar-benar diserahkan ke petugas.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Kembalikan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('kembali-form-' + id).submit();
                }
            });
        }
    </script>
    @endpush

</x-app-layout>