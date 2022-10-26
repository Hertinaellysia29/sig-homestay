@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Homestay </h1>
    </div>

    @if (auth()->user()->pemilik_homestay)
        @if (auth()->user()->pemilik_homestay->status == 'waiting_for_approval')
          <div class="alert alert-warning col-lg" role="alert">
            Registrasi akun anda masih menunggu konfirmasi dari admin
          </div>
          <a href="/dashboard/homestay/create" class="btn btn-primary mb-4 disabled">Tambah</a>
        @elseif (auth()->user()->pemilik_homestay->status == 'rejected')
          <div class="alert alert-danger col-lg" role="alert">
            Registrasi akun anda ditolak oleh admin, alasan penolakan bisa di lihat pada menu akun
          </div>
          <a href="/dashboard/homestay/create" class="btn btn-primary mb-4 disabled">Tambah</a>
        @elseif (auth()->user()->pemilik_homestay->status == 'approved')
          <a href="/dashboard/homestay/create" class="btn btn-primary mb-4">Tambah</a>
        @endif
    @else
      <a href="/dashboard/homestay/create" class="btn btn-primary mb-4 mt-3">Tambah</a>
    @endif

    @if(session()->has('success'))
      <div class="alert alert-success col-lg" role="alert">
       {{ session('success') }}
      </div>
    @endif
  
    <div class="table-responsive col-lg">
      <table id="example" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Pemilik</th>
                <th>No HP</th>
                <th>Desa</th>
                <th>Dibuat Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

          @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama}}</td>
                <td>{{ $data->nama_pemilik }}</td>
                <td>{{ $data->no_hp }}</td>
                <td>{{ $data->desa->nama }}</td>
                <td>{{ $data->user->name }} | {{ ($data->user->role === 'admin') ? 'Admin' : 'Pemilik Homestay' }}</td>
                <td>
                    <a href="/dashboard/homestay/{{ $data->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/dashboard/homestay/{{ $data->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <a href="" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-whatever="{{$data->id}}:{{$data->nama}}"><span data-feather="x-circle"></span></a>
                    {{-- <form action="/dashboard/homestay/{{$data->id}}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                    </form> --}}
                </td>
            </tr>
          @endforeach
            
        </tbody>
      </table>
    </div>

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

  <script>
    $(document).ready(function () {
      $('#example').DataTable();
    });

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