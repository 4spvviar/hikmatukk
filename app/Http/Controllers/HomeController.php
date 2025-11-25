<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil data untuk homepage marketplace
        $produkTerbaru = Produk::with(['kategori', 'toko', 'gambarProduk'])
            ->orderBy('tanggal_upload', 'desc')
            ->take(8)
            ->get();

        $kategoris = Kategori::withCount('produk')->get();

        $tokoPopuler = Toko::withCount('produk')
            ->orderBy('produk_count', 'desc')
            ->take(6)
            ->get();

        return view('layouts.home', compact('produkTerbaru', 'kategoris', 'tokoPopuler'));
    }
}
