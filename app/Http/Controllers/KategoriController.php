<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::with('alat')->latest()
            ->get();
        return view('admin.kategori.kategori', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.unique' => 'Kategori sudah ada',
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);

        logActivity(
            'Tambah Kategori',
            'Menambahkan kategori: ' . $kategori->nama_kategori
        );

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori,' . $kategori->id,
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'keterangan' => $request->keterangan,
        ]);


        logActivity(
            'Update Kategori',
            'Mengupdate kategori: ' . $kategori->nama_kategori
        );

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(Kategori $kategori)
    {
        $nama = $kategori->nama_kategori;
        // cek apakah kategori masih dipakai
        if ($kategori->alat()->count() > 0) {
            return back()->with(
                'error',
                'Kategori tidak bisa dihapus karena masih digunakan oleh alat'
            );
        }

        $kategori->delete();

        // LOG AKTIVITAS
        logActivity(
            'Hapus Kategori',
            'Menghapus kategori: ' . $nama
        );

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
