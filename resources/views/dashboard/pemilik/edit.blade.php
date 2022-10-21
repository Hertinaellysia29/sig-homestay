@extends('dashboard.layouts.main')

@section('container')
    {{-- {{dd($data)}} --}}
    <div class="col-lg-8">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> Info Pribadi </h1>
        </div>
        
        @if (auth()->user()->pemilik_homestay->status == 'waiting_for_approval')
          <div class="alert alert-warning col-lg" role="alert">
            Registrasi akun anda masih menunggu konfirmasi dari admin
          </div>
        @elseif (auth()->user()->pemilik_homestay->status == 'rejected')
          <div class="alert alert-danger col-lg" role="alert">
            Registrasi akun anda ditolak oleh admin
          </div>
        @endif

        @if(session()->has('success'))
        <div class="alert alert-success col-lg" role="alert">
        {{ session('success') }}
        </div>
        @endif
        <form method="post" action="/dashboard/pemilik-homestay" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div style="text-align: right">
                <a href="/dashboard/pemilik-homestay" class="btn btn-light" style="margin-right: 10px"> &nbsp;&nbsp; Batal &nbsp;&nbsp; </a>
                <button type="submit" class="btn btn-primary"> &nbsp;&nbsp; Edit &nbsp;&nbsp; </button>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nama_depan" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control @error('nama_depan') is-invalid @enderror" id="nama_depan" name="nama_depan" value="{{ old('nama_depan', $data->nama_depan) }}">
                        @error('nama_depan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nama_belakang" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control @error('nama_belakang') is-invalid @enderror" id="nama_belakang" name="nama_belakang" value="{{ old('nama_belakang', $data->nama_belakang) }}">
                        @error('nama_belakang')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">No Handphone</label>
                        <input type="number" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}">
                        @error('no_hp')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="nama_homestay" class="form-label">Nama Homestay</label>
                        <input type="text" class="form-control @error('nama_homestay') is-invalid @enderror" id="nama_homestay" name="nama_homestay" value="{{ old('nama_homestay', $data->nama_homestay) }}">
                        @error('nama_homestay')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Detail</label>
                <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" rows="2" >{{{ old('alamat', $data->alamat) }}}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pesan" class="form-label">Pesan Registrasi Akun</label>
                <textarea class="form-control @error('pesan') is-invalid @enderror" name="pesan" id="pesan" rows="2" disabled>{{{ old('pesan', $data->pesan) }}}</textarea>
                @error('pesan')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>


            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h3"> Info Akun </h1>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $data->user->username) }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <p>Status Akun: <b><i>
                        @if ($data->status == "waiting_for_approval")
                            Menunggu konfirmasi dari admin
                        @elseif ($data->status == "reject")
                            Registrasi akun ditolak
                        @else 
                            Registrasi akun diterima
                        @endif
                    </i></b></p>
                    @if ($data->alasan_penolakan)
                        <div class="mb-3">
                            <label for="alasan_penolakan" class="form-label">Alasan Penolakan</label>
                            <textarea class="form-control @error('alasan_penolakan') is-invalid @enderror" name="alasan_penolakan" id="alasan_penolakan" rows="2" disabled style="background-color: #f8d7da">{{{ old('alasan_penolakan', $data->alasan_penolakan) }}}</textarea>
                            @error('alasan_penolakan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>  
                    @endif
                </div>
                <div class="col-lg-6">
                    <p><b>Ubah Password</b></p>
                    <div class="mb-3">
                        <label for="password_lama" class="form-label">Password Lama</label>
                        <input type="password" class="form-control @error('password_lama') is-invalid @enderror" id="password_lama" name="password_lama">
                        @if(session()->has('old-password-invalid'))
                        <div class="alert alert-danger col-lg" role="alert">
                        {{ session('old-password-invalid') }}
                        </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="password_baru" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password_baru') is-invalid @enderror" id="password_baru" name="password_baru">
                        @error('password_baru')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-5">
                        <label for="konfirmasi_password_baru" class="form-label">Konfirmasi Password baru</label>
                        <input type="password" class="form-control @error('konfirmasi_password_baru') is-invalid @enderror" id="konfirmasi_password_baru" name="konfirmasi_password_baru">
                        @if(session()->has('password-confirmation-invalid'))
                        <div class="alert alert-danger col-lg" role="alert">
                        {{ session('password-confirmation-invalid') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection