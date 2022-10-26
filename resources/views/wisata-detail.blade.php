
@extends('layouts.main')

@section('container')
  
  <div class="container mt-5" style="padding-top: 50px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div style="max-height: 550px; overflow:hidden" class="text-center mb-5">
          <img src="{{ asset('storage/'. $data->foto) }}" alt="" class="img-fluid">
        </div>
        <h2 class="mb-4">{{$data->nama}}</h2>
        <article class="my-3 mb-3">
          {!! $data["deskripsi"] !!}
          <br>
          <i class="bi bi-pin-map"></i> Lokasi wisata di desa {{$data->desa->nama}}, {{$data->lokasi}}
        </article>
        <form class="mb-4">
          <input type="button" class="btn btn-success btn-sm" value=" Kembali " onclick="history.go(-1)">
         </form>
      </div>
    </div>
  </div>
  
@endsection
