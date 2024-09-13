<?php

namespace App\Http\Controllers;

use App\Models\advanceModel;
use App\Models\detailAdvanceModel;
use App\Models\karyawanModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class advanceController extends Controller
{
    function index()
    {
        $karyawan   = karyawanModel::whereNull('km')->orderBy('nikKerja')->get();
        $tmp = [
            'title' => 'Monitoring Data Advance (Pinjaman)',
            'karyawan' => $karyawan,
        ];
        return view('advance.v_advance', $tmp);
    }

    function getId(Request $request)
    {
        $lastRow = advanceModel::latest()->first();
        $lastNumber = '0';
        if (!empty($lastRow)) {
            $lastNumber = $lastRow->no_pinjaman;
        }
        return response()->json([
            'last' => $lastNumber,
        ]);
    }
    function store(Request $request)
    {
        $jumlahPinjaman = $request->jumlahPinjaman;

        //remove karakter from input mask
        $jumlahPinjaman = explode('.', $jumlahPinjaman);
        $jumlahPinjaman = implode($jumlahPinjaman);
        $jumlahPinjaman = explode('_', $jumlahPinjaman);
        $jumlahPinjaman = implode($jumlahPinjaman);
        $jumlahPinjaman = explode('Rp', $jumlahPinjaman);
        $jumlahPinjaman = implode($jumlahPinjaman);

        advanceModel::create([
            'no_pinjaman' => $request->noPinjaman,
            'idKaryawan' => $request->idKaryawan,
            'totalPinjaman' => $jumlahPinjaman,
            'totalPotongan' => $request->jumlahPotongan,
            'sisaPotongan' => $request->jumlahPotongan,
            'sudahDipotong' => 0,
            'tanggalRealisasi' => $request->tanggalRealisasi,
            'status' => '1',
        ]);
        return response()->json([
            'success' => 'Data Saved',
            'error' => '',
        ]);
    }
    function tabelData(Request $request)
    {
        $idKaryawan = $request->id;
        if ($idKaryawan == 0) {
            $data = advanceModel::where('status', 1)->get();
        } else {
            $data = advanceModel::where('idKaryawan', $idKaryawan)->get();
        }
        $tmp = [
            'data' => $data,
        ];
        return view('advance.v_tabelAdvance', $tmp);
    }
    function delete(Request $request)
    {
        $id = $request->id;
        detailAdvanceModel::where('no_pinjaman', $id)->delete();
        advanceModel::where('no_pinjaman', $id)->delete();
    }
    function update(Request $request)
    {
        $jumlahPinjaman = $request->jumlahPinjaman;

        //remove karakter from input mask
        $jumlahPinjaman = explode('.', $jumlahPinjaman);
        $jumlahPinjaman = implode($jumlahPinjaman);
        $jumlahPinjaman = explode('_', $jumlahPinjaman);
        $jumlahPinjaman = implode($jumlahPinjaman);
        $jumlahPinjaman = explode('Rp', $jumlahPinjaman);
        $jumlahPinjaman = implode($jumlahPinjaman);

        $id = $request->id;
        advanceModel::where('no_pinjaman', $id)->update([
            'idKaryawan' => $request->idKaryawan,
            'totalPinjaman' => $jumlahPinjaman,
            'totalPotongan' => $request->jumlahPotongan,
            'tanggalRealisasi' => $request->tanggalRealisasi,
            'sisaPotongan' => $request->jumlahPotongan,
        ]);
        return response()->json([
            'success' => 'Data Updated',
            'error' => '',
        ]);
    }

    function prosesData()
    {
        $m = date('m');
        $y = date('Y');
        $date = date('Y-m-d');

        $list = advanceModel::where('status', 1)->get();
        foreach ($list as $l) {
            $cekadvance = detailAdvanceModel::where('no_pinjaman', $l->no_pinjaman)->whereMonth('tanggalProses', $m)->whereYear('tanggalProses', $y)->first();
            if (empty($cekadvance)) {
                if ($l->sudahDipotong + 1 == $l->totalPotongan) {
                    $status = '2';
                } else {
                    $status = '1';
                }

                $potong = $l->totalPinjaman / $l->totalPotongan;
                $tmp = [
                    'no_pinjaman' => $l->no_pinjaman,
                    'tanggalProses' => $date,
                    'jumlahPotong' => $potong,
                    'potonganKe' => $l->sudahDipotong + 1
                ];
                detailAdvanceModel::create($tmp);

                $tmpUpdate = [
                    'sisaPotongan' => $l->sisaPotongan - 1,
                    'sudahDipotong' => $l->sudahDipotong + 1,
                    'status' => $status,
                ];
                advanceModel::where('no_pinjaman', $l->no_pinjaman)->update($tmpUpdate);
            }
        }

        return response()->json([
            'success' => 'Pemotongan Advance Sukses',
            'error' => '',
        ]);

        // return response()->json([
        //     'success' => '',
        //     'error' => 'Advance Sudah dipotong',
        // ]);
    }
    function cetakLaporan(Request $request)
    {
        $m = $request->m;
        $y = $request->y;
        $modifYear = $y . '-' . $m . '-30';
        $m = date('m', strtotime($modifYear));
        $realDate = date('Y-m-d', strtotime("-1 Month", strtotime($modifYear)));
        $advance = DB::table('advance')->join('detailAdvance', 'detailAdvance.no_pinjaman', 'advance.no_pinjaman')->whereYear('detailAdvance.tanggalProses', $y)->whereMonth('detailAdvance.tanggalProses', $m)->get();
        $nama = karyawanModel::whereNull('km')->get()->toArray();
        $detailAdvance = DB::table('detailAdvance')->select('advance.no_pinjaman', DB::raw('count(detailAdvance.no_pinjaman) as total'))->join('advance', 'detailAdvance.no_pinjaman', 'advance.no_pinjaman')->whereDate('tanggalProses', '<=', $realDate)->groupBy('advance.no_pinjaman')->get()->toArray();
        $tmp = [
            'month' => $m,
            'year' => $y,
            'advance' => $advance,
            'detail' => $detailAdvance,
            'nama' => $nama,
        ];
        $pdf = Pdf::loadView('advance.laporan', $tmp)->setPaper('A4', 'landscape');

        return $pdf->stream("laporan-Advance.pdf");
        // return view('advance.laporan');
    }
    function updateStatus(Request $request)
    {
        $id = $request->id;
        advanceModel::where('no_pinjaman', $id)->update(['status' => '2']);
    }
}
