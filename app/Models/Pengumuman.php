<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman'; // ✅ Tambahkan ini

    protected $fillable = ['judul', 'tanggal', 'keterangan'];
}
