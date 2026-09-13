<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alat;
use App\Models\User;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali_rencana',
        'status'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
