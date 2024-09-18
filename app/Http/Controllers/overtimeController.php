<?php

namespace App\Http\Controllers;

use App\Models\bagianModel;
use App\Models\karyawanModel;
use App\Models\overtimeDetailModel;
use App\Models\overtimeModel;
use App\Models\prosesAbsensiHarianModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class overtimeController extends Controller
{
    function index()
    {
        $overtime = overtimeModel::all();
        $tmp = [
            'title' => 'Data Overtime',
            'overtime' => $overtime,
        ];
        return view('overtime.v_overtime', $tmp);
    }

    function addData()
    {
        if (auth()->user()->role == '5') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idBagian', auth()->user()->karyawan->idBagian)->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->where('id', auth()->user()->karyawan->idBagian)->get();
        } elseif (auth()->user()->role == '4') {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
        } else {
            $karyawan   = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->get();
            $bagian = bagianModel::with(['departemen'])->get();
        }
        $tmp = [
            'title' => 'Tambah Data Overtime',
            'karyawan' => $karyawan,
            'bagian' => $bagian
        ];
        return view('overtime.addDataOvertime', $tmp);
    }


    function storeData(Request $request)
    {
        $tmp = [];
        $idBagian = $request->bagian;
        $tanggalLembur = $request->tglLembur;

        $isRow = overtimeModel::where('idBagian', $idBagian)->where('tanggalOT', $tanggalLembur)->first();

        if (!empty($isRow)) {
            return redirect()->back()->with('status', 'Tanggal Lembur sudah ada');
        }
        $store = overtimeModel::create([
            'idBagian' => $idBagian,
            'tanggalOT' => $tanggalLembur,
        ]);

        $karyawan = $request->karyawan;
        $jamLembur = $request->jamLembur;
        $jp = $request->jp;
        foreach ($karyawan as $key => $k) {
            if ($jamLembur[$key] > 1) {
                $jam1 = 1;
                $jam2 = $jamLembur[$key] - $jam1;
            } else {
                $jam1 = 1;
                $jam2 = 0;
            }
            if (date('D', strtotime($tanggalLembur)) == 'Sun') {
                $jam1 = 0;
                $jam2 = $jamLembur[$key];
            }
            $tmp[] = [
                'idOvertime' => $store->id,
                'idKaryawan' => $k,
                'jam1' => $jam1,
                'jam2' => $jam2,
                'jenisPekerjaan' => $jp[$key],
                'status' => '1'
            ];
        }

        DB::table('overtimeDetail')->insert($tmp);

        return redirect('pay/overtime/')->with('status', 'Data Lembur Berhasil disimpan');
    }
    function detail(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $formLembur = overtimeModel::where('id', $id)->first();
        $data = overtimeDetailModel::where('idOvertime', $id)->get();
        $absensi = prosesAbsensiHarianModel::where('tglAbsen', $formLembur->tanggalOT)->get()->toArray();
        $tmp = [
            'title' => 'Detail Overtime',
            'data' => $data,
            'absensi' => $absensi
        ];
        return view('overtime.detailOvertime', $tmp);
    }
}
