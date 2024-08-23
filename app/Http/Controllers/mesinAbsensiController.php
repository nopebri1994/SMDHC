<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mesinAbsensiModel;
use Illuminate\Support\Facades\Validator;
use App\Models\absensiHarianModel;
use App\Models\absensiModel;
use Illuminate\Support\Facades\Storage;

class mesinAbsensiController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Mesin Absensi',
        ];
        return view('mesinAbsensi.v_mesinAbsensi', $data);
    }
    public function tabelData()
    {
        $data = [
            'mesin' => mesinAbsensiModel::all(),
        ];
        return view('mesinAbsensi.tabelMesinAbsensi', $data);
    }

    function insert(Request $request)
    {
        $namaMesin = $request->namaMesin;
        $keyMesin = $request->keyMesin;
        $ipAddress = $request->ipAddress;
        $keterangan = $request->keterangan;

        $validator = Validator::make(
            $request->all(),
            [
                'namaMesin' => 'required',
                'keyMesin' => 'required',
                'ipAddress' => 'required',
                'keterangan' => 'required',

            ],
            $messages = [
                'namaMesin.required' => 'Input data tidak boleh Kosong.',
                'keyMesin.required' => 'Key Mesin tidak boleh Kosong.',
            ]
        )->validate();

        mesinAbsensiModel::create([
            'namaMesin'     => $namaMesin,
            'key'           => $keyMesin,
            'ipAddress'     => $ipAddress,
            'keterangan'    => $keterangan
        ]);


        $sendToView = array(
            'status' => 1,
        );
        echo json_encode($sendToView);
    }
    function delete(Request $request)
    {
        mesinAbsensiModel::where('id', $request->id)->delete();
    }
    function update(Request $request)
    {
        $namaMesin = $request->namaMesin;
        $keyMesin = $request->keyMesin;
        $ipAddress = $request->ipAddress;
        $keterangan = $request->keterangan;

        $validator = Validator::make(
            $request->all(),
            [
                'namaMesin' => 'required',
                'keyMesin' => 'required',
                'ipAddress' => 'required',

            ],
            $messages = [
                'namaMesin.required' => 'Input data tidak boleh Kosong.',
                'keyMesin.required' => 'Key Mesin tidak boleh Kosong.',
            ]
        )->validate();

        mesinAbsensiModel::where('id', $request->id)->update([
            'namaMesin'     => $namaMesin,
            'key'           => $keyMesin,
            'ipAddress'     => $ipAddress,
            'keterangan'    => $keterangan
        ]);
    }

    function sync()
    {
        $data = [
            'title' => 'Sinkoronisasi Data Mesin Absensi',
            'data' => mesinAbsensiModel::all(),
        ];
        return view('mesinAbsensi.sync', $data);
    }

    function connect(Request $request)
    {
        $id = $request->id;
        $mesin = mesinAbsensiModel::where('id', $id)->first();
        $connect = $this->connectMesin($mesin->ipAddress, $mesin->key);
        if ($connect) {
            $sendToView = array(
                'status' => 'Connected',
            );
        } else {
            $sendToView = array(
                'status' => 'not-Conected',
            );
        }
        echo json_encode($sendToView);
    }

    function connectMesin($ip)
    {
        $connect = fsockopen($ip, "80", $errno, $errstr, 1);
        if ($connect) {
            return true;
        } else {
            return false;
        }
    }

    function tarikDataMesin(Request $request)
    {
        $id = $request->id;
        $date = date("Y-m-d");
        $file = Storage::disk('mesinAbsen');
        $file->put("$date.txt", 'Log Absensi');
        $tmp = [];
        $mesin = mesinAbsensiModel::where('id', $id)->first();
        $connect = fsockopen($mesin->ipAddress, "80", $errno, $errstr, 1);
        $soap_request = "<GetAttLog>
                                    <ArgComKey xsi:type=\"xsd:integer\">" . $mesin->key . "<ArgComKey>
                                    <Arg>
                                        <PIN xsi:type=\"xsd:integer\">All</PIN>
                                    </Arg>
                              </GetAttLog>";
        $newline = "\r\n";
        fputs($connect, "POST /iWsService HTTP/1.0" . $newline);
        fputs($connect, "Content-Type:text/xml" . $newline);
        fputs($connect, "Content-Length: " . strlen($soap_request) . $newline . $newline);
        fputs($connect, $soap_request . $newline);
        $buffer = "";
        while ($response = fgets($connect, 1024)) {
            $buffer = $buffer . $response;
        }
        $buffer = $this->parse_data($buffer, "<GetAttLogResponse>", "</GetAttLogResponse>");
        $buffer = explode("\r\n", $buffer);

        // $myfile = fopen("log/Mesin_Absensi/$date.txt", "w");
        for ($a = 1; $a < count($buffer); $a++) {
            $row = $this->parse_data($buffer[$a], "<Row>", "</Row>");
            $pin = $this->parse_data($row, "<PIN>", "</PIN>");
            $datetime = $this->parse_data($row, "<DateTime>", "</DateTime>");
            $date2 = date("Y-m-d", strtotime($datetime));
            $date3 = date("d/m/y", strtotime($datetime));
            $time2 = date("H:i", strtotime($datetime));
            if ($pin) {
                $cekDuplicate = absensiHarianModel::where('idFinger', $pin)->where('tanggalAbsen', $date2)->where('jamAbsen', $time2)->first();
                if (empty($cekDuplicate)) {
                    $tmp[] = [
                        'idFinger' => $pin,
                        'tanggalAbsen' => $date2,
                        'jamAbsen' => $time2,
                        'idMesin' => $id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    if (count($tmp) == 1000) {
                        DB::table('absensiHarian')->insert($tmp);
                        $tmp = [];
                    }
                    $txt = "001.$date3.$time2.$pin";
                    // fwrite($myfile, $txt);
                    $file->append("$date.txt", $txt);
                }
            }
        }
        DB::table('absensiHarian')->insert($tmp);
        // fclose($myfile);
        echo "file txt saved to ";
        echo "<a href='../storage/mesin/$date.txt' target='_blank'>file.txt</a>";
    }

    function parse_data($data, $p1, $p2)
    {
        $data = "" . $data;
        $hasil = "";
        $awal = strpos($data, $p1);
        if ($awal != "") {
            $akhir = strpos(strstr($data, $p1), $p2);
            if ($akhir != "") {
                $hasil = substr($data, $awal + strlen($p1), $akhir - strlen($p1));
                // echo $hasil;
            }
        }
        return $hasil;
    }
}
