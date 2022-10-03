@extends('layouts.main')

@section('container')
<div class="container">
  <div class="mt-5 mb-5">
    <h1>Homestay</h1>
  </div>

  <div class="table-responsive col-lg">
    <table id="example" class="table table-striped table-sm">
      <thead>
          <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Pemilik</th>
              <th>No HP</th>
              <th>Desa</th>
              <th>Action</th>
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
              <td>
                  <a href="/homestay/{{ $data->id }}"> Lihat selengkapnya </a>
              </td>
          </tr>
        @endforeach
          
      </tbody>
    </table>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#example').DataTable();
  });
</script>
@endsection