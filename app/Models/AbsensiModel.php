<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiModel extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'siswa_id',
        'kode_kelas',
        'sakit',
        'izin',
        'alfa',
        'tahun_ajaran_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(SiswaKelasModel::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(KelasModel::class, 'kode_kelas', 'kode_kelas');
    }
}
