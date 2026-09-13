<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Storage;

class ToolsController extends Controller
{
    /**
     * Tampilkan daftar alat
     */
    public function index()
    {
        $alat = Alat::with('kategori')->latest()
            ->get();

        return view('admin.alat.tools', compact('alat'));
    }

    /**
     * Form tambah alat
     * 
     */
    public function create()
    {
        $kategori = Kategori::all(); // ambil semua kategori

        return view('admin.alat.createAlat', compact('kategori'));
    }

    /**
     * Simpan data alat
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_alat'       => 'required|unique:alat,kode_alat',
            'nama_alat'       => 'required',
            'kategori_id'     => 'required|exists:kategori,id',
            'jumlah_tersedia' => 'required|integer|min:0',
            'kondisi'         => 'required|in:baik',
            'gambar'          => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'kode_alat.required' => 'Kode alat wajib diisi!',
            'kode_alat.unique'   => 'Kode alat sudah ada',
            'gambar.mimes'       => 'Format gambar harus JPG, JPEG, PNG, atau WEBP!',
            'gambar.max'         => 'Ukuran gambar maksimal 2MB!',
        ]);

        // Upload gambar
        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('alat', 'public');
        }

        // Simpan data alat
        Alat::create([
            'kode_alat'       => $request->kode_alat,
            'nama_alat'       => $request->nama_alat,
            'kategori_id'     => $request->kategori_id,
            'jumlah_tersedia' => $request->jumlah_tersedia,
            'kondisi'         => $request->kondisi,
            'qr_token'        => Str::random(12),
            'gambar'          => $gambar,
        ]);

        logActivity(
            'Tambah Alat',
            'Menambahkan alat ' . $request->nama_alat
        );

        return redirect()->route('tools.index')
            ->with('success', 'Data alat berhasil ditambahkan');
    }

    /* Form edit alat
     */
    public function edit(Alat $tool)
    {
        $kategori = Kategori::all();

        return view('admin.alat.editAlat', [
            'alat' => $tool,
            'kategori' => $kategori
        ]);;
    }

    /**
     * Update data alat
     */
    public function update(Request $request, Alat $tool)
    {
        $request->validate([
            'kode_alat'       => 'required|unique:alat,kode_alat,' . $tool->id,
            'nama_alat'       => 'required',
            'kategori_id'     => 'required|exists:kategori,id',
            'jumlah_tersedia' => 'required|integer|min:0',
            'kondisi'         => 'required|in:baik',
            'gambar'          => 'nullable|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'kode_alat.required' => 'Kode alat wajib diisi!',
            'kode_alat.unique'   => 'Kode alat sudah ada',
            'gambar.mimes'       => 'Format gambar harus JPG, JPEG, PNG, atau WEBP!',
            'gambar.max'         => 'Ukuran gambar maksimal 2MB!',
        ]);

        // Data yang akan diupdate
        $data = [
            'kode_alat'       => $request->kode_alat,
            'nama_alat'       => $request->nama_alat,
            'kategori_id'     => $request->kategori_id,
            'jumlah_tersedia' => $request->jumlah_tersedia,
            'kondisi'         => $request->kondisi,
        ];

        // Kalau user upload foto baru
        if ($request->hasFile('gambar')) {

            // Hapus foto lama jika ada
            if ($tool->gambar && Storage::disk('public')->exists($tool->gambar)) {
                Storage::disk('public')->delete($tool->gambar);
            }

            // Simpan foto baru
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $tool->update($data);

        logActivity(
            'Edit Alat',
            'Mengubah data alat ' . $request->nama_alat
        );

        return redirect()->route('tools.index')
            ->with('success', 'Data alat berhasil diperbarui');
    }

    /**
     * Hapus data alat
     */
    public function destroy(Alat $tool)
    {
        // cek apakah masih ada peminjaman aktif
        $masihDipakai = $tool->peminjaman()
            ->where('status', 'dipinjam')
            ->exists();

        if ($masihDipakai) {
            return redirect()->route('tools.index')
                ->with('error', 'Alat tidak bisa dihapus karena masih dipinjam!');
        }

        logActivity(
            'Hapus Alat',
            'Menghapus alat ' . $tool->nama_alat
        );

        $tool->delete();

        return redirect()->route('tools.index')
            ->with('success', 'Data alat berhasil dihapus');
    }
}
