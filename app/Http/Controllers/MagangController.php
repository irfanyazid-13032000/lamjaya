<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMagangRequest;
use App\Http\Requests\UpdateMagangRequest;
use App\Models\Divisi;
use App\Models\Magang;
use App\Models\User;


class MagangController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $magang = User::all();

        return view('dashboard.magang.index', ['magang' => $magang]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi = Divisi::all();

        return view('dashboard.magang.create', ['divisi' => $divisi]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMagangRequest $request)
    {
        $validatedData = $request->validated();
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'divisi' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|max:255',
            'jurusan' => 'required|string|max:255',
            'universitas' => 'required|string|max:255',
            'surat_kontrak' => 'required|file|mimes:pdf,doc,docx|max:5048',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date',
            'status' => 'required|string|max:255',
        ];

        if ($request->has('sertifikat')) {
            $rules['sertifikat'] = 'max:255';
        }

        $request->validate($rules);

        if ($request->hasFile('surat_kontrak')) {
            $suratKontrakPath = $request->file('surat_kontrak')->store('surat_kontrak');
            $validatedData['surat_kontrak'] = $suratKontrakPath;
        }

        User::create($validatedData);
         //User::create($request->validate($rules));

        return redirect()->route('intern.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Magang $magang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idmagang)
    {
        $divisi = Divisi::all();
        $data = User::findorfail($idmagang);

        return view('dashboard.magang.edit', ['magang' => $data, 'divisi' => $divisi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMagangRequest $request, Magang $user, $idmagang)
    {
        $old_data = $user->where('id', $idmagang)->first();
        $rules =
            [
                'nama' => 'required|string|max:255',
                'divisi' => 'required|string|max:255',
                'no_hp' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|max:255',
                'nim' => 'required|string|max:255',
                'jenjang_pendidikan' => 'required|max:255',
                'jurusan' => 'required|string|max:255',
                'universitas' => 'required|string|max:255',
                'surat_kontrak' => 'required',
                'tanggal_masuk' => 'required|date',
                'tanggal_keluar' => 'required|date',
                'status' => 'required|string|max:255',
            ];

        if ($request->has('sertifikat')) {
            $rules['sertifikat'] = 'max:255';
        }

        if ($request->email != $old_data->email) {
            $rules['email'] = 'required|email|unique:magangs,email|max:255';
        } else {
            $rules['email'] = 'required|email|max:255';
        }

        if ($request->hasFile('surat_kontrak')) {
            $file = $request->file('surat_kontrak');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('folder_tujuan', $fileName); 
    
            $request->merge(['surat_kontrak' => $fileName]);
        }

        User::whereId($idmagang)->update($request->validate($rules));

        return redirect()->route('intern.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Magang $magang, $idmagang)
    {
        $magang->where('id', $idmagang)->delete();

        return redirect()->route('intern.index')->with('success', 'Data berhasil dihapus');
    }
}
