<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::latest()->take(5)->get();

         return view('admin.dashboard',compact('logs'), [
        'totalUser'        => User::count(),
        'totalAlat'        => Alat::count(),
        'totalPeminjaman'  => Peminjaman::count(),
        'dipinjam'         => Peminjaman::where('status', 'dipinjam')->count(),
        'menunggu'         => Peminjaman::where('status', 'menunggu')->count(),
        'selesai'          => Peminjaman::where('status', 'selesai')->count(),
    ]);


    }
}
