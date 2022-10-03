@extends('layouts.main')

@section('container')
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light mb-3">HUBUNGI KAMI</h1>
        <p class="text-dark" style="font-size:1.50rem;font-weight:300;">Ingin mendaftarkan Homestay anda?</p>
        <p class="text-dark" style="font-size:1.30rem;font-weight:300;">Silahkan lakukan Registrasi Pemilik Homestay pada link di bawah ini!</p>
        <p>
          <a href="/register">Registrasi Akun Pemilik Homestay</a>
        </p>
        <div class="mt-5">
          <h2 class="fw-light mb-3">Kontak Kami</h2>
          <div class="fs-5 mb-2"><i class="bi bi-telephone-fill" style="color: #0d6efd"></i> &nbsp;&nbsp; 081323234239</div>
          <div class="fs-5"><i class="bi bi-envelope-fill" style="color: #0d6efd"></i> &nbsp;&nbsp; hertina@gmail.com</div>
        </div>
      </div>
    </div>
  </section>
@endsection