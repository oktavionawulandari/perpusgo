@extends('layouts.mainlayout')
@section('body')
@include('navigasi.nav-anggota')
<div class="container mt-lg-5">
    <div class="my-5 py-5 px-3">
        <div class="container mt-4 p-3">
            <div class="row">
                <div class="col-md-12">

                    <div class="card border-0 shadow rounded">
                        <div class="card-header text-light p-3 fs-5">Data Transaksi</div>
                        <div class="card-body p-3 mx-3">

                            <div class="my-3 mx-3 table-responsive">
                                <table id="tbtransaksi2" class="table table-hover table-bordered border-secondary border-1">
                                    <thead class="text-center">
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
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="text-center text-muted" colspan="10">Data tidak tersedia </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function () {
    $('#tbtransaksi2').DataTable(
        {
        scrollX: true,
        scrollY: '500px',
        scrollCollapse: true,
        paging: true,
    });
});
</script>
@endsection