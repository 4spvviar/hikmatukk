<footer style="background-color: #004715;" class="text-white pt-5 pb-4">
    <div class="container">
        <div class="row gy-4">

            {{-- Logo & Deskripsi --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    @if($profile->logo)
                        <img src="{{ asset('storage/' . $profile->logo) }}"
                             alt="Logo Sekolah"
                             height="70"
                             class="me-3">
                    @endif
                    <h5 class="fw-bold m-0">{{ $profile->nama_sekolah }}</h5>
                </div>

                @if ($profile->deskripsi)
                    <p>{{ $profile->deskripsi }}</p>
                @endif

                {{-- Sosial Media --}}
                <div class="social-icons">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>

            {{-- Last News --}}
            @if (isset($beritas) && $beritas->count() > 0)
                <div class="col-12 col-md-6 col-lg-4">
                    <h5 class="fw-bold mb-3">Last News</h5>
                    <ul class="list-unstyled">
                        @foreach ($beritas->take(2) as $berita)
                            <li class="mb-3">
                                <small>{{ $berita->tanggal }}</small>
                                <h6 class="fw-bold" style="color: #f7b500">{{ $berita->judul }}</h6>
                                <p class="text-white small mb-0">
                                    Berikut ini pembagian ruang seleksi mata pelajaran pilihan...
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Galeri --}}
            @if (isset($galeris) && $galeris->count() > 0)
                <div class="col-12 col-md-6 col-lg-4">
                    <h5 class="fw-bold mb-3">Gallery</h5>
                    <ul class="list-unstyled">
                        @foreach ($galeris->take(2) as $galeri)
                            <li class="mb-3">
                                <small>{{ $galeri->tanggal }}</small>
                                <h6 class="fw-bold" style="color: #f7b500">{{ $galeri->judul }}</h6>
                                <p class="text-white small mb-0">
                                    Pembagian laporan hasil belajar siswa akan dilaksanakan...
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>

    <hr class="my-4 text-white">

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-white mb-0 small">
                    &copy; Copyright 2019.
                    All Rights Reserved By <span class="text-info fw-bold">ICT Teladan</span>
                </p>
            </div>
        </div>
    </div>
</footer>
