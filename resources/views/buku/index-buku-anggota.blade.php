@extends('layouts.mainlayout')
@section('body')
@include('navigasi.nav-anggota')
<div class="container mt-lg-5">
    <div class="my-5 py-5 px-3">
        <div class="container mt-4 p-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow rounded">
                        <div class="card-header text-light fs-5">Data Buku</div>
                        <div class="card-body p-3">

                            <div class="my-3 mx-3 table-responsive">
                                <table id="tbbuku2" class="table table-hover table-bordered border-secondary border-1">
                                    <thead class="text-center">
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
                                        @forelse($bukus as $buku)
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
    $('#tbbuku2').DataTable(
    {
        scrollX: true,
        scrollY: '500px',
        scrollCollapse: true,
        paging: true,
    }
    );
});
</script>
@endsection