@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-5">
    <div class="row mb-5">
      <div class="col-lg-10">
        <div style="max-height: 350px; overflow:hidden" class="text-center mb-5">
          {{-- <img src="https://source.unsplash.com/1200x400?tour" alt="" class="img-fluid"> --}}
          <img src="{{ asset('storage/'. $data->foto) }}" alt="" class="img-fluid">
        </div>
        <h2 class="mb-4">Wisata {{$data->nama}}</h2>
        <article class="my-3 mb-5">
          {!! $data["deskripsi"] !!}
          <i class="bi bi-pin-map"></i> Lokasi wisata di desa {{$data->desa->nama}}, {{$data->lokasi}}
        </article>

        <a href="/dashboard/wisata" class="btn btn-success"><span data-feather="arrow-left"></span> Back</a>
        <a href="/dashboard/wisata/{{ $data->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
        <form action="/dashboard/wisata/{{$data->id}}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
        </form>
      </div>
    </div>
  </div>

@endsection