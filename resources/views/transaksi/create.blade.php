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
                <div class="card shadow rounded">
                    <div class="card-header p-3 fs-5 text-light" style="background-color: #757BC8;">Tambah
                        Peminjaman
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transaksi.store') }}" method="POST" class="row mx-3">
                            @csrf
                            <!--Pilih Nama Anggota yang Meminjam-->
                            <div class="form-group mt-3 col-6">
                                <label for="id_anggota">Nama Anggota</label>
                                <select class="mt-1 form-select @error('id_anggota') is-invalid @enderror"
                                    name="id_anggota" id="id_anggota" required>

                                    @foreach ($anggotas as $tr)
                                    @if(old('id_anggota')==$tr->id_anggota)
                                    <option value="{{$tr->id_anggota}}" selected>{{$tr->nim}} - {{$tr->nama_anggota}}
                                    </option>
                                    @else
                                    <option value="{{$tr->id_anggota}}">{{$tr->nim}} - {{$tr->nama_anggota}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                                <!-- error message untuk anggota -->
                                @error('id_anggota')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <!--Pilih Judul Buku yang Dipinjam-->
                            <div class="form-group mt-3 col-6">
                                <label for="id_buku">Judul Buku</label>
                                <select class="mt-1 form-select @error('id_buku') is-invalid @enderror" name="id_buku"
                                    id="id_buku" required>
                                    @foreach ($bukus as $tr)
                                    @if(old('id_buku')==$tr->id_buku)
                                    <option value="{{$tr->id_buku}}" selected>{{$tr->isbn}} - {{$tr->judul_buku}}
                                    </option>
                                    @else
                                    <option value="{{$tr->id_buku}}">{{$tr->isbn}} - {{$tr->judul_buku}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <!-- error message untuk anggota -->
                                @error('id_anggota')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <!--Tanggal Pinjam-->
                            <div class="form-group mt-3 col-3">
                                <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                <input type="date"
                                    class="mt-1 form-control @error('tanggal_pinjam')is-invalid @enderror"
                                    id="tanggal_pinjam" name="tanggal_pinjam" value="{{$tgl_pinjam}}" readonly>

                                <!-- error message untuk tanggal pinjam -->
                                @error('tanggal_pinjam')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <!--Tanggal Kembali-->
                            <div class="form-group mt-3 col-3">
                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                <input type="date"
                                    class="mt-1 form-control @error('tanggal_kembali')is-invalid @enderror"
                                    id="tanggal_kembali" name="tanggal_kembali" value="{{$tgl_kembali}}" readonly>

                                <!-- error message untuk tanggal pinjam -->
                                @error('tanggal_kembali')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <!--Status Peminjaman-->
                            <div class="form-group mt-3 col-3">
                                <label for="status_peminjaman">Status Peminjaman</label>
                                <input type="text"
                                    class="mt-1 form-control @error('status_peminjaman')is-invalid @enderror"
                                    id="status_peminjaman" name="status_peminjaman" value="dipinjam" readonly>

                                <!-- error message untuk status peminjaman -->
                                @error('status_peminjaman')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <!--Denda-->
                            <div class="form-group mt-3 col-3">
                                <label for="denda">Denda</label>
                                <input type="text" class="mt-1 form-control @error('denda')is-invalid @enderror"
                                    id="denda" name="denda" value="0" readonly>

                                <!-- error message untuk denda -->
                                @error('denda')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>



                            <div class="mt-5 mb-3">
                                <a href="{{ route('transaksi.index') }}" class="btn btn-md btn-outline float-end ms-2"
                                    style="border-color: #757BC8;">Kembali</a>
                                <button type="submit" class="btn btn-md float-end text-light"
                                    style="background-color: #757BC8;">Simpan</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection