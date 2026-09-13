<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Sistem Manajemen Peminjaman Alat laboratorium
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Persetujuan Peminjaman
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Ringkasan --}}
            <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-3xl p-6 text-white shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-sm">
                            Pengajuan Menunggu
                        </p>
                        <h1 class="text-4xl font-bold">
                            {{ $peminjaman->count() }}
                        </h1>
                        <p class="text-amber-100 mt-1">
                            Menunggu persetujuan petugas
                        </p>
                    </div>

                    <div class="hidden md:flex w-20 h-20 rounded-2xl bg-white/20 items-center justify-center text-4xl">
                        ⏳
                    </div>
                </div>
            </div>

            {{-- Header Table --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">

                <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-bold">
                                Daftar Pengajuan
                            </h3>
                            <p class="text-sm text-gray-500">
                                Setujui atau tolak peminjaman alat.
                            </p>
                        </div>

                        <div class="relative w-full md:w-72">
                            <input id="search"
                                type="text"
                                placeholder="Cari peminjam..."
                                class="w-full pl-10 pr-4 py-2 rounded-xl border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                            <span class="absolute left-3 top-2.5 text-gray-400">
                                🔍
                            </span>
                        </div>

                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm" id="pengajuanTable">

                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left">Peminjam</th>
                                <th class="px-4 py-3 text-left">Alat</th>
                                <th class="px-4 py-3 text-center">Jumlah</th>
                                <th class="px-4 py-3 text-center">Pinjam</th>
                                <th class="px-4 py-3 text-center">Kembali</th>
                                <th class="px-4 py-3 text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse($peminjaman as $p)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                                {{-- User --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">

                                        <div class="w-11 h-11 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold">
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

                                {{-- Pinjam --}}
                                <td class="px-4 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                                </td>

                                {{-- Kembali --}}
                                <td class="px-4 py-4 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal_kembali_rencana)->format('d M Y') }}
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                                        Menunggu
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-4 py-4">
                                    <div class="flex justify-center gap-2">

                                        {{-- SETUJUI --}}
                                        <form id="setujui-form-{{ $p->id }}"
                                            action="{{ route('petugas.setujui',$p->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('PUT')

                                            <button type="button"
                                                onclick="confirmSetujui({{ $p->id }})"
                                                class="px-3 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-xs font-semibold transition">
                                                ✔ Setujui
                                            </button>

                                        </form>

                                        {{-- TOLAK --}}
                                        <form id="tolak-form-{{ $p->id }}"
                                            action="{{ route('petugas.tolak',$p->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('PUT')

                                            <button type="button"
                                                onclick="confirmTolak({{ $p->id }})"
                                                class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition">
                                                ✖ Tolak
                                            </button>

                                        </form>

                                    </div>
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="7" class="text-center py-12 text-gray-500">

                                    <div class="flex flex-col items-center gap-3">

                                        <div class="text-6xl">
                                            📭
                                        </div>

                                        <h4 class="text-lg font-semibold">
                                            Tidak Ada Pengajuan
                                        </h4>

                                        <p class="text-sm">
                                            Semua peminjaman sudah diproses.
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
        const rows = document.querySelectorAll('#pengajuanTable tbody tr');

        search?.addEventListener('keyup', function () {
            const key = this.value.toLowerCase();

            rows.forEach(row => {
                row.style.display =
                    row.innerText.toLowerCase().includes(key) ? '' : 'none';
            });
        });

        function confirmSetujui(id) {
            Swal.fire({
                title: 'Setujui peminjaman?',
                text: 'Status akan berubah menjadi DIPINJAM.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Setujui',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('setujui-form-' + id).submit();
                }
            })
        }

        function confirmTolak(id) {
            Swal.fire({
                title: 'Tolak pengajuan?',
                text: 'Peminjaman akan ditolak.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('tolak-form-' + id).submit();
                }
            })
        }
    </script>
    @endpush

</x-app-layout>