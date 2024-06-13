<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perusahaanModel;
use App\Models\jabatanModel;
use App\Models\jamKerjaModel;
use Illuminate\Support\Facades\Validator;

class karyawanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Karyawan',
        ];
        return View('karyawan.v_karyawan', $data);
    }

    function addData()
    {
        $perusahaan = perusahaanModel::all();
        $jabatan    = jabatanModel::all();
        $jamKerja   = jamKerjaModel::all();
        $data = [
            'title'         => 'Tambah Data Karyawan',
            'perusahaan'    => $perusahaan,
            'jabatan'       => $jabatan,
            'jamKerja'      => $jamKerja,
        ];

        return View('karyawan.addDataKaryawan', $data);
    }

    function storeData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nikKerja' => 'required',
                'nama' => 'required',
                'tmt' => 'required',
                'fpId' => 'required'
            ],
            $messages = [
                'nikKerja.required' => 'NIK tidak boleh Kosong.',
                'nama.required' => 'Nama tidak boleh kosong.',
                'tmt.required' => 'Tanggal Masuk tidak boleh kosong',
            ]
        );
        if ($validator->fails()) {
            return redirect('dk/karyawan/addData')
                ->withErrors($validator)
                ->withInput();
        }
    }
}
