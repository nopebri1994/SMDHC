<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawanModel;


class homeController extends Controller
{
    public function index()
    {
        $count = karyawanModel::whereNull('km')->count();
        $metal = karyawanModel::where('idPerusahaan', 1)->whereNull('km')->count();
        $data = [
            'title' => 'Sistem Manajemen Data Human Capital',
            'countEmployee' => $count,
            'metalEmployee' => $metal
        ];

        return view('home', $data);
    }
}
