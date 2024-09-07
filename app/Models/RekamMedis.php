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
        'diagnosa',
        'suhu',
        'respiratory',
        'heart_rate',
        'bmhp'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    public function anatomi()
    {
        return $this->hasMany(Anatomi::class, 'rekam_medis_id');
    }
}
