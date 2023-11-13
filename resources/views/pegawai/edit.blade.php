@extends('layouts.mainlayout')
@section('body')
@include('navigasi.nav-admin')
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
                    <div class="card-header p-3 fs-5 text-light" style="background-color: #757BC8;">Tambah Data
                        Pegawai
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pegawai.update',$pegawai->id_pegawai) }}" method="POST"
                            class="row mx-3">
                            @csrf
                            @method('PUT')
                            <!--Input nip-->
                            <div class="form-group mt-3 col-3">
                                <label for="nip">NIP</label>
                                <input type="text" class="mt-1 form-control @error('nip')is-invalid @enderror" id="nip"
                                    name="nip" value="{{ old('nip',$pegawai->nip) }}">

                                <!-- error message untuk nip -->
                                @error('nip')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <!--Input nama-->
                            <div class="form-group mt-3 col-6">
                                <label for="nama">Nama</label>
                                <input type="text" class="mt-1 form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama',$pegawai->nama) }}" required>
                                <!-- error message untuk nama -->
                                @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input tanggal lahir-->
                            <div class="form-group  mt-3 col-3">
                                <label for="tgl_lahir">Tanggal Lahir</label>
                                <input type="date" class="mt-1 form-control @error('tgl_lahir') is-invalid @enderror"
                                    name="tgl_lahir" value="{{ old('tgl_lahir',$pegawai->tgl_lahir) }}" required>
                                <!-- error message untuk tanggal lahir -->
                                @error('tgl_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--pilih jenis kelamin-->
                            <div class="form-group mt-3 col-3">
                                <label class="form-check-label" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="mt-1 radio-inline">
                                    @if(old('jenis_kelamin',$pegawai->jenis_kelamin)=="Laki-laki" )
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenisKelamin1"
                                        value="Laki-laki" checked required> Laki-laki
                                    <input class="form-check-input ms-2" type="radio" name="jenis_kelamin"
                                        id="jenisKelamin2" value="Perempuan" required> Perempuan

                                    @elseif(old('jenis_kelamin',$pegawai->jenis_kelamin)=="Perempuan" )
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

                            <!--input alamat-->
                            <div class="form-group mt-3 col-6">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="mt-1 form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" value="{{ old('alamat',$pegawai->alamat) }}" required>
                                <!-- error message untuk alamat -->
                                @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input no_hp-->
                            <div class="form-group mt-3 col-3">
                                <label for="no_hp">No HP</label>
                                <input type="text" class="mt-1 form-control @error('no_hp') is-invalid @enderror"
                                    name="no_hp" value="{{ old('no_hp',$pegawai->no_hp) }}" required>

                                <!-- error message untuk no_hp -->
                                @error('no_hp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!--input email-->
                            <div class="form-group  mt-3 col-3">
                                <label for="email">Email</label>
                                <input type="text" class="mt-1 form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email',$pegawai->email) }}" required>
                                <!-- error message untuk email -->
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <!--pilih role-->
                            <div class="form-group mt-3 col-3">
                                <label for="role">Role</label>
                                <select class="mt-1 form-select @error('role') is-invalid @enderror" name="role"
                                    required>
                                    @if(old('role',$pegawai->role)=="Admin" )
                                    <option value="Admin" selected>Admin</option>
                                    <option value="Pustakawan">Pustakawan</option>
                                    @elseif(old('role',$pegawai->role)=="Pustakawan" )
                                    <option value="Admin">Admin</option>
                                    <option value="Pustakawan" selected>Pustakawan</option>
                                    @endif
                                </select>
                                <!-- error message untuk role -->
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mt-5 mb-3">
                                <a href="{{ route('pegawai.index') }}" class="btn btn-md btn-outline float-end ms-2"
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