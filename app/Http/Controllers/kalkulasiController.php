<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use App\Models\prosesAbsensiHarianModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class kalkulasiController extends Controller
{
    function index()
    {
        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idBagian', auth()->user()->karyawan->idBagian)->orderBy('nikKerja')->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->orderBy('nikKerja')->get();
        } else {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->get();
        }
        $tmp = [
            'title' => 'Kalkulasi Ijin',
            'karyawan' => $karyawan,
        ];
        return view('kalkulasi.v_kalkulasi', $tmp);
    }

    function tabelData(Request $request)
    {
        $id = $request->id;
        $tglAwal = $request->tglAwal;
        $tglAkhir = $request->tglAkhir;

        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idBagian', auth()->user()->karyawan->idBagian)->orderBy('nikKerja')->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->orderBy('nikKerja')->get();
        } else {
            $karyawan = DB::table('prosesAbsensiHarian')->select('idKaryawan', 'nikKerja', 'namaKaryawan', DB::raw("count(IF(keteranganIjin='AL',1,NULL)) al"))->join('dataKaryawan', 'dataKaryawan.id', 'prosesAbsensiHarian.idKaryawan')->whereBetween('tglAbsen', [$tglAwal, $tglAkhir])->groupBy('idKaryawan')->get();
        }

        if ($id == '' and $tglAkhir != '') {
            $data = [
                'karyawan' => $karyawan,
            ];
        } elseif ($id != '') {
            $data = [
                'karyawan' => $karyawan,
            ];
        } else {
            $karyawan = [];
            $data = [
                'karyawan' => $karyawan,
            ];
        }

        return view('kalkulasi.tabelKalkulasi', $data);
    }
}
