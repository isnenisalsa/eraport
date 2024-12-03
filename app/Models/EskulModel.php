<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EskulModel extends Model
{
    use HasFactory;
    protected $table = 'eskul';

    protected $fillable = [
        'id',
        'nama_eskul',
        'guru_nik',
        'tempat',
    ];
    public function guru()
    {
        return $this->belongsTo(GuruModel::class, 'guru_nik', 'nik');
    }
}
