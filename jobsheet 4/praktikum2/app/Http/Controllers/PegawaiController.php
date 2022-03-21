<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
    	// mengambil semua data pegawai
    	//$pegawai = Pegawai::all();

        // mengambil data pegawai pertama
        $pegawai = Pegawai::first(); 

        // mengambil data pegawai yang id nya 1
	    //$pegawai = Pegawai::find(1); 
 
    	// mengirim data pegawai ke view pegawai
    	return view('pegawai', ['pegawai' => $pegawai]);
    }
}
