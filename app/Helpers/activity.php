<?php

use App\Models\ActivityLog;

function logActivity($aksi, $keterangan)
{
    ActivityLog::create([
        'user_id' => auth()->user()->id,
        'aksi' => $aksi,
        'keterangan' => $keterangan
    ]);
}
