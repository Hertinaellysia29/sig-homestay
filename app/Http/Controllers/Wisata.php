<?php

namespace App\Http\Controllers;

use App\Models\Wisata as ModelsWisata;
use Illuminate\Http\Request;

class Wisata extends Controller
{
    public function index(){
        return view('wisata', [
            "title" => "Wisata",
            "datas" => ModelsWisata::with(['user', 'desa'])->latest()->get(),
            "active" => "wisata"
        ]);
    }

    public function detailWisata($id){
        $wisata = ModelsWisata::with(['user', 'desa'])->find($id);
        return view('wisata-detail', [
            "title" => $wisata->nama,
            "data" => $wisata,
            "active" => 'wisata'
        ]);
    }

    public function wisataJson()
    {   
        $wisata = ModelsWisata::all();
        return json_encode($wisata);
    }
}
