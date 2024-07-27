<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mesinAbsensiModel extends Model
{
    use HasFactory;
    protected $table = 'mesinabsensi';
    protected $fillable = [
        'namaMesin',
        'keterangan',
        'key',
        'ipAddress'
    ];
}
