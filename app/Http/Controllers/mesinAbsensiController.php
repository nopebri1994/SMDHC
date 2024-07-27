<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mesinAbsensiModel;
use Illuminate\Support\Facades\Validator;

class mesinAbsensiController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Mesin Absensi',
        ];
        return view('mesinAbsensi.v_mesinAbsensi', $data);
    }
    public function tabelData()
    {
        $data = [
            'mesin' => mesinAbsensiModel::all(),
        ];
        return view('mesinAbsensi.tabelMesinAbsensi', $data);
    }

    function insert(Request $request)
    {
        $namaMesin = $request->namaMesin;
        $keyMesin = $request->keyMesin;
        $ipAddress = $request->ipAddress;
        $keterangan = $request->keterangan;

        $validator = Validator::make(
            $request->all(),
            [
                'namaMesin' => 'required',
                'keyMesin' => 'required',
                'ipAddress' => 'required',
                'keterangan' => 'required',

            ],
            $messages = [
                'namaMesin.required' => 'Input data tidak boleh Kosong.',
                'keyMesin.required' => 'Key Mesin tidak boleh Kosong.',
            ]
        )->validate();

        mesinAbsensiModel::create([
            'namaMesin'     => $namaMesin,
            'key'           => $keyMesin,
            'ipAddress'     => $ipAddress,
            'keterangan'    => $keterangan
        ]);


        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }
    function delete(Request $request)
    {
        mesinAbsensiModel::where('id', $request->id)->delete();
    }
    function update(Request $request)
    {
        $namaMesin = $request->namaMesin;
        $keyMesin = $request->keyMesin;
        $ipAddress = $request->ipAddress;
        $keterangan = $request->keterangan;

        $validator = Validator::make(
            $request->all(),
            [
                'namaMesin' => 'required',
                'keyMesin' => 'required',
                'ipAddress' => 'required',

            ],
            $messages = [
                'namaMesin.required' => 'Input data tidak boleh Kosong.',
                'keyMesin.required' => 'Key Mesin tidak boleh Kosong.',
            ]
        )->validate();

        mesinAbsensiModel::where('id', $request->id)->update([
            'namaMesin'     => $namaMesin,
            'key'           => $keyMesin,
            'ipAddress'     => $ipAddress,
            'keterangan'    => $keterangan
        ]);
    }
}
