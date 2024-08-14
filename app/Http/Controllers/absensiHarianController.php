<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use App\Models\absensiHarianModel;
use App\Models\prosesAbsensiHarianModel;
use App\Models\absensiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class absensiHarianController extends Controller
{
    function index()
    {
        $data = [
            'title' => 'Data Absensi Harian',
        ];
        return view('absensiHarian.v_absensiHarian', $data);
    }

    function list(Request $request)
    {
        $tgl = $request->tgl;
        $absensi =
            $data = [
                'absensi' => prosesAbsensiHarianModel::with(['karyawan'])->where('tglAbsen', $tgl)->get(),
                'ket' => absensiModel::with('keteranganIjin')->where('tanggalijin', $tgl)->get()->toArray(),
                'tgl' => $tgl
            ];
        return view('absensiHarian.tabelHarian', $data);
    }
    function prosesAbsensi(Request $request)
    {
        $tgl = $request->tgl;
        prosesAbsensiHarianModel::where('tglAbsen', $tgl)->delete();
        $tmp = [];

        $dataKaryawan = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->orderBy('nikKerja')->get();
        $jamAbsen = absensiHarianModel::where('tanggalAbsen', $tgl)->get()->toArray();
        if (empty($jamAbsen)) {
            $sendToView = array(
                'status'        => 0,
                'message'       => 'Data Absensi tidak tersedia / silahkan tarik data terlebih dahulu'
            );
            return json_encode($sendToView);
            exit();
        }
        $absenPulang = array_reverse($jamAbsen);
        foreach ($dataKaryawan as $dk) {
            //inisialisasi
            $jamDatang = null;
            $jamPulang = null;
            $t = 'Tidak';
            $f = 'Tidak';

            $obj = array_search($dk->fpId, array_column($jamAbsen, 'idFinger'));
            if ($obj != '') {
                $jamDatang = $jamAbsen[$obj]['jamAbsen'];
            }
            $obj2 = array_search($dk->fpId, array_column($absenPulang, 'idFinger'));
            if ($obj2 != '') {
                $jamPulang = $absenPulang[$obj2]['jamAbsen'];
            }
            if (date('D', strtotime($tgl)) == 'Sat') {
                if ($jamDatang > $dk->jamKerja->jamMasukS) {
                    $t = 'Ya';
                }
            } else {
                if ($jamDatang > $dk->jamKerja->jamMasukSJ) {
                    $t = 'Ya';
                }
            }

            if (date('D', strtotime($tgl)) == 'Sat') {
                if ($jamDatang <= $dk->jamKerja->jamMasukS and $jamPulang >= $dk->jamKerja->jamPulangS) {
                    $f = 'Ya';
                }
            } else {
                if ($jamDatang <= $dk->jamKerja->jamMasukSJ and $jamPulang >= $dk->jamKerja->jamPulangSJ) {
                    $f = 'Ya';
                }
            }
            if (date('D', strtotime($tgl)) == 'Sat' or date('D', strtotime($tgl)) == 'Sun') {
                $f = 'Ya';
                $t = 'Tidak';
            }

            $tmp[] = [
                'idKaryawan' => $dk->id,
                'tglAbsen' => $tgl,
                'jamDatang' => $jamDatang,
                'jamPulang' => $jamPulang,
                'terlambat' => $t,
                'full' => $f,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        DB::table('prosesabsensiharian')->insert($tmp);
        $sendToView = array(
            'status'        => 1,
            'message'       => 'Proses Absensi Sukses'
        );
        return json_encode($sendToView);
    }
    function updateFull(Request $request)
    {
        $id = $request->idAbsensi;
        $full = $request->full;
        $tmp = [
            'full' => $full
        ];
        prosesAbsensiHarianModel::where('id', $id)->update($tmp);
    }
    function updateTerlambat(Request $request)
    {
        $id = $request->idAbsensi;
        $terlambat = $request->terlambat;
        $tmp = [
            'terlambat' => $terlambat
        ];
        prosesAbsensiHarianModel::where('id', $id)->update($tmp);
    }
}
