<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class potonganCutiModel extends Model
{
    use HasFactory;

    protected $table = 'potonganCuti';
    protected $fillable = [
        'namaPotongan',
        'tahunPotongan',
        'totalPotongan',
        'keterangan'
    ];
}
