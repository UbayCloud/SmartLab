<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // // Buat roles dulu
        // Role::firstOrCreate(['name' => 'admin']);
        // Role::firstOrCreate(['name' => 'petugas']);
        // Role::firstOrCreate(['name' => 'peminjam']);

        // Buat user test
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test3@example.com',
        ]);

        // Assign role
        $user->assignRole('admin');
    }
}
