<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SPModel extends Model
{
    protected $table = 'suratPeringatan';
    protected $fillable = [
        'idKaryawan',
        'nomorSP',
        'dibuatTanggal',
        'berlakuTanggal',
        'sampaiTanggal',
        'sp',
        'status',
        'file'
    ];
    function karyawanModel(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
