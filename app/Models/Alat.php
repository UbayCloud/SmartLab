<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';

    protected $fillable = [
        'kode_alat',
        'nama_alat',
        'kategori_id',
        'jumlah_tersedia',
        'kondisi',
        'qr_token',
        'gambar',
    ];

    /**
     * Relasi ke tabel kategori
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class, 'alat_id');
    }
}
