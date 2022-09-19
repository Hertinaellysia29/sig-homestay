
@extends('layouts.main')

@section('container')
  
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h1 class="mb-4">Wisata {{$data->nama}}</h1>
        <img src="https://source.unsplash.com/1200x400?tour" alt="">
        <article class="my-3 fs-5 mb-5">
          {!! $data["deskripsi"] !!}
          <i class="bi bi-pin-map"></i> Lokasi wisata di desa {{$data->desa->nama}}, {{$data->lokasi}}
        </article>
      </div>
    </div>
  </div>
  
@endsection
