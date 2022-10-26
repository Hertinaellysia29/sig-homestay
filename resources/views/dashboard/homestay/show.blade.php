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
        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-whatever="{{$data->id}}:{{$data->nama}}"><span data-feather="x-circle"></span> Hapus </a>
        {{-- <form action="/dashboard/homestay/{{$data->id}}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Hapus</button>
        </form> --}}

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Homestay</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <div class="confirm">Apakah anda yakin untuk menghapus homestay ini ?</div>
                <form action="" method="post" action="">
                  {{ csrf_field() }}
                  {{ method_field('delete') }}
                  <div style="text-align: center" class="mt-3">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm"> &nbsp;&nbsp;&nbsp;Ya&nbsp;&nbsp;&nbsp; </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script>
    const deleteModal = document.getElementById('deleteModal')
      deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const data = button.getAttribute('data-bs-whatever')
        const modalBodyForm = deleteModal.querySelector('.modal-body form')
        const modalBodyConfirm = deleteModal.querySelector('.confirm')

        var arr = data.split(':');
        modalBodyForm.action = "/dashboard/homestay/" + arr[0];
        modalBodyForm.method = "post";
        modalBodyConfirm.textContent = "Apakah anda yakin untuk menghapus homestay " + arr[1] + " ?";
      });
  </script>

@endsection