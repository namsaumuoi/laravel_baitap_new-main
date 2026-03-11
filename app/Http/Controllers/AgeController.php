<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgeController extends Controller
{
    public function showForm()
    {
        return view('age.form');
    }

    public function store(Request $request)
    {
        $request->validate(['age' => 'required']);
        $age = $request->input('age');
        session(['age' => $age]);
        return redirect()->route('age.protected');
    }

    public function protected(Request $request)
    {
        $age = $request->session()->get('age');
        return view('age.protected', ['age' => $age]);
    }
}