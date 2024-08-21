<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawanModel;


class homeController extends Controller
{
    public function index()
    {
        $count = karyawanModel::count();
        $metal = karyawanModel::where('idPerusahaan',1)->count();
        $data = [
            'title' => 'Sistem Manajemen Data Human Capital',
            'countEmployee' => $count,
            'metalEmployee' =>$metal
        ];

        return view('home', $data);
    }
}
