<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FruitController extends Controller
{
    public function index(): View
    {
        $fruits = Fruit::latest()->paginate(5);

        return view('fruits.index', compact('fruits'));
    }

    public function create(): View
    {
        return view('fruits.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama'      => 'required|min:3',
            'jenis'     => 'required|min:1',
            'harga'     => 'required|min:4',
            'stok'      => 'required|min:1',
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $image = $request->file('image');
        $image->storeAs('public/fruits', $image->hashName());

        Fruit::create([
            'nama'      => $request->nama,
            'jenis'     => $request->jenis,
            'harga'     => $request->harga,
            'stok'      => $request->stok,
            'image'     => $image->hashName()
        ]);

        return redirect()->route('fruits.index')->with(['success', "Data Berhasil Ditambahkan"]);
    }

    public function show(string $id): View
    {
        $fruits = Fruit::findOrFail($id);

        return view('fruits.show', compact('fruits'));
    }

    public function edit(string $id): View
    {
        $fruits = Fruit::findOrFail($id);

        return view('fruits.edit', compact('fruits'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'nama'      => 'required|min:3',
            'jenis'     => 'required|min:1',
            'harga'     => 'required|min:4',
            'stok'      => 'required|min:1',
            'image'     => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $fruits = Fruit::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('/public/fruits', $image->hashName());

            Storage::delete('/public/fruits' . $fruits->image);

            $fruits->update([
                'nama'      => $request->nama,
                'jenis'     => $request->jenis,
                'harga'     => $request->harga,
                'stok'      => $request->stok,
                'image'     => $image->hashName()
            ]);
        } else {
            $fruits->update([
                'nama'      => $request->nama,
                'jenis'     => $request->jenis,
                'harga'     => $request->harga,
                'stok'      => $request->stok,
            ]);
        }

        return redirect()->route('fruits.index')->with(['success' => 'Data Berhasil Diedit']);
    }

    public function destroy(string $id): RedirectResponse
    {
        $fruits = Fruit::findOrFail($id);

        Storage::delete('public/fruits'.$fruits->image);

        $fruits->delete([]);

        return redirect()->route('fruits.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
