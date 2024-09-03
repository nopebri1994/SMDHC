<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use Illuminate\Http\Request;

class pmkController extends Controller
{
    function index()
    {
        $tmp = [
            'title' => 'Penghargaan Masa Kerja',
        ];
        return view('pmk.v_pmk', $tmp);
    }

    function tabelData()
    {
        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::whereNull('km')->where('idBagian', auth()->user()->karyawan->idBagian)->where('statusKaryawan', '2')->orderBy('tglMasuk')->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan   = karyawanModel::whereNull('km')->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->where('statusKaryawan', '2')->orderBy('tglMasuk')->get();
        } else {
            $karyawan = karyawanModel::whereNull('km')->where('statusKaryawan', '2')->orderBy('tglMasuk')->get();
        }

        $tmp = [
            'karyawan' => $karyawan,
        ];
        return view('pmk.tabelPmk', $tmp);
    }

    function tabelDataHak()
    {
        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::whereNull('km')->where('idBagian', auth()->user()->karyawan->idBagian)->where('statusKaryawan', '2')->orderBy('tglMasuk')->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan   = karyawanModel::whereNull('km')->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->where('statusKaryawan', '2')->orderBy('tglMasuk')->get();
        } else {
            $karyawan = karyawanModel::whereNull('km')->where('statusKaryawan', '2')->orderBy('tglMasuk')->get();
        }

        $tmp = [
            'karyawan' => $karyawan,
        ];
        return view('pmk.tabelPmkHak', $tmp);
    }
}
