<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anatomi extends Model
{
    use HasFactory;
    protected $fillable = ['x', 'y', 'keterangan','rekam_medis_id'];


    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'rekam_medis_id');
    }
}
