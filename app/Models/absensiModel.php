<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class absensiModel extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $fillable = [
        'idKaryawan',
        'idKeteranganIjin',
        'tanggalIjin',
        'status',
    ];

    function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }

    function keteranganIjin(): BelongsTo
    {
        return $this->belongsTo(keteranganIjinModel::class, 'idKeteranganIjin');
    }
}