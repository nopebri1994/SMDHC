<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailCutiModel extends Model
{
    use HasFactory;

    protected $table = 'detailcuti';
    protected $fillable = [
        'idKaryawan',
        'tanggalIjin',
        'tahun',
    ];
}
