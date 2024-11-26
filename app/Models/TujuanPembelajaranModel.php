<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanPembelajaranModel extends Model
{
    protected $table = 'tupel';


    use HasFactory;
    protected $fillable = [
        'pembelajaran_id',
        'nama_tupel',
    ];
}
