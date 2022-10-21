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

    public function homestayCurrentLocationJson(Request $request)
    {   
        $current_lat = $request->query('current_lat');
        $current_long = $request->query('current_long');
        $distance = $request->query('distance');

        $homestays = Homestay::all();

        $emptyArray = (array) null;
        foreach($homestays as $homestay) {
            $tempDestination = (explode(",", str_replace(' ', '', $homestay->koordinat_lokasi)));
            $tempDistance = $this->calculateDistance($current_lat, $current_long, $tempDestination[0], $tempDestination[1], "K");
            if ($tempDistance <= $distance) {
                array_push($emptyArray, $homestay);
            } 
        }

        return json_encode($emptyArray);
    }

    function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $unit = strtoupper($unit);
      
          if ($unit == "K") {
            return ($miles * 1.609344);
          } else if ($unit == "N") {
            return ($miles * 0.8684);
          } else {
            return $miles;
          }
        }
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
