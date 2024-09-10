<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class overtimeController extends Controller
{
    function index()
    {
        $tmp = [
            'title' => 'Data Overtime (Lembur)'
        ];
        return view('overtime.v_overtime', $tmp);
    }
}
