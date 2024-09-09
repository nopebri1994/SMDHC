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
        $tglAwal = $request->tglAwal;
        $tglAkhir = $request->tglAkhir;

        if (auth()->user()->role == '5') {
            $karyawan = DB::table('prosesAbsensiHarian')->select('idKaryawan', 'nikKerja', 'namaKaryawan', DB::raw("count(IF(keteranganIjin='AL',1,NULL)) al"), DB::raw("count(IF(keteranganIjin='AD',1,NULL)) ad"), DB::raw("count(IF(keteranganIjin='SL',1,NULL)) sl"), DB::raw("count(IF(keteranganIjin='CL',1,NULL)) cl"), DB::raw("count(IF(keteranganIjin='CL2',1,NULL)) cl2"), DB::raw("count(IF(keteranganIjin='ISD',1,NULL)) isd"), DB::raw("count(IF(keteranganIjin='ISH',1,NULL)) ish"), DB::raw("count(IF(keteranganIjin='NPL',1,NULL)) npl"), DB::raw("count(IF(keteranganIjin='A',1,NULL)) a"), DB::raw("count(IF(terlambat='Ya',1,NULL)) t"))->join('dataKaryawan', 'dataKaryawan.id', 'prosesAbsensiHarian.idKaryawan')->whereBetween('tglAbsen', [$tglAwal, $tglAkhir])->groupBy('idKaryawan')->where('dataKaryawan.idBagian', auth()->user()->karyawan->idBagian)->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan = DB::table('prosesAbsensiHarian')->select('idKaryawan', 'nikKerja', 'namaKaryawan', DB::raw("count(IF(keteranganIjin='AL',1,NULL)) al"), DB::raw("count(IF(keteranganIjin='AD',1,NULL)) ad"), DB::raw("count(IF(keteranganIjin='SL',1,NULL)) sl"), DB::raw("count(IF(keteranganIjin='CL',1,NULL)) cl"), DB::raw("count(IF(keteranganIjin='CL2',1,NULL)) cl2"), DB::raw("count(IF(keteranganIjin='ISD',1,NULL)) isd"), DB::raw("count(IF(keteranganIjin='ISH',1,NULL)) ish"), DB::raw("count(IF(keteranganIjin='NPL',1,NULL)) npl"), DB::raw("count(IF(keteranganIjin='A',1,NULL)) a"), DB::raw("count(IF(terlambat='Ya',1,NULL)) t"))->join('dataKaryawan', 'dataKaryawan.id', 'prosesAbsensiHarian.idKaryawan')->whereBetween('tglAbsen', [$tglAwal, $tglAkhir])->groupBy('idKaryawan')->where('dataKaryawan.idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
        } else {
            $karyawan = DB::table('prosesAbsensiHarian')->select('idKaryawan', 'nikKerja', 'namaKaryawan', DB::raw("count(IF(keteranganIjin='AL',1,NULL)) al"), DB::raw("count(IF(keteranganIjin='AD',1,NULL)) ad"), DB::raw("count(IF(keteranganIjin='SL',1,NULL)) sl"), DB::raw("count(IF(keteranganIjin='CL',1,NULL)) cl"), DB::raw("count(IF(keteranganIjin='CL2',1,NULL)) cl2"), DB::raw("count(IF(keteranganIjin='ISD',1,NULL)) isd"), DB::raw("count(IF(keteranganIjin='ISH',1,NULL)) ish"), DB::raw("count(IF(keteranganIjin='NPL',1,NULL)) npl"), DB::raw("count(IF(keteranganIjin='A',1,NULL)) a"), DB::raw("count(IF(terlambat='Ya',1,NULL)) t"))->join('dataKaryawan', 'dataKaryawan.id', 'prosesAbsensiHarian.idKaryawan')->whereBetween('tglAbsen', [$tglAwal, $tglAkhir])->groupBy('idKaryawan')->get();
        }

        if ($tglAkhir != '') {
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
