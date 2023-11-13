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
                    <div class="card-header p-3 fs-5 text-light" style="background-color: #757BC8;">Edit Data
                        Anggota
                    </div>
                    <div class="card-body">
                        <form action="{{ route('anggota.update',$anggota->id_anggota) }}" method="POST"
                            class="row g-3 mx-3">
                            @csrf
                            @method('PUT')

                            <!--Input nim-->
                            <div class="form-group mt-3 col-4">
                                <label for="nim">NIM</label>
                                <input type="text" class="mt-1 form-control @error('nim')is-invalid @enderror" id="nim"
                                    name="nim" value="{{ old('nim',$anggota->nim) }}" readonly>
                                <!-- error message untuk nim -->
                                @error('nim')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <!--Input nama_anggota-->
                            <div class="form-group mt-3 col-4">
                                <label for="nama_anggota">Nama Anggota</label>
                                <input type="text" class="mt-1 form-control @error('nama_anggota') is-invalid @enderror"
                                    name="nama_anggota" value="{{ old('nama_anggota',$anggota->nama_anggota) }}"
                                    required>
                                <!-- error message untuk nama_anggota -->
                                @error('nama_anggota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--Input tgl_lahir-->
                            <div class="form-group mt-3 col-4">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="mt-1 form-control @error('tgl_lahir') is-invalid @enderror"
                                    name="tgl_lahir" value="{{ old('tgl_lahir',$anggota->tgl_lahir) }}" required>
                                <!-- error message untuk tgl_lahir -->
                                @error('tgl_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--pilih jenis kelamin-->
                            <div class="form-group mt-3 col-4">
                                <label class="form-check-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="mt-1 radio-inline">
                                    @if(old('jenis_kelamin',$anggota->jenis_kelamin)=="Laki-laki" )
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenisKelamin1"
                                        value="Laki-laki" checked required> Laki-laki
                                    <input class="form-check-input ms-2" type="radio" name="jenis_kelamin"
                                        id="jenisKelamin2" value="Perempuan" required> Perempuan

                                    @elseif(old('jenis_kelamin',$anggota->jenis_kelamin)=="Perempuan" )
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenisKelamin1"
                                        value="Laki-laki" required> Laki-laki
                                    <input class="form-check-input ms-2" type="radio" name="jenis_kelamin"
                                        id="jenisKelamin2" value="Perempuan" checked required> Perempuan
                                    @endif
                                </div>
                                <!-- error message untuk jenis_kelamin -->
                                @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--Input alamat-->
                            <div class="form-group mt-3 col-4">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="mt-1 form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" value="{{ old('alamat',$anggota->alamat) }}" required>
                                <!-- error message untuk alamat -->
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--Input no_hp-->
                            <div class="form-group mt-3 col-4">
                                <label for="no_hp">No Hp</label>
                                <input type="text" class="mt-1 form-control @error('no_hp') is-invalid @enderror"
                                    name="no_hp" value="{{ old('no_hp',$anggota->no_hp) }}" required>
                                <!-- error message untuk no_hp -->
                                @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input prodi-->
                            <div class="form-group mt-3 col-4">
                                <label for="kode_prodi">Prodi</label>
                                <select class="mt-1 form-select @error('kode_prodi') is-invalid @enderror"
                                    name="kode_prodi" id="kode_prodi" required>
                                    @foreach ($prodis as $prodi)
                                    @if(old('kode_prodi',$anggota->kode_prodi)==$prodi->kode_prodi)
                                    <option value="{{$prodi->kode_prodi}}" selected>{{$prodi->nama_prodi}}
                                    </option>
                                    @else
                                    <option value="{{$prodi->kode_prodi}}">{{$prodi->nama_prodi}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <!-- error message untuk prodi -->
                                @error('kode_prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--Input email-->
                            <div class="form-group mt-3 col-4">
                                <label for="email">Email</label>
                                <input type="text" class="mt-1 form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email',$anggota->email) }}" required>
                                <!-- error message untuk email -->
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <!--Input role-->
                            <div class="form-group mt-3 col-4">
                                <label for="role">Role</label>
                                <input type="text" class="mt-1 form-control @error('role') is-invalid @enderror"
                                    name="role" value="Anggota" readonly>
                                <!-- error message untuk role -->
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mt-5 mb-3">
                                <a href="{{ route('anggota.index') }}" class="btn btn-md btn-outline float-end ms-2"
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