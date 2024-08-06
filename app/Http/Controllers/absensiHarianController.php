<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use App\Models\absensiHarianModel;
use Illuminate\Http\Request;

class absensiHarianController extends Controller
{
    function index()
    {
        $data = [
            'title' => 'Data Absensi Harian',
        ];
        return view('absensiHarian.v_absensiHarian', $data);
    }

    function list()
    {
        $data = [
            'dataKaryawan' => karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->orderBy('nikKerja')->get(),
            'jamAbsen' => absensiHarianModel::where('tanggalAbsen', '2024-08-05')->get()->toArray(),
        ];
        return view('absensiHarian.tabelHarian', $data);
    }
}
