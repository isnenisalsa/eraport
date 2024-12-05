<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EskulSiswaModel extends Model
{
    use HasFactory;
    protected $table = 'eskul_siswa';
    protected $fillable = [
        'siswa_id',
        'eskul_id',
    ];
    public function siswa()
    {
        return $this->belongsTo(SiswaKelasModel::class, 'siswa_id');
    }
}
