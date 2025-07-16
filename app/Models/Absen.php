<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
     protected $fillable = [
        'username', 'tanggal', 'jam', 'status', 'keterangan', 'foto', 'latitude', 'longitude'
    ];
}
