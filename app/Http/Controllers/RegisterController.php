<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PemilikHomestay;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index', [
            'title' => 'Register',
            'active' => ''
        ]);
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'password' => 'required|min:5|max:255',
            'no_hp' => 'required|min:12|max:13',
            'alamat' => 'required',
            'nama_homestay' => 'required',
            'pesan' => 'required'
        ]);

        \DB::beginTransaction();
        try{

            $user = User::create([
                'name' => $validatedData['first_name'] . " " . $validatedData['last_name'],
                'username' => $validatedData['username'],
                'password' => bcrypt($validatedData['password']),
            ]);
            
            PemilikHomestay::create([
                'user_id' => $user->id,
                'nama_depan' => $validatedData['first_name'],
                'nama_belakang' => $validatedData['last_name'],
                'no_hp' => $validatedData['no_hp'],
                'alamat' => $validatedData['alamat'],
                'nama_homestay' => $validatedData['nama_homestay'],
                'status' => 'waiting_for_approval',
                'pesan' => $validatedData['pesan'],
                'alasan_penolakan' => "",
            ]);
            \DB::commit();
        }
        catch(\Exception $e){
            \DB::rollback();
            throw $e;
        }

        return redirect('/login')->with('success', 'Berhasil daftar akun sebagai pemilik homestay! silahkan masuk');
    }
}
