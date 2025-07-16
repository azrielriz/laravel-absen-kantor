<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cuti extends Model
{
    // Jika nama tabel tidak plural 'cutis', bisa didefinisikan secara eksplisit
    protected $table = 'cutis';

    // Kolom yang diizinkan untuk mass-assignment
    protected $fillable = [
    'username', 'tanggal_mulai', 'tanggal_selesai', 'alasan', 'jumlah_hari'
];

    // Jika tidak menggunakan timestamps (created_at, updated_at)
    public $timestamps = false;
}
