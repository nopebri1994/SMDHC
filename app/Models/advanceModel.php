<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class advanceModel extends Model
{
    use HasFactory;
    protected $table = 'advance';
    protected $fillable = [
        'no_pinjaman',
        'idKaryawan',
        'totalPinjaman',
        'totalPotongan',
        'sisaPotongan',
        'sudahDipotong',
        'tanggalRealisasi',
        'status',
    ];
    function karyawanModel(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }

    function detailAdvanceModel(): HasOne
    {
        return $this->hasOne(detailAdvanceModel::class, 'no_pinjaman','no_pinjaman');
    }
}
