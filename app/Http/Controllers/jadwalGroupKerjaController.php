<?php

namespace App\Http\Controllers;

use App\Models\groupKerjaModel;
use App\Models\jadwalGroupKerjaModel;
use App\Models\jamKerjaModel;
use Illuminate\Http\Request;

class jadwalGroupKerjaController extends Controller
{
    function index()
    {
        $groupKerja = groupKerjaModel::all();
        $jamKerja = jamKerjaModel::all();
        $tmp = [
            'title' => 'Jadwal Group Kerja / Shift',
            'groupKerja' => $groupKerja,
            'jamKerja' => $jamKerja,
        ];
        return view('jadwalGroup.v_jadwalGroup', $tmp);
    }
    function storeData(Request $request)
    {
        $group = $request->group;
        $jamKerja = $request->jam;
        $awal = $request->dariTanggal;
        $akhir = $request->sampaiTanggal;

        while (strtotime($awal) <= strtotime($akhir)) {

            $tmp = [
                'idGroupKerja' => $group,
                'idJamKerja' => $jamKerja,
                'tanggal' => $awal
            ];

            jadwalGroupKerjaModel::create($tmp);

            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));
        }
        return redirect()->back()->with('status', 'Data Berhasil disimpan');
    }
    function tabelData()
    {
        $tmp = [
            'data' => jadwalGroupKerjaModel::all(),
        ];
        return view('jadwalGroup.tabelJadwalGroup', $tmp);
    }

    function delete(Request $request)
    {
        $id = $request->id;
        jadwalGroupKerjaModel::where('id', $id)->delete();
    }
}
