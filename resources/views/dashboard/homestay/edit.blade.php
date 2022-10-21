@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Edit Homestay</h1>
    </div>
    <div class="col-lg-8">
        <form method="post" action="/dashboard/homestay/{{$data->id}}" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Homestay</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" autofocus value="{{ old('nama', $data->nama) }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                        <input type="text" class="form-control @error('nama_pemilik') is-invalid @enderror" id="nama_pemilik" name="nama_pemilik" value="{{ old('nama_pemilik', $data->nama_pemilik) }}">
                        @error('nama_pemilik')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $data->harga) }}">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="fasilitas" class="form-label">Fasilitas</label>
                <input id="fasilitas" type="hidden" name="fasilitas" value="{{ old('fasilitas', $data->fasilitas) }}">
                <trix-editor input="fasilitas"></trix-editor>
                @error('fasilitas')
                    <p class="text-danger">
                        {{$message}}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input id="deskripsi" type="hidden" name="deskripsi" value="{{ old('deskripsi', $data->deskripsi) }}">
                <trix-editor input="deskripsi"></trix-editor>
                @error('deskripsi')
                    <p class="text-danger">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto Homestay</label>
                <input type="hidden" name="oldFoto" value="{{ $data->foto }}">
                @if ($data->foto)
                <img src="{{ asset('storage/'. $data->foto) }}" class="foto-preview img-fluid mb-3 col-sm-5 d-block" alt="">
                @else
                <img class="foto-preview img-fluid mb-3 col-sm-5">
                @endif
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
                        @if(old('desa_id', $data->desa_id) == $d->id)
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
                <label for="alamat_detail" class="form-label">Alamat Detail</label>
                <textarea class="form-control @error('alamat_detail') is-invalid @enderror" name="alamat_detail" id="alamat_detail" rows="3">{{{ old('alamat_detail', $data->alamat_detail) }}}</textarea>
                @error('alamat_detail')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="koordinat_lokasi" class="form-label">Koordinat Lokasi</label>
                <input type="text" class="form-control @error('koordinat_lokasi') is-invalid @enderror" id="koordinat_lokasi" name="koordinat_lokasi" value="{{ old('koordinat_lokasi', $data->koordinat_lokasi) }}">
                @error('koordinat_lokasi')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-5"> &nbsp;&nbsp; Edit &nbsp;&nbsp; </button>
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