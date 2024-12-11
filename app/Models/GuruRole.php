<?php

use App\Models\GuruModel;
use App\Models\RolesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruRole extends Model
{
    use HasFactory;

    protected $fillable = ['guru_nik', 'role_id'];

    public function guru()
    {
        return $this->belongsTo(GuruModel::class, 'guru_nik', 'nik');
    }

    public function role()
    {
        return $this->belongsTo(RolesModel::class, 'role_id');
    }
}
