@extends('admin.layouts.admin')
@section('content')


<div class="container mt-4">
    @forelse ($profileSekolahs as $profile)
        <div class="card shadow-lg border-0 mb-4" style="background:#002147 ; border-radius: 15px;">
            <div class="card-body p-5">
                <div class="row align-items-center mb-5">
                    <div class="col-md-3 text-center">
                        @if($profile->logo)
                            <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo Sekolah" class="img-fluid rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff;">
                        @else
                            <img src="{{ asset('assets/foto/logo1.png') }}" alt="Logo Sekolah" class="img-fluid rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff;">
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h1 class="fw-bold text-white mb-2" style="font-size: 2.5rem;">{{ $profile->nama_sekolah }}</h1>
                        {{-- <p class="text-white-50 mb-1" style="font-size: 1.1rem;">NPSN: {{ $profile->npsn }}</p>
                        <p class="text-white-50" style="font-size: 1.1rem;">Didirikan: {{ $profile->tahun_berdiri }}</p> --}}
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h4 class="fw-bold text-white mb-3" style="border-bottom: 2px solid #fff; padding-bottom: 10px;">Deskripsi Singkat</h4>
                        <p class="text-white" style="font-size: 1.1rem; line-height: 1.6;">{{ $profile->deskripsi }}</p>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-4">
                        <h4 class="fw-bold text-white mb-3" style="border-bottom: 2px solid #fff; padding-bottom: 10px;">Foto Marketplace</h4>
                        @if($profile->foto)
                            <img src="{{ asset('storage/' . $profile->foto) }}" alt="Foto Sekolah" class="img-fluid rounded shadow mb-3" style="width: 100%; max-width: 200px; height: auto;">
                        @endif
                        <p class="text-white"><strong>Nama Owner Web:</strong> {{ $profile->kepala_sekolah }}</p>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold text-white mb-3" style="border-bottom: 2px solid #fff; padding-bottom: 10px;">Alamat & Kontak</h4>
                        <p class="text-white mb-2"><i class="fas fa-map-marker-alt me-2"></i><strong>Alamat:</strong> {{ $profile->alamat }}</p>
                        <p class="text-white"><i class="fas fa-phone me-2"></i><strong>Kontak:</strong> {{ $profile->kontak ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="bg-white p-4 rounded shadow-sm">
                            <h4 class="fw-bold mb-3" style="color: #002147;">Visi & Misi</h4>
                            <div class="text-dark" style="font-size: 1.1rem; line-height: 1.6;">
                                {!! nl2br(e($profile->visi_misi)) !!}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-end mt-5">
                    <a href="{{ route('admin.profile_sekolah.edit', Crypt::encrypt($profile->id_profil)) }}" class="btn btn-light btn-lg me-3 shadow" style="border-radius: 25px; font-weight: 600;">Edit Profile</a>
                    <form action="{{ route('admin.profile_sekolah.destroy', Crypt::encrypt($profile->id_profil)) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <!-- <button type="submit" class="btn btn-danger btn-lg shadow" style="border-radius: 25px; font-weight: 600;">Hapus</button> -->
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5">
            <i class="fa-solid fa-building fa-4x text-muted mb-4"></i>
            <h4 class="text-muted mb-3">Belum Ada Data Profile Sekolah</h4>
            <a href="{{ route('admin.profile_sekolah.create') }}" class="btn btn-primary btn-lg shadow" style="border-radius: 25px; font-weight: 600;">Tambah Profile Sekolah</a>
        </div>
    @endforelse
</div>


@endsection
