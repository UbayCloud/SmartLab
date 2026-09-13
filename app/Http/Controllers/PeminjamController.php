<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use function Symfony\Component\Clock\now;

class PeminjamController extends Controller
{
    // menampilkan daftar alat
    public function daftarAlat()
    {
        $alat = Alat::with('kategori')->latest()
            ->get();

        return view('peminjam.DaftarAlat', compact('alat'));
    }


    // mengajukan peminjaman
    public function create()
    {
        $alat = Alat::where('jumlah_tersedia', '>', 0)->get();

        return view('peminjam.pengajuanPeminjaman', compact('alat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id'       => 'required|exists:alat,id',
            'jumlah'         => 'required|integer|min:1',
            'tanggal_kembali_rencana' => 'required|date',
        ]);

        Peminjaman::create([
            'user_id'        => Auth::id(),
            'alat_id'        => $request->alat_id,
            'jumlah'         => $request->jumlah,
            'tanggal_pinjam' => now(),
            'tanggal_kembali_rencana' => $request->tanggal_kembali_rencana,
            'status'         => 'menunggu',
        ]);

        $alat = Alat::find($request->alat_id);
        logActivity(
            'Pengajuan peminjaman',
            'Meminjam ' . $alat->nama_alat . ' sebanyak ' . $request->jumlah
        );

        return redirect()->route('peminjam.dashboard')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim');
    }

    // riwayat pengajuan
    public function riwayat()
    {
        $peminjaman = Peminjaman::with('alat')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjam.pengajuan', compact('peminjaman'));
    }


    // pengembalian
    public function index()
    {
        $peminjaman = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->get();

        return view('peminjam.pengembalian', compact('peminjaman'));
    }

    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'dipinjam') {
            return back()->with('error', 'Data tidak valid');
        }

        DB::transaction(function () use ($peminjaman) {
            $alat = $peminjaman->alat;
            $jumlah = (int) $peminjaman->jumlah;

            // stok kembali
            $alat->increment('jumlah_tersedia', $jumlah);

            // update status
            $peminjaman->update([
                'status' => 'selesai',
            ]);
        });

        logActivity(
            'Pengembalian',
            'Mengembalikan ' . $peminjaman->alat->nama_alat
        );

        return redirect()->route('peminjam.dashboard')
            ->with('success', 'Alat berhasil dikembalikan');
    }

    public function dashboard()
    {
        return view('peminjam.dashboard', [
            'menunggu' => Peminjaman::where('user_id', auth()->id())
                ->where('status', 'menunggu')->count(),
            'dipinjam' => Peminjaman::where('user_id', auth()->id())
                ->where('status', 'dipinjam')->count(),
            'selesai'  => Peminjaman::where('user_id', auth()->id())
                ->where('status', 'selesai')->count(),
        ]);
    }
}
