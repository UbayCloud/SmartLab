<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->latest()->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => ['required', 'min:8', 'regex:/[a-zA-Z]/'],
            'role'     => 'required|exists:roles,name',
        ], [
            'name.required' => 'Nama wajib diisi!',

            'email.required' => 'Email wajib diisi!',
            'email.email'    => 'Format email tidak valid!',
            'email.unique'   => 'Email sudah digunakan, pakai email lain!',

            'password.required' => 'Password wajib diisi!',
            'password.min'      => 'Password minimal 8 karakter!',
            'password.regex' => 'Password tidak boleh hanya angka, harus ada huruf!',

           
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        logActivity(
            'Tambah User',
            'Menambahkan user ' . $user->name . ' dengan role ' . $request->role
        );

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }



    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
            'password' => ['nullable','confirmed','min:8', 'regex:/[a-zA-Z]/'],
        ],
        [
            'name.required' => 'Nama wajib diisi!',

            'email.required' => 'Email wajib diisi!',
            'email.email'    => 'Format email tidak valid!',
            'email.unique'   => 'Email sudah digunakan, pakai email lain!',

            'password.required' => 'Password wajib diisi!',
            'password.min'      => 'Password minimal 8 karakter!',
            'password.regex' => 'Password tidak boleh hanya angka, harus ada huruf!',

        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // kalau password diisi → update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // update role
        $user->syncRoles([$request->role]);

        logActivity(
            'Update User',
            'Mengubah user ' . $user->name
        );

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diupdate');
    }


    public function destroy(User $user)
    {
        // cek apakah masih ada alat yang belum dikembalikan
        $masihPinjam = $user->peminjaman()
            ->where('status', 'dipinjam')
            ->exists();

        if ($masihPinjam) {
            return back()
                ->with('error', 'User tidak bisa dihapus karena masih memiliki alat yang dipinjam!');
        }

        logActivity(
            'Hapus User',
            'Menghapus user ' . $user->name
        );

        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus');
    }
}
