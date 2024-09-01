<?php

namespace App\Http\Controllers;

use App\Services\userServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class loginController extends Controller
{
    private userServices $userServices;

    public function __construct(userServices $userServices)
    {
        $this->userServices = $userServices;
    }


    function index()
    {
        return view('login.v_login');
    }

    function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($this->userServices->login($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('status', 'Selamat Datang di halaman SMDHC');
        }
        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/')->with('status', 'Selamat Datang di halaman SMDHC');
        // }
        return redirect('/login')->with('status', 'userrname atau password salah');
    }

    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }
}
