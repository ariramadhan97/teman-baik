<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $nullable = [];

    public function Pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_status');
    }
}
