@extends('layouts.mainlayout')
@section('body')
@if(Auth::guard('user')->user()->role=="Admin")
@include('navigasi.nav-admin')
@elseif(Auth::guard('user')->user()->role=="Pustakawan")
@include('navigasi.nav-pustakawan')
@endif
<div class="container mt-lg-5">
    <div class="my-5 py-5 px-3">
        <div class="mt-4 p-3">
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
                    <div class="card-header p-3 fs-5 text-light" style="background-color: #757BC8;">Tambah Data
                        Buku
                    </div>
                    <div class="card-body">
                        <form action="{{ route('buku.store') }}" method="POST" class="row mx-3">
                            @csrf
                            <!--Input isbn-->
                            <div class="form-group mt-3 col-3">
                                <label for="isbn">ISBN</label>
                                <input type="text" class="mt-1 form-control @error('isbn')is-invalid @enderror"
                                    id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="contoh: 9786020312552">

                                <!-- error message untuk isbn -->
                                @error('isbn')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <!--Input judul_buku-->
                            <div class="form-group mt-3 col-6">
                                <label for="judul_buku">Judul Buku</label>
                                <input type="text" class="mt-1 form-control @error('judul_buku') is-invalid @enderror"
                                    name="judul_buku" value="{{ old('judul_buku') }}" required>
                                <!-- error message untuk judul_buku -->
                                @error('judul_buku')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input nama_penulis-->
                            <div class="form-group  mt-3 col-3">
                                <label for="nama_penulis">Nama Penulis</label>
                                <input type="text" class="mt-1 form-control @error('nama_penulis') is-invalid @enderror"
                                    name="nama_penulis" value="{{ old('nama_penulis') }}" required>
                                <!-- error message untuk nama_penulis -->
                                @error('nama_penulis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input penerbit-->
                            <div class="form-group mt-3 col-3">
                                <label for="kode_penerbit">Penerbit</label>
                                <select class="mt-1 form-select @error('kode_penerbit') is-invalid @enderror"
                                    name="kode_penerbit" id="kode_penerbit" required>
                                    @foreach ($penerbits as $penerbit)
                                    @if(old('kode_penerbit')==$penerbit->kode_penerbit)
                                    <option value="{{$penerbit->kode_penerbit}}" selected>
                                        {{$penerbit->nama_penerbit}}
                                    </option>
                                    @else
                                    <option value="{{$penerbit->kode_penerbit}}">
                                        {{$penerbit->nama_penerbit}}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                                <!-- error message untuk penerbit -->
                                @error('kode_penerbit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input tahun_terbit-->
                            <div class="form-group mt-3 col-3">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input type="year" class="mt-1 form-control @error('tahun_terbit') is-invalid @enderror"
                                    name="tahun_terbit" value="{{ old('tahun_terbit') }}" required>

                                <!-- error message untuk tahun_terbit -->
                                @error('tahun_terbit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input jumlah-->
                            <div class="form-group  mt-3 col-3">
                                <label for="jumlah">Jumlah</label>
                                <input type="number" class="mt-1 form-control @error('jumlah') is-invalid @enderror"
                                    name="jumlah" value="{{ old('jumlah') }}" required>
                                <!-- error message untuk jumlah -->
                                @error('jumlah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input kategori-->
                            <div class="form-group mt-3 col-3">
                                <label for="kode_kategori">Kategori</label>
                                <select class="mt-1 form-select @error('kode_kategori') is-invalid @enderror"
                                    name="kode_kategori" id="kode_kategori" required>
                                    @foreach ($kategoris as $kategori)
                                    @if(old('kode_kategori')==$kategori->kode_kategori)
                                    <option value="{{$kategori->kode_kategori}}" selected>{{$kategori->kategori}}
                                    </option>
                                    @else
                                    <option value="{{$kategori->kode_kategori}}">{{$kategori->kategori}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <!-- error message untuk kategori -->
                                @error('kode_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input deskripsi-->
                            <div class="form-group mt-3 col-12">
                                <label for="deskripsi">Deskripsi</label>
                                <input type="text" class="mt-1 form-control @error('deskripsi') is-invalid @enderror"
                                    name="deskripsi" value="{{ old('deskripsi') }}" required></input>
                                <!-- error message untuk deskripsi -->
                                @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mt-5 mb-3">
                                <a href="{{ route('buku.index') }}" class="btn btn-md btn-outline float-end ms-2"
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