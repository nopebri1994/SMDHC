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
        $metalCount = DB::table('dataKaryawan')->select(DB::raw('count(*) as total,idBagian,bagian.namaBagian'))->join('bagian', 'bagian.id', 'datakaryawan.idBagian')->whereNull('km')->whereNotNull('idBagian')->where('idPerusahaan', 1)->groupBy('idBagian')->orderBy('idBagian')->get()->toArray();
        $data = [
            'title' => 'Sistem Manajemen Data Human Capital',
            'countEmployee' => $count,
            'metalEmployee' => $metal,
            'metalC' => $metalCount,
        ];

        return view('home', $data);
    }
}
