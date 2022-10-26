@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Tambah Nama Desa</h1>
    </div>
    <div class="col-lg-4">
        <form method="post" action="/dashboard/desa">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Desa</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" autofocus value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <input type="button" class="btn btn-success mb-5" value="Kembali" onclick="history.go(-1)">
            <button type="submit" class="btn btn-primary mb-5"> Tambah </button>
        </form>
    </div>
@endsection