<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiswaKelasModel extends Model
{
    use HasFactory;
    protected $table = 'siswa_kelas';
    protected $fillable = [
        'siswa_id',
        'kelas_id',
    ];

    public function siswa()
{
    return $this->belongsTo(SiswaModel::class, 'siswa_id');
}
    public function absensi()
{
    return $this->hasOne(AbsensiModel::class, 'siswa_id');
}
    public function kelas()
    {
        return $this->belongsTo(KelasModel::class, 'kelas_id', 'kode_kelas');
    }
    public function nilai()
    {
        return $this->hasMany(NilaiModel::class, 'siswa_id');  // Gunakan foreign key yang benar
    }
}
