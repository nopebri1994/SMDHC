<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class overtimeDetailModel extends Model
{
    use HasFactory;
    protected $table = 'overtimeDetail';
    protected $guarded = ['id'];

    function overtime(): BelongsTo
    {
        return $this->belongsTo(overtimeModel::class, 'idBagian');
    }

    function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
