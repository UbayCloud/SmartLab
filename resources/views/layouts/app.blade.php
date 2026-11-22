<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SmartLab | Peminjaman Alat</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    {{-- Flatpickr --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Custom Styles --}}
    @stack('styles')
</head>


<body class="font-sans antialiased
             bg-gray-50 dark:bg-gray-900
             text-gray-800 dark:text-gray-100">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        {{-- Navigation --}}
        @include('layouts.navigation')


        {{-- Page Heading --}}
        @isset($header)

            <header class="bg-white dark:bg-gray-800
                           border-b border-gray-100 dark:border-gray-700">

                <div class="max-w-7xl mx-auto
                            py-5 px-4 sm:px-6 lg:px-8">

                    {{ $header }}

                </div>

            </header>

        @endisset


        {{-- Page Content --}}
        <main>

            {{ $slot }}

        </main>

    </div>


    {{-- ============================= --}}
    {{-- SWEETALERT2 --}}
    {{-- ============================= --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    {{-- ============================= --}}
    {{-- FLASH MESSAGE --}}
    {{-- ============================= --}}

    @if (session('success'))

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                Swal.fire({

                    icon: 'success',

                    title: 'Berhasil',

                    text: @json(session('success')),

                    timer: 2000,

                    showConfirmButton: false,

                    timerProgressBar: true

                });

            });

        </script>

    @endif


    @if (session('error'))

        <script>

            document.addEventListener('DOMContentLoaded', function () {

                Swal.fire({

                    icon: 'error',

                    title: 'Gagal',

                    text: @json(session('error')),

                    confirmButtonText: 'OK'

                });

            });

        </script>

    @endif


    {{-- ============================= --}}
    {{-- FLATPICKR --}}
    {{-- ============================= --}}

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    {{-- ============================= --}}
    {{-- PAGE SCRIPTS --}}
    {{-- ============================= --}}

    @stack('scripts')

</body>

</html>
