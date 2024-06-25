<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawanModel;
use App\Models\cutiModel;
use App\Models\potonganCutiModel;
use varHelper;

class cutiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Cuti Tahunan',
        ];
        return view('cuti.v_cuti', $data);
    }

    function postingCuti(Request $request)
    {
        $m = $request->m;
        $y = $request->y;
        $now = date_create(date('Y-m-d', strtotime("$y-$m-01")));
        $karyawan = karyawanModel::whereMonth('tglMasuk', $m)->whereYear('tglMasuk', '<', $y)->get();

        foreach ($karyawan as $k) {
            $tglMasuk = date_create($k->tglMasuk);
            $selisih = date_diff($now, $tglMasuk);
            $hasilCuti = varHelper::varCuti($selisih->y);
            $potonganTahunan = potonganCutiModel::where('tahunPotongan', $y)->sum('totalPotongan');
            $cekData = cutiModel::where('month', $m)->where('year', $y)->where('idKaryawan', $k->id)->first();

            if (empty($cekData)) {
                $sisaCuti = $hasilCuti['hak'] - $potonganTahunan;
                $tmpSave = [
                    'idKaryawan' => $k->id,
                    'jumlahCuti' => $sisaCuti,
                    'ambilCuti' => 0,
                    'sisaCuti' => $sisaCuti,
                    'keterangan' => $hasilCuti['status'],
                    'month' => $m,
                    'year' => $y
                ];
                cutiModel::create($tmpSave);
            }
        }
    }
    function tabelCuti(Request $request)
    {
        $m = $request->m;
        $y = $request->y;
        $data = [
            'vCuti' => cutiModel::where('month', $m)->where('year', $y)->get(),
        ];

        return view('cuti.postingCuti', $data);
    }
    function detailData(Request $request)
    {
        $detail = karyawanModel::where('nikKerja', $request->nik)->first();
        if (empty($detail)) {
            $sendToView = array(
                'status' => 0,
            );
            echo json_encode($sendToView);
        } else {
            $namaDept = $detail->departemen->kode;
            $namaBag = $detail->bagian->kode;
            $sendToView = array(
                'status'        => 1,
                'namaKaryawan'  => $detail->namaKaryawan,
                'deptBagian'    => "$namaDept / $namaBag",
                'idKaryawan'    => $detail->id,
            );
            echo json_encode($sendToView);
        }
    }

    function detailCuti(Request $request)
    {
        $id     = $request->id;
        $y      = $request->year;

        $cuti = cutiModel::where('idKaryawan', $id)->where('year', $y)->first();
        $tglMasuk = date_create($cuti->karyawan->tglMasuk);
        $m = $cuti->month;
        $now = date_create(date('Y-m-d', strtotime("$y-$m-01")));
        $selisih = date_diff($now, $tglMasuk);

        $data = [
            'vCuti'     => $cuti,
            'masaKerja' => $selisih->y,
        ];

        return view('cuti.detailCuti', $data);
    }
}
