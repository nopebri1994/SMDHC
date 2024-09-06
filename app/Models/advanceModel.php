<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
