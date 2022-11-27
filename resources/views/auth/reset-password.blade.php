{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Reset Password') }}
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
                <h1 class="h3 mb-3 fw-normal text-center">Reset Password</h1>
                <small class="d-block text-center mb-3">Masukkan password baru untuk akun anda</small>
                <form action="/reset-password" method="post">
                    @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="hidden" name="email" value="{{ $request->email}}">
                <div class="form-floating">
                    <input type="email" name="email" class="form-control rounded-top" id="email" placeholder="Email" value="{{ old('email', $request->email) }}" disabled>
                    <label for="email">Email</label>
                    {{-- @error('errors') --}}
                        <div class="text-danger fs-6 p1">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-1" :errors="$errors" />
                        </div>
                    {{-- @enderror --}}
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required autofocus>
                    <label for="password">Password</label>
                    {{-- @error('errors') --}}
                        <div class="text-danger fs-6 p1">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-1" :errors="$errors" />
                        </div>
                    {{-- @enderror --}}
                </div>
                <div class="form-floating">
                    <input type="password" name="password_confirmation" class="form-control rounded-bottom" id="password_confirmation" placeholder="Konfirmasi Password" required>
                    <label for="password_confirmation">Konfirmasi Password</label>
                    {{-- @error('errors') --}}
                        <div class="text-danger fs-6 p1">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-1" :errors="$errors" />
                        </div>
                    {{-- @enderror --}}
                </div>
                <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Reset Password</button>
                </form>
            </main>
        </div>
    </div>
</div>

@endsection
