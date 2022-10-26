@extends('layouts.main')

@section('container')
<div class="container mt-5" style="padding-top: 50px">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <h2 class="mb-4">{{$data->nama}}</h2>
        <article class="my-3 mb-3">
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
          <div style="" class="text-center mb-5">
            {{-- <img src="https://source.unsplash.com/1200x400?tour" alt="" class="img-fluid"> --}}
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
        <form class="mb-3">
          <input type="button" class="btn btn-success btn-sm" value=" Kembali " onclick="history.go(-1)">
         </form>
      </div>
    </div>
  </div>

@endsection