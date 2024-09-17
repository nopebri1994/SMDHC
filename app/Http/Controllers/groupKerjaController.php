<?php

namespace App\Http\Controllers;

use App\Models\groupKerjaModel;
use Illuminate\Http\Request;

class groupKerjaController extends Controller
{
    function index()
    {
        $tmp = [
            'title' => 'Data Group Kerja',
        ];
        return view('groupKerja.v_groupKerja', $tmp);
    }

    function tabelData()
    {
        $group = groupKerjaModel::all();
        $tmp = [
            'data' => $group,
        ];
        return view('groupKerja.tabelGroupKerja', $tmp);
    }

    function storeData(Request $request)
    {
        $group = $request->group;
        groupKerjaModel::create(['groupKerja' => $group]);
        return redirect()->back()->with('status', 'Data Berhasil disimpan');
    }
    function delete(Request $request)
    {
        $id = $request->id;
        groupKerjaModel::where('id', $id)->delete();
    }
}
