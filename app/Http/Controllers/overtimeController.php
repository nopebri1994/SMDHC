<?php

namespace App\Http\Controllers;

use App\Models\bagianModel;
use App\Models\karyawanModel;
use App\Models\overtimeDetailModel;
use App\Models\overtimeModel;
use App\Models\prosesAbsensiHarianModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class overtimeController extends Controller
{
    function index()
    {
        $tmp = [
            'title' => 'Data Overtime',

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

        $isRow = overtimeModel::where('idBagian', $idBagian)->where('tanggalOT', $tanggalLembur)->whereNULL('tanggalCancel')->first();
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
        $jm = $request->jamMulai;
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
                'status' => '1',
                'jamMulai' => $jm[$key],
            ];
        }

        DB::table('overtimeDetail')->insert($tmp);

        return redirect('pay/overtime/')->with('status', 'Data Lembur Berhasil disimpan');
    }
    function detail(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $formLembur = overtimeModel::with(['bagian'])->where('id', $id)->first();
        $data = overtimeDetailModel::where('idOvertime', $id)->get();
        $absensi = prosesAbsensiHarianModel::where('tglAbsen', $formLembur->tanggalOT)->get()->toArray();
        $tmp = [
            'title' => 'Detail Overtime',
            'form' => $formLembur
        ];
        return view('overtime.detailOvertime', $tmp);
    }

    function cetak(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $data = overtimeDetailModel::with(['karyawan'])->where('idOvertime', $id)->get();
        $formLembur = overtimeModel::with(['bagian'])->where('id', $id)->first();
        $absensi = prosesAbsensiHarianModel::where('tglAbsen', $formLembur->tanggalOT)->get()->toArray();
        $tmp = [
            'data' => $data,
            'form' => $formLembur,
            'absensi' => $absensi
        ];
        $pdf = Pdf::loadView('overtime.formLembur', $tmp)->setPaper('A4', 'landscape');
        $domPdf = $pdf->getDomPDF();
        $pdf->output();
        $font =  $pdf->getFontMetrics()->getFont(null, "normal");
        $canvas = $domPdf->get_canvas();
        $canvas->page_text(763, 113, "{PAGE_NUM} dari {PAGE_COUNT}", $font, 9, [0, 0, 0]);
        return $pdf->stream("Form Lembur.pdf");

        // return view('advance.laporan');
    }

    function updateStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        overtimeDetailModel::where('id', $id)->update([
            'status' => $status,
        ]);
    }

    function tabelDetail(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $formLembur = overtimeModel::with(['bagian'])->where('id', $id)->first();
        $data = overtimeDetailModel::where('idOvertime', $id)->get();
        $absensi = prosesAbsensiHarianModel::where('tglAbsen', $formLembur->tanggalOT)->get()->toArray();
        $tmp = [
            'data' => $data,
            'absensi' => $absensi,
            'form' => $formLembur,
        ];
        return view('overtime.tabelDetailOvertime', $tmp);
    }
    function tabelData()
    {
        if (auth()->user()->role == '5') {
            $overtime = overtimeModel::where('idBagian', auth()->user()->karyawan->idBagian)->orderBy('tanggalOT', 'DESC')->get();
        } elseif (auth()->user()->role == '4') {
            $overtime = overtimeModel::with(['bagian'])->whereHas('bagian', function ($q) {
                $q->where('idDepartemen', auth()->user()->karyawan->idDepartemen);
            })->orderBy('tanggalOT', 'DESC')->get();
        } else {
            $overtime = overtimeModel::orderBy('tanggalOT', 'DESC')->get();
        }
        $tmp = [
            'overtime' => $overtime,
        ];
        return view('overtime.tabelOvertime', $tmp);
    }
    function updateStatusForm(Request $request)
    {

        $id = $request->id;
        $cek = overtimeDetailModel::where('idOvertime', $id)->where('status', '1')->first();

        if (empty($cek)) {
            overtimeModel::where('id', $id)->update([
                'tanggalAcc' => date('Y-m-d H:i:s'),
            ]);
            return response()->json(['success' => 'Data Berhasil dikonfirmasi', 'error' => '']);
        } else {
            return response()->json(['success' => '', 'error' => 'Data gagal dikonfirmasi, cek detail form']);
        }
    }

    function updateStatusFormHC(Request $request)
    {
        $id = $request->id;
        overtimeModel::where('id', $id)->update([
            'tanggalApp' => date('Y-m-d H:i:s'),
        ]);
    }
    function updateStatusFormReject(Request $request)
    {
        $id = $request->id;
        overtimeModel::where('id', $id)->update([
            'tanggalCancel' => date('Y-m-d H:i:s'),
        ]);
    }

    //kalkulasi
    function kalkulasi()
    {
        $tmp = [
            'title' => 'Kalkulasi Lembur Karyawan',
        ];
        return view('overtime.v_kalkulasiOvertime', $tmp);
    }
}
