<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class fkpModel extends Model
{
    use HasFactory;

    protected $table = 'fkp';
    protected $guarded = ['id'];

    protected $with = ['karyawan'];

    function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
