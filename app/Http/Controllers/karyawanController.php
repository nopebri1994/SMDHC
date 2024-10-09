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
use App\Models\groupKerjaModel;
use App\Models\salaryModel;
use App\Models\tunjaganPotonganModel;
use varHelper;

class karyawanController extends Controller
{
    public function index()
    {
        $data = [
            'title'     => 'Daftar Karyawan',
            'perusahaan' => perusahaanModel::all(),
        ];
        return View('karyawan.v_karyawan', $data);
    }

    function tableData(Request $request)
    {
        $perusahaan = $request->perusahaan;
        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idBagian', auth()->user()->karyawan->idBagian)->orderBy('nikKerja')->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->orderBy('nikKerja')->get();
        } else {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idPerusahaan', $perusahaan)->orderBy('nikKerja')->get();
        }
        $data = [
            'karyawan'  => $karyawan,
        ];
        return View('karyawan.vTable', $data);
    }

    function addData()
    {
        $perusahaan = perusahaanModel::all();
        $jabatan    = jabatanModel::all();
        $jamKerja   = jamKerjaModel::all();
        $groupKerja = groupKerjaModel::all();

        $data = [
            'title'         => 'Tambah Data Karyawan',
            'perusahaan'    => $perusahaan,
            'jabatan'       => $jabatan,
            'jamKerja'      => $jamKerja,
            'groupKerja'    => $groupKerja,
        ];

        return View('karyawan.addDataKaryawan', $data);
    }

    function storeData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nikKerja' => 'required|unique:dataKaryawan',
                'nama' => 'required',
                'tmt' => 'required',
                'fpId' => 'required|unique:dataKaryawan',
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
        if ($request->groupKerja ==  'null') {
            $tmp_groupKerja = null;
        } else {
            $tmp_groupKerja = $request->groupKerja;
        }

        if ($request->email == '') {
            $email = NULL;
        } else {
            $email = $request->email;
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
            'idJamKerja'        => $request->jamKerja,
            'groupOff'          => $request->groupOff,
            'idGroupKerja'      => $tmp_groupKerja,
            'email'             => $email,

        ];
        karyawanModel::create($tmpSave);
        return redirect('dk/karyawan')->with('status', 'Data berhasil disimpan');
    }

    function updateData(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nikKerja' => 'sometimes|required|unique:dataKaryawan,uuid,' . $request->id,
                'nama' => 'required',
                'tmt' => 'required',
                'fpId' => 'required|unique:dataKaryawan,uuid,' . $request->id,
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
        if ($request->groupKerja ==  'null') {
            $tmp_groupKerja = null;
        } else {
            $tmp_groupKerja = $request->groupKerja;
        }
        if ($request->email == '') {
            $email = NULL;
        } else {
            $email = $request->email;
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
            'idJamKerja'        => $request->jamKerja,
            'groupOff'        => $request->groupOff,
            'idGroupKerja'      => $tmp_groupKerja,
            'email'             => $email,
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
        $groupKerja = groupKerjaModel::all();
        $tunj       = tunjaganPotonganModel::get()->first();

        $data = [
            'title'         => 'Edit Data Karyawan',
            'detailData'    => $detailData,
            'perusahaan'    => $perusahaan,
            'jabatan'       => $jabatan,
            'jamKerja'      => $jamKerja,
            'departemen'    => $departemen,
            'bagian'        => $bagian,
            'groupKerja'    => $groupKerja,
            'tunjangan'     => $tunj,
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

    function updateSalary(Request $request)
    {
        $tunj       = tunjaganPotonganModel::get()->first();
        $gpCek = $request->gpCek;
        $gp = $request->gp;
        $id = $request->id;

        $up = [
            'status' => 'Tidak',
        ];
        salaryModel::where('idKaryawan', $id)->update($up);

        if ($gpCek === true) {
            $gpStatus = '1';
            $gp = $tunj->gp;
        } else {
            $gpStatus = '0';
            $gp = varHelper::rupiahImplode($gp);
        }

        $tmp = [
            'gpCek' => $gpStatus,
            'gp' => $gp,
            'idKaryawan' => $id,
            'tjMakan' => '0',
            'tjMakanCek' => '0',
            'tjTransport' => '0',
            'tjTransportCek' => '0',
            'status' => 'Aktif',
            'tjJabatan' => '0',
        ];
        salaryModel::create($tmp);
    }
}
