<?php

namespace App\Http\Controllers;

use App\Models\Homestay;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'foto' => 'image|file|max:1024',
            'desa_id' => 'required',
            'alamat_detail' => 'required',
            'koordinat_lokasi' => 'required'
        ]);

        if($request->file('foto')){
            $validatedData['foto'] = $request->file('foto')->store('foto-homestay');
        }

        if($request->harga) {
            $validatedData['harga'] = $request->harga;
        }

        $validatedData['user_id'] = auth()->user()->id;

        Homestay::create($validatedData);

        return redirect('/dashboard/homestay')->with('success', 'Add Homestay successfull!');
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
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'nama_pemilik' => 'required|max:255',
            'no_hp' => 'required|max:13',
            'fasilitas' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|file|max:1024',
            'desa_id' => 'required',
            'alamat_detail' => 'required',
            'koordinat_lokasi' => 'required'
        ]);
        
        if($request->file('foto')){
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-homestay');
        }

        if($request->harga) {
            $validatedData['harga'] = $request->harga;
        }

        Homestay::where('id', $id)
            ->update($validatedData);

        return redirect('/dashboard/homestay')->with('success', 'Homestay has been updated!');
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
        return redirect('/dashboard/homestay')->with('success', 'Homestay has been deleted!');
    }
}
