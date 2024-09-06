<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailAdvanceModel extends Model
{
    use HasFactory;
    protected $table = 'detailAdvance';
    protected $fillable = [
        'no_pinjaman',
        'tanggalProses',
        'jumlahPotong',
        'potonganKe'
    ];
}
