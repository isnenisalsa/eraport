<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiModel extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $fillable = [
        'pembelajaran_id',
        'siswa_id',
        'tupel_id',
        'nilai',
        'uts',
        'uas',
        'rata_rata_tupel',
        'rata_rata_uts_uas',
        'nilai_rapor',

    ];
    public function siswakelas()
    {
        return $this->belongsTo(SiswaKelasModel::class, 'siswa_id');
    }
}
