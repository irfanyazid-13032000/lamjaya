<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();

        return view('dashboard.magang.role.index', ['role' => $role]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.magang.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:role,name',
        ];

        Role::create($request->validate($rules));

        return redirect()->route('role.index')->with('success', 'Role berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Role::findorfail($id);

        return view('dashboard.magang.role.edit', ['role' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $old_name = $role->nama;

        if ($request->name != $old_name) {
            $rules['name'] = 'required|string|max:255|unique:divisis,name';
        } else {
            $rules['name'] = 'required|string|max:255';
        }

        $role->update($request->validate($rules));

        return redirect()->route('role.index')->with('success', 'Role berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
    }
}
