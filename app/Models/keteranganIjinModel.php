<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class keteranganIjinModel extends Model
{
    use HasFactory;

    
    public static function boot() {
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    protected $table = 'keteranganIjin';
    public $incrementing = false;
    protected $fillable = [
        'kode',
        'status',
        'keterangan',
    ];

}
