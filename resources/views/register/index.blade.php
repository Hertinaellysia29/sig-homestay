@extends('layouts.main')

@section('container')

<div class="row justify-content-center mt-5">
    <div class="col-lg-5">
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center mb-5">Registrasi Pemilik Homestay</h1>
            <form>
            <div class="form-floating">
                <input type="text" name="first-name" class="form-control rounded-top" id="first-name" placeholder="Name Depan">
                <label for="name">Nama Depan</label>
            </div>
            <div class="form-floating">
                <input type="text" name="last-name" class="form-control" id="last-name" placeholder="Nama Belakang">
                <label for="last-name">Nama Belakang</label>
            </div>
            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="form-floating">
                <input type="text" name="no-hp" class="form-control" id="no-hp" placeholder="Nomor HP">
                <label for="no-hp">Nomor HP</label>
            </div>
            <div class="form-floating">
                {{-- <input type="text-area" class="form-control" id="alamat" placeholder="Alamat"> --}}
                <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Alamat"></textarea>
                <label for="alamat">Alamat</label>
            </div>
            <div class="form-floating">
                <input type="text-area" name="nama=homestay" class="form-control" id="nama-homestay" placeholder="Nama Homestay">
                <label for="nama-homestay">Nama Homestay</label>
            </div>
            <div class="form-floating">
                <input type="text-area" name="pesan" class="form-control rounded-bottom" id="pesan" placeholder="Pesan registrasi akun">
                <label for="pesan">Pesan registrasi akun</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Register</button>
            </form>

            <small class="d-block text-center mt-3">Already registeered? <a href="/login">Login</a></small>
        </main>
    </div>
</div>

@endsection