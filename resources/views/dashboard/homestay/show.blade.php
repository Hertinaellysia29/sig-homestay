@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-5">
    <div class="row mb-5">
      <div class="col-lg-10">
        <div style="" class="text-center mb-5">
          @php
              $images = explode("||", $data->foto)
          @endphp
          <!-- Gallery -->
          <div class="row">
            @foreach ($images as $image)
              <div class="col-md-4 mt-3 col-lg-4">
                  <img src="{{ asset('storage/'. $image) }}" class="img-fluid" alt="image">
              </div>
              @endforeach
          </div>
          <!-- Gallery -->
         
            {{-- <img src="{{ asset('storage/'. $image) }}" alt="{{$image}}" class="img-fluid"><br> --}}
          
          {{-- <img src="{{ asset('storage/'. $data->foto) }}" alt="" class="img-fluid"> --}}
        </div>
        <h2 class="mb-4">{{$data->nama}}</h2>
        <article class="my-3 mb-5">
          {!! $data["deskripsi"] !!}
          <div class="mt-2">
            <b> Fasilitas </b>
          </div>
            {!! $data["fasilitas"] !!}
          <div>
            <b>Harga</b>
          </div>
          <div class="mb-2">
            Rp.{{$data->harga}}
          </div>
          <div>
            <b>Pemilik Homestay</b>
          </div>
          <div class="mb-2">
            {{$data->nama_pemilik}}
          </div>
          <div>
            <b>Nomor HP</b>
          </div>
          <div class="mb-2">
            {{$data->no_hp}}
          </div>
          <i class="bi bi-pin-map"></i> Lokasi wisata di desa {{$data->desa->nama}}, {{$data->alamat_detail}}
          <div class="mt-2">
            Koordinat Lokasi: {{$data->koordinat_lokasi}}
          </div>
        </article>

        <a href="/dashboard/homestay" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali </a>
        <a href="/dashboard/homestay/{{ $data->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
        <form action="/dashboard/homestay/{{$data->id}}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Hapus</button>
        </form>
      </div>
    </div>
  </div>

@endsection