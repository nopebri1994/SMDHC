<?php

namespace App\Http\Controllers;

use App\Models\bagianModel;
use App\Models\departemenModel;
use App\Models\fkpModel;
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

        //fkp
        $fkp = fkpModel::whereBetween('tglSelesai', [$notifikasi, $akhir])->orderBy('tglSelesai')->count();

        //PMK
        $karyawan = karyawanModel::whereNull('km')->where('statusKaryawan', '2')->orderBy('tglMasuk')->get();

        $hak = 0;
        foreach ($karyawan as $k) {
            $pmk9 = date('Y-m-d', strtotime('+9 years', strtotime($k->tglMasuk)));
            $pmk10 = date('Y-m-d', strtotime('+10 years', strtotime($k->tglMasuk)));
            $pmk92 = date('Y-m-d', strtotime('+10 month', strtotime($pmk9)));
            $pmkdisplay1 = date('Y-m-d', strtotime('+10 years', strtotime($k->tglMasuk)));

            $pmk19 = date('Y-m-d', strtotime('+19 years', strtotime($k->tglMasuk)));
            $pmk192 = date('Y-m-d', strtotime('+10 month', strtotime($pmk19)));
            $pmk20 = date('Y-m-d', strtotime('+20 years', strtotime($k->tglMasuk)));
            $pmkdisplay2 = date('Y-m-d', strtotime('+20 years', strtotime($k->tglMasuk)));

            $pmk24 = date('Y-m-d', strtotime('+24 years', strtotime($k->tglMasuk)));
            $pmk25 = date('Y-m-d', strtotime('+25 years', strtotime($k->tglMasuk)));
            $pmk242 = date('Y-m-d', strtotime('+10 month', strtotime($pmk24)));
            $pmkdisplay3 = date('Y-m-d', strtotime('+25 years', strtotime($k->tglMasuk)));

            $pmk29 = date('Y-m-d', strtotime('+29 years', strtotime($k->tglMasuk)));
            $pmk30 = date('Y-m-d', strtotime('+30 years', strtotime($k->tglMasuk)));
            $pmk292 = date('Y-m-d', strtotime('+10 month', strtotime($pmk29)));
            $pmkdisplay4 = date('Y-m-d', strtotime('+30 years', strtotime($k->tglMasuk)));
            if (
                $date > $pmk92 and $date <= $pmk10 or
                $date > $pmk192 and $date <= $pmk20 or
                $date > $pmk242 and $date <= $pmk25 or
                $date > $pmk292 and $date <= $pmk30
            ) {
                $hak = $hak + 1;
            }
        }

        $data = [
            'title' => 'Sistem Manajemen Data Human Capital',
            'countEmployee' => $count,
            'metalEmployee' => $metal,
            'metalC' => $metalCount,
            'pkwt' => $pkwt,
            'sp' => $sp,
            'pmk' => $hak,
            'fkp' => $fkp
        ];

        return view('home', $data);
    }
}
