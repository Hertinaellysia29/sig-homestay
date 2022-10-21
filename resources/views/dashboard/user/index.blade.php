@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> User</h1>
    </div>
    {{-- {{ dd($data) }} --}}

    @if(session()->has('success'))
      <div class="alert alert-success col-lg" role="alert">
       {{ session('success') }}
      </div>
    @endif

    <div class="table-responsive col-lg mb-3 mt-5">
      <table id="example" class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

          @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name}}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->role }}</td>
                @if ($data->pemilik_homestay) 
                  {{-- <td>{{ ($data->pemilik_homestay->status == "waiting_for_approval") ? "Waiting For Approval":"Approved"  }}</td> --}}
                  <td>{{$data->pemilik_homestay->status}}</td>
                @else 
                  <td> - </td>
                @endif
                <td>
                @if ($data->pemilik_homestay) 
                  <a href="/dashboard/user/{{ $data->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                  @if ($data->pemilik_homestay->status == "waiting_for_approval")
                  <a href="" class="badge bg-success" data-bs-toggle="modal" data-bs-target="#approveModal" data-bs-whatever="{{$data->pemilik_homestay->id}}"><span data-feather="check-circle"></span></a>
                  <a href="" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#rejectModal" data-bs-whatever="{{$data->pemilik_homestay->id}}"><span data-feather="x-circle"></span></a>
                  @endif
                @else
                   - 
                @endif
                </td>
            </tr>
          @endforeach
            
        </tbody>
      </table>
    </div>

    <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Registrasi Akun</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            Apakah anda yakin menerima permintaan registrasi akun ini ?
            <form action="" method="post" action="" novalidate>
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div style="text-align: center" class="mt-3">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Terima</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Registrasi Akun</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="post" action="">
              <input type="hidden" name="_method" value="PUT">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="mb-3">
                <label for="alasan_penolakan" class="col-form-label">Alasan Penolakan: </label>
                <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" required></textarea>
              </div>
              <div style="text-align: center" class="mt-3">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
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

      const approveModal = document.getElementById('approveModal')
      approveModal.addEventListener('show.bs.modal', event => {
        // Button that triggered the modal
        const button = event.relatedTarget
        // Extract info from data-bs-* attributes
        const recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        // const modalTitle = exampleModal.querySelector('.modal-title')
        // const modalBodyInput = exampleModal.querySelector('.modal-body input')
        const modalBodyForm = approveModal.querySelector('.modal-body form')

        // modalTitle.textContent = `New message to ${recipient}`
        // modalBodyInput.value = recipient
        modalBodyForm.action = "/dashboard/user/approve/" + recipient
        modalBodyForm.method = "post"
        
      });

      const rejectModal = document.getElementById('rejectModal')
      rejectModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const recipient = button.getAttribute('data-bs-whatever')
        const modalBodyForm = rejectModal.querySelector('.modal-body form')

        modalBodyForm.action = "/dashboard/user/reject/" + recipient
        
      });

    </script>
@endsection