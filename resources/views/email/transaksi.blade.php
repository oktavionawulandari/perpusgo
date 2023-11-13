<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Halo, {{ $data['nama'] }}!</h3>
    <p>Tenggat pengembalian buku "{{ $data['judul_buku'] }}" dengan tanggal peminjaman {{ $data['tgl_pinjam'] }}
        telah terlambat selama {{ $data['lambat'] }} hari. Anda dikenakan denda sebesar Rp {{ $data['denda'] }}.
        Mohon segera melakukan pengembalian. Terima kasih</p>


</body>

</html>