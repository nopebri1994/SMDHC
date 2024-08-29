<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use App\Models\absensiHarianModel;
use App\Models\prosesAbsensiHarianModel;
use App\Models\absensiModel;
use App\Models\bagianModel;
use App\Models\groupOffModel;
use App\Models\liburModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $dataOff = groupOffModel::where('tanggalOff', $tgl)->first();
        if (auth()->user()->role == '5') {
            $idBagian = karyawanModel::where('idBagian', auth()->user()->karyawan->idBagian)->get();
            $absensi = prosesAbsensiHarianModel::whereBelongsTo($idBagian)->with(['karyawanModel'])->where('tglAbsen', $tgl)->get();
        } elseif (auth()->user()->role == '4') {
            $idDepartemen = karyawanModel::where('idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
            $absensi = prosesAbsensiHarianModel::whereBelongsTo($idDepartemen)->with(['karyawanModel'])->where('tglAbsen', $tgl)->get();
        } else {
            $absensi = prosesAbsensiHarianModel::with(['karyawanModel'])->where('tglAbsen', $tgl)->get();
        }
        $data = [
            'absensi' => $absensi,
            'ket' => DB::table('absensi_keteranganIjin')->where('tanggalIjin', $tgl)->get()->toArray(),
            'tgl' => $tgl,
            'off' => $dataOff,
        ];
        return view('absensiHarian.tabelHarian', $data);
    }
    function prosesAbsensi(Request $request)
    {
        $tgl = $request->tgl;
        prosesAbsensiHarianModel::where('tglAbsen', $tgl)->delete();
        $dataOff = groupOffModel::where('tanggalOff', $tgl)->first();
        $dataIjin = DB::table('absensi_keteranganIjin')->where('tanggalIjin', $tgl)->get()->toArray();
        $tmp = [];
        $dataKaryawan = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->whereNull('km')->orderBy('nikKerja')->get();
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
            $jadwalMasuk = null;
            $jadwalPulang = null;
            $t = 'Tidak';
            $f = 'Tidak';
            $ket = null;
            $objKet = array_search($dk->id, array_column($dataIjin, 'idKaryawan'));
            if ($objKet != '') {
                $ket = $dataIjin[$objKet]->kode;
            }
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
                $jadwalMasuk = $dk->jamKerja->jamMasukS;
                $jadwalPulang = $dk->jamKerja->jamPulangS;
            } else {
                if ($jamDatang > $dk->jamKerja->jamMasukSJ) {
                    $t = 'Ya';
                }
                $jadwalMasuk = $dk->jamKerja->jamMasukSJ;
                $jadwalPulang = $dk->jamKerja->jamPulangSJ;
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
            if (date('D', strtotime($tgl)) == 'Sun') {
                $f = 'Ya';
                $t = 'Tidak';
            }

            if (!empty($datOff)) {
                if ($dk->groupOff == $dataOff->group) {
                    $f = 'Ya';
                    $t = 'Tidak';
                }
            }

            $tmp[] = [
                'idKaryawan' => $dk->id,
                'tglAbsen' => $tgl,
                'jamDatang' => $jamDatang,
                'jamPulang' => $jamPulang,
                'terlambat' => $t,
                'full' => $f,
                'keteranganIjin' => $ket,
                'jadwalMasuk' => $jadwalMasuk,
                'jadwalPulang' => $jadwalPulang,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        DB::table('prosesAbsensiHarian')->insert($tmp);
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

    function cetakAbsensi()
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
        $data = [
            'title' => 'Cetak Absensi Karyawan',
            'karyawan' => $karyawan,
            'bagian' => $bagian,
        ];
        return view('absensiHarian.v_printAbsensi', $data);
    }
    function cetakPerorang(Request $request)
    {

        $uuid = $request->idKaryawan;
        $getid = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->where('uuid', $uuid)->first();
        $id = $getid->id;
        $tglAkhir = $request->akhir;
        $tglAwal = $request->awal;
        $awal = date('Y-m-d', strtotime('-1 days', strtotime($tglAwal)));
        $dataHeader = karyawanModel::with(['jabatan', 'departemen', 'bagian', 'perusahaan', 'jamKerja'])->where('id', $id)->first();
        $dataisi = prosesAbsensiHarianModel::where('idKaryawan', $id)->whereBetween('tglAbsen', [$awal, $tglAkhir])->orderBy('tglAbsen')->get()->toArray();
        $ketijin = DB::table('absensi_keteranganIjin')->where('idKaryawan', $id)->whereBetween('tanggalIjin', [$tglAwal, $tglAkhir])->get()->toArray();
        $sof = groupOffModel::whereBetween('tanggalOff', [$tglAwal, $tglAkhir])->get()->toArray();
        $libur = liburModel::whereBetween('tanggalLibur', [$tglAwal, $tglAkhir])->get()->toArray();
        $tmp = [
            'id' => $id,
            'dataHeader' => $dataHeader,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'dataisi' => $dataisi,
            'ijin' => $ketijin,
            'libur' => $libur,
            'sof' => $sof
        ];
        // dd($dataisi);

        // return view('absensiHarian.printAbsensi', $tmp);
        // dd($ketijin);   
        $pdf = Pdf::loadView('absensiHarian.printAbsensi', $tmp);
        Pdf::setPaper('A4');
        // $pdf = Pdf::loadView('absensiHarian.printAbsensi', $tmp)->save('pdf/Absensi-Harian.pdf');
        // return $pdf->download('users_list.pdf');
        return $pdf->stream("$uuid.pdf");
    }
}
