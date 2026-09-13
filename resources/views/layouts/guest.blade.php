<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartLab</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-cover bg-center relative"
        style="background-image:url('{{ asset('image/background.jpg') }}')">

        {{-- Overlay gelap --}}
        <div class="absolute inset-0 bg-slate-900/60"></div>

        <div class="relative z-10">
            {{ $slot }}
        </div>

    </div>

</body>
</html>