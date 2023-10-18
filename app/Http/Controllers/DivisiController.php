<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisiRequest;
use App\Http\Requests\UpdateDivisiRequest;
use App\Models\Divisi;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisi = Divisi::all();

        return view('dashboard.magang.divisi.index', ['divisi' => $divisi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.magang.divisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDivisiRequest $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:divisis,name',
        ];

        if ($request->jumlah_anggota != null) {
            $rules['jumlah_anggota'] = 'integer';
        } else {
            $request->request->add(['jumlah_anggota' => 0]);
        }

        Divisi::create($request->validate($rules));

        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Divisi::findorfail($id);

        return view('dashboard.magang.divisi.edit', ['divisi' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDivisiRequest $request, Divisi $divisi)
    {
        $old_name = $divisi->nama;
        $rules = [
            'jumlah_anggota' => 'required|integer',
        ];

        if ($request->name != $old_name) {
            $rules['name'] = 'required|string|max:255|unique:divisis,name';
        } else {
            $rules['name'] = 'required|string|max:255';
        }

        $divisi->update($request->validate($rules));

        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisi $divisi)
    {
        $divisi->delete();

        return redirect()->route('divisi.index')->with('success', 'Divisi berhasil dihapus');
    }
}
