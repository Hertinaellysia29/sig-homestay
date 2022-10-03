@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-5">
    <div class="row mb-5">
      <div class="col-lg-10">
        <div style="max-height: 350px; overflow:hidden" class="text-center mb-5">
          {{-- <img src="https://source.unsplash.com/1200x400?tour" alt="" class="img-fluid"> --}}
          <img src="{{ asset('storage/'. $data->foto) }}" alt="" class="img-fluid">
        </div>
        <h2 class="mb-4">Homestay {{$data->nama}}</h2>
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

        <a href="/dashboard/homestay" class="btn btn-success"><span data-feather="arrow-left"></span> Back</a>
        <a href="/dashboard/homestay/{{ $data->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
        <form action="/dashboard/homestay/{{$data->id}}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
        </form>
      </div>
    </div>
  </div>

@endsection