<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cutiModel extends Model
{
    use HasFactory;

    protected $table = 'cuti';
    protected $fillable = [
        'idKaryawan',
        'jumlahCuti',
        'ambilCuti',
        'sisaCuti',
        'keterangan',
        'month',
        'year'
    ];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
