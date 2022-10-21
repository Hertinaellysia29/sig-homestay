<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class AdminDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $this->authorize('admin');

        return view('dashboard.desa.index',[
            'datas' => Desa::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.desa.create');
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
        ]);

        Desa::create($validatedData);

        return redirect('/dashboard/desa')->with('success', 'Tambah Nama Desa berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function show(Desa $desa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Desa::find($id);
        return view('dashboard.desa.edit',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255'
        ]);

        Desa::where('id', $id)
            ->update($validatedData);

        return redirect('/dashboard/desa')->with('success', 'Edit Nama Desa berhasil!');
    }

    public function editDesa(Request $request, $id)
    {   
        return $request;
        $validatedData = $request->validate([
            'nama' => 'required|max:255'
        ]);

        Desa::where('id', $id)
            ->update($validatedData);

        return redirect('/dashboard/desa')->with('success', 'Edit Nama Desa berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desa  $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Desa::destroy($id);
        return redirect('/dashboard/desa')->with('success', 'Hapus Nama Desa berhasil!');
    }
}
