<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perusahaanModel;
use App\Models\jabatanModel;
use App\Models\jamKerjaModel;

class karyawanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Karyawan',
        ];
        return View('karyawan.v_karyawan', $data);
    }

    function addData()
    {
        $perusahaan = perusahaanModel::all();
        $jabatan    = jabatanModel::all();
        $jamKerja   = jamKerjaModel::all();
        $data = [
            'title'         => 'Tambah Data Karyawan',
            'perusahaan'    => $perusahaan,
            'jabatan'       => $jabatan,
            'jamKerja'      => $jamKerja,
        ];

        return View('karyawan.addDataKaryawan', $data);
    }
}
