@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Welcome back, {{ auth()->user()->name }}</h1>
    </div>

    <div class="row mt-4">
        <div class="col-sm-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
            <h5 class="card-title">30</h5>
            <p class="card-text">Data Homestay</p>
            <a href="#" class="btn btn-light">Lihat detail..</a>
            </div>
        </div>
        </div>
        <div class="col-sm-3">
        <div class="card">
            <div class="card-body text-dark bg-warning">
            <h5 class="card-title">20</h5>
            <p class="card-text">Data User</p>
            <a href="#" class="btn btn-light">Lihat detail..</a>
            </div>
        </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                <h5 class="card-title">25</h5>
                <p class="card-text">Data Wisata</p>
                <a href="#" class="btn btn-light">Lihat detail..</a>
                </div>
            </div>
            </div>
            <div class="col-sm-3">
            <div class="card text-dark bg-info">
                <div class="card-body">
                <h5 class="card-title">5</h5>
                <p class="card-text">Data Desa</p>
                <a href="#" class="btn btn-light">Lihat detail..</a>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-5 border-bottom">
        <h3 class="h3"> Peta Homestay </h3>
    </div>
@endsection