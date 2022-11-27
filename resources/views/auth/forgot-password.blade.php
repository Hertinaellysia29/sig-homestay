{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@extends('layouts.main')

@section('container')
<div class="container">
    <div class="row justify-content-center mt-5" style="padding-top: 50px">
        <div class="col-lg-5">

            @if (session()->has('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('status')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- @if (session()->has('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('errors')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}

            <main class="form-login">
                <h1 class="h3 mb-3 fw-normal text-center">Lupa Password</h1>
                <small class="d-block text-center mb-3">Masukkan email akun anda dan sistem akan mengirim link ubah password</small>
                <form action="/forgot-password" method="post">
                    @csrf
                <div class="form-floating">
                    <input type="email" name="email" class="form-control rounded" id="username" placeholder="Email" required autofocus>
                    <label for="email">Email</label>
                    {{-- @error('errors') --}}
                        <div class="text-danger fs-6 p1">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-1" :errors="$errors" />
                        </div>
                    {{-- @enderror --}}
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Kirim email reset password</button>
                </form>
            </main>
        </div>
    </div>
</div>

@endsection
