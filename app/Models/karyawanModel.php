<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class karyawanModel extends Model
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    protected $table = 'datakaryawan';
    protected $fillable = [
        'nikKerja',
        'id',
        'namaKaryawan',
        'tglMasuk',
        'jenisKelamin',
        'idPerusahaan',
        'idDepartemen',
        'idBagian',
        'statusKaryawan',
        'idJabatan',
        'idJamKerja',
        'fpId'
    ];
    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(jabatanModel::class, 'idJabatan');
    }

    public function departemen(): BelongsTo
    {
        return $this->belongsTo(departemenModel::class, 'idDepartemen');
    }

    public function bagian(): BelongsTo
    {
        return $this->belongsTo(bagianModel::class, 'idBagian');
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(perusahaanModel::class, 'idPerusahaan');
    }

    public function jamKerja(): BelongsTo
    {
        return $this->belongsTo(jamKerjaModel::class, 'idJamKerja');
    }
}
