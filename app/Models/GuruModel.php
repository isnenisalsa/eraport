<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = "nik";
    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ibu',
        'agama',
        'jabatan',
        'status',
        'no_telp',
        'pendidikan_terakhir',
        'status_perkawinan',
        'email',
        'username',
        'password',
        'roles_id',
    ];
    public function level()
    {
        return $this->belongsTo(RolesModel::class, 'roles_id', 'id');
    }
}
