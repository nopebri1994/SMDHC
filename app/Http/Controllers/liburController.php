<?php

namespace App\Http\Controllers;

use App\Models\liburModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class liburController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Hari Libur',
        ];
        return view('libur.v_libur', $data);
    }
    public function tabelData()
    {
        $data = [
            'libur' => liburModel::all(),
        ];
        return view('libur.tabelLibur', $data);
    }

    function insert(Request $request)
    {
        $tanggalLibur = $request->tanggalLibur;
        $keterangan = $request->keterangan;

        $validator = Validator::make(
            $request->all(),
            [
                'tanggalLibur' => 'required',
                'keterangan' => 'required',
            ],
            $messages = [
                'tanggalLibur.required' => 'Input data tidak boleh Kosong.',
                'keterangan.required' => 'Keterangan tidak boleh Kosong.',
            ]
        )->validate();

        liburModel::create([
            'tanggalLibur' => $tanggalLibur,
            'keterangan' => $keterangan,
        ]);


        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }
    function delete(Request $request)
    {
        liburModel::where('id', $request->id)->delete();
    }
    function update(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'tanggalLibur' => 'required',
            ],
            $messages = [
                'required' => 'Input data tidak boleh Kosong.',
            ]
        )->validate();

        liburModel::where('id', $request->id)->update([
            'tanggalLibur' => $request->tanggalLibur,
            'keterangan' => $request->keterangan,
        ]);
    }
}
