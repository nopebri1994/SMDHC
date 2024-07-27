<?php

namespace App\Http\Controllers;

use App\Imports\karyawanImport;
use App\Models\bagianModel;
use App\Models\departemenModel;
use Illuminate\Http\Request;
use App\Models\perusahaanModel;
use App\Models\jabatanModel;
use App\Models\jamKerjaModel;
use Illuminate\Support\Facades\Validator;
use App\Models\karyawanModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;



class karyawanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::where('idBagian', auth()->user()->karyawan->idBagian)->orderBy('nikKerja')->get();
        } else {
            $karyawan   = karyawanModel::orderBy('nikKerja')->get();
        }
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
                'fpId' => 'required|unique:datakaryawan',
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
        if ($request->bagian ==  'null') {
            $tmp_bagian = null;
        } else {
            $tmp_bagian = $request->bagian;
        }
        $tmpSave = [
            'nikKerja'          => $request->nikKerja,
            'namaKaryawan'      => strtoupper($request->nama),
            'jenisKelamin'      => $request->JK,
            'tglMasuk'          => $request->tmt,
            'fpId'              => $request->fpId,
            'idPerusahaan'      => $request->perusahaan,
            'idDepartemen'      => $request->departemen,
            'idBagian'          => $tmp_bagian,
            'idJabatan'         => $request->jabatan,
            'statusKaryawan'    => $request->statusKaryawan,
            'idJamKerja'        => $request->jamKerja

        ];
        karyawanModel::create($tmpSave);
        return redirect('dk/karyawan')->with('status', 'Data berhasil disimpan');
    }

    function updateData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nikKerja' => 'sometimes|required|unique:datakaryawan,uuid,' . $request->id,
                'nama' => 'required',
                'tmt' => 'required',
                'fpId' => 'required|unique:datakaryawan,uuid,' . $request->id,
            ],
            $messages = [
                'nikKerja.required' => 'NIK tidak boleh Kosong.',
                'nama.required' => 'Nama tidak boleh kosong.',
                'tmt.required' => 'Tanggal Masuk tidak boleh kosong',
                'fpId.required' => 'ID Finger print tidak boleh kosong',
            ]
        );
        if ($validator->fails()) {
            return redirect("dk/karyawan/edit-data/$request->id")
                ->withErrors($validator)
                ->withInput();
        };

        if ($request->bagian ==  'null') {
            $tmp_bagian = null;
        } else {
            $tmp_bagian = $request->bagian;
        }

        $tmpSave = [
            'nikKerja'          => $request->nikKerja,
            'namaKaryawan'      => strtoupper($request->nama),
            'jenisKelamin'      => $request->JK,
            'tglMasuk'          => $request->tmt,
            'fpId'              => $request->fpId,
            'idPerusahaan'      => $request->perusahaan,
            'idDepartemen'      => $request->departemen,
            'idBagian'          => $tmp_bagian,
            'idJabatan'         => $request->jabatan,
            'statusKaryawan'    => $request->statusKaryawan,
            'idJamKerja'        => $request->jamKerja

        ];
        karyawanModel::where('uuid', $request->id)->update($tmpSave);
        return redirect('dk/karyawan')->with('status', 'Data berhasil diperbarui');
    }

    function detailData(Request $request)
    {

        $uuid = $request->id;
        $detailData = karyawanModel::where('uuid', $uuid)->first();

        $data = [
            'title'         => 'Detail Data Karyawan',
            'detailData'    => $detailData,
        ];

        return View('karyawan.detailDataKaryawan', $data);
    }
    function editData(Request $request)
    {

        $uuid = $request->id;
        $detailData = karyawanModel::where('uuid', $uuid)->first();
        $departemen = departemenModel::where('idPerusahaan', $detailData->idPerusahaan)->get();
        $perusahaan = perusahaanModel::all();
        $jabatan    = jabatanModel::all();
        $jamKerja   = jamKerjaModel::all();
        $bagian     = bagianModel::where('idDepartemen', $detailData->idDepartemen)->get();

        $data = [
            'title'         => 'Edit Data Karyawan',
            'detailData'    => $detailData,
            'perusahaan'    => $perusahaan,
            'jabatan'       => $jabatan,
            'jamKerja'      => $jamKerja,
            'departemen'    => $departemen,
            'bagian'        => $bagian,
        ];

        return View('karyawan.editDataKaryawan', $data);
    }
    function export(Request $request)
    {
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('assets/upload/file_karyawan', $nama_file);
        Excel::import(new karyawanImport, public_path('/assets/upload/file_karyawan/' . $nama_file));
    }
}
