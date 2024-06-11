<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jamKerjaModel extends Model
{
    use HasFactory;

    protected $table    = 'jamKerja';
    protected $fillable = [
        'kodeJamKerja',
        'jamMasukSJ',
        'jamPulangSJ',
        'jamMasukS',
        'jamPulangS',
    ];
}
