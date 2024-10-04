<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tunjanganPotonganController extends Controller
{
    function index()
    {
        $tmp = [
            'title' => 'Setting Tunjangan dan Potongan',
        ];
        return view('tunjanganPotongan.v_tunjanganPotongan', $tmp);
    }
}
