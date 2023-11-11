<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
}
