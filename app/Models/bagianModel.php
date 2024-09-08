<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class bagianModel extends Model
{
    use HasFactory;

    protected $table = 'bagian';
    protected $fillable = [
        'idDepartemen',
        'namaBagian',
        'kode'
    ];
    
    public function karyawan(): HasMany
    {
        return $this->hasMany(karyawanModel::class, 'idBagian');
    }

    public function departemen(): BelongsTo
    {
        return $this->belongsTo(departemenModel::class, 'idDepartemen');
    }
}
