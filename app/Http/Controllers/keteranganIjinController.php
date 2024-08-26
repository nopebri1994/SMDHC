<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keteranganIjinModel;
use Illuminate\Support\Facades\Validator;


class keteranganIjinController extends Controller
{
    public function index()
    {
        $data = [
            // 'dataTable' => keteranganIjinModel::paginate(5),
            'title' => 'Data Keterangan Ijin ',
        ];

        return view('keteranganIjin/v_keteranganIjin', $data);
    }

    function tabelData(Request $request)
    {

        $data = [
            'dataTable' => keteranganIjinModel::orderByDesc('id')->paginate(8),
        ];

        //pagination ajax
        if ($request->ajax()) {
            return view('keteranganIjin/tabelKeteranganIjin', $data);
        }
        return view('dataTable', $data);
        //end
    }

    function insert(Request $request)
    {

        //validasi
        // $this->validate($request,[
        //     'kode'=>'required|unique:keteranganijin',
        // ]);
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required|unique:keteranganIjin|max:5',
                'keterangan' => 'required',
            ],
            $messages = [
                'kode.required' => 'Input data tidak boleh Kosong.',
                'kode.unique' => 'Kode tidak Boleh sama',
                'keterangan.required' => 'Keterangan tidak boleh Kosong.',
            ]
        )->validate();


        //ambilData
        keteranganIjinModel::create([
            'kode' => strtoupper($request->kode),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }

    function delete(Request $request)
    {
        keteranganIjinModel::where('id', $request->id)->delete();
    }

    function update(Request $request)
    {

        if ($request->kode != $request->tmpKode) {
            $validator = Validator::make(
                $request->all(),
                [
                    'kode' => 'required|unique:keteranganIjin|max:5',
                ],
                $messages = [
                    'required' => 'Input data tidak boleh Kosong.',
                    'unique' => 'Kode sudah digunakan',
                ]
            )->validate();
        }
        keteranganIjinModel::where('id', $request->id)->update([
            'kode' => strtoupper($request->kode),
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);
    }
}
