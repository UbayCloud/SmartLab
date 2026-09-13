<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
| Jika sudah login → redirect sesuai role
| Jika belum login → halaman login
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard.redirect');
    }

    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| RESOURCE ROUTES (TIDAK DIUBAH)
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT (INTI LOGIKA ROLE)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard-redirect', function () {
    $user = auth()->user();

    // safety: user lama belum punya role
    if (!$user->roles->count()) {
        $user->assignRole('peminjam');
    }

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('petugas')) {
        return redirect()->route('petugas.dashboard');
    }

    return redirect()->route('peminjam.dashboard');
})->middleware('auth')->name('dashboard.redirect');

/*
|--------------------------------------------------------------------------
| DASHBOARD PER ROLE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->get('/admin/dashboard', [AdminController::class, 'index'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'role:petugas'])
    ->get('/petugas/dashboard', [PetugasController::class, 'dashboard'])
    ->name('petugas.dashboard');

Route::middleware(['auth', 'role:peminjam'])
    ->get('/peminjam/dashboard', [PeminjamController::class, 'dashboard'])
    ->name('peminjam.dashboard');

/*
|--------------------------------------------------------------------------
| Route Peminjam
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:peminjam'])->group(function () {
    // daftar alat
    Route::get('/peminjam/alat', [PeminjamController::class, 'daftarAlat'])
        ->name('peminjam.alat.index');

    //pengembalian
    Route::get('/peminjam/pengembalian', [PeminjamController::class, 'index'])
        ->name('peminjam.pengembalian');
    Route::put('/peminjam/pengembalian/{peminjaman}', [PeminjamController::class, 'kembalikan'])
        ->name('peminjam.pengembalian.kembalikan');

    //pengajuan
    Route::resource('pengajuan', PeminjamController::class);

    //riwayat pengajuan
    Route::get('/peminjam/riwayat', [PeminjamController::class, 'riwayat'])
        ->name('peminjam.riwayat');
});





/*
|--------------------------------------------------------------------------
| Route petugas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas/peminjaman', [PetugasController::class, 'index'])
        ->name('petugas.menyetujuiPeminjaman');

    // menyetujui peminjaman    
    Route::put('/petugas/peminjaman/{peminjaman}/setujui', [PetugasController::class, 'setujui'])
        ->name('petugas.setujui');

    // menolak peminjaman
    Route::put(
        'petugas/peminjaman/{peminjaman}/tolak',
        [PetugasController::class, 'tolak']
    )->name('petugas.tolak');



    // pengembalian
    Route::get(
        '/petugas/pengembalian',
        [PetugasController::class, 'monitor']
    )->name('petugas.pengembalian');

    // mencetak laporan
    Route::get('/petugas/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/petugas/laporan/cetak', [LaporanController::class, 'cetak'])
        ->name('laporan.cetak');


    // daftar alat
    Route::get('/petugas/alat', [PeminjamController::class, 'daftarAlat'])
        ->name('petugas.daftaralat');
});
/*
|--------------------------------------------------------------------------
| Route admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // pengembalian di admin
    Route::put(
        '/admin/pengembalian/{peminjaman}/kembalikan',
        [PengembalianController::class, 'kembalikan']
    )->name('admin.pengembalian.kembalikan');

    Route::get('/admin/pengembalian', [PengembalianController::class, 'index'])
        ->name('admin.pengembalian.index');


   

    Route::resource('tools', ToolsController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('user', UserController::class);
    Route::resource('peminjaman', PeminjamanController::class);
    Route::resource('logs', ActivityLogController::class);
    Route::resource('pengembalian', PengembalianController::class)
        ->only(['index', 'create', 'store']);
});



// halaman form
Route::get('/lupa-password', function () {
    return view('auth.lupa-password');
})->name('password.simple');

// proses reset
Route::post('/lupa-password', [AuthController::class, 'resetpassword'])
    ->name('lupapassword');



// Scanner (semua user yang login)
  Route::middleware('auth')->group(function () {

    Route::get('/scanner', [ScannerController::class, 'index'])
        ->name('scanner');

    Route::get('/scan/{token}', [ScanController::class, 'index'])
        ->name('scan');

    Route::get('/tools/{tool}/qrcode', [ScanController::class, 'qrcode'])
    ->name('tools.qrcode');

});
