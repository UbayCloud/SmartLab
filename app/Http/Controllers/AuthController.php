<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function resetpassword(Request $request)
    {
        // cek biar gak kosong
        if (!$request->username || !$request->password) {
            return back()->with('error', 'Harus diisi semua');
        }

        $user = DB::table('users')
            ->where('email', $request->username)
            ->first();

        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan');
        }

        DB::table('users')
            ->where('email', $request->username)
            ->update([
                'password' => Hash::make($request->password)
            ]);

        return redirect('/login')->with('success', 'Password berhasil diubah');

    }
}
