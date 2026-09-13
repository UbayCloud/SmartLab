<x-app-layout>

    {{-- HEADER --}}
    <x-slot name="header">

        <div class="flex items-center gap-3">

            <a href="{{ route('peminjam.dashboard') }}"
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
                    Scan QR Alat
                </h2>
            </div>

        </div>

    </x-slot>


    {{-- CONTENT --}}
    <div class="py-8">

        <div class="max-w-2xl mx-auto px-4 sm:px-6">


            {{-- INTRO --}}
            <div class="text-center mb-6">

                <div class="w-16 h-16 mx-auto
                            rounded-2xl
                            bg-blue-100 dark:bg-blue-900/30
                            flex items-center justify-center
                            text-3xl mb-4">

                    📷

                </div>

                <h1 class="text-2xl sm:text-3xl
                           font-extrabold
                           text-gray-900 dark:text-white">

                    Scan QR Alat

                </h1>

                <p class="mt-2 text-sm
                          text-gray-500 dark:text-gray-400
                          max-w-md mx-auto">

                    Gunakan kamera untuk memindai QR Code
                    yang terdapat pada alat laboratorium.

                </p>

            </div>



            {{-- SCANNER CARD --}}
            <div class="bg-white dark:bg-gray-800
                        rounded-3xl
                        shadow-sm
                        border border-gray-100 dark:border-gray-700
                        overflow-hidden">


                {{-- CARD HEADER --}}
                <div class="px-6 py-5
                            border-b border-gray-100
                            dark:border-gray-700">

                    <div class="flex items-center justify-between">

                        <div>

                            <h3 class="font-bold
                                       text-gray-900 dark:text-white">

                                Kamera Scanner

                            </h3>

                            <p class="text-xs
                                      text-gray-500 dark:text-gray-400
                                      mt-1">

                                Arahkan QR Code ke area pemindaian.

                            </p>

                        </div>


                        {{-- STATUS --}}
                        <div class="flex items-center gap-2
                                    px-3 py-1.5
                                    rounded-full
                                    bg-green-50 dark:bg-green-900/20
                                    text-green-600 dark:text-green-400
                                    text-xs font-semibold">

                            <span class="w-2 h-2
                                         rounded-full
                                         bg-green-500
                                         animate-pulse">
                            </span>

                            Siap

                        </div>

                    </div>

                </div>



                {{-- CAMERA --}}
                <div class="p-5 sm:p-6">

                    <div class="relative
                                bg-black
                                rounded-2xl
                                overflow-hidden
                                p-2">

                        {{-- Scanner --}}
                        <div id="reader"
                             class="w-full overflow-hidden rounded-xl">
                        </div>


                        {{-- SCAN CORNERS --}}
                        <div class="absolute inset-5 pointer-events-none">

                            {{-- TOP LEFT --}}
                            <div class="absolute top-0 left-0
                                        w-10 h-10
                                        border-t-4 border-l-4
                                        border-white
                                        rounded-tl-xl">
                            </div>


                            {{-- TOP RIGHT --}}
                            <div class="absolute top-0 right-0
                                        w-10 h-10
                                        border-t-4 border-r-4
                                        border-white
                                        rounded-tr-xl">
                            </div>


                            {{-- BOTTOM LEFT --}}
                            <div class="absolute bottom-0 left-0
                                        w-10 h-10
                                        border-b-4 border-l-4
                                        border-white
                                        rounded-bl-xl">
                            </div>


                            {{-- BOTTOM RIGHT --}}
                            <div class="absolute bottom-0 right-0
                                        w-10 h-10
                                        border-b-4 border-r-4
                                        border-white
                                        rounded-br-xl">
                            </div>

                        </div>

                    </div>



                    {{-- STATUS --}}
                    <div class="mt-5 flex items-center justify-center gap-2">

                        <span class="relative flex h-3 w-3">

                            <span class="animate-ping absolute
                                         inline-flex h-full w-full
                                         rounded-full bg-green-400
                                         opacity-75">
                            </span>

                            <span class="relative
                                         inline-flex
                                         rounded-full
                                         h-3 w-3
                                         bg-green-500">
                            </span>

                        </span>

                        <span class="text-sm font-medium
                                     text-gray-600 dark:text-gray-300">

                            Kamera siap digunakan

                        </span>

                    </div>

                </div>

            </div>



            {{-- CARA MENGGUNAKAN --}}
            <div class="mt-5
                        bg-blue-50 dark:bg-blue-900/20
                        border border-blue-100 dark:border-blue-900/30
                        rounded-2xl
                        p-5">

                <div class="flex gap-4">

                    <div class="w-10 h-10 flex-shrink-0
                                rounded-xl
                                bg-blue-100 dark:bg-blue-900/40
                                flex items-center justify-center
                                text-lg">

                        ℹ️

                    </div>


                    <div>

                        <h3 class="font-bold
                                   text-blue-800 dark:text-blue-300">

                            Cara menggunakan

                        </h3>

                        <div class="mt-2 space-y-2
                                    text-sm
                                    text-blue-700 dark:text-blue-300">

                            <p>
                                <span class="font-bold">1.</span>
                                Izinkan akses kamera saat diminta.
                            </p>

                            <p>
                                <span class="font-bold">2.</span>
                                Arahkan kamera ke QR Code alat.
                            </p>

                            <p>
                                <span class="font-bold">3.</span>
                                Tunggu sampai QR Code berhasil terbaca.
                            </p>

                            <p>
                                <span class="font-bold">4.</span>
                                Kamu akan diarahkan ke detail alat.
                            </p>

                        </div>

                    </div>

                </div>

            </div>



            {{-- TIPS --}}
            <div class="mt-5
                        grid grid-cols-1 sm:grid-cols-3 gap-3">

                <div class="bg-white dark:bg-gray-800
                            border border-gray-100 dark:border-gray-700
                            rounded-xl p-4 text-center">

                    <div class="text-xl mb-2">
                        💡
                    </div>

                    <p class="text-xs font-semibold
                              text-gray-700 dark:text-gray-200">

                        Pencahayaan cukup

                    </p>

                </div>


                <div class="bg-white dark:bg-gray-800
                            border border-gray-100 dark:border-gray-700
                            rounded-xl p-4 text-center">

                    <div class="text-xl mb-2">
                        📱
                    </div>

                    <p class="text-xs font-semibold
                              text-gray-700 dark:text-gray-200">

                        Jaga kamera stabil

                    </p>

                </div>


                <div class="bg-white dark:bg-gray-800
                            border border-gray-100 dark:border-gray-700
                            rounded-xl p-4 text-center">

                    <div class="text-xl mb-2">
                        🔍
                    </div>

                    <p class="text-xs font-semibold
                              text-gray-700 dark:text-gray-200">

                        Dekatkan QR Code

                    </p>

                </div>

            </div>



            {{-- FOOTER --}}
            <div class="text-center mt-8 text-xs text-gray-400">

                SmartLab • Sistem Peminjaman Alat • SMKN 1 Sumenep

            </div>

        </div>

    </div>



    {{-- QR SCANNER LIBRARY --}}
    <script src="https://unpkg.com/html5-qrcode"></script>


    <script>

        function onScanSuccess(decodedText, decodedResult) {

            // Hentikan scanner
            scanner.clear();

            // Arahkan ke URL yang terdapat pada QR Code
            window.location.href = decodedText;

        }


        function onScanFailure(error) {

            // Tidak perlu menampilkan error
            // karena fungsi ini dipanggil terus
            // ketika QR belum terbaca.

        }


        let scanner = new Html5QrcodeScanner(

            "reader",

            {
                fps: 10,

                qrbox: {
                    width: 250,
                    height: 250
                },

                rememberLastUsedCamera: true,

                showTorchButtonIfSupported: true

            }

        );


        scanner.render(

            onScanSuccess,

            onScanFailure

        );

    </script>

</x-app-layout>