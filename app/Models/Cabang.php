<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    // 🛡️ Aktifkan mass assignment untuk kolom "nama"
    protected $fillable = ['nama'];

    // 🔁 Relasi: Satu cabang punya banyak user
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
