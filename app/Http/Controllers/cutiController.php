<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cutiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Cuti Tahunan',
        ];
        return view('cuti.v_cuti', $data);
    }
}
