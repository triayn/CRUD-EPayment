<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(): View
    {
        $suppliers = Supplier::latest()->paginate(5);
        
        return view('suppliers.index', compact('suppliers'));
    }

    public function create(): View
    {
        return view('suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama'      => 'required|min:3',
            'phone'     => 'required|min:11|max:15',
            'alamt'     => 'required|min:5'
        ]);

        Supplier::create([
            'nama'      => $request->nama,
            'phone'     => $request->phone,
            'alamat'    => $request->alamat
        ]);

        return redirect()->route('suppliers.index')->with(['success', 'Data Berhasil Ditambahkan']);
    }

    public function show($id): View
    {
        $suppliers = Supplier::findOrFail($id);

        return view('suppliers.show', compact('suppliers'));
    }

    public function edit($id): View
    {
        $suppliers = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('suppliers'));
    }
}
