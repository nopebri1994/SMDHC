<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use Illuminate\Http\Request;

class kontrakKaryawanController extends Controller
{
    public function index()
    {
        $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->where('statuskaryawan', '1')->get();
        $tmp = [
            'title' => 'Data Kontrak karyawan',
            'karyawan' => $karyawan
        ];
        return view('karyawanKontrak.v_karyawanKontrak', $tmp);
    }
}
