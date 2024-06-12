<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jamKerjaModel;
use Illuminate\Support\Facades\Validator;

class jamKerjaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Jam Kerja ',
        ];
        return view('jamKerja/v_jamKerja', $data);
    }

    function tabelData(Request $request)
    {

        $data = [
            'dataTable' => jamKerjaModel::orderBy('id')->paginate(8),
        ];

        //pagination ajax
        if ($request->ajax()) {
            return view('jamKerja/tabelJamKerja', $data);
        }
        return view('dataTable', $data);
        //end
    }

    function insert(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required|max:5',
                'jamMasukSJ' => 'required',
                'jamPulangSJ' => 'required',
                'jamMasukS' => 'required',
                'jamPulangS' => 'required',
            ],
            $messages = [
                'kode.required' => 'Input data tidak boleh Kosong.',
                'jamMasukSJ.required' => 'Input data tidak boleh Kosong.',
                'jamPulangSJ.required' => 'Input data tidak boleh Kosong.',
                'jamMasukS.required' => 'Input data tidak boleh Kosong.',
                'jamPulangS.required' => 'Input data tidak boleh Kosong.',

            ]
        )->validate();


        //ambilData
        jamKerjaModel::create([
            'kodeJamKerja'  => strtoupper($request->kode),
            'jamMasukSJ'    => $request->jamMasukSJ,
            'jamPulangSJ'   => $request->jamPulangSJ,
            'jamMasukS'     => $request->jamMasukS,
            'jamPulangS'    => $request->jamPulangS,
        ]);

        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }

    function delete(Request $request)
    {
        jamKerjaModel::where('id', $request->id)->delete();
    }

    function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required|max:5',
                'jamMasukSJ' => 'required',
                'jamPulangSJ' => 'required',
                'jamMasukS' => 'required',
                'jamPulangS' => 'required',
            ],
            $messages = [
                'kode' => 'Input data tidak boleh Kosong.',
                'jamMasukSJ.required' => 'Input data tidak boleh Kosong.',
                'jamPulangSJ.required' => 'Input data tidak boleh Kosong.',
                'jamMasukS.required' => 'Input data tidak boleh Kosong.',
                'jamPulangS.required' => 'Input data tidak boleh Kosong.',

            ]
        )->validate();

        jamKerjaModel::where('id', $request->id)->update([
            'kodeJamKerja'  => strtoupper($request->kode),
            'jamMasukSJ'    => $request->jamMasukSJ,
            'jamPulangSJ'   => $request->jamPulangSJ,
            'jamMasukS'     => $request->jamMasukS,
            'jamPulangS'    => $request->jamPulangS,
        ]);
    }
}
