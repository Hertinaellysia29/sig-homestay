@extends('layouts.main')

@section('container')

<div class="row justify-content-center mt-5">
    <div class="col-lg-5">
        <main class="form-login">
            <h1 class="h3 mb-3 fw-normal text-center mb-5">Please Login</h1>
            <form>
            <div class="form-floating">
                <input type="text" class="form-control rounded-top" id="floatingInput" placeholder="Username">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control rounded-bottom" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Login</button>
            </form>

            <small class="d-block text-center mt-3">Not registered? <a href="/register">Register Now!</a></small>
        </main>
    </div>
</div>

@endsection