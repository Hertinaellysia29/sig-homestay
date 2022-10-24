<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardHomestayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (auth()->user()->role !== 'admin') {
            return view('dashboard.homestay.index', [
                'datas' => Homestay::where('user_id', auth()->user()->id)->get()
            ]);
        }

        return view('dashboard.homestay.index', [
            'datas' => Homestay::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.homestay.create',[
            'desa' => Desa::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nama_pemilik' => 'required|max:255',
            'no_hp' => 'required|max:13',
            'fasilitas' => 'required',
            'deskripsi' => 'required',
            'desa_id' => 'required',
            'alamat_detail' => 'required',
            'koordinat_lokasi' => 'required',
            'morePhotos.0' => 'required|image|file|max:1024'
        ],[
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong.',
            'no_hp.required' => 'No HP tidak boleh kosong.',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'alamat_detail.required' => 'Alamat Detail tidak boleh kosong.',
            'koordinat_lokasi.required' => 'Koordinat Lokasi tidak boleh kosong.',
            'morePhotos.0.required' => 'Foto tidak boleh kosong.',
        ]);
        
        // $validatedData = $request->validate([
        //     'nama' => 'required|max:255',
        //     'nama_pemilik' => 'required|max:255',
        //     'no_hp' => 'required|max:13',
        //     'fasilitas' => 'required',
        //     'deskripsi' => 'required',
        //     'foto' => 'image|file|max:1024',
        //     'desa_id' => 'required',
        //     'alamat_detail' => 'required',
        //     'koordinat_lokasi' => 'required'
        // ]);
        // return $validatedData;

        // if($request->file('foto')){
        //     $validatedData['foto'] = $request->file('foto')->store('foto-homestay');
        // }
        $a = "";
        $i = 0;
        foreach ($request->morePhotos as $photo) {
            $temp = $photo->store('foto-homestay');
            if ($i == 0) {
                $a = $temp;
            }else{
                $a = $a."||".$temp;
            }
            $i++;
        }

        if($request->harga) {
            $validatedData['harga'] = $request->harga;
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['foto'] = $a;
        Homestay::create($validatedData);

        return redirect('/dashboard/homestay')->with('success', 'Tambah Homestay berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Homestay::with(['user', 'desa'])->find($id);
        return view('dashboard.homestay.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Homestay::with(['user', 'desa'])->find($id);
        return view('dashboard.homestay.edit',[
            'data' => $data,
            'desa' => Desa::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // dd($request);
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nama_pemilik' => 'required|max:255',
            'no_hp' => 'required|max:13',
            'fasilitas' => 'required',
            'deskripsi' => 'required',
            'desa_id' => 'required',
            'alamat_detail' => 'required',
            'koordinat_lokasi' => 'required'
            // 'morePhotos.0' => 'required|image|file|max:1024'
        ],[
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong.',
            'no_hp.required' => 'No HP tidak boleh kosong.',
            'fasilitas.required' => 'Fasilitas tidak boleh kosong.',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong.',
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'alamat_detail.required' => 'Alamat Detail tidak boleh kosong.',
            'koordinat_lokasi.required' => 'Koordinat Lokasi tidak boleh kosong.'
            // 'morePhotos.0.required' => 'Foto tidak boleh kosong.',
        ]);
        // $validatedData = $request->validate([
        //     'nama' => 'required|max:255',
        //     'nama_pemilik' => 'required|max:255',
        //     'no_hp' => 'required|max:13',
        //     'fasilitas' => 'required',
        //     'deskripsi' => 'required',
        //     'foto' => 'image|file|max:1024',
        //     'desa_id' => 'required',
        //     'alamat_detail' => 'required',
        //     'koordinat_lokasi' => 'required'
        // ]);
        
        
        // if($request->file('foto')){
        //     if ($request->oldFoto) {
        //         Storage::delete($request->oldFoto);
        //     }
        //     $validatedData['foto'] = $request->file('foto')->store('foto-homestay');
        // }
        $a = "";
        $i = 0;
        $lenOld = count($request->oldPhotos);
        if($request->morePhotos) {
            foreach ($request->morePhotos as $key => $photo) {
                if ($key < $lenOld) {
                    if ($request->oldPhotos[$key]) {
                        $as = $request->oldPhotos[$key];
                        Storage::delete($request->oldPhotos[$key]);
                        unset($request->oldFoto[$key]);
                        return $as;
                    }
                }
                $temp = $photo->store('foto-homestay');
                if ($i == 0) {
                    $a = $temp;
                }else{
                    $a = $a."||".$temp;
                }
                $i++;
            }
        }
        $oldPhotos = implode("||", $request->oldPhotos);
        if($oldPhotos) {
            if($a) {
                $a = $a."||".$oldPhotos; 
            }else{
                $a = $oldPhotos;
            }
        }

        if($request->harga) {
            $validatedData['harga'] = $request->harga;
        }
        $validatedData['foto'] = $a;

        Homestay::where('id', $id)
            ->update($validatedData);

        return redirect('/dashboard/homestay')->with('success', 'Edit Homestay berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Homestay  $homestay
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Homestay::find($id);
        if ($data->foto !== "") {
            Storage::delete($data->foto);
        }
        Homestay::destroy($id);
        return redirect('/dashboard/homestay')->with('success', 'Hapus Homestay berhasil!');
    }

    public function homestayJson()
    {
        if (auth()->user()->role !== 'admin') {
            $homestay = Homestay::where('user_id', auth()->user()->id)->get();
            return json_encode($homestay);
        }
        $homestay = Homestay::all();
        return json_encode($homestay);
    }
}
