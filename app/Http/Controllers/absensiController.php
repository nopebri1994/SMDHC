<?php

namespace App\Http\Controllers;

use App\Models\absensiModel;
use App\Models\cutiModel;
use App\Models\detailCutiModel;
use App\Models\detailHutangCutiModel;
use App\Models\hutangCutiModel;
use App\Models\karyawanModel;
use App\Models\keteranganIjinModel;
use App\Models\liburModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xls\RC4;
use varHelper;

class absensiController extends Controller
{
    public function index()
    {
        $keteranganIjin = keteranganIjinModel::all();
        $data = [
            'title' => 'Proses Absensi Harian',
            'ket'   => $keteranganIjin,
        ];
        return view('absensi.v_absensi', $data);
    }

    function detailData(Request $request)
    {
        $id = $request->id;
        $kode = $request->kode;
        $y = $request->y;

        if ($kode == 'AL') {
            $getData = cutiModel::where('year', $y)->where('idKaryawan', $id)->first();
            if (!empty($getData)) {
                if ($getData->sisaCuti < 1) {
                    $sendToView = array(
                        'status'        => 0,
                        'message'       => "Data Cuti Habis, Digunakan : $getData->ambilCuti, Total : $getData->jumlahCuti "
                    );
                    echo json_encode($sendToView);
                } else {
                    $sendToView = array(
                        'status'        => 1,
                        'message'       => "Data Cuti tersedia, Digunakan : $getData->ambilCuti, Total : $getData->jumlahCuti"
                    );
                    echo json_encode($sendToView);
                }
            } else {
                $sendToView = array(
                    'status'        => 0,
                    'message'       => 'Data Cuti tidak ditemukan'
                );
                echo json_encode($sendToView);
            }
        }

        if ($kode == 'AD') {
            $getData = hutangCutiModel::where('year', $y)->where('idKaryawan', $id)->first();
            if (!empty($getData)) {
                if ($getData->ambilHutangCuti == $getData->jumlahHutangCuti) {
                    $sendToView = array(
                        'status'        => 0,
                        'message'       => "Data Hutang Cuti sudah habis, Digunakan : $getData->ambilHutangCuti, Total : $getData->jumlahHutangCuti",
                    );
                    echo json_encode($sendToView);
                } else {
                    $exp = varHelper::formatDate($getData->expired);
                    $sendToView = array(
                        'status'        => 1,
                        'message'       => "Data Hutang Cuti tersedia, Digunakan : $getData->ambilHutangCuti, Total : $getData->jumlahHutangCuti,
Bisa digunakan sebelum $exp",
                    );
                    echo json_encode($sendToView);
                }
            } else {
                $sendToView = array(
                    'status'        => 0,
                    'message'       => 'Data Hutang Cuti tidak ditemukan'
                );
                echo json_encode($sendToView);
            }
        }
    }

    function prosesData(Request $request)
    {
        $tglAwal = $request->awal;
        $tglAkhir = $request->akhir;
        $bagian = karyawanModel::where('id', $request->id)->first();
        $detailbagian = $bagian->bagian->kode;

        if ($tglAkhir == '') {
            $libur = liburModel::where('tanggalLibur', $tglAwal)->first();
            $skipHoliday = date('l', strtotime($tglAwal));
            if (empty($libur) and $skipHoliday != 'Sunday' or $detailbagian == 'SCT') {
                $parsing = [
                    'id'         => $request->id,
                    'kode'       => $request->kode,
                    'y'          => $request->y,
                    'tglAwal'    => $tglAwal,
                ];
                $json = $this->saveData($parsing);
            } else {
                $sendToView = array(
                    'status'        => 0,
                    'message'       => 'Tanggal Yang dimasukan salah/ hari libur'
                );
                $json = json_encode($sendToView);
            }
        } else {
            while (strtotime($tglAwal) <= strtotime($tglAkhir)) {
                $libur = liburModel::where('tanggalLibur', $tglAwal)->first();
                $skipHoliday = date('l', strtotime($tglAwal));
                if (empty($libur) and $skipHoliday != 'Sunday' or $detailbagian == 'SCT') {
                    $parsing = [
                        'id'         => $request->id,
                        'kode'       => $request->kode,
                        'y'          => $request->y,
                        'tglAwal'    => $tglAwal,
                    ];
                    $json = $this->saveData($parsing);
                }
                $tglAwal = date('Y-m-d', strtotime("+1 day", strtotime($tglAwal)));
            }
        }

        echo $json;
    }

