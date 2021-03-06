@extends('mahasiswa.layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <div class="float-left my-2">
            <form action="{{ route('mahasiswa.index') }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="search now" name="search" value="{{ request('search')}}">
                    <button class="p-1 btn border border-primary text-primary" type="submit" >Search</button>&emsp;
                </div>
            </form>
        </div>
        <div class="float-right my-2">
            <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th width="75px">Kelas</th>
        <th>Jurusan</th>
        <th width="50px">Foto</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Tanggal Lahir</th>
        <th width="300px">Action</th>
    </tr>
    @foreach ($paginate as $mhs)
    <tr >

        <td>{{ $mhs ->nim }}</td>
        <td>{{ $mhs ->nama }}</td>
        <td>{{ $mhs ->kelas->nama_kelas }}</td>
        <td>{{ $mhs ->jurusan }}</td>
        <td><img width="150px" src="{{asset('storage/'.$mhs ->foto)}}"></td>
        <td>{{ $mhs ->email }}</td>
        <td>{{ $mhs ->alamat }}</td>
        <td>{{ $mhs ->tanggal_lahir }}</td>
        <td>
            <form action="{{ route('mahasiswa.destroy',$mhs->nim) }}" method="POST">

                <a class="btn btn-info" href="{{ route('mahasiswa.show',$mhs->nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$mhs->nim) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('yakin?');">Delete</button>
                <a class="btn btn-warning" href="{{ route('mahasiswa.khs',$mhs->id_mahasiswa) }}">Nilai</a>
            </form>
            
        </td>
    </tr>
    @endforeach
</table>
<div class="d-flex justify-content-end">
    {{ $paginate->links() }}
</div>
@endsection
