<?php

namespace App\Http\Controllers;

use App\Models\groupKerjaModel;
use App\Models\groupOffModel;
use App\Models\karyawanModel;
use Illuminate\Http\Request;

class komposisiController extends Controller
{
    function index()
    {
        $groupOffA = karyawanModel::where('groupOff', 'A')->get();
        $groupOffB = karyawanModel::where('groupOff', 'B')->get();
        $groupKerja = groupKerjaModel::all();
        $karyawanGroup = karyawanModel::whereNotNull('idGroupKerja')->whereNull('km')->get();
        $tmp = [
            'title' => 'Komposisi Karyawan',
            'groupOffA' => $groupOffA,
            'groupOffB' => $groupOffB,
            'groupKerja' => $groupKerja,
            'karyawanGroup' => $karyawanGroup,
        ];
        return view('komposisi.v_komposisi', $tmp);
    }
}
