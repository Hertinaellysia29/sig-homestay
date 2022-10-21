@extends('dashboard.layouts.main')

@section('container')
    {{-- {{ dd($data->pemilik_homestay) }} --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Detail User Pemilik Homestay</h1>
    </div>
    <div class="table-responsive col-lg-8 mt-5">
      <table class="table">
        <tbody>
          <tr>
            <th>Nama Depan</th>
            <td>:</td>
            <td>{{$data->pemilik_homestay->nama_depan}}</td>
          </tr>
          <tr>
            <th>Nama Belakang</th>
            <td>:</td>
            <td>{{$data->pemilik_homestay->nama_belakang}}</td>
          </tr>
          <tr>
            <th>Username</th>
            <td>:</td>
            <td>{{$data->username}}</td>
          </tr>
          <tr>
            <th>No. Handphone</th>
            <td>:</td>
            <td>{{$data->pemilik_homestay->no_hp}}</td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td>:</td>
            <td>{{$data->pemilik_homestay->alamat}}</td>
          </tr>
          <tr>
            <th>Nama Homestay</th>
            <td>:</td>
            <td>{{$data->pemilik_homestay->nama_homestay}}</td>
          </tr>
          <tr>
            <th>Status Akun</th>
            <td>:</td>
            <td>{{$data->pemilik_homestay->status}}</td>
          </tr>
          <tr>
            <th>Pesan Registrasi Akun</th>
            <td>:</td>
            <td>{{$data->pemilik_homestay->pesan}}</td>
          </tr>
          @if ($data->pemilik_homestay->alasan_penolakan)
            <tr>
              <th>Alasan Penolakan</th>
              <td>:</td>
              <td>{{$data->pemilik_homestay->alasan_penolakan}}</td>
            </tr>
          @endif
        </tbody>
      </table>
      <a href="/dashboard/user" class="btn btn-success mt-3"><span data-feather="arrow-left"></span> Kembali </a>
    </div>
    {{-- <div class="row mb-5">
      <div class="col-lg-10">
        <div style="max-height: 350px; overflow:hidden" class="text-center mb-5">
          <img src="{{ asset('storage/'. $data->foto) }}" alt="" class="img-fluid">
        </div>
        <h2 class="mb-4">{{$data->nama}}</h2>
        <article class="my-3 mb-5">
          {!! $data["deskripsi"] !!}
          <i class="bi bi-pin-map"></i> Lokasi wisata di desa {{$data->desa->nama}}, {{$data->lokasi}}
        </article>

        <a href="/dashboard/wisata" class="btn btn-success"><span data-featder="arrow-left"></span> Back</a>
        <a href="/dashboard/wisata/{{ $data->id }}/edit" class="btn btn-warning"><span data-featder="edit"></span> Edit</a>
        <form action="/dashboard/wisata/{{$data->id}}" metdod="post" class="d-inline">
          @metdod('delete')
          @csrf
          <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-featder="x-circle"></span> Delete</button>
        </form>
      </div>
    </div> --}}

@endsection