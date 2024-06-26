<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailHutangCutiModel extends Model
{
    use HasFactory;
    protected $table = 'detailhutangcuti';
    protected $fillable = [
        'idKaryawan',
        'tanggalIjin',
        'tahun',
    ];
}
