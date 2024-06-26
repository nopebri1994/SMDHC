<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class loginController extends Controller
{
    function index()
    {
        return view('login.v_login');
    }

    function login(Request $request)
    {
        $nik = $request->nik;
        $pass = $request->pass;

        $validator = Validator::make(
            $request->all(),
            [
                'nik' => 'required',
                'pass' => 'required',
            ],
            $messages = [
                'nik.required' => 'Input data tidak boleh Kosong.',
                'pass.required' => 'Input data tidak boleh Kosong.',
            ]
        )->validate();

        if ($nik == 'a' and $pass == 'a') {
            $request->session()->put('statusLogin', 1);
            return redirect('/');
        } else {
            return redirect()->back();
        }
    }

    function logout()
    {
        if (Session::has('statusLogin')) {
            Session::pull('statusLogin');
            return redirect('login');
        }
    }
}
