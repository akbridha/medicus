<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama'
    ];


    public function pasiens() {
        return $this->belongsToMany(Pasien::class, 'keluarga_pasien');
    }
}
