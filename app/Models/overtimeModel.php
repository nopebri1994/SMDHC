<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class overtimeModel extends Model
{
    use HasFactory;
    protected $table = 'overtime';
    protected $guarded = ['id'];

    function bagian(): BelongsTo
    {
        return $this->belongsTo(bagianModel::class, 'idBagian');
    }
}
