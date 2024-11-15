<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapelModel extends Model
{
    use HasFactory;
    protected $table = 'mapel';
    protected $primaryKey = 'kode_mapel';
    protected $keyType = 'string';

    protected $fillable = [
        'kode_mapel',
        'mata_pelajaran',
    ];
}
