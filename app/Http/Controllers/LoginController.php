<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function halamanlogin()
    {
        return view('login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::guard('user')->attempt($request->only('username', 'password'))) {
            return redirect('/home/pegawai');
        } else if (Auth::guard('anggota')->attempt($request->only('username', 'password'))) {
            return redirect('/home/anggota');
        }
        return redirect()
            ->back()
            ->withInput()
            ->with([
                'error' => 'Password atau Username Anda salah, silahkan coba kembali'
            ]);
    }

    public function logout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        } else if (Auth::guard('anggota')->check()) {
            Auth::guard('anggota')->logout();
        }
        return redirect('/');
    }
}