<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\departemenModel;
use Illuminate\Support\Facades\Validator;
use App\Models\perusahaanModel;

class departemenController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Departemen ',
            'perusahaan' => perusahaanModel::all(),
        ];
        return view('departemen/v_departemen', $data);
    }

    function tabelData(Request $request)
    {

        $data = [
            'dataTable' => departemenModel::latest()->paginate(8),
        ];
        //pagination ajax
        if ($request->ajax()) {
            return view('departemen.tabelDepartemen', $data);
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
                'kode' => 'required|max:5',
                'nama' => 'required',
            ],
            $messages = [
                'kode.required' => 'Input data tidak boleh Kosong.',
                'nama.required' => 'Nama tidak boleh Kosong.',
            ]
        )->validate();


        //ambilData
        departemenModel::create([
            'kode' => strtoupper($request->kode),
            'namaDepartemen' => $request->nama,
            'idPerusahaan' => $request->idPerusahaan,
        ]);

        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }
    function delete(Request $request)
    {
        departemenModel::where('id', $request->id)->delete();
    }
    function update(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'kode' => 'required|max:5',
            ],
            $messages = [
                'kodde.required' => 'Input data tidak boleh Kosong.',

            ]
        )->validate();

        departemenModel::where('id', $request->id)->update([
            'kode' => strtoupper($request->kode),
            'namaDepartemen' => $request->nama,
            'idPerusahaan' => $request->idPerusahaan,
        ]);
    }
    function selectDepartemen(Request $request)
    {

        $departemen = departemenModel::where('idPerusahaan', $request->idPerusahaan)->get();
        foreach ($departemen as $d) {
            echo "<option value='$d->id'>$d->namaDepartemen</option>";
        }
    }
}
