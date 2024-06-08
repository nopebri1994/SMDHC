<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class perusahaanModel extends Model
{
    use HasFactory;
    protected $table = 'perusahaan';
    protected $fillable = [
        'namaPerusahaan',
    ];

    public function departemen(): HasMany
    {
        return $this->hasMany(departemenModel::class, 'idPerusahaan');
    }
}
