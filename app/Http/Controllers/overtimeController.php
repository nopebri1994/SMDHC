<?php

namespace App\Http\Controllers;

use App\Models\bagianModel;
use App\Models\karyawanModel;
use App\Models\overtimeDetailModel;
use App\Models\overtimeModel;
use App\Models\prosesAbsensiHarianModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Auth\Access\Gate;
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


    function storeDataDetail(Request $request)
    {
        $id = Crypt::decryptString($request->idForm);
        $karyawan = $request->idKaryawan;
        $jamLembur = $request->jamOT;
        $jm = $request->jamMulail;
        $jp = $request->jp;
        $jm = $request->jamMulai;
        $tgl = $request->tgl;

        $isRow = overtimeDetailModel::where('idOvertime', $id)->where('idKaryawan', $karyawan)->first();
        if (!empty($isRow)) {
            return response()->json(['success' => '', 'error' => 'Data Karyawan sudah tersedia di form ini']);
        }

        if ($jamLembur > 1) {
            $jam1 = 1;
            $jam2 = $jamLembur - $jam1;
        } else {
            $jam1 = 1;
            $jam2 = 0;
        }
        if (date('D', strtotime($tgl)) == 'Sun') {
            $jam1 = 0;
            $jam2 = $jamLembur;
        }

        $tmp[] = [
            'idOvertime' => $id,
            'idKaryawan' => $karyawan,
            'jam1' => $jam1,
            'jam2' => $jam2,
            'jenisPekerjaan' => $jp,
            'status' => '1',
            'jamMulai' => $jm,
        ];
        DB::table('overtimeDetail')->insert($tmp);
        return response()->json(['success' => 'Data Berhasil ditambahkan', 'error' => '']);
    }

    function updateDataDetail(Request $request)
    {
        $id = $request->idDetail;
        $jamLembur = $request->jamOT;
        $jm = $request->jamMulail;
        $jp = $request->jp;
        $jm = $request->jamMulai;
        $tgl = $request->tgl;
        if ($jamLembur > 1) {
            $jam1 = 1;
            $jam2 = $jamLembur - $jam1;
        } else {
            $jam1 = 1;
            $jam2 = 0;
        }
        if (date('D', strtotime($tgl)) == 'Sun') {
            $jam1 = 0;
            $jam2 = $jamLembur;
        }

        $tmp = [
            'jam1' => $jam1,
            'jam2' => $jam2,
            'jenisPekerjaan' => $jp,
            'status' => '1',
            'jamMulai' => $jm,
        ];
        overtimeDetailModel::where('id', $id)->update($tmp);
        return response()->json(['success' => 'Data Berhasil diperbarui', 'error' => '']);
    }

    function detail(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $formLembur = overtimeModel::with(['bagian'])->where('id', $id)->first();
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

        $absensi = prosesAbsensiHarianModel::where('tglAbsen', $formLembur->tanggalOT)->get()->toArray();
        $tmp = [
            'title' => 'Detail Overtime',
            'form' => $formLembur,
            'karyawan' => $karyawan,
        ];
        return view('overtime.detailOvertime', $tmp);
    }

    function cetak(Request $request)
    {
        $id = Crypt::decryptString($request->id);
        $data = overtimeDetailModel::with(['karyawan'])->where('idOvertime', $id)->where('status', '>', '0')->get();
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
        $absensi = prosesAbsensiHarianModel::where('tglAbsen', $formLembur->tanggalOT)->get()->toArray();

        if (auth()->user()->role == '5') {
            $data = overtimeDetailModel::where('idOvertime', $id)->get();
        } elseif (auth()->user()->role == '4') {
            $data = overtimeDetailModel::where('idOvertime', $id)->get();
        } else {
            $data = overtimeDetailModel::where('idOvertime', $id)->where('status', '>', '0')->get();
        }

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
                'tanggalCancel' => null,
                'tanggalApp' => null,
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
            'tanggalAcc' => null
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

    function tabelKalkulasi(Request $request)
    {
        $tglAwal = $request->awal;
        $tglAkhir = $request->akhir;
        $overtime = DB::table('overtimeDetail')->select('idKaryawan', 'nikKerja', 'namaKaryawan', 'dataKaryawan.idBagian as idBagian', DB::raw("SUM(jam1) jam1"), DB::raw("sum(jam2) jam2"))
            ->join('dataKaryawan', 'dataKaryawan.id', 'overtimeDetail.idKaryawan')
            ->join('overtime', 'overtime.id', 'overtimeDetail.idOvertime')
            ->whereBetween('tanggalOT', [$tglAwal, $tglAkhir])
            ->where('overtimeDetail.status', '2')
            ->whereNotNull('overtime.tanggalApp')
            ->groupBy('overtimeDetail.idKaryawan')
            ->get();

        $bagian = bagianModel::with(['departemen'])->get()->toArray();
        $tmp = [
            'overtime' => $overtime,
            'bagian' => $bagian,
        ];
        return view('overtime.tabelKalkulasi', $tmp);
    }

    function detailKalkulasi(Request $request)
    {
        $id = $request->id;
        $tglAwal = $request->awal;
        $tglAkhir = $request->akhir;
        $overtime = overtimeModel::whereBetween('tanggalOT', [$tglAwal, $tglAkhir])->whereNotNull('overtime.tanggalApp')->get();
        $detailOvertime = overtimeDetailModel::whereBelongsTo($overtime)->where('status', '2')->where('idKaryawan', $id)->get();

        $karyawan = karyawanModel::where('id', $id)->first();
        $tmp = [
            'overtime' => $detailOvertime,
            'karyawan' => $karyawan,
        ];
        return view('overtime.detailKalkulasi', $tmp);
    }
}
