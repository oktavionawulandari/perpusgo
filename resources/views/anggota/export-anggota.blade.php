<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>

    <style type="text/css">
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    table,
    td,
    th {
        border: 1px solid;
        font-size: 12px;

    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td,
    th {
        text-align: center;
    }


    .center {
        text-align: center;
    }
    </style>

</head>

<body>

    <div class="center">
        <h3>Data Anggota Tahun {{date("Y")}}</h3>
    </div>
    <table>
        <thead class="text-center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIM</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">No HP</th>
                <th scope="col">Email</th>
                <th scope="col">Prodi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php $no=1; @endphp
            @foreach($anggotas as $anggota)
            <tr>
                <td>{{$no++}}</td>
                <td>{{ $anggota->nim }}</td>
                <td>{{ $anggota->nama_anggota }}</td>
                <td>{{ $anggota->tgl_lahir }}</td>
                <td>{{ $anggota->jenis_kelamin }}</td>
                <td>{{ $anggota->alamat}}</td>
                <td>{{ $anggota->no_hp }}</td>
                <td>{{ $anggota->email }}</td>
                <td>{{$anggota->prodi->nama_prodi}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>