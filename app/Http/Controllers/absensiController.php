<?php

namespace App\Http\Controllers;

use App\Models\cutiModel;
use App\Models\hutangCutiModel;
use App\Models\keteranganIjinModel;
use Illuminate\Http\Request;

class absensiController extends Controller
{
    public function index()
    {
        $keteranganIjin = keteranganIjinModel::all();
        $data = [
            'title' => 'Proses Absensi Harian',
            'ket'   => $keteranganIjin,
        ];
        return view('absensi.v_absensi', $data);
    }

    function detailData(Request $request)
    {
        $id = $request->id;
        $kode = $request->kode;
        $y = $request->y;

        if ($kode == 'AL') {
            $getData = cutiModel::where('year', $y)->where('idKaryawan', $id)->first();
            if (!empty($getData)) {
                $sendToView = array(
                    'status'        => 1,
                    'message'       => 'Data Cuti tersedia'
                );
                echo json_encode($sendToView);
            } else {
                $sendToView = array(
                    'status'        => 0,
                    'message'       => 'Data Cuti tidak ditemukan'
                );
                echo json_encode($sendToView);
            }
        }

        if ($kode == 'AD') {
            $getData = hutangCutiModel::where('year', $y)->where('idKaryawan', $id)->first();
            if (!empty($getData)) {
            } else {
                $sendToView = array(
                    'status'        => 0,
                    'message'       => 'Data Hutang Cuti tidak ditemukan'
                );
                echo json_encode($sendToView);
            }
        }
    }
}
