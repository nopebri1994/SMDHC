<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tambahCutiModel extends Model
{
    use HasFactory;
    protected $table = 'tambahcuti';
    protected $fillable = [
        'idKaryawan',
        'tahunCuti',
        'jumlahTambah',
        'status'
    ];
}
