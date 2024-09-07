<?php

namespace App\Http\Controllers;

use App\Models\bagianModel;
use App\Models\departemenModel;
use Illuminate\Http\Request;
use App\Models\karyawanModel;
use App\Models\kontrakKaryawanModel;
use App\Models\SPModel;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d');
        $notifikasi = date('Y-m-d', strtotime('-31 days', strtotime($date)));
        $akhir = date('Y-m-d', strtotime('+31 days', strtotime($date)));
        $count = karyawanModel::whereNull('km')->count();
        $metal = karyawanModel::where('idPerusahaan', 1)->whereNull('km')->count();
        $metalCount = DB::table('dataKaryawan')->select(DB::raw('count(*) as total,idBagian,bagian.namaBagian,bagian.kode'))->join('bagian', 'bagian.id', 'dataKaryawan.idBagian')->whereNull('km')->whereNotNull('idBagian')->where('idPerusahaan', 1)->groupBy('idBagian')->orderBy('idBagian')->get()->toArray();
        $pkwt = kontrakKaryawanModel::where('status', '1')->whereBetween('sampaiTanggal', [$notifikasi, $akhir])->count();
        $sp = SPModel::where('status', '1')->whereBetween('sampaiTanggal', [$notifikasi, $akhir])->count();
        $data = [
            'title' => 'Sistem Manajemen Data Human Capital',
            'countEmployee' => $count,
            'metalEmployee' => $metal,
            'metalC' => $metalCount,
            'pkwt' => $pkwt,
            'sp' => $sp,
        ];

        return view('home', $data);
    }
}
