<?php

namespace App\Http\Controllers;

use App\Models\karyawanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class usersController extends Controller
{
    public function index()
    {
        $karyawan = karyawanModel::orderBy('namaKaryawan')->get();
        $data = [
            'title' => 'Data Pengguna',
            'karyawan' => $karyawan,
        ];
        return view('admin.v_admin', $data);
    }

    function store(Request $request)
    {
        $tmp = [
            'idKaryawan' => $request->idKaryawan,
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->pass),

        ];

        UserModel::create($tmp);
        return redirect('admin/users');
    }

    function tabelAdmin()
    {
        $karyawan = UserModel::with('karyawan')->get();
        $data = [
            'data' => $karyawan,
        ];
        return view('admin.tabelAdmin', $data);
    }
}
