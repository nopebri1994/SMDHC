<?php

namespace App\Imports;

use App\Models\karyawanModel;
use Maatwebsite\Excel\Concerns\ToModel;

class karyawanImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new karyawanModel([
            'id' => $row[0],
            'fpId' => $row[1],
            'nikKerja' => $row[2],
            'namaKaryawan' => $row[3],
            'tglMasuk' => $row[4],
            'jenisKelamin' => '1',
            'idPerusahaan' => '1',
            'idDepartemen' => '1',
            'idBagian' => '1',
            'statusKaryawan' => '1',
            'idJabatan' => '1',
            'idJamKerja' => '3'
        ]);
    }
}
