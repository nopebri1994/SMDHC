<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensiHarianModel extends Model
{
    use HasFactory;

    protected $table = 'absensiharian';
    protected $fillable = [
        'idFinger',
        'tanggalAbsen',
        'jamAbsen',
        'idMesin'
    ];
}
