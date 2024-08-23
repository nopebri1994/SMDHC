<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class karyawanKeluarModel extends Model
{
    use HasFactory;

    protected $table = 'karyawanKeluar';
    protected $fillable = [
        'idKaryawan',
        'tanggalKeluar',
        'keterangan'
    ];

    function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
