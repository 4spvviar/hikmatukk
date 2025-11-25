<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Galeri;
use App\Models\GambarProduk;
use App\Models\Siswa;
use App\Models\Produk;;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OperatorController extends Controller
{
    //
    public function dashboard(){
        $countKategori = Kategori::count();
        $countProduk = Produk::count();
        $countGaleri = Galeri::count();
        $countGambarProduk = GambarProduk::count();

        return view('operator.dashboard', compact(
            'countKategori',
            'countProduk',
            'countGaleri',
            'countGambarProduk'
        ));
    }

    //----kategori----
    public function kategoriIndex()
    {
        $kategoris = Kategori::all();
        return view('operator.kategori.index', compact('kategoris'));
    }

    public function kategoriCreate()
    {
        return view('operator.kategori.create');
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:40|unique:kategoris,nama_kategori',
            'deskripsi' => 'nullable|string',

        ]);

        Kategori::create($validated);

        return redirect()->route('operator.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $kategori = Kategori::findOrFail($id);
        return view('operator.kategori.edit', compact('kategori'));
    }

    public function kategoriUpdate(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:40|unique:kategoris,nama_kategori,' . $kategori->getKey() . ',id',
            'deskripsi' => 'nullable|string',

        ]);

        $kategori->update($validated);

        return redirect()->route('operator.kategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function kategoriDestroy(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('operator.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    //----Produk----
    public function produkIndex()
    {
        $produks = Produk::all();
        return view('operator.produk.index', compact('produks'));
    }

    public function produkCreate()
    {
        return view('operator.produk.create');
    }

    public function produkStore(Request $request)
    {
        $validated = $request->validate([
            'id_produk' => 'required|string|max:20|unique:produks,id_produk',
            'nama_produk' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id',
            'id_toko' => 'required|exists:tokos,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'tanggal_upload' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk_gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        Produk::create($validated);

        return redirect()->route('operator.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function produkEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $produk = Produk::findOrFail($id);
        return view('operator.produk.edit', compact('produk'));
    }

    public function produkUpdate(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'id_produk' => 'required|string|max:20|unique:produks,id_produk,' . $produk->getKey() . ',id_produk',
            'nama_produk' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id',
            'id_toko' => 'required|exists:tokos,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'tanggal_upload' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk_gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        $produk->update($validated);

        return redirect()->route('operator.produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    public function produkDestroy(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('operator.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    //----gambarproduk----
    public function beritaIndex()
    {
        $gambarproduks = GambarProduk::with('user')->get();
        return view('operator.gambarproduk.index', compact('gambarproduks'));
    }

    public function gambarprodukCreate()
    {
        return view('operator.gambarproduk.create');
    }

    public function gambarprodukStore(Request $request)
    {
        $validated = $request->validate([
            'id_gambar' => 'required|string|max:20|unique:gambarproduks,id_gambar',
            'id_produk' => 'required|exists:produks,id_produk',
            'nama_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['id_gambar', 'id_produk']);
        $data['id_user'] = Auth::user()->id_user;

        if ($request->hasFile('gambar')) {
            $file = $request->file('nama_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('gambarproduk', $filename, 'public');
            $data['nama_gambar'] = 'gambarproduk/' . $filename;
        }

        GambarProduk::create($data);
        return redirect()->route('operator.gambarproduk.index')->with('success', 'Gambar Produk berhasil ditambahkan.');
    }

    public function gambarprodukEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $gambarproduk = GambarProduk::findOrFail($id);
        return view('operator.gambarproduk.edit', compact('gambarproduk'));
    }

    public function gambarprodukUpdate(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $gambarproduk = GambarProduk::findOrFail($id);

        $validated = $request->validate([
            'id_gambar' => 'required|string|max:20|unique:gambarproduks,id_gambar,' . $gambarproduk->getKey() . ',id_gambar',
            'id_produk' => 'required|exists:produks,id_produk',
            'nama_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['id_gambar', 'id_produk']);

        if ($request->hasFile('nama_gambar')) {
            // Delete old image
            if ($gambarproduk->nama_gambar && file_exists(storage_path('app/public/' . $gambarproduk->nama_gambar))) {
                unlink(storage_path('app/public/' . $gambarproduk->nama_gambar));
            }
            $file = $request->file('nama_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('gambarproduk', $filename, 'public');
            $data['nama_gambar'] = 'gambarproduk/' . $filename;
        }

        $gambarproduk->update($data);
        return redirect()->route('operator.gambarproduk.index')->with('success', 'Gambar Produk berhasil diperbarui.');
    }

    public function gambarprodukDestroy(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $gambarproduk = GambarProduk::findOrFail($id);
        if ($gambarproduk->nama_gambar && file_exists(storage_path('app/public/' . $gambarproduk->nama_gambar))) {
            unlink(storage_path('app/public/' . $gambarproduk->nama_gambar));
        }
        $gambarproduk->delete();
        return redirect()->route('operator.gambarproduk.index')->with('success', 'Gambar Produk berhasil dihapus.');
    }

    //---galeri---
    public function galeriIndex()
    {
        $galeris = Galeri::all();
        return view('operator.galeri.index', compact('galeris'));
    }

    public function galeriCreate()
    {
        return view('operator.galeri.create');
    }

    public function galeriStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|unique:galeris,judul',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:2024800',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('galeri_file', 'public');
            $validated['file'] = $filePath;
        }

        Galeri::create($validated);

        return redirect()->route('operator.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function galeriEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $galeri = Galeri::findOrFail($id);
        return view('operator.galeri.edit', compact('galeri'));
    }

    public function galeriUpdate(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255|unique:galeris,judul,' . $galeri->getKey() . ',id_galeri',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('galeri_file', 'public');
            $validated['file'] = $filePath;
        }

        $galeri->update($validated);

        return redirect()->route('operator.galeri.index')->with('success', 'Galeri berhasil diupdate.');
    }

    public function galeriDestroy(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $galeri = Galeri::findOrFail($id);
        $galeri->delete();

        return redirect()->route('operator.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
