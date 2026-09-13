<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Manajemen Inventaris
                </p>

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Daftar Alat
                </h2>
            </div>

            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $alat->count() }} alat terdaftar
            </div>
        </div>
    </x-slot>


    {{-- CONTENT --}}
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- TOP SECTION --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm
                        border border-gray-100 dark:border-gray-700
                        p-6 mb-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Inventaris Laboratorium
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Kelola data alat, stok, kondisi, dan QR Code alat laboratorium.
                        </p>
                    </div>

                    <a href="{{ route('tools.create') }}"
                        class="inline-flex items-center justify-center gap-2
                               bg-blue-600 hover:bg-blue-700
                               text-white px-5 py-3 rounded-xl
                               font-semibold transition shadow-sm">

                        <span>＋</span>
                        Tambah Alat
                    </a>

                </div>
            </div>


            {{-- TABLE CARD --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl
                        shadow-sm border border-gray-100 dark:border-gray-700
                        overflow-hidden">

                {{-- TABLE HEADER --}}
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Data Alat
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Daftar seluruh alat yang tersedia di laboratorium.
                            </p>
                        </div>
                    </div>

                </div>


                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        {{-- TABLE HEAD --}}
                        <thead class="bg-gray-50 dark:bg-gray-700/50">

                            <tr class="text-left text-xs font-semibold
                                       uppercase tracking-wider
                                       text-gray-500 dark:text-gray-300">

                                <th class="px-5 py-4 text-center">
                                    No
                                </th>

                                <th class="px-5 py-4">
                                    Alat
                                </th>

                                <th class="px-5 py-4">
                                    Kode
                                </th>

                                <th class="px-5 py-4">
                                    Kategori
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Stok
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Kondisi
                                </th>

                                <th class="px-5 py-4 text-center">
                                    QR Code
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        {{-- TABLE BODY --}}
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse ($alat as $index => $alt)

                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">


                                    {{-- NO --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="text-gray-500 dark:text-gray-400">
                                            {{ $index + 1 }}
                                        </span>

                                    </td>


                                    {{-- ALAT --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            {{-- FOTO --}}
                                            <div class="w-12 h-12 rounded-xl overflow-hidden
                                                        bg-gray-100 dark:bg-gray-700
                                                        flex items-center justify-center
                                                        flex-shrink-0">

                                                @if ($alt->gambar)

                                                    <img
                                                        src="{{ asset('storage/' . $alt->gambar) }}"
                                                        alt="{{ $alt->nama_alat }}"
                                                        class="w-full h-full object-cover"
                                                    >

                                                @else

                                                    <span class="text-xl">
                                                        📦
                                                    </span>

                                                @endif

                                            </div>


                                            {{-- NAMA --}}
                                            <div class="min-w-0">

                                                <p class="font-semibold text-gray-800 dark:text-white truncate">
                                                    {{ $alt->nama_alat }}
                                                </p>

                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    Alat Laboratorium
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- KODE --}}
                                    <td class="px-5 py-4">

                                        <span class="inline-flex items-center
                                                     px-2.5 py-1 rounded-lg
                                                     bg-gray-100 dark:bg-gray-700
                                                     text-gray-700 dark:text-gray-200
                                                     text-xs font-semibold">

                                            {{ $alt->kode_alat }}

                                        </span>

                                    </td>


                                    {{-- KATEGORI --}}
                                    <td class="px-5 py-4">

                                        <span class="text-gray-600 dark:text-gray-300">

                                            {{ $alt->kategori->nama_kategori ?? '-' }}

                                        </span>

                                    </td>


                                    {{-- STOK --}}
                                    <td class="px-5 py-4 text-center">

                                        @if ($alt->jumlah_tersedia > 0)

                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-green-100 dark:bg-green-900/30
                                                         text-green-700 dark:text-green-400
                                                         font-semibold text-xs">

                                                {{ $alt->jumlah_tersedia }} tersedia

                                            </span>

                                        @else

                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-red-100 dark:bg-red-900/30
                                                         text-red-700 dark:text-red-400
                                                         font-semibold text-xs">

                                                Stok habis

                                            </span>

                                        @endif

                                    </td>


                                    {{-- KONDISI --}}
                                    <td class="px-5 py-4 text-center">

                                        @if ($alt->kondisi === 'baik')

                                            <span class="inline-flex items-center gap-1
                                                         px-3 py-1 rounded-full
                                                         bg-blue-100 dark:bg-blue-900/30
                                                         text-blue-700 dark:text-blue-400
                                                         font-semibold text-xs">

                                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>

                                                Baik

                                            </span>

                                        @else

                                            <span class="inline-flex items-center
                                                         px-3 py-1 rounded-full
                                                         bg-yellow-100 dark:bg-yellow-900/30
                                                         text-yellow-700 dark:text-yellow-400
                                                         font-semibold text-xs">

                                                {{ ucfirst($alt->kondisi) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- QR CODE --}}
                                    <td class="px-5 py-4 text-center">

                                        <a
                                            href="{{ route('tools.qrcode', ['tool' => $alt->id]) }}"
                                            class="inline-flex items-center gap-2
                                                   bg-blue-600 hover:bg-blue-700
                                                   text-white px-3 py-2
                                                   rounded-lg font-medium
                                                   text-xs transition">

                                            <span>▣</span>
                                            QR Code

                                        </a>

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="px-5 py-4">

                                        <div class="flex justify-center items-center gap-2">

                                            {{-- EDIT --}}
                                            <a
                                                href="{{ route('tools.edit', $alt->id) }}"
                                                title="Edit alat"
                                                class="w-9 h-9 flex items-center justify-center
                                                       rounded-lg
                                                       bg-yellow-100 hover:bg-yellow-200
                                                       dark:bg-yellow-900/30 dark:hover:bg-yellow-900/50
                                                       text-yellow-700 dark:text-yellow-400
                                                       transition">

                                                ✏️

                                            </a>


                                            {{-- DELETE --}}
                                            <form
                                                id="delete-form-{{ $alt->id }}"
                                                action="{{ route('tools.destroy', $alt->id) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="button"
                                                    onclick="confirmDelete({{ $alt->id }})"
                                                    title="Hapus alat"
                                                    class="w-9 h-9 flex items-center justify-center
                                                           rounded-lg
                                                           bg-red-100 hover:bg-red-200
                                                           dark:bg-red-900/30 dark:hover:bg-red-900/50
                                                           text-red-600 dark:text-red-400
                                                           transition"
                                                >

                                                    🗑️

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                {{-- EMPTY --}}
                                <tr>

                                    <td colspan="8" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div class="w-16 h-16 rounded-full
                                                        bg-gray-100 dark:bg-gray-700
                                                        flex items-center justify-center
                                                        text-3xl mb-4">

                                                📦

                                            </div>

                                            <h3 class="font-semibold text-gray-700 dark:text-gray-200">
                                                Belum ada data alat
                                            </h3>

                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                Tambahkan alat pertama ke inventaris laboratorium.
                                            </p>

                                            <a
                                                href="{{ route('tools.create') }}"
                                                class="mt-5 inline-flex items-center gap-2
                                                       bg-blue-600 hover:bg-blue-700
                                                       text-white px-4 py-2
                                                       rounded-lg text-sm font-medium transition"
                                            >

                                                ＋ Tambah Alat

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- FOOTER --}}
                @if ($alat->count() > 0)

                    <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700
                                bg-gray-50/50 dark:bg-gray-700/20">

                        <p class="text-xs text-gray-500 dark:text-gray-400">

                            Menampilkan
                            <span class="font-semibold">
                                {{ $alat->count() }}
                            </span>
                            data alat.

                        </p>

                    </div>

                @endif

            </div>


            {{-- FOOTER --}}
            <div class="text-center mt-8 text-xs text-gray-400">

                SmartLab • Sistem Peminjaman Alat • TCC

            </div>

        </div>
    </div>


    {{-- SWEETALERT DELETE --}}
    <script>

        function confirmDelete(id) {

            Swal.fire({

                title: 'Yakin ingin menghapus?',

                text: 'Data alat akan dihapus secara permanen!',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#dc2626',

                cancelButtonColor: '#6b7280',

                confirmButtonText: 'Ya, Hapus!',

                cancelButtonText: 'Batal',

                reverseButtons: true

            }).then((result) => {

                if (result.isConfirmed) {

                    document
                        .getElementById('delete-form-' + id)
                        .submit();

                }

            });

        }

    </script>

</x-app-layout>