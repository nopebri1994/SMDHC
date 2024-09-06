<?php

namespace App\Http\Controllers;

use App\Models\advanceModel;
use App\Models\detailAdvanceModel;
use App\Models\karyawanModel;
use Illuminate\Http\Request;

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
            $data = advanceModel::where('idKaryawan', $idKaryawan)->where('status', 1)->get();
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
        $y = date('y');
        $date = date('Y-m-d');
        $cekadvance = detailAdvanceModel::whereMonth('tanggalProses', $m)->whereYear('tanggalProses', $y)->first();

        if (empty($cekadvance)) {
            $list = advanceModel::where('status', 1)->get();
            foreach ($list as $l) {
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
            return response()->json([
                'success' => 'Pemotongan Advance Sukses',
                'error' => '',
            ]);
        } else {
            return response()->json([
                'success' => '',
                'error' => 'Advance Sudah dipotong',
            ]);
        }
    }
}
