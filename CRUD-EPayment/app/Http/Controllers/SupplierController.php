<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $suppliers = Supplier::latest()->paginate(5);

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'nama'       => 'required|min:1',
            'phone'      => 'required|min:11|max:15',
            'almat'      => 'required|min:5'
        ]);

        Supplier::create([
            'nama'      => $request->nama,
            'phone'     => $request->phone,
            'alamat'    => $request->alamat
        ]);

        return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nama'       => 'required|min:1',
            'phone'      => 'required|min:11|max:15',
            'almat'      => 'required|min:5'
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'nama'      => $request->nama,
            'phone'     => $request->phone,
            'alamat'    => $request->alamat
        ]);

        return redirect()->route('suppliers.index')->with(['success' => 'Data Berhasil Ditambahkan']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
