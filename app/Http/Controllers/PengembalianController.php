<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PengembalianController extends Controller
{
    // tampilkan data yg masih dipinjam
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'alat'])
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.pengembalian.index', compact('peminjaman'));
    }


    // klik kembalikan
    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Data tidak valid');
        }

        DB::transaction(function () use ($peminjaman) {

            //  stok kembali
            $peminjaman->alat->increment(
                'jumlah_tersedia',
                $peminjaman->jumlah
            );

            //  status selesai
            $peminjaman->update([
                'status' => 'selesai'
            ]);
        });

        logActivity(
            'Pengembalian',
            'Mengembalikan ' . $peminjaman->alat->nama_alat
        );
        
        return back()->with('success', 'Alat berhasil dikembalikan');
    }
}
