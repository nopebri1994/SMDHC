<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class hutangCutiModel extends Model
{
    use HasFactory;
    protected $table = 'hutangcuti';
    protected $fillable = [
        'idKaryawan',
        'jumlahHutangCuti',
        'ambilHutangCuti',
        'keterangan',
        'expired',
        'month',
        'year'
    ];

    function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
