<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class potongCutiModel extends Model
{
    use HasFactory;
    protected $table = 'potongcuti';
    protected $fillable = [
        'idKaryawan',
        'tahunCuti',
        'jumlahPotong',
        'status'
    ];
}
