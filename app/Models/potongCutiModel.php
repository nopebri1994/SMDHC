<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class potongCutiModel extends Model
{
    use HasFactory;
    protected $table = 'potongcuti';
    protected $fillable = [
        'idKaryawan',
        'tahunCuti',
        'jumlahPotong',
        'status',
        'keterangan'
    ];
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
