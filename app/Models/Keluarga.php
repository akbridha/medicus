<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'nama'
    ];

    // public function pasien()
    // {
    //     return $this->belongsTo(Pasien::class);
    // }
    /**
     * The pasiens that belong to the Keluarga.
     */
    public function pasiens() {
        return $this->belongsToMany(Pasien::class, 'keluarga_pasien');
    }
}
