<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kontrakKaryawanModel extends Model
{
    use HasFactory;

    protected $table = 'karyawanKontrak';
    protected $fillable = [
        'idKaryawan',
        'noKontrak',
        'dibuatTanggal',
        'berlakuTanggal',
        'sampaiTanggal',
        'kontrakKe',
        'file',
    ];
}
