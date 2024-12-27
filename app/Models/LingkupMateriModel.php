<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LingkupMateriModel extends Model
{
    use HasFactory;
    protected $table = 'lingkup_materi';

    protected $fillable = [
        'pembelajaran_id',
        'tahun_ajaran_id',
        'nama_lingkup_materi'
    ];
}
