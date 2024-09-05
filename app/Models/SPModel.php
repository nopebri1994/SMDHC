<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPModel extends Model
{
    protected $table = 'suratPeringatan';
    protected $fillable = [
        'idKaryawan',
        'nomorSP',
        'dibuatTanggal',
        'berlakuTanggal',
        'sampaiTanggal',
        'sp',
        'status'
    ];
}
