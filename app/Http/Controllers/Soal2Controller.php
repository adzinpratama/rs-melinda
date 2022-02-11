<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Soal2Controller extends Controller
{
    public function __invoke()
    {
        return view('soal2.index');
    }
}
