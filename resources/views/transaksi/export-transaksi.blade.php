<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi</title>

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
        <h3>Data Transaksi Tahun {{date("Y")}}</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">NIM</th>
                <th scope="col">Nama Anggota</th>
                <th scope="col">Prodi</th>
                <th scope="col">ISBN</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Tanggal Kembali</th>
                <th scope="col">Denda</th>
            </tr>
        </thead>
        <tbody>
            @php $no=1; @endphp
            @foreach($transaksis as $tr)
            <tr>

                <td>{{$no++}}</td>
                <td>{{ $tr->anggota->nim }}</td>
                <td>{{ $tr->anggota->nama_anggota }}</td>
                <td>{{ $tr->anggota->prodi->nama_prodi }}</td>
                <td>{{ $tr->buku->isbn }}</td>
                <td>{{ $tr->buku->judul_buku}}</td>
                <td>{{ $tr->tanggal_pinjam }}</td>
                <td>{{ $tr->tanggal_kembali }}</td>
                <td>{{ $tr->denda }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>