<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

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
        <h3>Data Buku Tahun {{date("Y")}}</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ISBN</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Nama Penulis</th>
                <th scope="col">Tahun Terbit</th>
                <th scope="col">Nama Penerbit</th>
                <th scope="col">Kategori</th>
                <th scope="col">Jumlah</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @php $no=1; @endphp
            @foreach($bukus as $buku)
            <tr>
                <td>{{$no++}}</td>
                <td>{{ $buku->isbn }}</td>
                <td>{{ $buku->judul_buku }}</td>
                <td>{{ $buku->nama_penulis }}</td>
                <td>{{ $buku->tahun_terbit}}</td>
                <td>{{ $buku->penerbit->nama_penerbit}}</td>
                <td>{{ $buku->kategoribk->kategori}}</td>
                <td>{{ $buku->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>