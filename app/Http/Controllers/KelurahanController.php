<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allKelurahan = DB::table('t_kelurahan')->join('t_kecamatan','t_kelurahan.kecamatan_id','=','t_kecamatan.id')
                                ->select('t_kelurahan.*','t_kecamatan.nama_kecamatan')
                                ->get();
        return view('kelurahan.index',compact('allKelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allKecamatan = Kecamatan::all();
        return view('kelurahan.create',compact('allKecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kelurahan::create([
            'kode' => $request->kode,
            'nama_kelurahan' => $request->nama_kelurahan,
            'active' => $request->active,
            'kecamatan_id' => $request->kecamatan_id,
        ]);

        return redirect()->route('kelurahan.index');
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
        $kelurahan = Kelurahan::find($id);
        $allKecamatan = Kecamatan::all();
        return view('kelurahan.edit',compact('kelurahan','allKecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        kelurahan::find($id)->update([
            'kode' => $request->kode,
            'nama_kelurahan' => $request->nama_kelurahan,
            'kecamatan_id' => $request->kecamatan_id,
        ]);

        return redirect()->route('kelurahan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kelurahan::find($id)->delete();

        return redirect()->route('kelurahan.index');
    }
}
