<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manajemen Pengguna
            </p>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Tambah User
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-xl">
                            👤
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Tambah Pengguna Baru
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Buat akun Admin, Petugas, atau Peminjam.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form action="{{ route('user.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Nama --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Nama Lengkap
                        </label>

                        <input type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama pengguna"
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
                            value="{{ old('email') }}"
                            placeholder="contoh@email.com"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Password
                            </label>

                            <input type="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Konfirmasi Password
                            </label>

                            <input type="password"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        </div>

                    </div>

                    {{-- Role --}}
                    <div>
                        <label class="block text-sm font-semibold mb-2">
                            Role Pengguna
                        </label>

                        <select name="role"
                            class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">

                            <option value="">-- Pilih Role --</option>

                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"
                                    {{ old('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach

                        </select>

                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Info Role --}}
                    <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 p-4">
                        <p class="font-semibold text-blue-700 dark:text-blue-300 mb-2">
                            Hak Akses Role
                        </p>

                        <div class="space-y-1 text-sm">
                            <p>🔴 **Admin** — Mengelola seluruh sistem.</p>
                            <p>🟡 **Petugas** — Menyetujui peminjaman & laporan.</p>
                            <p>🟢 **Peminjam** — Scan QR dan mengajukan peminjaman.</p>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">

                        <a href="{{ route('user.index') }}"
                            class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 transition">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow">
                            💾 Simpan User
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>