    function saveData($parsing)
    {
        $idKode = keteranganIjinModel::where('kode', $parsing['kode'])->first();
        if ($parsing['kode'] == 'AL') {
            $getData = cutiModel::where('year', $parsing['y'])->where('idKaryawan', $parsing['id'])->first();
            if ($getData->sisaCuti < 1) {

                $sendToView = array(
                    'status'        => 0,
                    'message'       => 'Data Cuti Habis'
                );
                return json_encode($sendToView);
            } {

                $tmpSaveCuti = [
                    'ambilCuti'  => $getData->ambilCuti + 1,
                    'sisaCuti'  => $getData->sisaCuti - 1,
                ];
                cutiModel::where('id', $getData->id)->update($tmpSaveCuti);

                $tmpSaveDetail = [
                    'idKaryawan'        => $parsing['id'],
                    'tanggalIjin'       => $parsing['tglAwal'],
                    'tahun'             => $parsing['y']
                ];
                detailCutiModel::create($tmpSaveDetail);

                $tmpSave = [
                    'idKaryawan'        => $parsing['id'],
                    'idKeteranganIjin'  => $idKode->id,
                    'tanggalIjin'       => $parsing['tglAwal'],
                    'status'            => '0'
                ];
                absensiModel::create($tmpSave);

                $sendToView = array(
                    'status'        => 1,
                    'message'       => 'Data Berhasil Di Proses'
                );
                return json_encode($sendToView);
            }
        } elseif ($parsing['kode'] == 'AD') {
            $getData = hutangCutiModel::where('year', $parsing['y'])->where('idKaryawan', $parsing['id'])->first();
            if ($getData->ambilHutangCuti == $getData->jumlahHutangCuti or  strtotime($parsing['tglAwal']) > strtotime($getData->expired)) {
                $sendToView = array(
                    'status'        => 0,
                    'message'       => 'Hutang Cuti sudah digunakan semua/expired'
                );
                return json_encode($sendToView);
            } else {

                $tmpSaveHutangCuti = [
                    'ambilHutangCuti'  => $getData->ambilHutangCuti + 1,
                ];
                hutangCutiModel::where('id', $getData->id)->update($tmpSaveHutangCuti);

                $tmpSaveDetail = [
                    'idKaryawan'        => $parsing['id'],
                    'tanggalIjin'       => $parsing['tglAwal'],
                    'tahun'             => $parsing['y']
                ];
                detailHutangCutiModel::create($tmpSaveDetail);

                $tmpSave = [
                    'idKaryawan'        => $parsing['id'],
                    'idKeteranganIjin'  => $idKode->id,
                    'tanggalIjin'       => $parsing['tglAwal'],
                    'status'            => '0'
                ];
                absensiModel::create($tmpSave);
                $sendToView = array(
                    'status'        => 1,
                    'message'       => 'Data Berhasil Di Proses'
                );
                return json_encode($sendToView);
            }
        } else {
            $tmpSave = [
                'idKaryawan'        => $parsing['id'],
                'idKeteranganIjin'  => $idKode->id,
                'tanggalIjin'       => $parsing['tglAwal'],
                'status'            => '0'
            ];
            absensiModel::create($tmpSave);
            $sendToView = array(
                'status'        => 1,
                'message'       => 'Data Berhasil Di Proses'
            );
            return json_encode($sendToView);
        }
    }

    function dataIjin()
    {
        $absensi = absensiModel::orderByDesc('id')->paginate(500);
        $data =  [
            'absensi' => $absensi,
        ];
        return view('absensi.dataIjin', $data);
    }

    function addStatus(Request $request)
    {
        $data = [
            'status' => $request->status,
        ];
        absensiModel::where('id', $request->id)->update($data);
    }
}