@extends('admin.layouts.admin')
@section('content')
<div class="container-fluid px-4">
    <h1 class="h2 mb-4"></h1>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6" onclick="{{ route('admin.user.index') }}">
            <div class="card text-white border-0 shadow-lg stat-card" style="background: linear-gradient(135deg,#4e73df,#224abe);">
                <div class="card-body position-relative overflow-hidden">
                    <i class="bi bi-person-circle fa-3x position-absolute opacity-25 top-50 end-0 translate-middle-y me-3"></i>
                    <p class="mb-1 fw-bold">User</p>
                    <h3 class="mb-0">{{ $countUser }}</h3>
                    <small class="text-light">Total User</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-lg stat-card" style="background: linear-gradient(135deg,#1cc88a,#0f9d58);">
                <div class="card-body position-relative overflow-hidden">
                    <i class="bi bi-person fa-3x position-absolute opacity-25 top-50 end-0 translate-middle-y me-3"></i>
                    <p class="mb-1 fw-bold">Kategori</p>
                    <h3 class="mb-0">{{ $countKategori }}</h3>
                    <small class="text-light">Total Kategori</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-lg stat-card" style="background: linear-gradient(135deg,#f6c23e,#d39e00);">
                <div class="card-body position-relative overflow-hidden">
                    <i class="bi bi-person-badge fa-3x position-absolute opacity-25 top-50 end-0 translate-middle-y me-3"></i>
                    <p class="mb-1 fw-bold">Toko</p>
                    <h3 class="mb-0">{{ $countToko }}</h3>
                    <small class="text-light">Total Toko</small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-lg stat-card" style="background: linear-gradient(135deg,#36b9cc,#117a8b);">
                <div class="card-body position-relative overflow-hidden">
                    <i class="bi bi-trophy fa-3x position-absolute opacity-25 top-50 end-0 translate-middle-y me-3"></i>
                    <p class="mb-1 fw-bold">Produk</p>
                    <h3 class="mb-0">{{ $countProduk }}</h3>
                    <small class="text-light">Total Produk</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card text-white border-0 shadow-lg stat-card" style="background: linear-gradient(135deg,#e74a3b,#c0392b);">
                <div class="card-body position-relative overflow-hidden">
                    <i class="bi bi-images fa-3x position-absolute opacity-25 top-50 end-0 translate-middle-y me-3"></i>
                    <p class="mb-1 fw-bold">Galeri</p>
                    <h3 class="mb-0">{{ $countGaleri }}</h3>
                    <small class="text-light">Total Galeri</small>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-white border-0 shadow-lg stat-card" style="background: linear-gradient(135deg,#6f42c1,#5a32a3);">
                <div class="card-body position-relative overflow-hidden">
                    <i class="bi bi-building fa-3x position-absolute opacity-25 top-50 end-0 translate-middle-y me-3"></i>
                    <p class="mb-1 fw-bold">Profile Sekolah</p>
                    <h3 class="mb-0">{{ $countProfileSekolah }}</h3>
                    <small class="text-light">Total Profile Sekolah</small>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-white border-0 shadow-lg stat-card" style="background: linear-gradient(135deg,#fd7e14,#e8680f);">
                <div class="card-body position-relative overflow-hidden">
                    <i class="bi bi-newspaper fa-3x position-absolute opacity-25 top-50 end-0 translate-middle-y me-3"></i>
                    <p class="mb-1 fw-bold">Gambar Produk</p>
                    <h3 class="mb-0">{{ $countGambarProduk }}</h3>
                    <small class="text-light">Total Gambar Produk</small>
                </div>
            </div>
        </div>
    </div>

<style>
.stat-card {
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.stat-card:hover {
    transform: translateY(5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}
</style>
<style>
    .table-row-hover:hover {
        background-color: rgba(0, 242, 254, 0.05);
        transition: background-color 0.3s ease;
    }
</style>

</div>
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@endsection
