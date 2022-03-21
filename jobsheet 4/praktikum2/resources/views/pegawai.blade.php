<!DOCTYPE html>
<html>
    <head>
        <title>Tutorial Laravel #20 : Eloquent Laravel</title>
    </head>
    <body>

        <h1>Data Pegawai</h1>

        <ul>
            @foreach($pegawai as $p)
                <li>{{ "Nama : ". $p->nama . ' | Alamat : ' . $p->alamat }}</li>
            @endforeach
        </ul>

    </body>
</html>