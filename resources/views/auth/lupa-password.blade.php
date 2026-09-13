<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartLab | Lupa Password</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="font-sans antialiased">

<div class="min-h-screen bg-cover bg-center relative"
    style="background-image:url('{{ asset('image/background.jpg') }}')">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-slate-900/60"></div>

    <div class="relative z-10 min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md">

            {{-- Logo --}}
            <div class="text-center mb-6">
                <img src="{{ asset('image/logo.png') }}"
                    class="w-20 h-20 mx-auto mb-3"
                    alt="Logo">

                <h1 class="text-3xl font-bold text-white">
                    SmartLab
                </h1>

                <p class="text-blue-100 text-sm">
                    Reset Password Akun
                </p>
            </div>

            {{-- Card --}}
            <div class="backdrop-blur-xl bg-white/95 rounded-3xl shadow-2xl p-8 border border-white/20">

                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        Lupa Password
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Masukkan username dan password baru.
                    </p>
                </div>

                {{-- Alert --}}
                @if(session('error'))
                    <div class="mb-4 rounded-xl bg-red-100 text-red-700 px-4 py-3 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="mb-4 rounded-xl bg-green-100 text-green-700 px-4 py-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('lupapassword') }}">
                    @csrf

                    {{-- Username --}}
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Username
                        </label>

                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-400">👤</span>

                            <input type="text"
                                name="username"
                                required
                                placeholder="Masukkan username"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    {{-- Password Baru --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru
                        </label>

                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-400">🔒</span>

                            <input id="password"
                                type="password"
                                name="password"
                                required
                                placeholder="Password baru"
                                class="w-full pl-10 pr-12 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                            <button type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-3 text-gray-400 hover:text-indigo-600">

                                <span id="eyeOpen">👁️</span>
                                <span id="eyeClose" class="hidden">🙈</span>

                            </button>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition shadow-lg">
                        Reset Password
                    </button>

                    <a href="{{ route('login') }}"
                        class="block text-center mt-4 text-sm text-indigo-600 hover:underline">
                        ← Kembali ke Login
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

<script>
function togglePassword(){
    const input = document.getElementById('password');
    const open = document.getElementById('eyeOpen');
    const close = document.getElementById('eyeClose');

    if(input.type === 'password'){
        input.type = 'text';
        open.classList.add('hidden');
        close.classList.remove('hidden');
    }else{
        input.type = 'password';
        open.classList.remove('hidden');
        close.classList.add('hidden');
    }
}
</script>

</body>
</html>