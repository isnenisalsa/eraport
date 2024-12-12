<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuruModel extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'guru';
    protected $primaryKey = "nik";
    protected $fillable = [
        'nik',
        'nip',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ibu',
        'agama',
        'jabatan',
        'status',
        'no_telp',
        'alamat',
        'pendidikan_terakhir',
        'status_perkawinan',
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(RolesModel::class, 'guru_roles', 'guru_nik', 'role_id');
    }
    public function kelas()
    {
        return $this->belongsTo(KelasModel::class, 'nik', 'guru_nik');
    }
    public function pembelajaran()
    {
        return $this->belongsTo(PembelajaranModel::class, 'nik', 'nama_guru');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}