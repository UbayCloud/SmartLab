<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\Controller;
use App\Models\Alat;

class PetugasController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])
            ->where('status', 'menunggu')
            ->get();

        return view('petugas.menyetujuiPeminjaman', compact('peminjaman'));
    }

    // setuju
    public function setujui(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman sudah diproses');
        }

        DB::transaction(function () use ($peminjaman) {
            $alat   = $peminjaman->alat;
            $jumlah = (int) $peminjaman->jumlah;

            if ($alat->jumlah_tersedia < $jumlah) {
                abort(400, 'Stok alat tidak mencukupi');
            }

            $alat->decrement('jumlah_tersedia', $jumlah);

            $peminjaman->update([
                'status' => 'dipinjam',
            ]);
        });

        logActivity(
            'Menyetujui',
            'Menyetujui peminjaman ' . $peminjaman->alat->nama_alat
        );

        return redirect()->route('petugas.menyetujuiPeminjaman')
            ->with('success', 'Peminjaman berhasil disetujui');
    }
    // ditolak
    public function tolak(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman sudah diproses');
        }

        $peminjaman->update([
            'status'   => 'ditolak',
        ]);

        logActivity(
            'Tolak Peminjaman',
            'Menolak peminjaman ' . $peminjaman->alat->nama_alat
        );

        return back()->with('success', 'Pengajuan berhasil ditolak');
    }


    // Memantau pengembalian
    public function monitor()
    {
        $pengembalian = Peminjaman::with(['user', 'alat'])
            ->where('status', 'selesai')
            ->orderBy('updated_at', 'desc')
            ->get();

        logActivity(
            'Monitoring Pengembalian',
            'Petugas melihat data pengembalian alat'
        );


        return view('petugas.pengembalian', compact('pengembalian'));
    }

    public function dashboard()
    {
        return view('petugas.dashboard', [
            'menunggu' => Peminjaman::where('status', 'menunggu')->count(),
            'dipinjam' => Peminjaman::where('status', 'dipinjam')->count(),
            'selesai'  => Peminjaman::where('status', 'selesai')->count(),
        ]);
    }

    public function daftarAlat()
    {
        $alat = Alat::with('kategori')->latest()
            ->get();

        return view('petugas.daftarAlat', compact('alat'));
    }
}
