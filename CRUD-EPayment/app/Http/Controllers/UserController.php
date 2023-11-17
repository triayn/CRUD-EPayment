<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(5);
        
        return view('karyawan.index', compact('users'));
    }

    public function create(): View
    {
        return view('karyawan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
        'email'       => 'required|min:10',
        'name'        => 'required|min:5',
        'password'    => 'required|min:6'
        ]);

        User::create([
            'email'       => $request->email,
            'name'        => $request->name,
            'password'    => $request->password,
        ]);

        return redirect()->route('karyawan.index')->with(['success'=> 'Data Berhasil Disimpan']);
    }

    public function show(string $id): View
    {
        $users = User::findOrFail($id);

        return view('karyawan.show', compact('users'));
    }

    public function edit(string $id): View
    {
        $users = User::findOrFail($id);

        return view('karyawan.edit', compact('users'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'email'       => 'required|min:10',
            'name'        => 'required|min:5',
            ]);

            $users = User::findOrFail($id);
    
            $users->update([
                'email'       => $request->email,
                'name'        => $request->name,
            ]);

            return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy($id): RedirectResponse
    {
        $users = User::findOrFail($id);

        $users->delete();

        return redirect()->route('karyawan.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
