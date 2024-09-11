<?php

namespace App\Http\Controllers;

use App\Models\bagianModel;
use App\Models\karyawanModel;
use Illuminate\Http\Request;

class overtimeController extends Controller
{
    function index()
    {
        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idBagian', auth()->user()->karyawan->idBagian)->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->where('id', auth()->user()->karyawan->idBagian)->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
        } else {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->get();
        }
        $tmp = [
            'title' => 'Data Overtime (Lembur)',
            'karyawan' => $karyawan,
            'bagian' => $bagian
        ];
        return view('overtime.v_overtime', $tmp);
    }

    function addData()
    {
        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idBagian', auth()->user()->karyawan->idBagian)->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->where('id', auth()->user()->karyawan->idBagian)->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
        } else {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->get();
        }
        $tmp = [
            'title' => 'Tambah Data Overtime (Lembur)',
            'karyawan' => $karyawan,
            'bagian' => $bagian
        ];
        return view('overtime.addDataOvertime', $tmp);
    }


    function storeData(Request $request)
    {
        dd($request);
    }
}
