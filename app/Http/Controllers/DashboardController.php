<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Homestay;
use App\Models\User;
use App\Models\Desa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index', [
            "totalHomestay" => Homestay::count(),
            "totalWisata" => Wisata::count(),
            "totalUser" => User::count(),
            "totalDesa" => Desa::count(),
        ]);
    }
}
