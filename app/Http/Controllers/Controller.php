<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\GambarProduk;
use App\Models\Toko;
use App\Models\profile_sekolah;
use App\Models\Galeri;

class Controller extends BaseController
{
    public function home()
    {
        $profile = profile_sekolah::first();
        $galeris = Galeri::whereIn('kategori', ['foto', 'video'])->orderBy('tanggal', 'desc')->get();
        $admins = User::where('role', 'admin')->get();
        $members = User::where('role', 'member')->get();
        return view('layouts.home', compact('profile', 'galeris', 'admins', 'members'));
    }

    public function galeri()
    {
        $profile = profile_sekolah::first();
        $galeris = Galeri::whereIn('kategori', ['foto', 'video'])->orderBy('tanggal', 'desc')->get();
        return view('layouts.galeri', compact('profile', 'galeris'));
    }

    public function tentang()
    {
        $profile = profile_sekolah::first();
        $galeris = Galeri::whereIn('kategori', ['foto', 'video'])->orderBy('tanggal', 'desc')->get();
        return view('profile.tentang', compact('profile', 'galeris'));
    }

    public function visimisi()
    {
        return view('profile.visimisi');
    }
}
