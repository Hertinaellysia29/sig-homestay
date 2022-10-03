@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Wisata</h1>
    </div>

    <a href="/dashboard/wisata/create" class="btn btn-primary mb-3">Add Wisata</a>

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
                <th>Desa</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

          @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama}}</td>
                <td>{{ $data->desa->nama }}</td>
                <td>{{ $data->lokasi }}</td>
                <td>
                    <a href="/dashboard/wisata/{{ $data->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
                    <a href="/dashboard/wisata/{{ $data->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/wisata/{{$data->id}}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
          @endforeach
            
        </tbody>
      </table>
    </div>
  
  
    <script>
      $(document).ready(function () {
        $('#example').DataTable();
      });
    </script>
@endsection