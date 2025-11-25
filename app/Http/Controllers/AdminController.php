<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Ekstrakulikuler;
use App\Models\profile_sekolah;
use App\Models\Galeri;
use App\Models\Berita;
use App\Models\GambarProduk;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    //
    public function dashboard(){
        $countUser = User::count();
        $countKategori = Kategori::count();
        $countToko = Toko::count();
        $countProduk = Produk::count();
        $countProfileSekolah = profile_sekolah::count();
        $countGaleri = Galeri::count();
        $countGambarProduk = GambarProduk::count();

        return view('admin.dashboard', compact(
            'countUser',
            'countKategori',
            'countToko',
            'countProduk',
            'countProfileSekolah',
            'countGaleri',
            'countGambarProduk'
        ));
    }


    //----user----
    public function userView()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function editView(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $users = User::findOrFail($id);
        return view('admin.user.edit', compact('users'));
    }

    public function updateView(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $user = User::findOrFail($id);

        // ✅ validasi dengan pengecualian id yang sedang diedit
        $validasi = $request->validate([
            'name'     => 'required|string|max:225',
            'username' => 'required|string|max:225|unique:users,username,' . $user->getKey() . ',id_user',
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,operator',
        ]);

        if ($request->filled('password')) {
            $validasi['password'] = bcrypt($request->password);
        } else {
            $validasi['password'] = $user->password;
        }

        $user->update($validasi);

        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Berhasil mengupdate data.');
    }

    public function userCreate()
    {
        return view('admin.user.create');
    }

    public function userStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,operator',
        ]);

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function userDestroy(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }

    //----kategori----
    public function kategoriIndex()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function kategoriCreate()
    {
        return view('admin.kategori.create');
    }

    public function kategoriStore(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|string|max:10|unique:kategoris,id_kategori',
            'nama_kategori' => 'required|string|max:40',
        ]);

        Kategori::create($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function kategoriEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
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
            'id_kategori' => 'required|string|max:10|unique:kategoris,id_kategori,' . $kategori->getKey() . ',id_kategori',
            'nama_kategori' => 'required|string|max:40',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diupdate.');
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

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    //----toko-----
    public function tokoIndex()
    {
        $tokos = Toko::all();
        return view('admin.toko.index', compact('tokos'));
    }

    public function tokoCreate()
    {
        return view('admin.toko.create');
    }

    public function tokoStore(Request $request)
    {
        $validated = $request->validate([
            'id_toko' => 'required|string|max:10|unique:toko,id_toko',
            'nama_toko' => 'required|string|max:40',
            'deskripsi' => 'required|string|max:15|unique:toko,deskripsi',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_user' => 'required|exists:users,id_user',
            'kontak_toko' => 'required|string|max:13',
            'alamat' => 'required|string',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('toko_gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        Toko::create($validated);

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    public function tokoEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $toko = Toko::findOrFail($id);
        return view('admin.toko.edit', compact('toko'));
    }

    public function tokoUpdate(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $toko = Toko::findOrFail($id);

        $validated = $request->validate([
            'id_toko' => 'required|string|max:10|unique:toko,id_toko,' . $toko->getKey() . ',id_toko',
            'nama_toko' => 'required|string|max:40',
            'deskripsi' => 'required|string|max:15|unique:toko,deskripsi,' . $toko->getKey() . ',id_toko',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_user' => 'required|exists:users,id_user',
            'kontak_toko' => 'required|string|max:13',
            'alamat' => 'required|string',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('toko_gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        $toko->update($validated);

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil diupdate.');
    }

    public function tokoDestroy(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $toko = Toko::findOrFail($id);
        $toko->delete();

        return redirect()->route('admin.toko.index')->with('success', 'Toko berhasil dihapus.');
    }

    //-----produk-----
    public function produkIndex()
    {
        $produk = Produk::all();
        return view('admin.produk.index', compact('produk'));
    }

    public function produkCreate()
    {
        return view('admin.produk.create');
    }

    public function produkStore(Request $request)
    {
        $validated = $request->validate([
            'id_toko' => 'required|exists:toko,id_toko',
            'nama_toko' => 'required|string|max:40',
            'deskripsi' => 'required|string|max:15|unique:toko,deskripsi',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_user' => 'required|exists:users,id_user',
            'kontak_toko' => 'required|string|max:13',
            'alamat' => 'required|string',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk_gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        Produk::create($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function produkEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $produk = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('produk'));
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
            'id_toko' => 'required|exists:toko,id_toko',
            'nama_toko' => 'required|string|max:40',
            'deskripsi' => 'required|string|max:15|unique:toko,deskripsi,' . $produk->getKey() . ',id_toko',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_user' => 'required|exists:users,id_user',
            'kontak_toko' => 'required|string|max:13',
            'alamat' => 'required|string',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk_gambar', 'public');
            $validated['gambar'] = $gambarPath;
        }

        $produk->update($validated);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diupdate.');
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

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    //----galeri----
    public function galeriIndex()
    {
        $galeris = Galeri::all();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function galeriCreate()
    {
        return view('admin.galeri.create');
    }

    public function galeriStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|unique:galeris,judul',
            'keterangan' => 'nullable|string',
            'kategori' => 'required|in:Foto,Video',
            'tanggal' => 'required|date',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:204800',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('galeri_file', 'public');
            $validated['file'] = $filePath;
        }

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function galeriEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
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
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:204800',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('galeri_file', 'public');
            $validated['file'] = $filePath;
        }

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diupdate.');
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

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    //----profil sekolah----
    public function profileSekolahIndex()
    {
        $profileSekolahs = profile_sekolah::all();
        return view('admin.profile_sekolah.index', compact('profileSekolahs'));
    }

    public function profileSekolahCreate()
    {
        return view('admin.profile_sekolah.create');
    }

    public function profileSekolahStore(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'npsn' => 'required|string|max:10',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:15',
            'visi_misi' => 'nullable|string',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('profile_foto', 'public');
            $validated['foto'] = $fotoPath;
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('profile_logo', 'public');
            $validated['logo'] = $logoPath;
        }

        profile_sekolah::create($validated);

        return redirect()->route('admin.profile_sekolah.index')->with('success', 'Profile Sekolah berhasil ditambahkan.');
    }

    public function profileSekolahEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $profileSekolah = profile_sekolah::findOrFail($id);
        return view('admin.profile_sekolah.edit', compact('profileSekolah'));
    }

    public function profileSekolahUpdate(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $profileSekolah = profile_sekolah::findOrFail($id);

        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:40',
            'kepala_sekolah' => 'required|string|max:40',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'npsn' => 'required|string|max:10',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:15',
            'visi_misi' => 'nullable|string',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'deskripsi' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('profile_foto', 'public');
            $validated['foto'] = $fotoPath;
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('profile_logo', 'public');
            $validated['logo'] = $logoPath;
        }

        $profileSekolah->update($validated);

        return redirect()->route('admin.profile_sekolah.index')->with('success', 'Profile Sekolah berhasil diupdate.');
    }

    public function profileSekolahDestroy(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $profileSekolah = profile_sekolah::findOrFail($id);
        $profileSekolah->delete();

        return redirect()->route('admin.profile_sekolah.index')->with('success', 'Profile Sekolah berhasil dihapus.');
    }

    //----gambarproduk----
    public function gambarProdukIndex()
    {
        $gambarProduks = GambarProduk::with('user')->get();
        return view('admin.gambarproduk.index', compact('gambarProduks'));
    }

    public function gambarProdukCreate()
    {
        return view('admin.gambarproduk.create');
    }

    public function gambarProdukStore(Request $request)
    {
        $validated = $request->validate([
            'id_gambar' => 'required|string|max:10|unique:gambar_produks,id_gambar',
            'id_produk' => 'required|exists:produks,id_produk',
            'nama_gambar' => 'required|string|max:100',
        ]);

        $data = $request->only(['judul', 'isi', 'tanggal']);
        $data['id_user'] = Auth::user()->id_user;

        // if ($request->hasFile('gambar')) {
        //     $fotoPath = $request->file('gambar')->store('guru_foto', 'public');
        //     $validated['gambar'] = $fotoPath;
        // }
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('berita_gambar', $filename, 'public');
            $data['gambar'] = 'berita_gambar/' . $filename;
        }

        GambarProduk::create($data);
        return redirect()->route('admin.gambarproduk.index')->with('success', 'Gambar Produk berhasil ditambahkan.');
    }

    public function gambarProdukEdit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $gambarProduk = GambarProduk::findOrFail($id);
        return view('admin.gambarproduk.edit', compact('gambarProduk'));
    }

    public function gambarProdukUpdate(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $gambarProduk = GambarProduk::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['judul', 'isi', 'tanggal']);

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($gambarProduk->gambar && file_exists(storage_path('app/public/' . $gambarProduk->gambar))) {
                unlink(storage_path('app/public/' . $gambarProduk->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('berita_gambar', $filename, 'public');
            $data['gambar'] = 'berita_gambar/' . $filename;
        }

        $gambarProduk->update($data);
        return redirect()->route('admin.gambarproduk.index')->with('success', 'Gambar Produk berhasil diperbarui.');
    }

    public function gambarProdukDestroy(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', 'ID tidak valid.');
        }

        $gambarProduk = GambarProduk::findOrFail($id);
        if ($gambarProduk->gambar && file_exists(storage_path('app/public/' . $gambarProduk->gambar))) {
            unlink(storage_path('app/public/' . $gambarProduk->gambar));
        }
        $gambarProduk->delete();
        return redirect()->route('admin.gambarproduk.index')->with('success', 'Gambar Produk berhasil dihapus.');
    }

}
