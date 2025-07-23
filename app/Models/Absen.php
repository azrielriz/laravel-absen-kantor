<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
     protected $fillable = [
        'tanggal',
        'jam',
        'status',
        'username',
        'keterangan',
        'latitude',
        'longitude',
        'foto',
    ];
}
