@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Edit Desa</h1>
    </div>
    <div class="col-lg-4">
        <form method="post" action="/dashboard/desa/{{$data->id}}">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Desa</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" autofocus value="{{ old('nama', $data->nama) }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-5">Edit Desa</button>
        </form>
    </div>

    <script>
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })
    </script>
@endsection