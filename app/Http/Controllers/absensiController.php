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
use App\Models\prosesAbsensiHarianModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        //looping atau proses ijin
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
        //proses save data ijin
        $idKode = keteranganIjinModel::where('kode', $parsing['kode'])->first();
        $cek = absensiModel::where('idKaryawan', $parsing['id'])->where('tanggalIjin', $parsing['tglAwal'])->first();
        if (empty($cek)) {
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

                    prosesAbsensiHarianModel::where('idKaryawan', $parsing['id'])->where('tglAbsen', $parsing['tglAwal'])->update([
                        'keteranganIjin' => $parsing['kode'],
                    ]);

                    //log
                    $msg = "Id Karyawan = " . $parsing['id'] . " kode KeteranganIjin = " . $parsing['kode'] . " Tanggal Ijin = " . $parsing['tglAwal'] . " User = " . auth()->user()->karyawan->namaKaryawan;
                    Log::channel('history')->info("Tambah data Ijin => " . $msg);

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

                    prosesAbsensiHarianModel::where('idKaryawan', $parsing['id'])->where('tglAbsen', $parsing['tglAwal'])->update([
                        'keteranganIjin' => $parsing['kode'],
                    ]);

                    //log
                    $msg = "Id Karyawan = " . $parsing['id'] . " kode KeteranganIjin = " . $parsing['kode'] . " Tanggal Ijin = " . $parsing['tglAwal'] . " User = " . auth()->user()->karyawan->namaKaryawan;
                    Log::channel('history')->info("Tambah data Ijin => " . $msg);

                    $sendToView = array(
                        'status'        => 1,
                        'message'       => 'Data Berhasil Di Proses'
                    );
                    return json_encode($sendToView);
                }
            } elseif ($parsing['kode'] == 'ISD') {
                $cm = date('m', strtotime($parsing['tglAwal']));
                $cy = date('Y', strtotime($parsing['tglAwal']));
                $cekISD = absensiModel::where('idKaryawan', $parsing['id'])->whereMonth('tanggalIjin', $cm)->whereYear('tanggalIjin', $cy)->where('idKeteranganIjin', $idKode->id)->first();
                if (empty($cekISD)) {
                    $tmpSave = [
                        'idKaryawan'        => $parsing['id'],
                        'idKeteranganIjin'  => $idKode->id,
                        'tanggalIjin'       => $parsing['tglAwal'],
                        'status'            => '0'
                    ];
                    absensiModel::create($tmpSave);

                    prosesAbsensiHarianModel::where('idKaryawan', $parsing['id'])->where('tglAbsen', $parsing['tglAwal'])->update([
                        'keteranganIjin' => $parsing['kode'],
                    ]);

                    //log
                    $msg = "Id Karyawan = " . $parsing['id'] . " kode KeteranganIjin = " . $parsing['kode'] . " Tanggal Ijin = " . $parsing['tglAwal'] . " User = " . auth()->user()->karyawan->namaKaryawan;
                    Log::channel('history')->info("Tambah data Ijin => " . $msg);

                    $sendToView = array(
                        'status'        => 1,
                        'message'       => 'Data Berhasil Di Proses'
                    );
                    return json_encode($sendToView);
                } else {
                    $sendToView = array(
                        'status'        => 0,
                        'message'       => 'Sudah Melakukan ISD, Cek kembali data ijin'
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

                prosesAbsensiHarianModel::where('idKaryawan', $parsing['id'])->where('tglAbsen', $parsing['tglAwal'])->update([
                    'keteranganIjin' => $parsing['kode'],
                ]);
                //log
                $msg = "Id Karyawan = " . $parsing['id'] . " kode KeteranganIjin = " . $parsing['kode'] . " Tanggal Ijin = " . $parsing['tglAwal'] . " User = " . auth()->user()->karyawan->namaKaryawan;
                Log::channel('history')->info("Tambah data Ijin => " . $msg);

                $sendToView = array(
                    'status'        => 1,
                    'message'       => 'Data Berhasil Di Proses'
                );
                return json_encode($sendToView);
            }
        } else {
            $sendToView = array(
                'status'        => 0,
                'message'       => 'Data Ijin Sudah tersedia'
            );
            return json_encode($sendToView);
        }
    }

    function dataIjin(Request $request)
    {
        $tanggal = $request->filterTanggal;
        if ($tanggal != '') {
            if (auth()->user()->role == '5') {
                $idBagian = karyawanModel::where('idBagian', auth()->user()->karyawan->idBagian)->get();
                $absensi = absensiModel::whereBelongsTo($idBagian)->where('tanggalIjin', $tanggal)->orderBy('tanggalIjin', 'desc')->limit(1000)->get();
                $count = absensiModel::whereBelongsTo($idBagian)->where('tanggalIjin', $tanggal)->count();
            } elseif (auth()->user()->role == '4') {
                $idDepartemen = karyawanModel::where('idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
                $absensi = absensiModel::whereBelongsTo($idDepartemen)->where('tanggalIjin', $tanggal)->orderBy('tanggalIjin', 'desc')->limit(1000)->get();
                $count = absensiModel::whereBelongsTo($idDepartemen)->where('tanggalIjin', $tanggal)->count();
            } else {
                $absensi = absensiModel::with(['karyawanModel'])->where('tanggalIjin', $tanggal)->orderBy('tanggalIjin', 'desc')->limit(1000)->get();
                $count = absensiModel::where('tanggalIjin', $tanggal)->count();
            }
        } else {
            if (auth()->user()->role == '5') {
                $idBagian = karyawanModel::where('idBagian', auth()->user()->karyawan->idBagian)->get();
                $absensi = absensiModel::whereBelongsTo($idBagian)->orderBy('tanggalIjin', 'desc')->limit(1000)->get();
                $count = absensiModel::whereBelongsTo($idBagian)->count();
            } elseif (auth()->user()->role == '4') {
                $idDepartemen = karyawanModel::where('idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
                $absensi = absensiModel::whereBelongsTo($idDepartemen)->orderBy('tanggalIjin', 'desc')->limit(1000)->get();
                $count = absensiModel::whereBelongsTo($idDepartemen)->count();
            } else {
                $absensi = absensiModel::with(['karyawanModel'])->orderBy('tanggalIjin', 'desc')->limit(1000)->get();
                $count = absensiModel::all()->count();
            }
        }

        $data =  [
            'absensi' => $absensi,
            'rows' => $count
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

    function deleteStatus(Request $request)
    {
        $id = $request->id;
        $ket = $request->ket;
        $tgl = $request->tgl;
        $idKaryawan = $request->idKaryawan;
        if ($ket == 'AL') {
            $cekCuti = detailCutiModel::where('tanggalIjin', $tgl)->where('idKaryawan', $idKaryawan)->first();
            $dataCuti = cutiModel::where('idKaryawan', $idKaryawan)->where('year', $cekCuti['tahun'])->first();
            $dataCutiUpdate = [
                'ambilCuti' => $dataCuti->ambilCuti - 1,
                'sisaCuti'  => $dataCuti->sisaCuti + 1
            ];
            cutiModel::where('id', $dataCuti->id)->update($dataCutiUpdate);
            detailCutiModel::where('tanggalIjin', $tgl)->where('idKaryawan', $idKaryawan)->delete();
            absensiModel::where('id', $id)->delete();
        } elseif ($ket == 'AD') {
            $cekHutangCuti = detailHutangCutiModel::where('tanggalIjin', $tgl)->where('idKaryawan', $idKaryawan)->first();
            $dataHutangCuti = hutangCutiModel::where('idKaryawan', $idKaryawan)->where('year', $cekHutangCuti['tahun'])->first();
            $dataHutangCutiUpdate = [
                'ambilHutangCuti' => $dataHutangCuti->ambilHutangCuti - 1,
            ];
            hutangCutiModel::where('id', $dataHutangCuti['id'])->update($dataHutangCutiUpdate);
            detailHutangCutiModel::where('tanggalIjin', $tgl)->where('idKaryawan', $idKaryawan)->delete();
            absensiModel::where('id', $id)->delete();
        } else {
            absensiModel::where('id', $id)->delete();
        }

        prosesAbsensiHarianModel::where('idKaryawan', $idKaryawan)->where('tglAbsen', $tgl)->update([
            'keteranganIjin' => null,
        ]);
        //log
        $msg = "Id Karyawan = " . $idKaryawan . " kode KeteranganIjin = " . $ket . " Tanggal Ijin = " . $tgl . " User = " . auth()->user()->karyawan->namaKaryawan;
        Log::channel('history')->warning("Hapus data Ijin => " . $msg);
    }

    function cekRows(Request $request)
    {
        $tanggal = $request->filterTanggal;
        if ($tanggal != '') {
            if (auth()->user()->role == '5') {
                $idBagian = karyawanModel::where('idBagian', auth()->user()->karyawan->idBagian)->get();
                $count = absensiModel::whereBelongsTo($idBagian)->where('tanggalIjin', $tanggal)->count();
            } elseif (auth()->user()->role == '4') {
                $idDepartemen = karyawanModel::where('idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
                $count = absensiModel::whereBelongsTo($idDepartemen)->where('tanggalIjin', $tanggal)->count();
            } else {
                $count = absensiModel::where('tanggalIjin', $tanggal)->count();
            }
        } else {
            if (auth()->user()->role == '5') {
                $idBagian = karyawanModel::where('idBagian', auth()->user()->karyawan->idBagian)->get();

                $count = absensiModel::whereBelongsTo($idBagian)->count();
            } elseif (auth()->user()->role == '4') {
                $idDepartemen = karyawanModel::where('idDepartemen', auth()->user()->karyawan->idDepartemen)->get();
                $count = absensiModel::whereBelongsTo($idDepartemen)->count();
            } else {
                $count = absensiModel::all()->count();
            }
        }
        return response()->json(['data' => $count]);
    }
}
