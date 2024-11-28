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

    ];
    public function siswakelas()
    {
        return $this->belongsTo(SiswaKelasModel::class, 'siswa_id');
    }
}
