@extends('dashboard.layouts.main')

@section('container')
<div class="container mt-5">
    <div class="row mb-5">
      <div class="col-lg-10">
        <div style="max-height: 350px; overflow:hidden" class="text-center mb-5">
          {{-- <img src="https://source.unsplash.com/1200x400?tour" alt="" class="img-fluid"> --}}
          <img src="{{ asset('storage/'. $data->foto) }}" alt="" class="img-fluid">
        </div>
        <h2 class="mb-4">{{$data->nama}}</h2>
        <article class="my-3 mb-5">
          {!! $data["deskripsi"] !!}
          <i class="bi bi-pin-map"></i> Lokasi wisata di desa {{$data->desa->nama}}, {{$data->lokasi}}
        </article>

        <a href="/dashboard/wisata" class="btn btn-success"><span data-feather="arrow-left"></span> Kembali</a>
        <a href="/dashboard/wisata/{{ $data->id }}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
        <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-whatever="{{$data->id}}:{{$data->nama}}"><span data-feather="x-circle"></span> Hapus </a>
        {{-- <form action="/dashboard/wisata/{{$data->id}}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span> Delete</button>
        </form> --}}

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Wisata</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <div class="confirm">Apakah anda yakin untuk menghapus wisata ini ?</div>
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
        modalBodyForm.action = "/dashboard/wisata/" + arr[0];
        modalBodyForm.method = "post";
        modalBodyConfirm.textContent = "Apakah anda yakin untuk menghapus wisata " + arr[1] + " ?";
      });
  </script>

@endsection