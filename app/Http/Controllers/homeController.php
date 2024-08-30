<?php

namespace App\Http\Controllers;

use App\Models\bagianModel;
use App\Models\departemenModel;
use Illuminate\Http\Request;
use App\Models\karyawanModel;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
        $count = karyawanModel::whereNull('km')->count();
        $metal = karyawanModel::where('idPerusahaan', 1)->whereNull('km')->count();
        $bagian = DB::table('bagian')->select('namaBagian')->where('departemen.idPerusahaan', 1)->join('departemen', 'departemen.id', 'bagian.idDepartemen')->orderBy('bagian.id')->get()->toArray();
        $metalCount = DB::table('dataKaryawan')->select(DB::raw('count(*) as total,idBagian'))->whereNull('km')->whereNotNull('idBagian')->where('idDepartemen', 1)->groupBy('idBagian')->orderBy('idBagian')->get()->toArray();
        $data = [
            'title' => 'Sistem Manajemen Data Human Capital',
            'countEmployee' => $count,
            'metalEmployee' => $metal,
            'bagian' => $bagian,
            'metalC' => $metalCount,
        ];

        return view('home', $data);
    }
}
