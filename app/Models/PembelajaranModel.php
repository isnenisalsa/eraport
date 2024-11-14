<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelajaranModel extends Model
{
    use HasFactory;
    protected $table = 'pembelajaran';
    protected $primaryKey = 'id_pembelajaran';
    protected $keyType = 'string';
    protected $fillable = [
        'id_pembelajaran',
        'mata_pelajaran',
        'nama_kelas',
        'nama_guru',
    ];

    public function mapel()
    {
        return $this->belongsTo(MapelModel::class, 'mata_pelajaran', 'kode_mapel');
    }

    /**
     * Relasi dengan model Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(KelasModel::class, 'nama_kelas', 'kode_kelas');
    }

    /**
     * Relasi dengan model Guru
     */
    public function guru()
    {
        return $this->belongsTo(GuruModel::class, 'nama_guru', 'nik');
    }
    

}
