<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class karyawanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Karyawan',
        ];
        return View('karyawan.v_karyawan', $data);
    }
}
