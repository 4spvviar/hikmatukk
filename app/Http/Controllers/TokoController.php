<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Produk;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::withCount('produk')->paginate(12);
        return view('toko.index', compact('tokos'));
    }

    public function show($id)
    {
        $toko = Toko::with('user')->findOrFail($id);
        $produks = Produk::where('id_toko', $id)
            ->with(['kategori', 'gambarProduk'])
            ->paginate(12);

        return view('toko.show', compact('toko', 'produks'));
    }
}
