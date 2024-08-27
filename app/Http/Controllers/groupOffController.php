<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class groupOffController extends Controller
{
    function index()
    {
        $data = [
            'title' => 'Data Sabtu OFF',
        ];
        return view('groupOff.v_groupOff', $data);
    }

    function storeData(Request $request)
    {
        $group = $request->group;
    }

    function tabelData() {}
}
