<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function show($name = 'Nguyen Danh Duoc', $mssv = '0305467')
    {
        return view('student', ['name' => $name, 'mssv' => $mssv]);
    }
}