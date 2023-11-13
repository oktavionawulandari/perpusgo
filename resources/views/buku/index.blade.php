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
            <div class="row">
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
                        <div class="card-header text-light fs-5">Data Buku</div>
                        <div class="card-body p-3">

                            <div class="my-3 mx-3 table-responsive">
                                <table id="tbbuku" class="table table-hover table-bordered border-secondary border-1">
                                    <thead class="text-center align-middle">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ISBN</th>
                                            <th scope="col">Judul Buku</th>
                                            <th scope="col">Nama Penulis</th>
                                            <th scope="col">Tahun Terbit</th>
                                            <th scope="col">Nama Penerbit</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Aksi</th>
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
                                            <td class="text-center">
                                                <div class="d-flex flex-row">
                                                    <a href="{{ route('buku.edit', $buku->id_buku) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="{{ route('buku.hapus', $buku->id_buku)}}"
                                                        onclick="return confirm('Apakah Anda Yakin Menghapus Data Buku Ini ?');"
                                                        class="btn btn-sm btn-danger ms-1">Hapus</a>
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
                            <a href="{{ route('buku.create') }}"
                                class="btn  btn-info btn-md mb-3 ms-3 float-right text-light"
                                style="width: fit-content;">+Tambah
                                Data Buku</a>
                            <a href="{{ route('buku.pdf') }}"
                                class="btn  btn-success btn-md mb-3 float-right text-light" style="width: fit-content;">
                                Export to PDF</a>
                            <a href="{{ route('buku.excel') }}"
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
    $('#tbbuku').DataTable(
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