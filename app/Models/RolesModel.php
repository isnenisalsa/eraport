<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolesModel extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = [
        'nama',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(GuruModel::class);
    }
}
