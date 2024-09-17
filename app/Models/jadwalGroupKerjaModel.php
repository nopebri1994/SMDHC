<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class jadwalGroupKerjaModel extends Model
{
    use HasFactory;

    protected $table = 'jadwalGroupKerja';
    protected $guarded = ['id'];

    public function groupKerja(): BelongsTo
    {
        return $this->belongsTo(groupKerjaModel::class, 'idGroupKerja')->withDefault();
    }
    public function jamKerja(): BelongsTo
    {
        return $this->belongsTo(jamKerjaModel::class, 'idJamKerja')->withDefault();
    }
}
