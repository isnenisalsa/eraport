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
        'tahun_ajaran_id',
        'lingkup_id'
    ];
    public function pembelajaran()
    {
        return $this->belongsTo(PembelajaranModel::class, 'pembelajaran_id', 'id_pembelajaran');
    }
    public function tahunAjarans()
    {
        return $this->belongsToMany(TahunAjarModel::class, 'kelas_tahun_ajaran', 'tahun_ajaran_id');
    }
    public function lingkup()
    {
        return $this->belongsTo(LingkupMateriModel::class, 'lingkup_id', 'id');
    }
}
