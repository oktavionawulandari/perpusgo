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
                        <div class="card-header text-warning fs-5">Data Anggota</div>
                        <div class="card-body p-3">

                            <div class="my-3 mx-3 table-responsive">
                                <table id="tbanggota" class="table table-hover table-bordered border-secondary border-1">
                                    <thead class="text-center align-middle">
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
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php $no=1; @endphp
                                        @forelse($anggotas as $anggota)
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
                                            <td class="text-center">
                                                 <div class="d-flex flex-row">
                                                    <a href="{{ route('anggota.edit', $anggota->id_anggota) }}"
                                                        class="btn btn-sm btn-dark">Edit</a>
                                                    <a href="{{ route('anggota.hapus', $anggota->id_anggota) }}"
                                                        onclick="return confirm('Apakah Anda Yakin Menghapus Data Anggota Ini ?');"
                                                        class="btn btn-sm btn-danger ms-1"> Hapus </a>
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
                            <a href="{{ route('anggota.create') }}"
                                class="btn  btn-info btn-md mb-3 ms-3 float-right text-light"
                                style="width: fit-content;">+Tambah
                                Data Anggota</a>
                            <a href="{{ route('anggota.pdf') }}"
                                class="btn  btn-success btn-md mb-3 float-right text-light" style="width: fit-content;">
                                Export to PDF</a>
                            <a href="{{ route('anggota.excel') }}"
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
    $('#tbanggota').DataTable(
    {
        scrollX: true,
        scrollY: '500px',
        scrollCollapse: true,
        paging: true,
    });
});
</script>
@endsection