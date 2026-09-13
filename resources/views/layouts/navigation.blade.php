<nav x-data="{ open: false }"
    class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">

    <!-- ============================= -->
    <!-- DESKTOP NAVIGATION -->
    <!-- ============================= -->

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            <!-- LEFT SIDE -->
            <div class="flex items-center">

                <!-- LOGO -->
                <div class="shrink-0 flex items-center">

                    @role('admin')
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 group">

                        @elserole('petugas')
                        <a href="{{ route('petugas.dashboard') }}"
                            class="flex items-center gap-3 group">

                            @elserole('peminjam')
                            <a href="{{ route('peminjam.dashboard') }}"
                                class="flex items-center gap-3 group">
                                @endrole

                                <!-- Logo -->
                                <div class="w-10 h-10 rounded-xl bg-white shadow-sm overflow-hidden
            flex items-center justify-center group-hover:scale-105 transition">

                                    <img src="{{ asset('image/triple-c.png') }}"
                                        alt="Logo SMKN 1 Sumenep"
                                        class="w-8 h-8 object-contain">

                                </div>

                                <!-- Brand -->
                                <div class="hidden sm:block leading-tight">

                                    <div class="text-lg font-bold text-gray-800 dark:text-white">
                                        SmartLab
                                    </div>

                                    <div class="text-[10px] text-gray-500 dark:text-gray-400">
                                        Laboratory Management
                                    </div>

                                </div>

                            </a>

                </div>


                <!-- ============================= -->
                <!-- NAVIGATION LINKS -->
                <!-- ============================= -->

                <div class="hidden sm:flex items-center ml-8 gap-1">

                    {{-- ================= ADMIN ================= --}}
                    @role('admin')

                    <x-nav-link
                        :href="route('admin.dashboard')"
                        :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('tools.index')"
                        :active="request()->routeIs('tools.*')">
                        Daftar Alat
                    </x-nav-link>

                    <x-nav-link
                        :href="route('kategori.index')"
                        :active="request()->routeIs('kategori.*')">
                        Kategori
                    </x-nav-link>

                    <x-nav-link
                        :href="route('user.index')"
                        :active="request()->routeIs('user.*')">
                        Manajemen User
                    </x-nav-link>

                    <x-nav-link
                        :href="route('peminjaman.index')"
                        :active="request()->routeIs('peminjaman.*')">
                        Peminjaman
                    </x-nav-link>

                    <x-nav-link
                        :href="route('pengembalian.index')"
                        :active="request()->routeIs('pengembalian.*')">
                        Pengembalian
                    </x-nav-link>

                    <x-nav-link
                        :href="route('logs.index')"
                        :active="request()->routeIs('logs.*')">
                        Log Aktivitas
                    </x-nav-link>

                    @endrole


                    {{-- ================= PETUGAS ================= --}}
                    @role('petugas')

                    <x-nav-link
                        :href="route('petugas.dashboard')"
                        :active="request()->routeIs('petugas.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('petugas.menyetujuiPeminjaman')"
                        :active="request()->routeIs('petugas.menyetujuiPeminjaman')">
                        Peminjaman
                    </x-nav-link>

                    <x-nav-link
                        :href="route('petugas.pengembalian')"
                        :active="request()->routeIs('petugas.pengembalian')">
                        Pengembalian
                    </x-nav-link>

                    <x-nav-link
                        :href="route('laporan.index')"
                        :active="request()->routeIs('laporan.*')">
                        Laporan
                    </x-nav-link>
                    <x-nav-link
                        :href="route('petugas.daftaralat')"
                        :active="request()->routeIs('petugas.daftaralat.*')">
                        Daftar Alat
                    </x-nav-link>

                    @endrole


                    {{-- ================= PEMINJAM ================= --}}
                    @role('peminjam')

                    <x-nav-link
                        :href="route('peminjam.dashboard')"
                        :active="request()->routeIs('peminjam.dashboard')">
                        Dashboard
                    </x-nav-link>

                    <x-nav-link
                        :href="route('peminjam.alat.index')"
                        :active="request()->routeIs('peminjam.alat.index')">
                        Daftar Alat
                    </x-nav-link>

                    <x-nav-link
                        :href="route('peminjam.riwayat')"
                        :active="request()->routeIs('peminjam.riwayat')">
                        Pengajuan
                    </x-nav-link>

                    <x-nav-link
                        :href="route('peminjam.pengembalian')"
                        :active="request()->routeIs('peminjam.pengembalian')">
                        Pengembalian
                    </x-nav-link>

                    @endrole

                </div>

            </div>


            <!-- ============================= -->
            <!-- USER DROPDOWN -->
            <!-- ============================= -->

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-3 px-3 py-2
                                   rounded-xl
                                   text-sm font-medium
                                   text-gray-600 dark:text-gray-300
                                   hover:bg-gray-100 dark:hover:bg-gray-700
                                   focus:outline-none
                                   transition">

                            <!-- Avatar -->
                            <div class="w-9 h-9 rounded-full
                                        bg-blue-100 dark:bg-blue-900/40
                                        flex items-center justify-center">

                                <span class="text-sm font-bold text-blue-600 dark:text-blue-400">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>

                            </div>


                            <!-- User Name -->
                            <div class="hidden lg:block text-left">

                                <div class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    @if(Auth::user()->hasRole('admin'))
                                    Administrator
                                    @elseif(Auth::user()->hasRole('petugas'))
                                    Petugas
                                    @else
                                    Peminjam
                                    @endif
                                </div>

                            </div>


                            <!-- Arrow -->
                            <svg class="w-4 h-4 text-gray-400"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor">

                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />

                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <!-- User Information -->
                        <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700">

                            <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                {{ Auth::user()->email }}
                            </p>

                        </div>


                        <!-- Profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>


                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                Logout

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            <!-- ============================= -->
            <!-- MOBILE HAMBURGER -->
            <!-- ============================= -->

            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center
                           p-2 rounded-xl
                           text-gray-500 dark:text-gray-400
                           hover:bg-gray-100 dark:hover:bg-gray-700
                           focus:outline-none
                           transition">

                    <svg class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24">

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open}"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open}"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    <!-- ============================= -->
    <!-- MOBILE NAVIGATION -->
    <!-- ============================= -->

    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden border-t border-gray-100 dark:border-gray-700">

        <div class="px-4 pt-3 pb-3 space-y-1">

            {{-- ADMIN --}}
            @role('admin')

            <x-responsive-nav-link
                :href="route('admin.dashboard')"
                :active="request()->routeIs('admin.dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('tools.index')"
                :active="request()->routeIs('tools.*')">
                Daftar Alat
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('kategori.index')"
                :active="request()->routeIs('kategori.*')">
                Kategori
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('user.index')"
                :active="request()->routeIs('user.*')">
                Manajemen User
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('peminjaman.index')"
                :active="request()->routeIs('peminjaman.*')">
                Peminjaman
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('pengembalian.index')"
                :active="request()->routeIs('pengembalian.*')">
                Pengembalian
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('logs.index')"
                :active="request()->routeIs('logs.*')">
                Log Aktivitas
            </x-responsive-nav-link>

            @endrole


            {{-- PETUGAS --}}
            @role('petugas')

            <x-responsive-nav-link
                :href="route('petugas.dashboard')"
                :active="request()->routeIs('petugas.dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('petugas.menyetujuiPeminjaman')"
                :active="request()->routeIs('petugas.menyetujuiPeminjaman')">
                Peminjaman
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('petugas.pengembalian')"
                :active="request()->routeIs('petugas.pengembalian')">
                Pengembalian
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('laporan.index')"
                :active="request()->routeIs('laporan.*')">
                Laporan
            </x-responsive-nav-link>

            @endrole


            {{-- PEMINJAM --}}
            @role('peminjam')

            <x-responsive-nav-link
                :href="route('peminjam.dashboard')"
                :active="request()->routeIs('peminjam.dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('peminjam.alat.index')"
                :active="request()->routeIs('peminjam.alat.index')">
                Daftar Alat
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('peminjam.riwayat')"
                :active="request()->routeIs('peminjam.riwayat')">
                Pengajuan
            </x-responsive-nav-link>

            <x-responsive-nav-link
                :href="route('peminjam.pengembalian')"
                :active="request()->routeIs('peminjam.pengembalian')">
                Pengembalian
            </x-responsive-nav-link>

            @endrole

        </div>


        <!-- ============================= -->
        <!-- MOBILE USER -->
        <!-- ============================= -->

        <div class="pt-4 pb-3 border-t border-gray-200 dark:border-gray-700">

            <div class="px-4 flex items-center gap-3">

                <div class="w-10 h-10 rounded-full
                            bg-blue-100 dark:bg-blue-900/40
                            flex items-center justify-center">

                    <span class="font-bold text-blue-600 dark:text-blue-400">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>

                </div>

                <div>

                    <div class="font-semibold text-gray-800 dark:text-gray-200">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ Auth::user()->email }}
                    </div>

                </div>

            </div>


            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>


                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">

                        Logout

                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>