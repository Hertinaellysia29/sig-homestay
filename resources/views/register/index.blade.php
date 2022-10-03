@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center mt-5 container">
        <div class="col-lg-5">
            <main class="form-registration">
                <h1 class="h3 mb-3 fw-normal text-center mb-5">Registrasi Pemilik Homestay</h1>
                <form action="/register" method="post">
                @csrf
                <div class="form-floating">
                    <input type="text" name="first_name" class="form-control rounded-top @error('first_name') is-invalid @enderror" id="first_name" placeholder="Name Depan" required value="{{ old('first_name') }}">
                    <label for="first_name">Nama Depan</label>
                    @error('first_name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Nama Belakang" required value="{{ old('last_name') }}">
                    <label for="last_name">Nama Belakang</label>
                    @error('last_name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" required value="{{ old('username') }}">
                    <label for="username">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                    @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" placeholder="Nomor HP" required value="{{ old('no_hp') }}">
                    <label for="no_hp">Nomor HP</label>
                    @error('no_hp')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    {{-- <input type="text-area" class="form-control" id="alamat" placeholder="Alamat"> --}}
                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="3" placeholder="Alamat" required value="{{ old('alamat') }}"></textarea>
                    <label for="alamat">Alamat</label>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="nama_homestay" class="form-control @error('nama_homestay') is-invalid @enderror" id="nama_homestay" placeholder="Nama Homestay" required value="{{ old('nama_homestay') }}">
                    <label for="nama_homestay">Nama Homestay</label>
                    @error('nama_homestay')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-floating">
                    <input type="text" name="pesan" class="form-control rounded-bottom @error('pesan') is-invalid @enderror" id="pesan" placeholder="Pesan registrasi akun" required value="{{ old('pesan') }}">
                    <label for="pesan">Pesan registrasi akun</label>
                    @error('pesan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Register</button>
                </form>

                <small class="d-block text-center mt-3">Already registeered? <a href="/login">Login</a></small>
            </main>
        </div>
    </div>
</div>

@endsection