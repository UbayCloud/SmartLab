<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat']);

        // filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // filter tanggal
        if ($request->tanggal_dari && $request->tanggal_sampai) {
            $query->whereBetween('tanggal_pinjam', [
                $request->tanggal_dari,
                $request->tanggal_sampai
            ]);
        }

        // filter peminjam 
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        $laporan = $query->get();
        $users = User::orderBy('name')->get();

        return view('petugas.laporan.index', compact('laporan', 'users'));
    }

    public function cetak(Request $request)
    {
        $query = Peminjaman::with(['user', 'alat']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->tanggal_dari && $request->tanggal_sampai) {
            $query->whereBetween('tanggal_pinjam', [
                $request->tanggal_dari,
                $request->tanggal_sampai
            ]);
        }

        //  FILTER PEMINJAM
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        $laporan = $query->latest()->get();

        // ambil list user buat dropdown
        $users = User::orderBy('name')->get();

        $laporan = $query->get();
        logActivity(
            'Mencetak laporan',
            'Petugas mencetak laporan'
        );

        // return view('petugas.laporan.cetak', compact('laporan'));
        return view('petugas.laporan.cetak', [
            'laporan' => $laporan,
            'users' => User::all(),
        ]);
    }
}
