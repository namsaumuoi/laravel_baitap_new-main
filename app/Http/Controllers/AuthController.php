<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('auth.signin');
    }

    public function checkSignIn(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'repass'   => 'required|string',
            'mssv'     => 'required|string',
            'lopmonhoc'=> 'required|string',
            'gioitinh' => 'required|string',
        ]);

        if ($data['password'] !== $data['repass']) {
            return view('auth.result', ['message' => 'Đăng ký thất bại: password != repass']);
        }

        $expected = [
            'username'  => 'DuocND',
            'password'  => '123456',
            'mssv'      => '0305467',
            'lopmonhoc' => '67PM2',
            'gioitinh'  => 'nam'
        ];

        $ok = $data['username'] === $expected['username']
           && $data['password'] === $expected['password']
           && $data['mssv'] === $expected['mssv']
           && $data['lopmonhoc'] === $expected['lopmonhoc']
           && strtolower($data['gioitinh']) === $expected['gioitinh'];

        $message = $ok ? 'Đăng ký thành công!' : 'Đăng ký thất bại';
        return view('auth.result', ['message' => $message]);
    }
}