<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Proses Pengembalian
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">

                <form action="{{ route('pengembalian.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                       <label class="block text-gray-700 dark:text-gray-200">Pengembalian</label>
                        <select name="peminjaman_id"
                            class="w-full mt-1 p-2 border rounded">
                            @foreach($peminjaman as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->user->name }} —
                                {{ $p->alat->nama_alat }} ({{ $p->jumlah }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('pengembalian.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </a>
                        <button class="bg-green-600 text-white px-4 py-2 rounded">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
