<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    
    public function index(): View
    {
        $produks = Produk::latest()->paginate(5);

        return view('produks.index', compact('produks'));
    }

    public function create(): View
    {
        return view('produks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'kode_produk' => 'required|min:3',
            'nama'        => 'required|min:5',
            'varian'      => 'required|min:5',
            'ukuran'      => 'required|min:3',
            'stok'        => 'required|regex:/^[0-9]+$/',
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $image = $request->file('image');
        $image->storeAs('public/produks', $image->hashName());

        Produk::create([
            'kode_produk' => $request->kode_produk,
            'nama'        => $request->nama,
            'varian'      => $request->varian,
            'ukuran'      => $request->ukuran,
            'stok'        => $request->stok,
            'image'       => $image->hashName()
        ]);

        return redirect()->route('produks.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show(string $id): View
    {
        $produk = Produk::findOrFail($id);

        return view('produks.show', compact('produk'));
    }

    public function edit(string $id): View
    {
        $produk = Produk::findOrFail($id);

        return view('produks.edit', compact('produk'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'kode_produk' => 'required|min:3',
            'nama'        => 'required|min:5',
            'varian'      => 'required|min:5',
            'ukuran'      => 'required|min:3',
            'stok'        => 'required|regex:/^[0-9]+$/',
            'image'       => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/produks', $image->hashName());

            Storage::delete('public/produks/'.$produk->image);

            $produk->update([
                'kode_produk' => $request->kode_produk,
                'nama'        => $request->nama,
                'varian'      => $request->varian,
                'ukuran'      => $request->ukuran,
                'stok'        => $request->stok,
                'image'       => $image->hashName()
            ]);
        } else {
            $produk->update([
                'kode_produk' => $request->kode_produk,
                'nama'        => $request->nama,
                'varian'      => $request->varian,
                'ukuran'      => $request->ukuran,
                'stok'        => $request->stok,
            ]);
        }
        
        return redirect()->route('produks.index')->with(['success' => "Data Berhasil DIedit"]);
    }

    public function destroy($id): RedirectResponse
    {
        $produk = Produk::findOrFail($id);

        Storage::delete('public/produks/' . $produk->image);

        $produk->delete();

        return redirect()->route('produks.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
