<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawanModel;


class homeController extends Controller
{
    public function index()
    {
        $count = karyawanModel::count();
        $data = [
            'title' => 'Sistem Manajemen Data Human Capital',
            'countEmployee' => $count,
        ];

        return view('home', $data);
    }
}
