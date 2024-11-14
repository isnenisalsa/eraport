<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = "kode_kelas";
    protected $keyType = 'string';
    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'guru_nik',
    ];

    public function guru()
    {
        return $this->belongsTo(GuruModel::class, 'guru_nik', 'nik');
    }
}
