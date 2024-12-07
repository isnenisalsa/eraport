<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapaianModel extends Model
{
    protected $table = 'capel';


    use HasFactory;
    protected $fillable = [
        'pembelajaran_id',
        'nama_capel',
    ];
}
