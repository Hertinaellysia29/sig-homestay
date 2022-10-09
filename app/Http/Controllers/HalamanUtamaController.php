<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use App\Models\Wisata;

class HalamanUtamaController extends Controller
{
    public function homestay()
    {   
        return view('homestay', [
            'datas' => Homestay::with(['user', 'desa'])->latest()->get(),
            'title' => 'Homestay',
            'active' => 'homestay'
        ]);
    }

    public function homestayJson()
    {   
        $homestay = Homestay::all();
        return json_encode($homestay);
    }

    public function homestayDetail($id)
    {   
        return view('homestay-detail', [
            'data' => Homestay::with(['user', 'desa'])->find($id),
            'title' => 'Homestay',
            'active' => 'homestay'
        ]);
    }

    public function getWisataJson($id)
    {   
        $homestay = Wisata::find($id);
        return json_encode($homestay);
    }
}
