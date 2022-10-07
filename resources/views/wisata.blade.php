
@extends('layouts.main')

@section('container')
  <div class="container" style="padding-top: 50px">
    <h1 class="mb mt-5 line-title">Wisata</h1>
    <div class="row">
      @foreach ($datas as $data)
      
        <div class="col-md-4 mb-5">
          <a href="/wisata/{{ $data->id }}">
          <div class="card bg-dark text-white border-0">
            {{-- <img src="https://source.unsplash.com/1200x750?tour" class="card-img" alt="..." class="img-fluid"> --}}
            <div style="max-height: 350px; overflow:hidden">
              <img src="{{ asset('storage/'. $data->foto) }}" class="card-img" alt="" class="img-fluid">
            </div>
            <div class="card-img-overlay d-flex align-items-end p-0">
              <h5 class="card-title text-center flex-fill p-2" style="background-color: rgba(0,0,0,0.6)">{{ $data["nama"] }}</h5>
            </div>
          </div>
          </a>
        </div>
      
      @endforeach
    </div>
  </div>

@endsection