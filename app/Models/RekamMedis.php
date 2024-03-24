<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;



    protected $fillable = [

        'pasien_id' ,
        'keluhan',
        'tekanan_darah',
        'berat_badan',
        'tinggi_badan',
        'tanggal' ,
        'pemeriksaan' ,
        'diagnosa'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }
}
