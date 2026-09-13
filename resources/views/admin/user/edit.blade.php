<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Pengguna
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Edit User
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-xl">
                            ✏️
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Edit Data Pengguna
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Perbarui informasi akun dan hak akses pengguna.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('user.update', $user->id) }}"
                    method="POST"
                    class="p-6 space-y-6">

                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Email
                        </label>

                        <input type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Password Baru
                            </label>

                            <input
                                type="password"
                                name="password"
                                placeholder="Kosongkan jika tidak diubah"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Konfirmasi Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Ulangi password baru"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Role Pengguna
                        </label>

                        <select
                            name="role"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @foreach($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                            @endforeach

                        </select>

                        @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Info --}}
                    <div class="rounded-xl bg-yellow-50 dark:bg-yellow-900/20 p-4">
                        <div class="flex gap-3">
                            <div class="text-yellow-600 text-lg">⚠️</div>

                            <div>
                                <p class="font-semibold text-yellow-700 dark:text-yellow-300">
                                    Perhatian
                                </p>

                                <p class="text-sm text-yellow-600 dark:text-yellow-400 mt-1">
                                    Jika password dikosongkan, maka password lama akan tetap digunakan.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">

                        <a href="{{ route('user.index') }}"
                            class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow">
                            💾 Update User
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>