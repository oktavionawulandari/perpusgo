<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>

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
        <h3>Data Pegawai Tahun {{date("Y")}}</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIP</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Lahir</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">No HP</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php $no=1; @endphp
            @foreach($pegawais as $pegawai)
            <tr>

                <td>{{$no++}}</td>
                <td>{{ $pegawai->nip }}</td>
                <td>{{ $pegawai->nama }}</td>
                <td>{{ $pegawai->tgl_lahir }}</td>
                <td>{{ $pegawai->jenis_kelamin }}</td>
                <td>{{ $pegawai->alamat}}</td>
                <td>{{ $pegawai->no_hp }}</td>
                <td>{{ $pegawai->email }}</td>
                <td>{{ $pegawai->role }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>