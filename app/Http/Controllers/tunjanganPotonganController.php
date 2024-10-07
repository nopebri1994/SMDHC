<?php

namespace App\Http\Controllers;

use App\Models\tunjaganPotonganModel;
use Illuminate\Http\Request;
use varHelper;

class tunjanganPotonganController extends Controller
{
    function index()
    {
        $data = tunjaganPotonganModel::get()->first();
        $tmp = [
            'title' => 'Setting Tunjangan dan Potongan',
            'data' => $data,
        ];
        return view('tunjanganPotongan.v_tunjanganPotongan', $tmp);
    }

    function store(Request $request)
    {
        $gp = $request->gp;
        $tjMakan = $request->tjMakan;
        $tjTransport = $request->tjTransport;

        $gp = varHelper::rupiahImplode($gp);
        $tjMakan = varHelper::rupiahImplode($tjMakan);
        $tjTransport = varHelper::rupiahImplode($tjTransport);

        $data = tunjaganPotonganModel::get()->first();
        if (empty($data)) {
            tunjaganPotonganModel::create([
                'gp' => $gp,
                'tjMakan' => $tjMakan,
                'tjTransport' => $tjTransport,
            ]);
        } else {
            tunjaganPotonganModel::where('id', 1)->update([
                'gp' => $gp,
                'tjMakan' => $tjMakan,
                'tjTransport' => $tjTransport,
            ]);
        }

        return redirect()->back();
    }
}
