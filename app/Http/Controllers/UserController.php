<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('users.index', ['user' => $user]);
    }

    public function create()
    {
        $role = Role::all();
        return view('users.create', ['role' => $role]);

    }

    public function store(StoreUserRequest $request)
    {
        $rules = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>$request->role

        ];
        $rules['password'] = bcrypt($rules['password']);
        User::create($rules);
        return redirect()->route('users.index')->with('success', 'Data berhasil ditambahkan');

    }

    public function show(user $user)
    {
        //
    }

    public function edit($iduser)
    {

        $role = Role::all();
        $data = User::findorfail($iduser);
        return view('users.edit', ['user' => $data, 'role' => $role]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findorfail($id);

        $user->update(
            [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,

            $user->save($request->all())
            ]
        );
        return redirect()->route('users.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy(user $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Data berhasil dihapus');
    }

}
