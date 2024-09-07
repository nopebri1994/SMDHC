<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class detailAdvanceModel extends Model
{
    use HasFactory;
    protected $table = 'detailAdvance';
    protected $fillable = [
        'no_pinjaman',
        'tanggalProses',
        'jumlahPotong',
        'potonganKe'
    ];

    protected $with = ['advanceModel'];

    function advanceModel(): BelongsTo
    {
        return $this->belongsTo(advanceModel::class, 'no_pinjaman','no_pinjaman');
    }
}
