@extends('layouts.main')

@section('container')
<div class="container mt-5" style="padding-top: 50px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h2 class="mb-4">{{$data->nama}}</h2>
        <article class="my-3 mb-5">
          {!! $data["deskripsi"] !!}
          <div class="mt-2">
            <b> Fasilitas </b>
          </div>
            {!! $data["fasilitas"] !!}
          @if ($data->harga)
          <div>
            <b>Harga</b>
          </div>
          <div class="mb-2">
            Rp.{{$data->harga}}
          </div>
          @endif
          <div>
            <b>Foto Homestay</b>
          </div>
          <div style="max-height: 350px; overflow:hidden" class="text-center mb-5">
            {{-- <img src="https://source.unsplash.com/1200x400?tour" alt="" class="img-fluid"> --}}
            <img src="{{ asset('storage/'. $data->foto) }}" alt="" class="img-fluid">
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

      </div>
    </div>
  </div>

@endsection