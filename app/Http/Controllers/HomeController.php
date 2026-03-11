<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function banco($n)
    {
        // Kiểm tra là số và hợp lý
        if (!is_numeric($n) || intval($n) <= 0 || intval($n) > 30) {
            return response()->view('banco.error', ['message' => 'Giá trị n không hợp lệ (1..30)'], 400);
        }
        $size = intval($n);
        return view('banco', ['n' => $size]);
    }
}