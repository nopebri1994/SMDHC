<?php

namespace App\Http\Controllers;

use App\Models\fkpModel;
use App\Models\karyawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class fkpController extends Controller
{
    function index()
    {
        $date = date('Y-m-d');
        $data = fkpModel::where('tglSelesai', '>=', $date)->orderBy('tglSelesai')->get();

        $tmp = [
            'data' => $data,
            'title' => 'Data Kebutuhan Pelatihan',
        ];
        return view('fkp.v_fkp', $tmp);
    }

    function addData()
    {
        $karyawan = karyawanModel::whereNull('km')->get();
        $tmp = [
            'title' => 'Tambah Data Kebutuhan Pelatihan',
            'karyawan' => $karyawan,
        ];
        return view('fkp.addFKP', $tmp);
    }

    function storeData(Request $request)
    {
        $id = $request->idKaryawan;
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'mimes:pdf',
            ],
            $messages = [
                'file.mimes' => 'Format file harus PDF.',
            ]
        );
        if ($validator->fails()) {
            return redirect('psn/fkp/addData')
                ->withErrors($validator)
                ->withInput();
        };

        $uid = karyawanModel::where('id', $id)->first();
        $fileName = $uid->uuid  . time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(storage_path('app/public/fkp'), $fileName);

        $typelain = null;
        if ($request->type == 0) {
            $typelain = $request->typeLain;
        };

        $jenislain = null;
        if ($request->jenis == 0) {
            $jenislain = $request->jenisLain;
        };

        $tmp = [
            'idKaryawan' => $id,
            'typePelatihan' => $request->type,
            'typeLain' => $typelain,
            'jenisPelatihan' => $request->jenis,
            'JenisLain' => $jenislain,
            'tglMulai' => $request->awal,
            'tglSelesai' => $request->akhir,
            'file' => $fileName
        ];
        fkpModel::create($tmp);
        return redirect('/psn/fkp')->with('status', 'Data Berhasil disimpan');
    }
}
