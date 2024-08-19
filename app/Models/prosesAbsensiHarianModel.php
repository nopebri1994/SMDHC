<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class prosesAbsensiHarianModel extends Model
{
    use HasFactory;
    protected $table = 'prosesAbsensiHarian';
    protected $fillable = [
        'idKaryawan',
        'tglAbsen',
        'jamDatang',
        'jamPulang',
        'terlambat',
        'full'
    ];

    function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
