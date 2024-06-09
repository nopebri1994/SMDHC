<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class bagianModel extends Model
{
    use HasFactory;

    protected $table = 'bagian';
    protected $fillable = [
        'idDepartemen',
        'namaBagian',
        'kode'
    ];

    public function departemen(): BelongsTo
    {
        return $this->belongsTo(departemenModel::class, 'idDepartemen');
    }
}
