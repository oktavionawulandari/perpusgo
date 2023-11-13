@extends('layouts.mainlayout')
@section('body')
@include('navigasi.nav-admin')
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
                        <div class="card-header text-light p-3 fs-5"> Data Pegawai</div>
                        <div class="card-body p-3 mx-3">
                            <div class="my-3 mx-3 table-responsive">
                                <table id="tbpegawai" class="table table-hover table-bordered border-secondary border-1">
                                    <thead class="text-center align-middle">
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
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @php $no=1; @endphp
                                        @forelse($pegawais as $pegawai)
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
                                            <td class="text-center">
                                                <div class="d-flex flex-row">
                                                    <a href="{{ route('pegawai.edit', $pegawai->id_pegawai) }}"
                                                        class="btn btn-sm btn-primary">Edit</a>
                                                    <a href="{{ route('pegawai.hapus', $pegawai->id_pegawai)}}"
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
                            <a href="{{ route('pegawai.create') }}"
                                class="btn  btn-info btn-md mb-3 ms-3 float-right text-light"
                                style="width: fit-content;">+Tambah
                                Data Pegawai</a>
                            <a href="{{ route('pegawai.pdf') }}"
                                class="btn  btn-success btn-md mb-3 float-right text-light" style="width: fit-content;">
                                Export to PDF</a>
                            <a href="{{ route('pegawai.excel') }}"
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
    $('#tbpegawai').DataTable(
    {
        scrollX: true,
        scrollY: '500px',
        scrollCollapse: true,
        paging: true,
    });
});
</script>
@endsection