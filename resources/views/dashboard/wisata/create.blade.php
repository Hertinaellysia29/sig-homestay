@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Add Wisata</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/wisata" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Wisata</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" autofocus value="{{ old('nama') }}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi') }}">
                <trix-editor input="deskripsi"></trix-editor>
                @error('deskripsi')
                    <p class="text-danger">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto Wisata</label>
                <img class="foto-preview img-fluid mb-3 col-sm-5">
                <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto" onchange="previewFoto()">
                @error('foto')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
              </div>
              
            <div class="mb-3">
                <label for="desa_id" class="form-label">Desa</label>
                <select class="form-select @error('desa_id') is-invalid @enderror" name="desa_id">
                    @foreach ($desa as $d)
                        @if(old('desa_id') == $d->id)
                            <option value="{{ $d->id }}" selected>{{ $d->nama }}</option>
                        @else
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endif
                    @endforeach
                </select>
                @error('desa_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Alamat Detail</label>
                <textarea class="form-control @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" rows="3">{{{ old('lokasi') }}}</textarea>
                @error('lokasi')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="koordinat_lokasi" class="form-label">Koordinat Lokasi</label>
                <input type="text" class="form-control @error('koordinat_lokasi') is-invalid @enderror" id="koordinat_lokasi" name="koordinat_lokasi" value="{{ old('koordinat_lokasi') }}">
                @error('koordinat_lokasi')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-5">Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener('trix-file-accept', function(e){
            e.preventDefault();
        })

        function previewFoto(){
            const foto = document.querySelector('#foto');
            const fotoPreview = document.querySelector('.foto-preview');

            fotoPreview.style.display = 'block'

            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);

            oFReader.onload = function(oFREvent) {
                fotoPreview.src = oFREvent.target.result;
            }
        }
        
    </script>
@endsection