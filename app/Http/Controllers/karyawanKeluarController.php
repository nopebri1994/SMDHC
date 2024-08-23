<?php

namespace App\Http\Controllers;

use App\Models\karyawanKeluarModel;
use App\Models\karyawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class karyawanKeluarController extends Controller
{
    function index()
    {
        $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->orderBy('nikKerja')->get();
        $data = [
            'title' => "Karyawan Keluar",
            'karyawan' => $karyawan,
        ];
        return view('karyawanKeluar.v_karyawanKeluar', $data);
    }

    function storeData(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'idKaryawan' => 'required',
                'tanggalKeluar' => 'required',
                'keterangan' => 'required',

            ]
        )->validate();

        $id = $request->idKaryawan;
        $tgl = $request->tanggalKeluar;
        $ket = $request->keterangan;

        $tmp = [
            'idKaryawan' => $id,
            'tanggalKeluar' => $tgl,
            'keterangan' => $ket
        ];

        karyawanKeluarModel::create($tmp);

        return back();
    }
    function tabelData()
    {
        $tmp = [
            'data' => karyawanKeluarModel::with(['karyawan'])->get(),
        ];
        return view('karyawanKeluar.tabelKaryawanKeluar', $tmp);
    }
}
