<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">

        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Transaksi
            </p>

            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Data Peminjaman
            </h2>
        </div>

    </x-slot>


    <div class="py-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- HEADER CARD --}}
            <div class="bg-white dark:bg-gray-800
                        rounded-2xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm
                        p-6 mb-6">

                <div class="flex flex-col md:flex-row
                            md:items-center md:justify-between
                            gap-4">

                    <div>

                        <h3 class="text-lg font-bold
                                   text-gray-800 dark:text-white">

                            Peminjaman Alat

                        </h3>

                        <p class="text-sm
                                  text-gray-500 dark:text-gray-400
                                  mt-1">

                            Kelola data peminjaman alat laboratorium.

                        </p>

                    </div>


                    <a href="{{ route('peminjaman.create') }}"
                       class="inline-flex items-center justify-center
                              gap-2
                              bg-blue-600 hover:bg-blue-700
                              text-white
                              px-5 py-3
                              rounded-xl
                              font-semibold
                              transition
                              shadow-sm">

                        <span>＋</span>

                        Tambah Peminjaman

                    </a>

                </div>

            </div>



            {{-- TABLE --}}
            <div class="bg-white dark:bg-gray-800
                        rounded-2xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm
                        overflow-hidden">


                {{-- TABLE HEADER --}}
                <div class="px-6 py-5
                            border-b border-gray-100
                            dark:border-gray-700">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="text-lg font-bold
                                       text-gray-800 dark:text-white">

                                Riwayat Peminjaman

                            </h3>

                            <p class="text-sm
                                      text-gray-500 dark:text-gray-400
                                      mt-1">

                                {{ $peminjaman->count() }} transaksi tercatat

                            </p>

                        </div>
                    </div>

                </div>



                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">


                        {{-- HEADER --}}
                        <thead class="bg-gray-50 dark:bg-gray-700/50">

                            <tr class="text-left
                                       text-xs font-semibold
                                       uppercase tracking-wider
                                       text-gray-500
                                       dark:text-gray-300">

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


                        {{-- BODY --}}
                        <tbody class="divide-y
                                     divide-gray-100
                                     dark:divide-gray-700">


                            @forelse($peminjaman as $p)

                                <tr class="hover:bg-gray-50
                                           dark:hover:bg-gray-700/40
                                           transition">


                                    {{-- NO --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="text-gray-500
                                                     dark:text-gray-400">

                                            {{ $loop->iteration }}

                                        </span>

                                    </td>



                                    {{-- PEMINJAM --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">


                                            {{-- AVATAR --}}
                                            <div class="w-10 h-10
                                                        rounded-full
                                                        bg-blue-100
                                                        dark:bg-blue-900/30
                                                        flex items-center
                                                        justify-center
                                                        text-blue-600
                                                        dark:text-blue-400
                                                        font-bold">

                                                {{ strtoupper(substr($p->user->name ?? 'U', 0, 1)) }}

                                            </div>


                                            <div>

                                                <p class="font-semibold
                                                          text-gray-800
                                                          dark:text-white">

                                                    {{ $p->user->name ?? 'User' }}

                                                </p>

                                                <p class="text-xs
                                                          text-gray-500
                                                          dark:text-gray-400">

                                                    Peminjam

                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- ALAT --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">


                                            {{-- FOTO --}}
                                            <div class="w-10 h-10
                                                        rounded-lg
                                                        bg-gray-100
                                                        dark:bg-gray-700
                                                        overflow-hidden
                                                        flex items-center
                                                        justify-center
                                                        flex-shrink-0">

                                                @if($p->alat && $p->alat->gambar)

                                                    <img
                                                        src="{{ asset('storage/' . $p->alat->gambar) }}"
                                                        alt="{{ $p->alat->nama_alat }}"
                                                        class="w-full h-full object-cover"
                                                    >

                                                @else

                                                    <span>
                                                        📦
                                                    </span>

                                                @endif

                                            </div>


                                            <div>

                                                <p class="font-semibold
                                                          text-gray-800
                                                          dark:text-white">

                                                    {{ $p->alat->nama_alat ?? '-' }}

                                                </p>

                                                <p class="text-xs
                                                          text-gray-500
                                                          dark:text-gray-400">

                                                    {{ $p->alat->kode_alat ?? '-' }}

                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- JUMLAH --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="inline-flex
                                                     items-center
                                                     justify-center
                                                     min-w-[36px]
                                                     px-2.5 py-1
                                                     rounded-lg
                                                     bg-gray-100
                                                     dark:bg-gray-700
                                                     text-gray-700
                                                     dark:text-gray-200
                                                     font-bold
                                                     text-xs">

                                            {{ $p->jumlah }}

                                        </span>

                                    </td>



                                    {{-- TANGGAL PINJAM --}}
                                    <td class="px-5 py-4 text-center">

                                        <p class="text-gray-700
                                                  dark:text-gray-300">

                                            {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}

                                        </p>

                                    </td>



                                    {{-- TANGGAL KEMBALI --}}
                                    <td class="px-5 py-4 text-center">

                                        <p class="text-gray-700
                                                  dark:text-gray-300">

                                            {{ \Carbon\Carbon::parse($p->tanggal_kembali_rencana)->format('d M Y') }}

                                        </p>

                                    </td>



                                    {{-- STATUS --}}
                                    <td class="px-5 py-4 text-center">

                                        @switch($p->status)


                                            {{-- MENUNGGU --}}
                                            @case('menunggu')

                                                <span class="inline-flex
                                                             items-center gap-2
                                                             px-3 py-1.5
                                                             rounded-full
                                                             bg-yellow-100
                                                             dark:bg-yellow-900/30
                                                             text-yellow-700
                                                             dark:text-yellow-400
                                                             text-xs
                                                             font-semibold">

                                                    <span class="w-2 h-2
                                                                 rounded-full
                                                                 bg-yellow-500">
                                                    </span>

                                                    Menunggu

                                                </span>

                                            @break



                                            {{-- DITOLAK --}}
                                            @case('ditolak')

                                                <span class="inline-flex
                                                             items-center gap-2
                                                             px-3 py-1.5
                                                             rounded-full
                                                             bg-red-100
                                                             dark:bg-red-900/30
                                                             text-red-700
                                                             dark:text-red-400
                                                             text-xs
                                                             font-semibold">

                                                    <span class="w-2 h-2
                                                                 rounded-full
                                                                 bg-red-500">
                                                    </span>

                                                    Ditolak

                                                </span>

                                            @break



                                            {{-- DIPINJAM --}}
                                            @case('dipinjam')

                                                <span class="inline-flex
                                                             items-center gap-2
                                                             px-3 py-1.5
                                                             rounded-full
                                                             bg-blue-100
                                                             dark:bg-blue-900/30
                                                             text-blue-700
                                                             dark:text-blue-400
                                                             text-xs
                                                             font-semibold">

                                                    <span class="w-2 h-2
                                                                 rounded-full
                                                                 bg-blue-500">
                                                    </span>

                                                    Dipinjam

                                                </span>

                                            @break



                                            {{-- SELESAI --}}
                                            @case('selesai')

                                                <span class="inline-flex
                                                             items-center gap-2
                                                             px-3 py-1.5
                                                             rounded-full
                                                             bg-green-100
                                                             dark:bg-green-900/30
                                                             text-green-700
                                                             dark:text-green-400
                                                             text-xs
                                                             font-semibold">

                                                    <span class="w-2 h-2
                                                                 rounded-full
                                                                 bg-green-500">
                                                    </span>

                                                    Selesai

                                                </span>

                                            @break



                                            @default

                                                <span class="inline-flex
                                                             px-3 py-1.5
                                                             rounded-full
                                                             bg-gray-100
                                                             dark:bg-gray-700
                                                             text-gray-600
                                                             dark:text-gray-300
                                                             text-xs
                                                             font-semibold">

                                                    {{ ucfirst($p->status) }}

                                                </span>

                                        @endswitch

                                    </td>



                                    {{-- AKSI --}}
                                    <td class="px-5 py-4">

                                        <div class="flex
                                                    justify-center
                                                    items-center
                                                    gap-2">


                                            @switch($p->status)


                                                {{-- SELESAI --}}
                                                @case('selesai')

                                                    <span class="inline-flex
                                                                 items-center gap-1
                                                                 text-xs
                                                                 text-green-600
                                                                 dark:text-green-400
                                                                 font-medium">

                                                        ✓ Dikembalikan

                                                    </span>

                                                @break



                                                {{-- DITOLAK --}}
                                                @case('ditolak')

                                                    <span class="inline-flex
                                                                 items-center gap-1
                                                                 text-xs
                                                                 text-gray-500
                                                                 dark:text-gray-400">

                                                        — Ditolak

                                                    </span>

                                                @break



                                                {{-- DEFAULT --}}
                                                @default

                                                    {{-- EDIT --}}
                                                    <a
                                                        href="{{ route('peminjaman.edit', $p->id) }}"
                                                        title="Edit peminjaman"
                                                        class="w-9 h-9
                                                               flex items-center
                                                               justify-center
                                                               rounded-lg
                                                               bg-yellow-100
                                                               hover:bg-yellow-200
                                                               dark:bg-yellow-900/30
                                                               dark:hover:bg-yellow-900/50
                                                               text-yellow-700
                                                               dark:text-yellow-400
                                                               transition"
                                                    >

                                                        ✏️

                                                    </a>


                                                    {{-- HAPUS --}}
                                                    <form
                                                        id="delete-form-{{ $p->id }}"
                                                        action="{{ route('peminjaman.destroy', $p->id) }}"
                                                        method="POST"
                                                    >

                                                        @csrf
                                                        @method('DELETE')


                                                        <button
                                                            type="button"
                                                            onclick="confirmDelete({{ $p->id }})"
                                                            title="Hapus peminjaman"
                                                            class="w-9 h-9
                                                                   flex items-center
                                                                   justify-center
                                                                   rounded-lg
                                                                   bg-red-100
                                                                   hover:bg-red-200
                                                                   dark:bg-red-900/30
                                                                   dark:hover:bg-red-900/50
                                                                   text-red-600
                                                                   dark:text-red-400
                                                                   transition"
                                                        >

                                                            🗑️

                                                        </button>

                                                    </form>

                                            @endswitch

                                        </div>

                                    </td>

                                </tr>


                            @empty


                                {{-- EMPTY --}}
                                <tr>

                                    <td colspan="8"
                                        class="px-6 py-16 text-center">

                                        <div class="flex flex-col
                                                    items-center">

                                            <div class="w-16 h-16
                                                        rounded-full
                                                        bg-gray-100
                                                        dark:bg-gray-700
                                                        flex items-center
                                                        justify-center
                                                        text-3xl mb-4">

                                                📋

                                            </div>


                                            <h3 class="font-semibold
                                                       text-gray-700
                                                       dark:text-gray-200">

                                                Belum ada data peminjaman

                                            </h3>


                                            <p class="text-sm
                                                      text-gray-500
                                                      dark:text-gray-400
                                                      mt-1">

                                                Belum ada transaksi peminjaman
                                                yang tercatat.

                                            </p>


                                            <a
                                                href="{{ route('peminjaman.create') }}"
                                                class="mt-5
                                                       inline-flex
                                                       items-center
                                                       gap-2
                                                       bg-blue-600
                                                       hover:bg-blue-700
                                                       text-white
                                                       px-4 py-2
                                                       rounded-lg
                                                       text-sm
                                                       font-medium
                                                       transition"
                                            >

                                                ＋ Tambah Peminjaman

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>



                {{-- FOOTER --}}
                @if($peminjaman->count() > 0)

                    <div class="px-6 py-4
                                border-t
                                border-gray-100
                                dark:border-gray-700
                                bg-gray-50/50
                                dark:bg-gray-700/20">

                        <p class="text-xs
                                  text-gray-500
                                  dark:text-gray-400">

                            Menampilkan
                            <span class="font-semibold">
                                {{ $peminjaman->count() }}
                            </span>
                            transaksi peminjaman.

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



    {{-- SWEETALERT --}}
    <script>

        function confirmDelete(id) {

            Swal.fire({

                title: 'Yakin ingin menghapus?',

                text: 'Data peminjaman akan dihapus permanen!',

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