<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Authenticatable
{
    use HasFactory;
    protected $table = "siswa";
    protected $primaryKey = "nis";
    protected $keyType = 'string';
    protected $fillable = [
        'nis',
        'nisn',
        'nama',
        'status',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'no_telp_ayah',
        'no_telp_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'no_telp_wali',
        'username',
        'password'
    ];
}
