<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keteranganIjinModel extends Model
{
    use HasFactory;

   

    protected $table = 'keteranganijin';
    protected $fillable = [
        'kode',
        'status',
        'keterangan',
    ];
}
