<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAbsensiRequest;
use App\Http\Requests\UpdateAbsensiRequest;
use App\Models\Absensi;
use App\Models\User;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::all();
        $dataUser = User::all();
        return view('dashboard.magang.absensi.index', compact('absensi', 'dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAbsensiRequest $request)
    {
        $data = [
            'tanggal' => now()->format('Y-m-d'),
            'user_id' => auth()->user()->id, // Menyertakan nilai user_id saat membuat entri Absensi baru
            'jam_masuk' => now()->format('H:i:s'),
        ];

        $old_data = Absensi::where('tanggal', $data['tanggal'])->where('user_id', auth()->user()->id)->first();
        if ($old_data != null && auth()->user()->role === 'User') {
            return redirect()->route('absensi.show', auth()->user()->email)->with('error', 'Anda Sudah Mengisi Absensi Masuk Hari Ini');
        } else {
            Absensi::create($data);

            return redirect()->route('absensi.show', auth()->user()->email)->with('success', 'Absensi Masuk Berhasil Dicatat');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($user_id)
    {
        $data = Absensi::where('user_id', '=', auth()->user()->id)->get();
        $dataUser = User::all();
        return view('dashboard.magang.absensi.show', compact('data', 'dataUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absensi $absensi)
    {
        return view('dashboard.magang.absensi.edit', ['absensi' => $absensi]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAbsensiRequest $request, Absensi $absensi)
    {
        $data = $request->validate(
            [
                'deskripsi' => 'required|string|max:255',
            ]
        );

        $data['tanggal'] = $absensi->tanggal;
        $data['user_id'] = $absensi->user_id;
        $data['jam_masuk'] = $absensi->jam_masuk;
        $data['jam_keluar'] = now()->format('H:i:s');

        if (auth()->user()->role === 'User' && $absensi->jam_keluar != null) {
            return redirect()->route('absensi.show', auth()->user()->email)->with('error', 'Anda Sudah Mengisi Absensi Keluar Hari Ini');
        } else {
            $absensi->update($data);

            return redirect()->route('absensi.show', auth()->user()->email)->with('success', 'Absensi Keluar Berhasil Dicatat');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
