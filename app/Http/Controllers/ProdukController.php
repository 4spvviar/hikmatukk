<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['kategori', 'toko', 'gambarProduk']);

        // Filter berdasarkan kategori
        if ($request->kategori) {
            $query->where('id_kategori', $request->kategori);
        }

        // Filter berdasarkan pencarian
        if ($request->search) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan harga
        if ($request->min_harga) {
            $query->where('harga', '>=', $request->min_harga);
        }
        if ($request->max_harga) {
            $query->where('harga', '<=', $request->max_harga);
        }

        $produks = $query->paginate(12);
        $kategoris = Kategori::all();

        return view('admin.produk.index', compact('produks', 'kategoris'));
    }

    public function show($id)
    {
        $produk = Produk::with(['kategori', 'toko', 'gambarProduk'])->findOrFail($id);
        $produkTerkait = Produk::where('id_kategori', $produk->id_kategori)
            ->where('id_produk', '!=', $id)
            ->take(4)
            ->get();

        return view('produk.show', compact('produk', 'produkTerkait'));
    }
}
