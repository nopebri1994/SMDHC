<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perusahaanModel;
use Illuminate\Support\Facades\Validator;

class perusahaanController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Data Perusahaan ',
        ];
        return view('perusahaan/v_perusahaan', $data);
    }

    function tabelData(Request $request)
    {

        $data = [
            'dataTable' => perusahaanModel::paginate(8),
        ];

        //pagination ajax
        if ($request->ajax()) {
            return view('perusahaan.tabelPerusahaan', $data);
        }
        return view('dataTable', $data);
        //end
    }

    function insert(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required',
            ],
            $messages = [
                'nama.required' => 'Nama tidak boleh Kosong.',
            ]
        )->validate();

        //ambilData
        perusahaanModel::create([
            'namaPerusahaan' => strtoupper($request->nama),
        ]);

        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }
    function delete(Request $request)
    {
        perusahaanModel::where('id', $request->id)->delete();
    }
    function update(Request $request)
    {
        perusahaanModel::where('id', $request->id)->update([
            'namaPerusahaan' => strtoupper($request->nama),
        ]);
    }
}
