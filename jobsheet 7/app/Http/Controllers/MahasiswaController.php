<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Mahasiswa_Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = Mahasiswa::where(
                'nim', 'like', '%' . request('search') . '%'
            )
                ->orwhere('nama', 'like', '%' . request('search') . '%')
                // ->orwhere('kelas_id', 'like', '%' . request('search') . '%')
                ->orwhere('jurusan', 'like', '%' . request('search') . '%')
                ->orwhere('email', 'like', '%' . request('search') . '%')
                ->orwhere('alamat', 'like', '%' . request('search') . '%')
                ->orwhere('tanggal_lahir', 'like', '%' . request('search') . '%')->paginate(3);
            return view('mahasiswa.index', ['paginate' => $paginate]);
        } else {
            $mahasiswa = Mahasiswa::with('kelas')->get(); // Mengambil semua isi tabel
            $paginate = Mahasiswa::orderBy('nim', 'asc')->paginate(3);
            return view('mahasiswa.index', ['mahasiswa' => $mahasiswa, 'paginate' => $paginate]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all(); //dapat data dari tabel kelas
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tanggal_Lahir' => 'required',
            'foto' => 'required',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tanggal_lahir = $request->get('Tanggal_Lahir');

        //controller foto
        if ($request->file('foto')) {
            $image_name = $request->file('foto')->store('images', 'public');
        }

        $mahasiswa->foto = $image_name;

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk tambah data dengan relasi BelongsTo
        $mahasiswa->kelas()->associate($kelas);

        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();

        return view('mahasiswa.detail', ['Mahasiswa' => $mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $kelas = Kelas::all(); //dapat data dari tabel kelas
        return view('mahasiswa.edit', compact('Mahasiswa','kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tanggal_Lahir' => 'required',
            'foto' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        // $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tanggal_lahir = $request->get('Tanggal_Lahir');

        if ($mahasiswa->foto && file_exists(storage_path('app/public/' . $mahasiswa->foto))) {
            Storage::delete('public/' . $mahasiswa->foto);
        }
      
        $image_name = $request->file('foto')->store('images', 'public');
        $mahasiswa->foto = $image_name;

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk tambah data dengan relasi BelongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if($mahasiswa != null){
            $mahasiswa->delete();
            return redirect()->route('mahasiswa.index')
                ->with('success', 'Mahasiswa Berhasil Dihapus');
        }
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Gagal Dihapus');
    }
    public function khs($id)
    {
        $khs = Mahasiswa_Matakuliah::where('mahasiswa_id', $id)
            ->with('matakuliah')->get();
        $khs->mahasiswa = Mahasiswa::with('kelas')
            ->where('id_mahasiswa', $id)->first();

        return view('mahasiswa.khs', compact('khs'));
    }
    
    public function cetak_pdf($id){
        $khs = Mahasiswa_Matakuliah::where('mahasiswa_id', $id)
            ->with('matakuliah')->get();
        $khs->mahasiswa = Mahasiswa::with('kelas')
            ->where('id_mahasiswa', $id)->first();
        
        // dd();

        $pdf = PDF::loadview('mahasiswa.export_pdf', ['khs' => $khs, 'mhs' => $khs->mahasiswa]);
        return $pdf->stream();
    }
}
