<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groupOffModel extends Model
{
    use HasFactory;

    protected $table = 'groupOff';
    protected $fillable = [
        'group',
        'tanggalOff'
    ];
}
