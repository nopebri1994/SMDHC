<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\bagianModel;
use App\Models\departemenModel;
use App\Models\perusahaanModel;

class bagianController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Bagian ',
            'perusahaan' => perusahaanModel::all(),
        ];
        return view('bagian/v_bagian', $data);
    }

    function selectPerusahaan(Request $request)
    {

        $departemen = departemenModel::where('idPerusahaan', $request->idPerusahaan)->get();
        foreach ($departemen as $d) {
            echo "<option value='$d->id'>$d->namaDepartemen</option>";
        }
    }

    function tabelData(Request $request)
    {

        $data = [
            'dataTable' => bagianModel::orderBy('idDepartemen')->paginate(8),
        ];
        //pagination ajax
        if ($request->ajax()) {
            return view('bagian.tabelBagian', $data);
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
        bagianModel::create([
            'namaBagian' => $request->nama,
            'idDepartemen' => $request->idDepartemen,
            'kode' => strtoupper($request->kode),
        ]);

        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }
    function delete(Request $request)
    {
        bagianModel::where('id', $request->id)->delete();
    }
    function update(Request $request)
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

        bagianModel::where('id', $request->id)->update([
            'namaBagian' => $request->nama,
            'idDepartemen' => $request->idDepartemen,
            'kode' => strtoupper($request->kode),
        ]);
    }
}
