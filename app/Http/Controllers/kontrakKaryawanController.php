<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use App\Models\kontrakKaryawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class kontrakKaryawanController extends Controller
{
    public function index()
    {
        $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->where('statuskaryawan', '1')->get();
        $tmp = [
            'title' => 'Data Kontrak karyawan',
            'karyawan' => $karyawan
        ];
        return view('karyawanKontrak.v_karyawanKontrak', $tmp);
    }
    function storeData(Request $request)
    {
        $id = $request->idKaryawan;
        $uid = karyawanModel::where('id', $id)->first();
        $kontrak = $request->kontrakKe;

        $isRow = kontrakKaryawanModel::where('idKaryawan', $id)->where('noKontrak', $kontrak)->first();
        if ($isRow) {
            $fileName = $uid->uuid . $kontrak . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(storage_path('app/public/pkwt'), $fileName);
            kontrakKaryawanModel::create([
                'idKaryawan' => $request->idKaryawan,
                'noKontrak' => $request->noKontrak,
                'dibuatTanggal' => $request->dibuatTanggal,
                'berlakuTanggal' => $request->berlakuTanggal,
                'sampaiTanggal' => $request->sampaiTanggal,
                'file' => $fileName,
                'kontrakKe' => $request->kontrakKe,
            ]);
            return response()->json(['success' => 'You have successfully upload file.']);
        } else {
            return response()->json(['error' => 'Data Allready']);
        }
    }

    function tabelData()
    {
        $tmp = [
            'data' => kontrakKaryawanModel::with(['karyawanModel'])->get(),
        ];
        return view('karyawanKontrak.tabelKaryawanKontrak', $tmp);
    }
    function delete(Request $request)
    {
        $id = $request->id;
        $isRow = kontrakKaryawanModel::where('id', $id)->first();
        Storage::delete('app/public/pkwt' . $isRow->file);
    }
}
