<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PemilikHomestay;

class DashboardUserController extends Controller
{
    public function index()
    {   
        return view('dashboard.user.index',[
            'datas' => User::with(['pemilik_homestay'])->latest()->get()
        ]);
    }

    public function approve(Request $request, $id)
    {   
        $pemilikHomestay = PemilikHomestay::find($id);
        $pemilikHomestay->status = 'approved';
        $pemilikHomestay->save();

        return redirect('/dashboard/user')->with('success', 'User ' . $pemilikHomestay->user->name . ' sudah di terima!');
    }

    public function reject(Request $request, $id)
    {      
        $pemilikHomestay = PemilikHomestay::find($id);
        $pemilikHomestay->status = 'rejected';
        $pemilikHomestay->alasan_penolakan = $request->alasan_penolakan;
        $pemilikHomestay->save();

        return redirect('/dashboard/user')->with('success', 'User ' . $pemilikHomestay->user->name . ' sudah di tolak!');
    }

    public function show($id)
    {   
        return view('dashboard.user.show',[
            'data' => User::with(['pemilik_homestay'])->find($id)
        ]);
    }
}
