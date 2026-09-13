<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\User;
use App\Models\Peminjaman;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('alat', 'user')->latest()
            ->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        return view('admin.peminjaman.create', [
            'alat' => Alat::where('jumlah_tersedia', '>', 0)->get(),
            'users' => User::whereHas('roles', 
            function ($query) {
                $query->whereIn('name', ['peminjam']);
            })->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'alat_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali_rencana' => 'required|date'
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah > $alat->jumlah_tersedia) {
            return back()->with('error', 'Stok tidak cukup');
        }

        Peminjaman::create([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => now(),
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status' => 'dipinjam'
        ]);

        //  Kurangi stok alat
        $alat->decrement('jumlah_tersedia', $request->jumlah);

        logActivity(
            'Pengajuan peminjaman',
            'Meminjam ' . $alat->nama_alat . ' sebanyak ' . $request->jumlah
        );

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('admin.peminjaman.edit', [
            'peminjaman' => $peminjaman,
            'alat' => Alat::all(),
            'users' => User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['peminjam'] );
            })->get()
        ]);
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'user_id' => 'required',
            'alat_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_kembali_rencana' => 'required|date'
        ]);

        //  Kembalikan stok lama
        $alatLama = Alat::find($peminjaman->alat_id);
        $alatLama->increment('jumlah_tersedia', $peminjaman->jumlah);

        //   Ambil alat baru
        $alatBaru = Alat::find($request->alat_id);

        //  Cek stok 
        if ($request->jumlah > $alatBaru->jumlah_tersedia) {
            return back()->with('error', 'Stok alat tidak mencukupi');
        }

        //   Kurangi stok baru
        $alatBaru->decrement('jumlah_tersedia', $request->jumlah);

        //   Update peminjaman
        $peminjaman->update([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
        ]);

        //  LOG AKTIVITAS
        logActivity(
            'Update Peminjaman',
            keterangan: 'Mengubah peminjaman alat ' . $alatBaru->nama_alat
        );

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diupdate');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        DB::transaction(function () use ($peminjaman) {

            // kembalikan stok
            $peminjaman->alat->increment('jumlah_tersedia', $peminjaman->jumlah);

            logActivity(
                'Hapus Peminjaman',
                'Menghapus peminjaman alat ' . $peminjaman->alat->nama_alat
            );

            $peminjaman->delete();
            
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus');
    }
}
