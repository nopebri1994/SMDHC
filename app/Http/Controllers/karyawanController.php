<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\perusahaanModel;
use App\Models\jabatanModel;
use App\Models\jamKerjaModel;
use Illuminate\Support\Facades\Validator;
use App\Models\karyawanModel;

class karyawanController extends Controller
{
    public function index()
    {
        $karyawan   = karyawanModel::all();
        $data = [
            'title'     => 'Daftar Karyawan',
            'karyawan'  => $karyawan,
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
                'nikKerja' => 'required|unique:datakaryawan',
                'nama' => 'required',
                'tmt' => 'required',
                'fpId' => 'required|unique:datakaryawan'
            ],
            $messages = [
                'nikKerja.required' => 'NIK tidak boleh Kosong.',
                'nama.required' => 'Nama tidak boleh kosong.',
                'tmt.required' => 'Tanggal Masuk tidak boleh kosong',
                'fpId.required' => 'ID Finger print tidak boleh kosong',
            ]
        );
        if ($validator->fails()) {
            return redirect('dk/karyawan/addData')
                ->withErrors($validator)
                ->withInput();
        };

        $tmpSave = [
            'nikKerja'          => $request->nikKerja,
            'namaKaryawan'      => $request->nama,
            'jenisKelamin'      => $request->JK,
            'tglMasuk'          => $request->tmt,
            'fpId'              => $request->fpId,
            'idPerusahaan'      => $request->perusahaan,
            'idDepartemen'      => $request->departemen,
            'idBagian'          => $request->bagian,
            'idJabatan'         => $request->jabatan,
            'statusKaryawan'    => $request->statusKaryawan,
            'idJamKerja'        => $request->jamKerja

        ];
        karyawanModel::create($tmpSave);
        return redirect('dk/karyawan')->with('status', 'Data berhasil disimpan');
    }
}
