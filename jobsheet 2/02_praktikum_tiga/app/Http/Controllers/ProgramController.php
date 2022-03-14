<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function karir()
    {
        return view('program', ['title' => 'Karir']);
    }
    public function magang()
    {
        return view('program', ['title' => 'Magang']);
    }
    public function kunjungan()
    {
        return view('program', ['title' => 'Kunjungan Industri']);
    }
}
