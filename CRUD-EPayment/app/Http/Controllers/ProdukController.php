<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\View\View;

class ProdukController extends Controller
{
    
    public function index(): View
    {
        $produks = Produk::latest()->paginate(5);

        return view('produks.index', compact('produks'));
    }
}
