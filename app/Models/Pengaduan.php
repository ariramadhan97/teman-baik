<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi');
    }
    public function Status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
