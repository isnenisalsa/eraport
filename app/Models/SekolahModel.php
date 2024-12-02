<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahModel extends Model
{
    use HasFactory;
    protected $table = 'sekolah';
    protected $fillable = [
        'nama',
        'npsn',
        'nss',
        'alamat',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'nama_kepsek',
        'nip_kepsek',
    ];
}
