<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\jabatanModel;


class jabatanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Jabatan ',
        ];
        return view('jabatan/v_jabatan', $data);
    }

    function tabelData(Request $request)
    {

        $data = [
            'dataTable' => jabatanModel::orderByDesc('id')->paginate(8),
        ];

        //pagination ajax
        if ($request->ajax()) {
            return view('jabatan/tabeljabatan', $data);
        }
        return view('dataTable', $data);
        //end
    }

    function insert(Request $request)
    {

        //validasi
        // $this->validate($request,[
        //     'kode'=>'required|unique:jabatan',
        // ]);
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required|max:5',
                'nama' => 'required',
            ],
            $messages = [
                'kode.required' => 'Input data tidak boleh Kosong.',
                'nama.required' => 'Keterangan tidak boleh Kosong.',
            ]
        )->validate();


        //ambilData
        jabatanModel::create([
            'kodeJabatan' => strtoupper($request->kode),
            'namaJabatan' => $request->nama
        ]);

        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }

    function delete(Request $request)
    {
        jabatanModel::where('id', $request->id)->delete();
    }

    function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required|max:5',
            ],
            $messages = [
                'required' => 'Input data tidak boleh Kosong.',
            ]
        )->validate();

        jabatanModel::where('id', $request->id)->update([
            'kodeJabatan' => strtoupper($request->kode),
            'namaJabatan' => $request->nama,
        ]);
    }
}
