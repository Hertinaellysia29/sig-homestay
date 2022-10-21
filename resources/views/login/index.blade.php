@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center mt-5" style="padding-top: 50px">
        <div class="col-lg-5">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('loginError')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-login">
                <h1 class="h3 mb-3 fw-normal text-center mb-5">Masuk</h1>
                <form action="/login" method="post">
                    @csrf
                <div class="form-floating">
                    <input type="text" name="username" class="form-control rounded-top" id="username" placeholder="Username" autofocus required>
                    <label for="username">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control rounded-bottom" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Masuk</button>
                </form>

                <small class="d-block text-center mt-3">Belum punya akun? <a href="/register">Daftar sekarang!</a></small>
            </main>
        </div>
    </div>
</div>

@endsection