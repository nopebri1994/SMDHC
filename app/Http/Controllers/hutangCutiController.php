<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use Illuminate\Http\Request;

class hutangCutiController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Data Hutang Cuti Karyawan',
        ];
        return view('hutangCuti.v_hutangCuti', $data);
    }

    function postingHutang(Request $request)
    {
        $m = $request->m;
        $y = $request->y;
        $now = date('Y-m-d', strtotime("$y-$m-01"));
        $getData = date('m', strtotime('-6 Months', strtotime($now)));
        $karyawan = karyawanModel::whereMonth('tglMasuk', $getData)->get();
        dd($karyawan);
    }
}
