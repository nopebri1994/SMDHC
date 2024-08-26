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
        $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->get();
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
        $cekData = karyawanKeluarModel::where('idKaryawan', $id)->first();
        if (empty($cekData)) {
            karyawanKeluarModel::create($tmp);
            karyawanModel::where('id', $id)->update(['km' => 1]);
        }
        return back();
    }
    function tabelData()
    {
        $tmp = [
            'data' => karyawanKeluarModel::with(['karyawan'])->get(),
        ];
        return view('karyawanKeluar.tabelKaryawanKeluar', $tmp);
    }

    function updateData(Request $request)
    {
        $id = $request->id;
        $idKaryawan = $request->idKaryawan;
        $keterangan = $request->keterangan;
        $tanggalKeluar = $request->tanggalKeluar;

        $tmp = [
            // 'idKaryawan' => $idKaryawan,
            'keterangan' => $keterangan,
            'tanggalKeluar' => $tanggalKeluar,
        ];
        karyawanKeluarModel::where('id', $id)->update($tmp);
    }

    function delete(Request $request)
    {
        $id = $request->id;
        $idKaryawan = $request->idKaryawan;
        karyawanModel::where('id', $idKaryawan)->update(['km' => null]);
        karyawanKeluarModel::where('id', $id)->delete();
    }
}
