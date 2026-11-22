<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">

        <div class="flex items-center gap-3">

            <a href="{{ route('scanner') }}"
               class="w-9 h-9 flex items-center justify-center
                      rounded-lg
                      bg-gray-100 hover:bg-blue-100
                      dark:bg-gray-700 dark:hover:bg-gray-600
                      text-gray-600 dark:text-gray-300
                      hover:text-blue-600
                      transition">

                ←

            </a>

            <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    SmartLab
                </p>

                <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                    Detail Alat
                </h2>
            </div>

        </div>

    </x-slot>


    {{-- CONTENT --}}
    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">


            {{-- BREADCRUMB --}}
            <div class="flex items-center gap-2 text-sm
                        text-gray-500 dark:text-gray-400 mb-5">

                <a href="{{ route('scanner') }}"
                   class="hover:text-blue-600 transition">

                    Scanner

                </a>

                <span>›</span>

                <span class="text-gray-700 dark:text-gray-200">
                    Detail Alat
                </span>

            </div>


            {{-- MAIN CARD --}}
            <div class="bg-white dark:bg-gray-800
                        rounded-3xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm overflow-hidden">


                <div class="grid grid-cols-1 lg:grid-cols-2">


                    {{-- ========================= --}}
                    {{-- FOTO ALAT --}}
                    {{-- ========================= --}}
                    <div class="bg-gray-50 dark:bg-gray-900/40
                                p-6 sm:p-8">

                        <div class="relative
                                    h-[320px] sm:h-[400px]
                                    rounded-2xl
                                    bg-white dark:bg-gray-800
                                    border border-gray-100 dark:border-gray-700
                                    overflow-hidden
                                    flex items-center justify-center">

                            @if($alat->gambar)

                                <img
                                    src="{{ 'https://smartlab-image.ubaidillahrahmann.workers.dev/' . $alt->gambar }}"
                                    alt="{{ $alat->nama_alat }}"
                                    class="w-full h-full object-contain p-5"
                                >

                            @else

                                <div class="text-center text-gray-400">

                                    <div class="w-24 h-24 mx-auto
                                                rounded-2xl
                                                bg-gray-100 dark:bg-gray-700
                                                flex items-center justify-center
                                                text-4xl mb-4">

                                        📦

                                    </div>

                                    <p class="font-medium">
                                        Foto alat belum tersedia
                                    </p>

                                    <p class="text-xs mt-1">
                                        Belum ada gambar yang diunggah
                                    </p>

                                </div>

                            @endif


                            {{-- BADGE STATUS --}}
                            <div class="absolute top-4 left-4">

                                @if($alat->jumlah_tersedia > 0)

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-green-100
                                                 text-green-700
                                                 text-xs font-bold
                                                 shadow-sm">

                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                        Tersedia

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-2
                                                 px-3 py-1.5
                                                 rounded-full
                                                 bg-red-100
                                                 text-red-700
                                                 text-xs font-bold
                                                 shadow-sm">

                                        <span class="w-2 h-2 rounded-full bg-red-500"></span>

                                        Tidak Tersedia

                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- KETERANGAN FOTO --}}
                        <div class="mt-4 flex items-center gap-2
                                    text-xs text-gray-500 dark:text-gray-400">

                            <span>📷</span>

                            <span>
                                Foto alat laboratorium
                            </span>

                        </div>

                    </div>



                    {{-- ========================= --}}
                    {{-- DETAIL --}}
                    {{-- ========================= --}}
                    <div class="p-6 sm:p-8">


                        {{-- KATEGORI --}}
                        <div class="mb-3">

                            <span class="inline-flex
                                         px-3 py-1
                                         rounded-lg
                                         bg-blue-50 dark:bg-blue-900/30
                                         text-blue-600 dark:text-blue-400
                                         text-xs font-semibold">

                                {{ $alat->kategori->nama_kategori ?? 'Tanpa Kategori' }}

                            </span>

                        </div>


                        {{-- NAMA --}}
                        <h1 class="text-3xl sm:text-4xl
                                   font-extrabold
                                   text-gray-900 dark:text-white
                                   leading-tight">

                            {{ $alat->nama_alat }}

                        </h1>


                        {{-- KODE --}}
                        <div class="flex items-center gap-2 mt-3">

                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Kode alat
                            </span>

                            <span class="px-2.5 py-1
                                         rounded-lg
                                         bg-gray-100 dark:bg-gray-700
                                         text-gray-700 dark:text-gray-200
                                         text-xs font-bold">

                                {{ $alat->kode_alat }}

                            </span>

                        </div>


                        {{-- DIVIDER --}}
                        <div class="border-t border-gray-100
                                    dark:border-gray-700
                                    my-6">
                        </div>


                        {{-- INFO --}}
                        <div class="grid grid-cols-2 gap-3">


                            {{-- STOK --}}
                            <div class="p-4
                                        rounded-2xl
                                        bg-gray-50 dark:bg-gray-700/50
                                        border border-gray-100
                                        dark:border-gray-600">

                                <div class="flex items-center gap-2">

                                    <div class="w-9 h-9
                                                rounded-lg
                                                bg-blue-100 dark:bg-blue-900/30
                                                flex items-center justify-center">

                                        📦

                                    </div>

                                    <p class="text-xs
                                              text-gray-500
                                              dark:text-gray-400">

                                        Stok tersedia

                                    </p>

                                </div>


                                <p class="mt-3 text-2xl font-extrabold
                                          text-gray-900 dark:text-white">

                                    {{ $alat->jumlah_tersedia }}

                                </p>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    unit
                                </p>

                            </div>



                            {{-- KONDISI --}}
                            <div class="p-4
                                        rounded-2xl
                                        bg-gray-50 dark:bg-gray-700/50
                                        border border-gray-100
                                        dark:border-gray-600">

                                <div class="flex items-center gap-2">

                                    <div class="w-9 h-9
                                                rounded-lg
                                                bg-green-100 dark:bg-green-900/30
                                                flex items-center justify-center">

                                        ✓

                                    </div>

                                    <p class="text-xs
                                              text-gray-500
                                              dark:text-gray-400">

                                        Kondisi

                                    </p>

                                </div>


                                <p class="mt-3 text-lg font-bold
                                          text-gray-900 dark:text-white">

                                    {{ ucfirst($alat->kondisi) }}

                                </p>

                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    Kondisi alat
                                </p>

                            </div>

                        </div>



                        {{-- ========================= --}}
                        {{-- FORM PEMINJAMAN --}}
                        {{-- ========================= --}}
                        @if($alat->jumlah_tersedia > 0)

                            <div class="mt-7">

                                <div class="mb-4">

                                    <h3 class="text-lg font-bold
                                               text-gray-900 dark:text-white">

                                        Ajukan Peminjaman

                                    </h3>

                                    <p class="text-sm
                                              text-gray-500 dark:text-gray-400
                                              mt-1">

                                        Isi jumlah alat dan rencana pengembalian.

                                    </p>

                                </div>


                                <form
                                    action="{{ route('pengajuan.store') }}"
                                    method="POST"
                                >

                                    @csrf


                                    {{-- USER --}}
                                    <input
                                        type="hidden"
                                        name="user_id"
                                        value="{{ auth()->id() }}"
                                    >


                                    {{-- ALAT --}}
                                    <input
                                        type="hidden"
                                        name="alat_id"
                                        value="{{ $alat->id }}"
                                    >


                                    <div class="space-y-4">


                                        {{-- JUMLAH --}}
                                        <div>

                                            <label
                                                class="block text-sm font-semibold
                                                       text-gray-700 dark:text-gray-300"
                                            >

                                                Jumlah

                                            </label>

                                            <div class="relative mt-2">

                                                <input
                                                    type="number"
                                                    name="jumlah"
                                                    value="1"
                                                    min="1"
                                                    max="{{ $alat->jumlah_tersedia }}"
                                                    required
                                                    class="w-full rounded-xl
                                                           border-gray-300
                                                           dark:border-gray-600
                                                           dark:bg-gray-700
                                                           dark:text-white
                                                           focus:border-blue-500
                                                           focus:ring-blue-500
                                                           pr-16"
                                                >

                                                <span class="absolute right-4 top-1/2
                                                             -translate-y-1/2
                                                             text-xs text-gray-400">

                                                    max {{ $alat->jumlah_tersedia }}

                                                </span>

                                            </div>

                                        </div>


                                        {{-- TANGGAL --}}
                                        <div>

                                            <label
                                                class="block text-sm font-semibold
                                                       text-gray-700 dark:text-gray-300"
                                            >

                                                Rencana Pengembalian

                                            </label>

                                            <input
                                                type="date"
                                                name="tanggal_kembali_rencana"
                                                required
                                                min="{{ date('Y-m-d') }}"
                                                class="mt-2 w-full rounded-xl
                                                       border-gray-300
                                                       dark:border-gray-600
                                                       dark:bg-gray-700
                                                       dark:text-white
                                                       focus:border-blue-500
                                                       focus:ring-blue-500"
                                            >

                                        </div>


                                        {{-- INFO --}}
                                        <div class="flex items-start gap-3
                                                    p-3 rounded-xl
                                                    bg-blue-50 dark:bg-blue-900/20
                                                    text-blue-700 dark:text-blue-300">

                                            <span class="text-sm">
                                                ℹ️
                                            </span>

                                            <p class="text-xs leading-relaxed">

                                                Pastikan jumlah dan tanggal pengembalian
                                                sudah sesuai sebelum mengajukan peminjaman.

                                            </p>

                                        </div>


                                        {{-- BUTTON --}}
                                        <button
                                            type="submit"
                                            class="w-full
                                                   inline-flex items-center
                                                   justify-center gap-2
                                                   bg-blue-600
                                                   hover:bg-blue-700
                                                   text-white
                                                   font-bold
                                                   py-3.5 px-5
                                                   rounded-xl
                                                   transition
                                                   shadow-sm
                                                   hover:shadow-md"
                                        >

                                            <span>📋</span>

                                            Ajukan Peminjaman

                                        </button>

                                    </div>

                                </form>

                            </div>

                        @else


                            {{-- STOK HABIS --}}
                            <div class="mt-7">

                                <div class="p-5
                                            rounded-2xl
                                            bg-red-50 dark:bg-red-900/20
                                            border border-red-100
                                            dark:border-red-900/30
                                            text-center">

                                    <div class="w-12 h-12 mx-auto
                                                rounded-full
                                                bg-red-100 dark:bg-red-900/40
                                                flex items-center justify-center
                                                text-xl">

                                        !

                                    </div>

                                    <h3 class="mt-3 font-bold
                                               text-red-700 dark:text-red-400">

                                        Alat Sedang Tidak Tersedia

                                    </h3>

                                    <p class="mt-1 text-xs
                                              text-red-600/80
                                              dark:text-red-300/70">

                                        Stok alat saat ini sedang habis.

                                    </p>

                                </div>

                            </div>

                        @endif


                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="text-center mt-8 text-xs text-gray-400">

                SmartLab • Sistem Peminjaman Alat • SMKN 1 Sumenep

            </div>

        </div>

    </div>

</x-app-layout>