<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;

    // Tentukan nama tabel dan primary key sesuai dengan yang ada di database
    protected $table = 'kelas';
    protected $primaryKey = 'kode_kelas';
    protected $keyType = 'string';  // Jika primary key adalah string
    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'guru_nik',
        'tahun_ajaran_id',
    ];

    /**
     * Relasi ke model Guru (Wali Kelas)
     */
    public function guru()
    {
        return $this->belongsTo(GuruModel::class, 'guru_nik', 'nik');
    }

    /**
     * Relasi ke model TahunAjaran
     */
    public function tahun_ajarans()
    {
        return $this->belongsTo(TahunAjarModel::class, 'tahun_ajaran_id');
    }

    /**
     * Relasi ke model SiswaKelas (Siswa yang terdaftar di kelas ini)
     */
    public function siswa()
    {
        return $this->hasMany(SiswaKelasModel::class, 'kelas_id', 'kode_kelas');  // Menggunakan hasMany untuk relasi ke siswa
    }
}
