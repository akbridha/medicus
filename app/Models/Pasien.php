<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIK',
        'NBL',
        'Nama',
        'Tanggal_lahir',
        'Umur',
        'Alamat',
        'Nomor_BPJS',
        'Jenis_Kelamin',
        'Pekerjaan',
    ];


    protected static function newFactory()
    {
        return \Database\Factories\PasienFactory::new();
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'pasien_id');
    }

    public function keluargas() {
        return $this->belongsToMany(Keluarga::class, 'keluarga_pasien');
    }

}
