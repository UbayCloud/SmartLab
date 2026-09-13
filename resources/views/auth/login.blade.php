<x-guest-layout>
<div class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        {{-- Logo & Judul --}}
        <div class="text-center mb-6">
            <img src="{{ asset('image/logo.png') }}"
                class="w-20 h-20 mx-auto mb-3 drop-shadow-lg"
                alt="Logo">

            <h1 class="text-3xl font-bold text-white">
                SmartLab
            </h1>

            <p class="text-blue-100 text-sm">
                Web Peminjaman Alat
            </p>
        </div>

        {{-- Card Login --}}
        <div class="backdrop-blur-xl bg-white/95 rounded-3xl shadow-2xl p-8 border border-white/20">

            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-800">
                    Selamat Datang 👋
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    Login menggunakan akun yang telah diberikan
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>

                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400">📧</span>

                        <input id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="nama@email.com"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                {{-- Password --}}
                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>

                    <div class="relative">
                        <span class="absolute left-3 top-3 text-gray-400">🔒</span>

                        <input id="password"
                            type="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full pl-10 pr-12 py-3 rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                        <button type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-3 text-gray-400 hover:text-indigo-600">

                            <span id="eyeOpen">👁️</span>
                            <span id="eyeClose" class="hidden">🙈</span>

                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                {{-- Lupa Password --}}
                <div class="flex justify-end mb-6">
                    <a href="{{ route('password.simple') }}"
                        class="text-sm text-indigo-600 hover:underline">
                        Lupa Password?
                    </a>
                </div>

                {{-- Tombol --}}
                <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition duration-200 shadow-lg">
                    Login
                </button>

            </form>

            <div class="mt-6 pt-5 border-t text-center">
                <p class="text-xs text-gray-400">
                    © {{ date('Y') }} SmartLab • TCC
                </p>
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

</x-guest-layout>