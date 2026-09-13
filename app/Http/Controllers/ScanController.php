<?php

namespace App\Http\Controllers;

use App\Models\Alat;

class ScanController extends Controller
{
    public function index($token)
    {
        $alat = Alat::where('qr_token', $token)->firstOrFail();

        return view('peminjam.scan.detailAlat', compact('alat'));
    }

    public function qrcode(Alat $tool)
{
    return view('admin.alat.barcode.showqr', [
        'alat' => $tool
    ]);
}
}