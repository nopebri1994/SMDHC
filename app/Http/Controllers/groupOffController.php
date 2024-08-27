<?php

namespace App\Http\Controllers;

use App\Models\groupOffModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class groupOffController extends Controller
{
    function index()
    {
        $data = [
            'title' => 'Data Sabtu OFF',
        ];
        return view('groupOff.v_groupOff', $data);
    }

    function storeData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'group' => 'required',
                'dariTanggal' => 'required',
                'sampaiTanggal' => 'required',

            ]
        )->validate();


        $group = $request->group;
        $dari = $request->dariTanggal;
        $sampai = $request->sampaiTanggal;

        $skip = 0;
        while (strtotime($dari) <= strtotime($sampai)) {
            $cek = groupOffModel::where('tanggalOff', $dari)->first();
            if (date('l', strtotime($dari)) == 'Saturday' and $skip == 0 and empty($cek)) {
                $tmp = [
                    'group' => $group,
                    'tanggalOff' => $dari,
                ];
                groupOffModel::create($tmp);
                $skip = 1;
            } elseif (date('l', strtotime($dari)) == 'Saturday' and $skip == 1) {
                $skip = 0;
            }
            $dari = date('Y-m-d', strtotime('+1 days', strtotime($dari)));
        }

        return back();
    }

    function tabelData()
    {
        $tmp = [
            'data' => groupOffModel::orderBy('tanggalOff')->get(),
        ];
        return view('groupOff.tabelGroup', $tmp);
    }
    function delete(Request $request)
    {
        $id = $request->id;
        groupOffModel::where('id', $id)->delete();
    }
}
