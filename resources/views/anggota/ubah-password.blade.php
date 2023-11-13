@extends('layouts.mainlayout')
@section('body')
@include('navigasi.nav-anggota')
<div class="container mt-lg-5">
    <div class="my-5 py-5 px-3">
        <div class="container mt-4 p-3">
            <div class="row justify-content-center">
                    <div class="col-md-6">
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
                        <div class="card-header p-3 fs-5 text-light" style="background-color: #757BC8;">Ubah Password
                        </div>
                        <div class="card-body">
                            <form action="{{ route('anggota.updatepassword') }}" method="POST"
                                class="row mx-3">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="oldpassword">Old Password</label>
                                    <input type="password" class="mt-1 form-control @error('oldpassword') is-invalid @enderror"
                                        name="oldpassword" value="{{ old('oldpassword') }}" placeholder="Masukkan Password Lama Anda"
                                        required>
                                    <!-- error message untuk oldpassword -->
                                    @error('oldpassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="newpassword">New Password</label>
                                    <input type="password" class="mt-1 form-control @error('newpassword') is-invalid @enderror"
                                        name="newpassword" value="{{ old('newpassword') }}" placeholder="Masukkan Password Baru Anda"
                                        required>
                                    <!-- error message untuk newpassword -->
                                    @error('newpassword')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="d-grid">
                                    <input type="submit" class="mt-2 btn btn-md float-end text-light"
                                        style="background-color: #757BC8;" value="Simpan"></input>
                                    <a href="{{ route('anggota.edit-profile') }}" class="btn btn-md btn-outline float-end my-2"
                                        style="border-color: #757BC8;">Batalkan</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection