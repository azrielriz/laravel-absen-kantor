<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    // 🛡️ Perbaikan: sesuaikan dengan nama kolom di database
    protected $fillable = ['nama_cabang'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
