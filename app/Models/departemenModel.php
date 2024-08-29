<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class departemenModel extends Model
{
    use HasFactory;
    protected $table = 'departemen';
    protected $with = ['perusahaan'];
    protected $fillable = [
        'kode',
        'namaDepartemen',
        'idPerusahaan'
    ];

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(perusahaanModel::class, 'idPerusahaan');
    }
}
