<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Manajemen Pengguna
                </p>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Daftar User
                </h2>
            </div>

            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ $users->count() }} user terdaftar
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm p-6 mb-6">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="w-11 h-11 rounded-xl
                                    bg-blue-100 dark:bg-blue-900/30
                                    flex items-center justify-center text-xl">
                            👥
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Manajemen User
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Kelola akun pengguna dan hak akses sistem SmartLab.
                            </p>
                        </div>

                    </div>

                    <a href="{{ route('user.create') }}"
                        class="inline-flex items-center justify-center gap-2
                               bg-blue-600 hover:bg-blue-700
                               text-white px-5 py-3 rounded-xl
                               font-semibold transition shadow-sm">

                        <span>＋</span>
                        Tambah User

                    </a>

                </div>

            </div>


            {{-- Table Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl
                        border border-gray-100 dark:border-gray-700
                        shadow-sm overflow-hidden">

                {{-- Table Header --}}
                <div class="px-6 py-5
                            border-b border-gray-100 dark:border-gray-700">

                    <div class="flex items-center justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                Data Pengguna
                            </h3>

                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Daftar akun yang terdaftar di sistem.
                            </p>
                        </div>
                    </div>

                </div>


                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 dark:bg-gray-700/50">

                            <tr class="text-left text-xs font-semibold
                                       uppercase tracking-wider
                                       text-gray-500 dark:text-gray-300">

                                <th class="px-5 py-4 text-center">
                                    No
                                </th>

                                <th class="px-5 py-4">
                                    Pengguna
                                </th>

                                <th class="px-5 py-4">
                                    Email
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Role
                                </th>

                                <th class="px-5 py-4 text-center">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">

                            @forelse ($users as $user)

                                <tr class="hover:bg-gray-50
                                           dark:hover:bg-gray-700/40
                                           transition">

                                    {{-- No --}}
                                    <td class="px-5 py-4 text-center">

                                        <span class="text-gray-500 dark:text-gray-400">
                                            {{ $loop->iteration }}
                                        </span>

                                    </td>


                                    {{-- User --}}
                                    <td class="px-5 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="w-11 h-11 rounded-full
                                                        bg-blue-100 dark:bg-blue-900/30
                                                        flex items-center justify-center
                                                        text-blue-600 dark:text-blue-400
                                                        font-bold text-lg">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </div>

                                            <div class="min-w-0">

                                                <p class="font-semibold
                                                          text-gray-800 dark:text-white
                                                          truncate">

                                                    {{ $user->name }}

                                                </p>

                                                <p class="text-xs
                                                          text-gray-500 dark:text-gray-400
                                                          mt-1">

                                                    Pengguna SmartLab

                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Email --}}
                                    <td class="px-5 py-4">

                                        <span class="text-gray-600 dark:text-gray-300">
                                            {{ $user->email }}
                                        </span>

                                    </td>


                                    {{-- Role --}}
                                    <td class="px-5 py-4 text-center">

                                        @if($user->roles->count())

                                            @foreach($user->getRoleNames() as $role)

                                                @if($role === 'admin')

                                                    <span class="inline-flex items-center gap-2
                                                                 px-3 py-1.5 rounded-full
                                                                 bg-purple-100 dark:bg-purple-900/30
                                                                 text-purple-700 dark:text-purple-400
                                                                 text-xs font-semibold">

                                                        <span class="w-2 h-2 rounded-full bg-purple-500"></span>

                                                        Admin

                                                    </span>

                                                @elseif($role === 'petugas')

                                                    <span class="inline-flex items-center gap-2
                                                                 px-3 py-1.5 rounded-full
                                                                 bg-blue-100 dark:bg-blue-900/30
                                                                 text-blue-700 dark:text-blue-400
                                                                 text-xs font-semibold">

                                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span>

                                                        Petugas

                                                    </span>

                                                @elseif($role === 'peminjam')

                                                    <span class="inline-flex items-center gap-2
                                                                 px-3 py-1.5 rounded-full
                                                                 bg-green-100 dark:bg-green-900/30
                                                                 text-green-700 dark:text-green-400
                                                                 text-xs font-semibold">

                                                        <span class="w-2 h-2 rounded-full bg-green-500"></span>

                                                        Peminjam

                                                    </span>

                                                @else

                                                    <span class="inline-flex items-center gap-2
                                                                 px-3 py-1.5 rounded-full
                                                                 bg-gray-100 dark:bg-gray-700
                                                                 text-gray-600 dark:text-gray-300
                                                                 text-xs font-semibold">

                                                        {{ ucfirst($role) }}

                                                    </span>

                                                @endif

                                            @endforeach

                                        @else

                                            <span class="inline-flex items-center
                                                         px-3 py-1.5 rounded-full
                                                         bg-gray-100 dark:bg-gray-700
                                                         text-gray-500 dark:text-gray-400
                                                         text-xs font-semibold">

                                                Belum ada role

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Aksi --}}
                                    <td class="px-5 py-4">

                                        <div class="flex justify-center items-center gap-2">

                                            {{-- Edit --}}
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                title="Edit user"
                                                class="w-9 h-9 flex items-center justify-center
                                                       rounded-lg
                                                       bg-yellow-100 hover:bg-yellow-200
                                                       dark:bg-yellow-900/30
                                                       dark:hover:bg-yellow-900/50
                                                       text-yellow-700
                                                       dark:text-yellow-400
                                                       transition">

                                                ✏️

                                            </a>


                                            {{-- Delete --}}
                                            @if($user->hasRole('admin'))

                                                <span
                                                    title="Admin utama tidak dapat dihapus"
                                                    class="w-9 h-9 flex items-center justify-center
                                                           rounded-lg
                                                           bg-gray-100 dark:bg-gray-700
                                                           text-gray-400 dark:text-gray-500
                                                           cursor-not-allowed">

                                                    🔒

                                                </span>

                                            @else

                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('user.destroy', $user->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="button"
                                                        onclick="confirmDelete({{ $user->id }})"
                                                        title="Hapus user"
                                                        class="w-9 h-9 flex items-center justify-center
                                                               rounded-lg
                                                               bg-red-100 hover:bg-red-200
                                                               dark:bg-red-900/30
                                                               dark:hover:bg-red-900/50
                                                               text-red-600
                                                               dark:text-red-400
                                                               transition">

                                                        🗑️

                                                    </button>

                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="5" class="px-6 py-16 text-center">

                                        <div class="flex flex-col items-center">

                                            <div class="w-16 h-16 rounded-full
                                                        bg-gray-100 dark:bg-gray-700
                                                        flex items-center justify-center
                                                        text-3xl mb-4">

                                                👥

                                            </div>

                                            <h3 class="font-semibold
                                                       text-gray-700 dark:text-gray-200">

                                                Belum ada data user

                                            </h3>

                                            <p class="text-sm
                                                      text-gray-500 dark:text-gray-400
                                                      mt-1">

                                                Belum ada pengguna yang terdaftar di sistem.

                                            </p>

                                            <a href="{{ route('user.create') }}"
                                                class="mt-5 inline-flex items-center gap-2
                                                       bg-blue-600 hover:bg-blue-700
                                                       text-white px-4 py-2
                                                       rounded-lg text-sm font-medium
                                                       transition">

                                                ＋ Tambah User

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Footer --}}
                @if($users->count() > 0)

                    <div class="px-6 py-4
                                border-t border-gray-100 dark:border-gray-700
                                bg-gray-50/50 dark:bg-gray-700/20">

                        <p class="text-xs text-gray-500 dark:text-gray-400">

                            Menampilkan

                            <span class="font-semibold">
                                {{ $users->count() }}
                            </span>

                            user terdaftar.

                        </p>

                    </div>

                @endif

            </div>


            {{-- Footer --}}
            <div class="text-center mt-8 text-xs text-gray-400">
                SmartLab • Sistem Peminjaman Alat • TCC
            </div>

        </div>
    </div>


    {{-- SweetAlert --}}
    <script>

        function confirmDelete(id) {

            Swal.fire({

                title: 'Yakin ingin menghapus?',

                text: 'Data user akan dihapus secara permanen!',

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