@extends('layouts.index')
@section('content')
<!-- Section Utama -->
@if ($profile)
<section class="banner-area">
    <div class="overlay">
        <div class="container text-center">
            <h1 class="sma1">{{ $profile->nama_sekolah }}</h1>
            <form action="" method="" class="search-form">
                <input type="text" placeholder="Apa yang ingin anda cari?" name="">
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
</section>
@endif

<!-- Profile Section -->
@if($profile)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold text-black">Tentang Kami</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 text-center mb-4 mb-lg-0">
                @if($profile->foto)
                    <img src="{{ asset('assets/' . $profile->foto) }}"
                         alt="Foto Sekolah"
                         class="img-fluid rounded shadow">
                @endif
            </div>
            <div class="col-lg-6">
                <h6 class="text-uppercase text-muted">Profile</h6>
                <h2 class="fw-bold">{{ $profile->nama_sekolah }}</h2>
                <p class="mb-4 text-black">{{ $profile->deskripsi }}</p>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 h-100">
                            <h6 class="fw-bold">
                                <i class="fas fa-map-marker-alt"></i> Alamat
                            </h6>
                            <p class="mb-0">{{ $profile->alamat }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 h-100">
                            <h6 class="fw-bold">
                                <i class="fas fa-phone"></i> Kontak
                            </h6>
                            <p class="mb-0">{{ $profile->kontak ?? 'Tidak tersedia' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm p-3 h-100">
                            <h6 class="fw-bold">
                                <i class="fas fa-calendar-alt"></i> Tahun Berdiri
                            </h6>
                            <p class="mb-0">{{ $profile->tahun_berdiri }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Gambar Produk -->
@if(isset($gambarProduks) && $gambarProduks->count() > 0)
<section class="py-5" style="background:#002147;">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold text-white">Gambar Produk</h2>
        <div class="row justify-content-center">
            @foreach($gambarProduks as $gambarProduk)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm overflow-hidden">
                    @if($gambarProduk->gambar)
                    <div class="position-relative">
                        <img src="{{ asset('storage/' . $gambarProduk->gambar) }}"
                             class="card-img-top"
                             alt="{{ $gambarProduk->judul }}"
                             style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 start-0 bg-dark bg-opacity-75 text-warning p-3"
                             style="width: 80px; height: 80px; border-radius: 0 0 1rem 0;">
                            <div class="fs-5 fw-bold">
                                {{ \Carbon\Carbon::parse($gambarProduk->tanggal)->format('d') }}
                            </div>
                            <div class="small">
                                {{ \Carbon\Carbon::parse($gambarProduk->tanggal)->format('M') }}
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $gambarProduk->judul }}</h5>
                        <p class="card-text flex-grow-1" style="max-height:4.5rem;overflow:hidden;">
                            {{ \Illuminate\Support\Str::limit(strip_tags($gambarProduk->isi), 100, '...') }}
                        </p>
                        <hr class="my-4">
                        <small class="text-muted d-flex justify-content-between align-items-center w-100">
                            <span><i class="fas fa-user"></i> {{ $gambarProduk->user ? $gambarProduk->user->name : 'admin' }}</span>
                            <a href="{{ url('/gambarProduk/' . $gambarProduk->id) }}" class="btnd">Detail</a>
                        </small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Gallery -->
@if(isset($galeris) && $galeris->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold">Galeri</h2>
        <div class="row justify-content-center">
            @foreach($galeris->take(4) as $galeri)
            <div class="col-6 col-md-3 mb-4">
                <div class="card border shadow-sm text-center overflow-hidden h-100">
                    @if($galeri->kategori === 'video')
                        <video class="card-img-top" controls style="height:180px;object-fit:cover;">
                            <source src="{{ asset('storage/' . $galeri->file) }}" type="video/mp4">
                            Browser tidak mendukung video.
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $galeri->file) }}"
                             class="card-img-top"
                             alt="{{ $galeri->judul }}"
                             style="height:180px;object-fit:cover;">
                    @endif
                    <div class="card-body p-2">
                        <p class="card-text text-truncate" style="font-size:0.9rem;">{{ $galeri->judul }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Produk -->
@if(isset($produk) && $produk->count() > 0)
<section class="py-5" style="background:#002147;">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold text-white">Produk</h2>
        <div class="row justify-content-center">
            @foreach($produk->take(3) as $produk)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm overflow-hidden">
                    @if($produk->gambar)
                        <img src="{{ asset('storage/' . $produk->gambar) }}"
                             class="card-img-top"
                             alt="{{ $produk->nama_produk }}"
                             style="height:250px;object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $produk->nama_produk }}</h5>
                        <p class="card-text flex-grow-1" style="max-height:4.5rem;overflow:hidden;">
                            {{ \Illuminate\Support\Str::limit(strip_tags($produk->deskripsi), 100, '...') }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Admins -->
@if(isset($admins) && $admins->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold text-black">Admins</h2>
        <div id="adminsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($admins->chunk(4) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row justify-content-center">
                        @foreach($chunk as $admin)
                        <div class="col-6 col-md-3 col-lg-2 mb-4">
                            <div class="card h-100 shadow-sm overflow-hidden">
                                @if($admin->foto)
                                    <img src="{{ asset('storage/' . $admin->foto) }}"
                                         class="card-img-top"
                                         alt="{{ $admin->nama }}"
                                         style="height:250px;object-fit:cover;">
                                @else
                                    <img src="{{ asset('assets/foto/guru.jpg') }}"
                                         class="card-img-top"
                                         alt="No Photo"
                                         style="height:250px;object-fit:cover;">
                                @endif
                                <div class="card-body text-center">
                                    <h5 class="card-title fw-bold">{{ $admin->nama }}</h5>
                                    <p class="card-text">{{ $admin->role }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#adminsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#adminsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endif

<!-- Data Admin & Members -->
<section class="py-5" style="background:#1196ad;">
    <div class="container">
        <h2 class="text-center mb-4 fw-bold text-white">Data Produk</h2>
        <div class="row justify-content-center g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm text-center p-4">
                    <i class="fas fa-box-open fa-3x mb-3 text-primary"></i>
                    <h3 class="fw-bold">{{ $admins->count() }}</h3>
                    <p class="mb-0">Total Produk</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm text-center p-4">
                    <i class="fas fa-box-open fa-3x mb-3 text-success"></i>
                    <h3 class="fw-bold">{{ $members->count() }}</h3>
                    <p class="mb-0">Total Produk Tersedia</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Comment -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-start mb-4 fw-bold">
            <h2>Kotak Saran</h2>
            <p class="mb-3 small fst-italic text-muted">
                Your email address will not be published. Required fields are marked <span class="text-danger">*</span>
            </p>
            <form action="" method="" id="comment" class="comment">
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment <span class="text-danger">*</span></label>
                    <textarea name="comment" id="comment" class="form-control" rows="6" maxlength="65525" required></textarea>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6 col-lg-4">
                        <label for="author" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" id="author" name="author" class="form-control" maxlength="245" autocomplete="name" required>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" maxlength="100" autocomplete="email" required>
                    </div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="save-info" name="save-info" checked>
                    <label class="form-check-label" for="save-info">Save my name, email, and website in this browser for the next time I comment.</label>
                </div>
                <button type="submit" class="btn text-white" style="">Post Comment
                    <i class="fa fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<style>
.btn{
    background: #002147;
}
.btnd {
    display: inline-block;
    font-size: 0.8rem;
    font-weight: 500;
    padding: 4px 10px;
    color: #fff;
    background-color: #002147;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btnd:hover {
    background-color: #014080;
    text-decoration: none;
    color: #fff;
}
.carousel-control-prev-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23000000' viewBox='0 0 8 8'%3e%3cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3e%3c/svg%3e");
}
.carousel-control-next-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23000000' viewBox='0 0 8 8'%3e%3cpath d='M2.75 0l4 4-4 4-1.5-1.5 2.5-2.5-2.5-2.5 1.5-1.5z'/%3e%3c/svg%3e");
}
.banner-area {
    position: relative;
    background-image: url('/assets/foto/market.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}
.banner-area .overlay {
    background: rgba(0, 0, 0, 0.3);
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.sma1 {
    font-size: 48px;
    font-weight: bold;
    margin-bottom: 30px;
}
.search-form {
    display: flex;
    justify-content: center;
    max-width: 700px;
    margin: 0 auto;
    background: white;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}
.search-form input {
    flex: 1;
    border: none;
    padding: 15px 20px;
    font-size: 16px;
    outline: none;
}
.search-form button {
    background: #f7b500;
    border: none;
    padding: 0 30px;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
}
.search-form button:hover {
    background: #e0a000;
}
@media (max-width: 768px) {
    .sma1 {
        font-size: 32px;
    }
    .search-form {
        flex-direction: column;
        border-radius: 15px;
    }
    .search-form input {
        border-bottom: 1px solid #ddd;
    }
    .search-form button {
        width: 100%;
        border-radius: 0;
        padding: 12px;
    }
}
</style>
@endsection
