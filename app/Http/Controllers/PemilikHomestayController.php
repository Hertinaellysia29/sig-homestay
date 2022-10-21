<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PemilikHomestay;
use Illuminate\Support\Facades\Hash;

class PemilikHomestayController extends Controller
{
    public function index()
    {   
        return view('dashboard.pemilik.edit',[
            'data' => PemilikHomestay::where('user_id', auth()->user()->id)->with(['user'])->first()
        ]);
    }

    public function update(Request $request)
    {   
        // $validatedData = $request->validate([
        //     'nama' => 'required|max:255',
        //     'deskripsi' => 'required',
        //     'foto' => 'image|file|max:1024',
        //     'desa_id' => 'required',
        //     'lokasi' => 'required',
        //     'koordinat_lokasi' => 'required'
        // ]);

        // if($request->file('foto')){
        //     if ($request->oldFoto) {
        //         Storage::delete($request->oldFoto);
        //     }
        //     $validatedData['foto'] = $request->file('foto')->store('foto-wisata');
        // }

        // $validatedData['user_id'] = auth()->user()->id;
        // Wisata::where('id', $id)
        //     ->update($validatedData);

        // return redirect('/dashboard/wisata')->with('success', 'Wisata has been updated!');
        $userID = auth()->user()->id;
        $pemilikHomestay = PemilikHomestay::where('user_id', $userID)->first();

        $validatedData = $request->validate([
            'nama_depan' => 'required|max:255',
            'nama_belakang' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', "unique:users,username,{$userID}"],
            'no_hp' => 'required|min:12|max:13',
            'nama_homestay' => 'required',
            'alamat' => 'required',
            // 'pesan' => 'required',
        ]);

        $password = auth()->user()->password;
        $isUpdatedPassword = false;
        if ($request->password_baru != ""){
            if (!(Hash::check($request->password_lama, auth()->user()->password))) {
                return redirect('/dashboard/pemilik-homestay')->with('old-password-invalid', 'Password lama salah!');
            }
            if ($request->password_baru != $request->konfirmasi_password_baru) {
                return redirect('/dashboard/pemilik-homestay')->with('password-confirmation-invalid', 'Konfirmasi password baru salah!');
            }
            $isUpdatedPassword = true;
            $password =  bcrypt($request->password_baru);
        }

        if ($validatedData['nama_depan'] == $pemilikHomestay->nama_depan &&
            $validatedData['nama_belakang'] == $pemilikHomestay->nama_belakang && 
            $validatedData['no_hp'] == $pemilikHomestay->no_hp &&
            $validatedData['nama_homestay'] == $pemilikHomestay->nama_homestay &&
            $validatedData['alamat'] == $pemilikHomestay->alamat &&
            $validatedData['username'] == auth()->user()->username && 
            $isUpdatedPassword == false
        ) {
            return redirect('/dashboard/pemilik-homestay')->with('success', 'Tidak ada perubahan data!');
        }

        $isUpdatedUser = false;
        if ($isUpdatedPassword == true || 
            $validatedData['username'] != auth()->user()->username ||
            $validatedData['nama_depan'] != $pemilikHomestay->nama_depan ||
            $validatedData['nama_belakang'] != $pemilikHomestay->nama_belakang) {
            $isUpdatedUser = true;
        }
        // dd($isUpdatedUser);
        // dd($request);

        \DB::beginTransaction();
        try{

            if ($isUpdatedUser) {
                $user = User::find($userID);
                $user->name = $validatedData['nama_depan'] . " " . $validatedData['nama_belakang'];
                $user->username = $validatedData['username'];
                $user->password = $password;
                $user->save();
                // User::where('id', $userID)->update(array(
                //     'name' => $validatedData['first_name'] . " " . $validatedData['last_name'],
                //     'username' => $validatedData['username'],
                //     'password' => $password,
                // ));
            }
            
            if($pemilikHomestay) {
                $pemilikHomestay->nama_depan = $validatedData['nama_depan'];
                $pemilikHomestay->nama_belakang = $validatedData['nama_belakang'];
                $pemilikHomestay->no_hp = $validatedData['no_hp'];
                $pemilikHomestay->nama_homestay = $validatedData['nama_homestay'];
                $pemilikHomestay->alamat = $validatedData['alamat'];
                $pemilikHomestay->save();
            }
            // PemilikHomestay::create([
            //     'user_id' => $user->id,
            //     'nama_depan' => $validatedData['first_name'],
            //     'nama_belakang' => $validatedData['last_name'],
            //     'no_hp' => $validatedData['no_hp'],
            //     'alamat' => $validatedData['alamat'],
            //     'nama_homestay' => $validatedData['nama_homestay'],
            //     'status' => 'waiting_for_approval',
            //     'pesan' => $validatedData['pesan'],
            // ]);
            \DB::commit();
        }
        catch(\Exception $e){
            \DB::rollback();
            throw $e;
        }
        return redirect('/dashboard/pemilik-homestay')->with('success', 'Akun berhasil diubah!');
    }
}
