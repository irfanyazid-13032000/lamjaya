<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProvinsi = Provinsi::all();
        return view('provinsi.index',compact('allProvinsi'));
    }

    public function updateActive($id,$active){
        $provinsi = Provinsi::find($id);
        if ($active == 0) {
            $provinsi->update(['active' => 1]);
        }else {
            $provinsi->update(['active' => 0]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Provinsi::create([
            'kode' => $request->kode,
            'nama_provinsi' => $request->nama_provinsi,
            'active' => $request->active,
        ]);

        return redirect()->route('provinsi.index');
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
        $provinsi = Provinsi::find($id);
        return view('provinsi.edit',compact('provinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Provinsi::find($id)->update([
            'kode' => $request->kode,
            'nama_provinsi' => $request->nama_provinsi,
        ]);

        return redirect()->route('provinsi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Provinsi::find($id)->delete();

        return redirect()->route('provinsi.index');
    }
}
