<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawanModel;
use App\Models\cutiModel;
use App\Models\detailCutiModel;
use App\Models\hutangCutiModel;
use App\Models\potonganCutiModel;
use App\Models\potongCutiModel;
use App\Models\tambahCutiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use varHelper;

class cutiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Cuti Tahunan',
        ];
        return view('cuti.v_cuti', $data);
    }

    function postingCuti(Request $request)
    {
        $m = $request->m;
        $y = $request->y;
        $now = date_create(date('Y-m-d', strtotime("$y-$m-01")));
        $karyawan = karyawanModel::whereMonth('tglMasuk', $m)->whereYear('tglMasuk', '<', $y)->get();

        foreach ($karyawan as $k) {
            $hutang = 0;
            $tglMasuk = date_create($k->tglMasuk);
            $selisih = date_diff($now, $tglMasuk);
            $hasilCuti = varHelper::varCuti($selisih->y);
            $potonganTahunan = potonganCutiModel::where('tahunPotongan', $y)->sum('totalPotongan');
            $cekData = cutiModel::where('month', $m)->where('year', $y)->where('idKaryawan', $k->id)->first();
            $cekHutang = hutangCutiModel::where('year', $y)->where('idKaryawan', $k->id)->first();
            $cekTambah = tambahCutiModel::select(DB::raw('SUM(jumlahTambah) as s'))->where('tahunCuti', $y)->where('idKaryawan', $k->id)->where('status', 'Belum')->first();
            $cekPotong = potongCutiModel::select(DB::raw('SUM(jumlahPotong) as s'))->where('tahunCuti', $y)->where('idKaryawan', $k->id)->where('status', 'Belum')->first();
            if (!empty($cekHutang)) {
                $hutang = $cekHutang->ambilHutangCuti;
            }
            if (empty($cekData)) {
                $sisaCuti = $hasilCuti['hak'] - $potonganTahunan - $hutang + $cekTambah['s'] - $cekPotong['s'];
                $tmpSave = [
                    'idKaryawan' => $k->id,
                    'jumlahCuti' => $sisaCuti,
                    'ambilCuti' => 0,
                    'sisaCuti' => $sisaCuti,
                    'keterangan' => $hasilCuti['status'],
                    'month' => $m,
                    'year' => $y
                ];
                cutiModel::create($tmpSave);
            }
        }
    }
    function tabelCuti(Request $request)
    {
        $m = $request->m;
        $y = $request->y;
        $data = [
            'vCuti' => cutiModel::with('karyawan')->where('month', $m)->where('year', $y)->get(),
        ];

        return view('cuti.postingCuti', $data);
    }
    function detailData(Request $request)
    {
        if (auth()->user()->role == '5') {
            $detail = karyawanModel::where('nikKerja', $request->nik)->where('idBagian', auth()->user()->karyawan->idBagian)->whereNull('km')->first();
        } elseif (auth()->user()->role == '4') {
            $detail = karyawanModel::where('nikKerja', $request->nik)->where('idDepartemen', auth()->user()->karyawan->idDepartemen)->whereNull('km')->first();
        } else {
            $detail = karyawanModel::where('nikKerja', $request->nik)->whereNull('km')->first();
        }

        if (empty($detail)) {
            $sendToView = array(
                'status' => 0,
            );
            echo json_encode($sendToView);
        } else {
            $namaDept = $detail->departemen->kode;
            $namaBag = $detail->bagian->kode;
            $sendToView = array(
                'status'        => 1,
                'namaKaryawan'  => $detail->namaKaryawan,
                'deptBagian'    => "$namaDept / $namaBag",
                'idKaryawan'    => $detail->id,
            );
            echo json_encode($sendToView);
        }
    }

    function detailCuti(Request $request)
    {
        $id     = $request->id;
        $y      = $request->year;

        $cuti = cutiModel::where('idKaryawan', $id)->where('year', $y)->first();
        $tglMasuk = date_create($cuti->karyawan->tglMasuk);
        $m = $cuti->month;
        $now = date_create(date('Y-m-d', strtotime("$y-$m-01")));
        $selisih = date_diff($now, $tglMasuk);
        $detail = detailCutiModel::where('idKaryawan', $id)->where('tahun', $y)->get();
        $potonganTahunan = potonganCutiModel::where('tahunPotongan', $y)->sum('totalPotongan');
        $detailHutang = hutangCutiModel::where('idKaryawan', $id)->where('year', $y)->first();
        $cekTambah = tambahCutiModel::select(DB::raw('SUM(jumlahTambah) as s'))->where('tahunCuti', $y)->where('idKaryawan', $id)->where('status', 'Sudah')->first();
        $cekPotong = potongCutiModel::select(DB::raw('SUM(jumlahPotong) as s'))->where('tahunCuti', $y)->where('idKaryawan', $id)->where('status', 'Sudah')->first();
        $data = [
            'vCuti'     => $cuti,
            'detail'    => $detail,
            'masaKerja' => $selisih->y,
            'bulan'     => $selisih->m,
            'potongan' => $potonganTahunan,
            'hutang'    => $detailHutang,
            'tambahan'  => $cekTambah['s'],
            'potongCuti' => $cekPotong['s'],

        ];

        return view('cuti.detailCuti', $data);
    }

    function tambahCuti(Request $request)
    {
        $idKaryawan = $request->idKaryawan;
        $tahun = $request->tahun;
        $tambahCuti = $request->tambahCuti;
        $ket = $request->ketTambah;
        $cekCuti = cutiModel::where('idKaryawan', $idKaryawan)->where('year', $tahun)->first();
        if (empty($cekCuti)) {
            tambahCutiModel::create([
                'idKaryawan' => $idKaryawan,
                'tahunCuti' => $tahun,
                'jumlahTambah' => $tambahCuti,
                'status' => 'Belum',
                'keterangan' => $ket,
            ]);
        } else {
            $tmpUpdate = [
                'jumlahCuti' => $cekCuti->jumlahCuti + $tambahCuti,
                'sisaCuti' => $cekCuti->sisaCuti + $tambahCuti,
            ];
            $cekCuti = cutiModel::where('idKaryawan', $idKaryawan)->where('year', $tahun)->update($tmpUpdate);
            tambahCutiModel::create([
                'idKaryawan' => $idKaryawan,
                'tahunCuti' => $tahun,
                'jumlahTambah' => $tambahCuti,
                'status' => 'Sudah',
                'keterangan' => $ket,
            ]);
        }
    }

    function potongCuti(Request $request)
    {
        $idKaryawan = $request->idKaryawan;
        $tahun = $request->tahun;
        $potongCuti = $request->cutiPotong;
        $ket = $request->ketPotong;
        $cekCuti = cutiModel::where('idKaryawan', $idKaryawan)->where('year', $tahun)->first();
        if (empty($cekCuti)) {
            potongCutiModel::create([
                'idKaryawan' => $idKaryawan,
                'tahunCuti' => $tahun,
                'jumlahPotong' => $potongCuti,
                'status' => 'Belum',
                'keterangan' => $ket,
            ]);
        } else {
            $tmpUpdate = [
                'jumlahCuti' => $cekCuti->jumlahCuti - $potongCuti,
                'sisaCuti' => $cekCuti->sisaCuti - $potongCuti,
            ];
            $cekCuti = cutiModel::where('idKaryawan', $idKaryawan)->where('year', $tahun)->update($tmpUpdate);
            potongCutiModel::create([
                'idKaryawan' => $idKaryawan,
                'tahunCuti' => $tahun,
                'jumlahPotong' => $potongCuti,
                'status' => 'Sudah',
                'keterangan' => $ket,

            ]);
        }
    }
    function listTambah()
    {
        $data = [
            'tambahCuti' => tambahCutiModel::with('karyawan')->get(),
        ];
        return view('cuti.tambahCuti', $data);
    }
    function listPotong()
    {
        $data = [
            'potongCuti' => potongCutiModel::with('karyawan')->get(),
        ];
        return view('cuti.potongCuti', $data);
    }

    function printCuti(Request $request)
    {
        $id     = $request->id;
        $y      = $request->year;

        $cuti = cutiModel::where('idKaryawan', $id)->where('year', $y)->first();
        $tglMasuk = date_create($cuti->karyawan->tglMasuk);
        $m = $cuti->month;
        $now = date_create(date('Y-m-d', strtotime("$y-$m-01")));
        $selisih = date_diff($now, $tglMasuk);
        $detail = detailCutiModel::where('idKaryawan', $id)->where('tahun', $y)->get();
        $potonganTahunan = potonganCutiModel::where('tahunPotongan', $y)->sum('totalPotongan');
        $detailHutang = hutangCutiModel::where('idKaryawan', $id)->where('year', $y)->first();
        $cekTambah = tambahCutiModel::select(DB::raw('SUM(jumlahTambah) as s'))->where('tahunCuti', $y)->where('idKaryawan', $id)->where('status', 'Belum')->first();
        $cekPotong = potongCutiModel::select(DB::raw('SUM(jumlahPotong) as s'))->where('tahunCuti', $y)->where('idKaryawan', $id)->where('status', 'Belum')->first();
        $data = [
            'vCuti'     => $cuti,
            'detail'    => $detail,
            'masaKerja' => $selisih->y,
            'potongan' => $potonganTahunan,
            'hutang'    => $detailHutang,
            'tambahan'  => $cekTambah['s'],
            'potongCuti' => $cekPotong['s'],

        ];

        return view('cuti.detailCuti', $data);
        $pdf = Pdf::loadView('cuti.detailCuti', $data);
        Pdf::setPaper('A4');
        // $pdf = Pdf::loadView('absensiHarian.printAbsensi', $tmp)->save('pdf/Absensi-Harian.pdf');
        // return $pdf->download('users_list.pdf');
        return $pdf->stream("detailCuti.pdf");
    }
    function detailPrint(Request $request)
    {
        $id     = $request->id;
        $y      = $request->year;

        $cuti = cutiModel::where('idKaryawan', $id)->where('year', $y)->first();
        $tglMasuk = date_create($cuti->karyawan->tglMasuk);
        $m = $cuti->month;
        $now = date_create(date('Y-m-d', strtotime("$y-$m-01")));
        $selisih = date_diff($now, $tglMasuk);
        $detail = detailCutiModel::where('idKaryawan', $id)->where('tahun', $y)->get();
        $potonganTahunan = potonganCutiModel::where('tahunPotongan', $y)->sum('totalPotongan');
        $detailHutang = hutangCutiModel::where('idKaryawan', $id)->where('year', $y)->first();
        $cekTambah = tambahCutiModel::select(DB::raw('SUM(jumlahTambah) as s'))->where('tahunCuti', $y)->where('idKaryawan', $id)->where('status', 'Sudah')->first();
        $cekPotong = potongCutiModel::select(DB::raw('SUM(jumlahPotong) as s'))->where('tahunCuti', $y)->where('idKaryawan', $id)->where('status', 'Sudah')->first();
        $data = [
            'vCuti'     => $cuti,
            'detail'    => $detail,
            'masaKerja' => $selisih->y,
            'bulan'     => $selisih->m,
            'potongan' => $potonganTahunan,
            'hutang'    => $detailHutang,
            'tambahan'  => $cekTambah['s'],
            'potongCuti' => $cekPotong['s'],

        ];

        return view('cuti.detailPrint', $data);
    }
}
