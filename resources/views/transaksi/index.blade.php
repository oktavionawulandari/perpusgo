@extends('layouts.mainlayout')
@section('body')
@if(Auth::guard('user')->user()->role=="Admin")
@include('navigasi.nav-admin')
@elseif(Auth::guard('user')->user()->role=="Pustakawan")
@include('navigasi.nav-pustakawan')
@endif
<div class="container mt-lg-5">
    <div class="my-5 py-5 px-3">
        <div class="container mt-4 p-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!--Notifikasi menggunakan flash session data-->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                    @endif
                    <div class="card border-0 shadow rounded">
                        <div class="card-header text-light p-3 fs-5">Data Transaksi</div>
                        <div class="card-body p-3 mx-3">

                            <div class="my-3 mx-3 table-responsive">
                                <table class="table table-hover table-bordered border-secondary border-1" id="tbtransaksi">
                                    <thead class="text-center align-middle">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">NIM</th>
                                            <th scope="col">Nama Anggota</th>
                                            <th scope="col">Prodi</th>
                                            <th scope="col">ISBN</th>
                                            <th scope="col">Judul Buku</th>
                                            <th scope="col">Tanggal Peminjaman</th>
                                            <th scope="col">Tanggal Kembali</th>
                                            <th scope="col">Denda</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php $no=1;@endphp
                                        @forelse($transaksis as $tr)

                                        @php
                                        $tgl_dateline = date_create($tr->tanggal_kembali);
                                        $tgl_sekarang = date_create(date('Y-m-d'));
                                        $selisih = date_diff($tgl_dateline, $tgl_sekarang);
                                        $lambat = $selisih->format("%R%a");
                                        if($lambat>0){
                                        $denda=$lambat*1000;
                                        }else{
                                        $denda=$lambat*0;
                                        }

                                        @endphp
                                        <tr>

                                            <td>{{$no++}}</td>
                                            <td>{{$tr->anggota->nim}}</td>
                                            <td>{{$tr->anggota->nama_anggota}}</td>
                                            <td>{{$tr->anggota->prodi->nama_prodi}}</td>
                                            <td>{{$tr->buku->isbn}}</td>
                                            <td>{{$tr->buku->judul_buku}}</td>
                                            <td>{{ $tr->tanggal_pinjam }}</td>
                                            <td>{{ $tr->tanggal_kembali }}</td>
                                            @if($lambat>0)
                                            <td class="text-danger">{{$denda}} (Terlambat {{$lambat}} hari)</td>
                                            @else
                                            <td>{{$denda}}</td>
                                            @endif
                                            <td class="text-center">
                                                <div class="d-flex flex-row">
                                                    <a href="{{ route('transaksi.perpanjang', $tr->id_transaksi)}}"
                                                        onclick="return confirm('Apakah Anda Yakin untuk Memperpanjang Peminjaman ?');"
                                                        class="btn btn-sm btn-primary">
                                                        Perpanjang
                                                    </a>
                                                    <a href="{{ route('transaksi.kembali',[$tr->id_transaksi,$denda,$tr->id_buku]) }}"
                                                        onclick="return confirm('Apakah Anda Yakin Mengembalikan Buku ?');"
                                                        class="btn btn-sm btn-danger ms-1"> Kembali </a>
                                                    @if($lambat>0)
                                                    <a href="{{ route('transaksi.email',[$tr->id_transaksi,$denda,$tr->id_buku,$tr->id_anggota]) }}"
                                                        class="btn btn-sm btn-info ms-1 text-light"><i
                                                            class="bi bi-envelope"></i></a>
                                                    @else
                                                    <a href="{{ route('transaksi.email',[$tr->id_transaksi,$denda,$tr->id_buku,$tr->id_anggota]) }}"
                                                        class="btn btn-sm btn-info ms-1 text-light disabled"><i
                                                            class="bi bi-envelope"></i></a>
                                                    @endif
                                                </div>

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="10">Data tidak tersedia </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                            <a href="{{ route('transaksi.create') }}"
                                class="btn  btn-info btn-md mb-3 ms-3 float-right text-light"
                                style="width: fit-content;">+Tambah
                                Peminjaman</a>
                            <a href="{{route('transaksi.pdf')}}"
                                class="btn  btn-success btn-md mb-3 float-right text-light" style="width: fit-content;">
                                Export to PDF</a>
                            <a href="{{route('transaksi.excel')}}"
                                class="btn  btn-success btn-md mb-3 float-right text-light" style="width: fit-content;">
                                Export To Excel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function () {
    $('#tbtransaksi').DataTable({
        scrollX: true,
        scrollY: '500px',
        scrollCollapse: true,
        paging: true,
    });
});
</script>
@endsection
