<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tambahCutiModel extends Model
{
    use HasFactory;
    protected $table = 'tambahCuti';
    protected $fillable = [
        'idKaryawan',
        'tahunCuti',
        'jumlahTambah',
        'status',
        'keterangan'
    ];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(karyawanModel::class, 'idKaryawan');
    }
}
