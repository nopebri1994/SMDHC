<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\karyawanModel;
use Illuminate\Support\Facades\Gate;

class homeController extends Controller
{
    public function index()
    {
        $count = karyawanModel::count();
        $data = [
            'title' => 'Halaman Depan SMDHC',
            'countEmployee' => $count,
        ];

        return view('home', $data);
    }
}
