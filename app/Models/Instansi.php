<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_instansi',
        'email1',
        'email2',
        'email3',
        'no_wa1'
    ];

    public function Pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_instansi');
    }
}
