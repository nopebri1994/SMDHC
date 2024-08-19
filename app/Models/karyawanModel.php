<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    protected $with = ['jabatan', 'departemen', 'bagian', 'jamKerja'];
    protected $table = 'dataKaryawan';
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
        return $this->belongsTo(bagianModel::class, 'idBagian')->withDefault();
    }

    public function perusahaan(): BelongsTo
    {
        return $this->belongsTo(perusahaanModel::class, 'idPerusahaan');
    }

    public function jamKerja(): BelongsTo
    {
        return $this->belongsTo(jamKerjaModel::class, 'idJamKerja');
    }
    public function users(): HasOne
    {
        return $this->hasOne(UserModel::class, 'idKaryawan');
    }
}
