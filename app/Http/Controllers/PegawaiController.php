<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $allPegawai = Pegawai::all();
        $allPegawai = DB::table('t_pegawai')
                    ->join('t_kelurahan','t_pegawai.kelurahan_id','=','t_kelurahan.id')
                    ->join('t_kecamatan','t_pegawai.kecamatan_id','=','t_kecamatan.id')
                    ->join('t_provinsi','t_pegawai.provinsi_id','=','t_provinsi.id')
                    ->select('t_pegawai.*','t_kelurahan.nama_kelurahan','t_kecamatan.nama_kecamatan','t_provinsi.nama_provinsi')
                    ->get();
        return view('pegawai.index',compact('allPegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allKecamatan = Kecamatan::all();
        $allKelurahan = Kelurahan::all();
        $allProvinsi = Provinsi::all();
        return view('pegawai.create',compact('allKecamatan','allKelurahan','allProvinsi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'provinsi_id' => $request->provinsi_id,
        ]);

        return redirect()->route('pegawai.index');
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
        $pegawai = Pegawai::find($id);
        $allKecamatan = Kecamatan::all();
        $allKelurahan = Kelurahan::all();
        $allProvinsi = Provinsi::all();
        

        return view('pegawai.edit',compact('pegawai','allKecamatan','allKelurahan','allProvinsi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Pegawai::find($id)->update([
            'nama_pegawai' => $request->nama_pegawai,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'kecamatan_id' => $request->kecamatan_id,
            'kelurahan_id' => $request->kelurahan_id,
            'provinsi_id' => $request->provinsi_id,
        ]);

        return redirect()->route('pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pegawai::find($id)->delete();

        return redirect()->route('pegawai.index');
    }
}
