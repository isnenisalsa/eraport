<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiEskulModel extends Model
{
    use HasFactory;
    protected $table = 'nilai_eskul';
    protected $fillable = [
        'siswa_id',
        'eskul_id',
        'keterangan'
    ];
    public function siswa()
    {
        return $this->belongsTo(SiswaKelasModel::class, 'siswa_id');
    }
    public function eskul()
    {
        return $this->belongsTo(EskulModel::class, 'eskul_id');
    }
}
