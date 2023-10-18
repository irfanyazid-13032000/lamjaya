<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allKecamatan = Kecamatan::all();
        return view('kecamatan.index',compact('allKecamatan'));
    }

    public function updateActive($id,$active){
        $kecamatan = Kecamatan::find($id);
        if ($active == 0) {
            $kecamatan->update(['active' => 1]);
        }else {
            $kecamatan->update(['active' => 0]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kecamatan::create([
            'kode' => $request->kode,
            'nama_kecamatan' => $request->nama_kecamatan,
            'active' => $request->active,
        ]);

        return redirect()->route('kecamatan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kecamatan = Kecamatan::find($id);
        return view('provinsi.edit',compact('kecamatan'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Kecamatan::find($id)->update([
            'kode' => $request->kode,
            'nama_kecamatan' => $request->nama_kecamatan,
        ]);

        return redirect()->route('provinsi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kecamatan::find($id)->delete();

        return redirect()->route('kecamatan.index');
    }
}
