<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            QR Code Alat
        </h2>
    </x-slot>

    <div class="py-10">

        <div class="max-w-md mx-auto px-4">

            {{-- Kartu QR --}}
            <div
                id="print-area"
                class="bg-white rounded-2xl shadow-lg p-8 text-center"
            >

                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $alat->nama_alat }}
                </h1>

                <p class="text-gray-500 mt-1">
                    Kode Alat: {{ $alat->kode_alat }}
                </p>

                {{-- QR CODE --}}
                <div class="flex justify-center mt-6">

                    {!! QrCode::size(250)->generate(
                        route('scan', ['token' => $alat->qr_token])
                    ) !!}

                </div>

                <p class="text-sm text-gray-500 mt-5">
                    Scan QR Code untuk melihat detail alat
                </p>

                <p class="text-xs text-gray-400 mt-2">
                    Sistem Peminjaman Alat
                </p>

            </div>


            {{-- Tombol --}}
            <div class="flex justify-center gap-3 mt-6 print:hidden">

                <a
                    href="{{ route('tools.index') }}"
                    class="px-5 py-3 bg-gray-200
                           text-gray-700 rounded-xl
                           hover:bg-gray-300 transition"
                >
                    ← Kembali
                </a>

                <button
                    onclick="window.print()"
                    class="px-5 py-3 bg-blue-600
                           text-white rounded-xl
                           hover:bg-blue-700 transition"
                >
                    🖨️ Cetak QR Code
                </button>

            </div>

        </div>

    </div>


    {{-- CSS PRINT --}}
    <style>

        @media print {

            body * {
                visibility: hidden;
            }

            #print-area,
            #print-area * {
                visibility: visible;
            }

            #print-area {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);

                width: 320px;

                box-shadow: none !important;
                border: 2px solid #000;
                border-radius: 12px;

                padding: 25px;
            }

            @page {
                size: A4;
                margin: 0;
            }

        }

    </style>

</x-app-layout>