<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // return view('dashboard.wisata.index', [
        //     'datas' => Wisata::where('user_id', auth()->user()->id)->get()
        // ]);

        return view('dashboard.wisata.index', [
            'datas' => Wisata::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.wisata.create',[
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
        // return $request->file('foto')->store('wisata-foto');

        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'foto' => 'image|file|max:1024',
            'desa_id' => 'required',
            'lokasi' => 'required',
            'koordinat_lokasi' => 'required'
        ]);

        if($request->file('foto')){
            $validatedData['foto'] = $request->file('foto')->store('foto-wisata');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Wisata::create($validatedData);

        return redirect('/dashboard/wisata')->with('success', 'Tambah Wisata berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Wisata::with(['user', 'desa'])->find($id);

        return view('dashboard.wisata.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = Wisata::with(['user', 'desa'])->find($id);
        return view('dashboard.wisata.edit',[
            'data' => $data,
            'desa' => Desa::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'foto' => 'image|file|max:1024',
            'desa_id' => 'required',
            'lokasi' => 'required',
            'koordinat_lokasi' => 'required'
        ]);

        if($request->file('foto')){
            if ($request->oldFoto) {
                Storage::delete($request->oldFoto);
            }
            $validatedData['foto'] = $request->file('foto')->store('foto-wisata');
        }

        $validatedData['user_id'] = auth()->user()->id;
        Wisata::where('id', $id)
            ->update($validatedData);

        return redirect('/dashboard/wisata')->with('success', 'Edit Wisata berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $data = Wisata::find($id);
        if ($data->foto !== "") {
            Storage::delete($data->foto);
        }
        Wisata::destroy($id);
        return redirect('/dashboard/wisata')->with('success', 'Hapus Wisata berhasil!');
    }
}
