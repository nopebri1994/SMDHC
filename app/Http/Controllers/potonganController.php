<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\potonganCutiModel;

class potonganController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Potongan Cuti Tahunan ',
        ];
        return view('potonganCuti/v_potonganCuti', $data);
    }

    function tabelData(Request $request)
    {
        $y = $request->year;
        if (empty($y)) {
            $data = [
                'dataTable' => potonganCutiModel::orderBy('id')->paginate(8),
            ];
        } else {
            $data = [
                'dataTable' => potonganCutiModel::where('tahunPotongan', $y)->orderBy('id')->paginate(8),
            ];
        }


        //pagination ajax
        if ($request->ajax()) {
            return view('potonganCuti/tabelPotonganCuti', $data);
        }
        return view('dataTable', $data);
        //end
    }

    function insert(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'year' => 'required',
                'nama' => 'required',
                'totalPotongan' => 'required',
                'keterangan' => 'required',
            ],
            $messages = [
                'year.required' => 'Input data tidak boleh Kosong.',
                'nama.required' => 'Input data tidak boleh Kosong.',
                'totalPotongan.required' => 'Input data tidak boleh Kosong.',
                'keterangan.required' => 'Input data tidak boleh Kosong.',
            ]
        )->validate();


        //ambilData
        potonganCutiModel::create([
            'namaPotongan'  => $request->nama,
            'tahunPotongan' => $request->year,
            'totalPotongan' => $request->totalPotongan,
            'keterangan'    => $request->keterangan,
        ]);

        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }

    function delete(Request $request)
    {
        potonganCutiModel::where('id', $request->id)->delete();
    }

    function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'year' => 'required',
                'nama' => 'required',
                'totalPotongan' => 'required',
                'keterangan' => 'required',
            ],
            $messages = [
                'year.required' => 'Input data tidak boleh Kosong.',
                'nama.required' => 'Input data tidak boleh Kosong.',
                'totalPotongan.required' => 'Input data tidak boleh Kosong.',
                'keterangan.required' => 'Input data tidak boleh Kosong.',
            ]
        )->validate();

        potonganCutiModel::where('id', $request->id)->update([
            'namaPotongan'  => $request->nama,
            'tahunPotongan' => $request->year,
            'totalPotongan' => $request->totalPotongan,
            'keterangan'    => $request->keterangan,
        ]);
    }
}
