<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use App\Models\SPModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SPController extends Controller
{
    public function index()
    {
        $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->get();
        $tmp = [
            'title' => 'Data Surat Peringatan',
            'karyawan' => $karyawan
        ];
        return view('sp.v_sp', $tmp);
    }
    function storeData(Request $request)
    {
        $id = $request->idKaryawan;
        $sp = $request->spKe;
        $isStatus = SPModel::where('idKaryawan', $id)->first();
        if ($request->file->getClientOriginalExtension() != 'pdf') {
            return response()->json(['error' => 'File Must be in PDF format']);
        }

        if (!empty($isStatus)) {
            SPModel::where('idKaryawan', $id)->update([
                'status' => '2',
            ]);
        }

        $uid = karyawanModel::where('id', $id)->first();
        $fileName = $uid->uuid . $sp . time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(storage_path('app/public/sp'), $fileName);
        SPModel::create([
            'idKaryawan' => $request->idKaryawan,
            'nomorSP' => $request->noSP,
            'dibuatTanggal' => $request->dibuatTanggal,
            'berlakuTanggal' => $request->berlakuTanggal,
            'sampaiTanggal' => $request->sampaiTanggal,
            'file' => $fileName,
            'sp' => $request->spKe,
            'status' => '1',
        ]);
        return response()->json(['success' => 'You have successfully upload file.', 'error' => '']);
    }

    function tabelData(Request $request)
    {
        $id = $request->id;
        $date = date('Y-m-d');
        if ($id == 0) {
            $data = SPModel::with(['karyawanModel'])->where('status', '1')->where('sampaiTanggal', '>=', $date)->orderBy('sampaiTanggal')->get();
        } else {
            $data = SPModel::with(['karyawanModel'])->where('idKaryawan', $id)->where('sampaiTanggal', '>=', $date)->orderBy('sampaiTanggal')->get();
        }
        $tmp = [
            'data' => $data,
        ];
        return view('sp.tabelSP', $tmp);
    }
    function delete(Request $request)
    {
        $id = $request->id;
        $isRow = SPModel::where('id', $id)->first();
        if (!empty($isRow->file)) {
            Storage::disk('sp')->delete($isRow->file);
        }
        SPModel::where('id', $id)->delete();
    }

    function update(Request $request)
    {
        $id = $request->id;
        $file = $request->file;
        $sp = $request->spKe;
        $isRow = SPModel::where('id', $id)->first();
        if (empty($file)) {
            SPModel::where('id', $id)->update([
                'idKaryawan' => $request->idKaryawan,
                'nomorSP' => $request->noSP,
                'dibuatTanggal' => $request->dibuatTanggal,
                'berlakuTanggal' => $request->berlakuTanggal,
                'sampaiTanggal' => $request->sampaiTanggal,
                'sp' => $request->spKe,
            ]);
            return response()->json(['success' => 'You have successfully update Data.', 'error' => '']);
        } else {
            if ($request->file->getClientOriginalExtension() != 'pdf') {
                return response()->json(['error' => 'File Must be in PDF format']);
            }
            if (!empty($isRow->file)) {
                Storage::disk('sp')->delete($isRow->file);
            }
            $uid = karyawanModel::where('id', $isRow->idKaryawan)->first();
            $fileName = $uid->uuid . $sp . time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(storage_path('app/public/sp'), $fileName);

            SPModel::where('id', $id)->update([
                'idKaryawan' => $request->idKaryawan,
                'nomorSP' => $request->noSP,
                'dibuatTanggal' => $request->dibuatTanggal,
                'berlakuTanggal' => $request->berlakuTanggal,
                'sampaiTanggal' => $request->sampaiTanggal,
                'file' => $fileName,
                'sp' => $request->spKe,
            ]);
            return response()->json(['success' => 'You have successfully upload file.', 'error' => '']);
        }
    }
}
