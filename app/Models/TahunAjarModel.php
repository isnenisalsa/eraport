<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjarModel extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'kode_tahun_ajaran';
protected $keyType = 'string';

    protected $fillable = [
        'kode_tahun_ajaran',
        'tahun_ajaran',
      
    ];

}