<?php

namespace App\Http\Controllers;

use App\Models\detailHutangCutiModel;
use App\Models\hutangCutiModel;
use App\Models\karyawanModel;
use App\Models\potonganCutiModel;
use Illuminate\Http\Request;
use varHelper;

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
        if ($m > 6) {
            $tahunPotongan = $y + 1;
        } else {
            $tahunPotongan = $y;
        }
        $now = date('Y-m-d', strtotime("$y-$m-01"));
        $getData = date('m', strtotime('-6 Months', strtotime($now)));
        $karyawan = karyawanModel::whereMonth('tglMasuk', $getData)->whereNULL('km')->get();
        $potonganTahunan = potonganCutiModel::where('tahunPotongan', $tahunPotongan)->sum('totalPotongan');
        foreach ($karyawan as $k) {
            $noww = date_create($now);
            $tglMonth = date('m', strtotime($k->tglMasuk));
            $tglYear = date('Y', strtotime($k->tglMasuk));
            $tglMasuk = date_create(date('Y-m-d', strtotime("$tglYear-$tglMonth-01")));
            $selisih = date_diff($noww, $tglMasuk);
            $hasilCuti = varHelper::varHutangCuti($selisih->y);
            $maksHutang = ($hasilCuti['hak'] - $potonganTahunan) / 2;
            $cekData = hutangCutiModel::where('month', $m)->where('year', $tahunPotongan)->where('idKaryawan', $k->id)->first();

            if (empty($cekData)) {
                $tmpSave = [
                    'idKaryawan' => $k->id,
                    'jumlahHutangCuti' => floor($maksHutang),
                    'ambilHutangCuti' => 0,
                    'keterangan' => $hasilCuti['status'],
                    'month' => $m,
                    'year' => $tahunPotongan,
                    'expired' => date('Y-m-d', strtotime('+6 Months', strtotime($now))),
                ];
                hutangCutiModel::create($tmpSave);
            }
        }
    }

    function tabelHutang(Request $request)
    {
        $m = $request->m;
        if ($m > 6) {
            $y = $request->y + 1;
        } else {
            $y = $request->y;
        }
        $data = [
            'vCuti' => hutangCutiModel::where('month', $m)->where('year', $y)->get(),
        ];

        return view('hutangCuti.postingHutang', $data);
    }

    function detailHutang(Request $request)
    {
        $id     = $request->id;
        $y      = $request->year;

        $cuti = hutangCutiModel::with('karyawan')->where('idKaryawan', $id)->where('year', $y)->first();
        $tglMasuk = date_create($cuti->karyawan->tglMasuk);
        $m = $cuti->month;
        $now = date_create(date('Y-m-d', strtotime("$y-$m-01")));
        $selisih = date_diff($now, $tglMasuk);
        $detail = detailHutangCutiModel::where('idKaryawan', $id)->where('tahun', $y)->get();

        $data = [
            'vCuti'     => $cuti,
            'detail'    => $detail,
            'masaKerjaTahun' => $selisih->y - 1,
            'masaKerjaBulan' => $selisih->m,
        ];

        return view('hutangCuti.detailHutang', $data);
    }
}
