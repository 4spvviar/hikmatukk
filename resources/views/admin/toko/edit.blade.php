@extends('admin.layouts.admin')

@section('content')
<div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Toko</h5>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.toko.update', Crypt::encrypt($toko->id_toko)) }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')


                        {{-- NAMA TOKO --}}
                        <div class="mb-3">
                            <label class="form-label">Nama Toko</label>
                            <input type="text"
                                   name="nama_toko"
                                   class="form-control @error('nama_toko') is-invalid @enderror"
                                   value="{{ old('nama_toko', $toko->nama_toko) }}"
                                   required>

                            @error('nama_toko')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- DESKRIPSI --}}
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      required>{{ old('deskripsi', $toko->deskripsi) }}</textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- KONTAK TOKO --}}
                        <div class="mb-3">
                            <label class="form-label">Kontak Toko</label>
                            <input type="text"
                                   name="kontak_toko"
                                   class="form-control @error('kontak_toko') is-invalid @enderror"
                                   value="{{ old('kontak_toko', $toko->kontak_toko) }}"
                                   required>

                            @error('kontak_toko')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        {{-- GAMBAR --}}
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file"
                                   name="gambar"
                                   class="form-control @error('gambar') is-invalid @enderror"
                                   accept="image/*">

                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($toko->gambar)
                                <div class="mt-2">
                                    <small class="text-muted">Gambar saat ini:</small><br>
                                    <img src="{{ asset('storage/' . $toko->gambar) }}"
                                         width="80"
                                         height="80"
                                         class="rounded border">
                                </div>
                            @endif
                        </div>


                        {{-- TOMBOL --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.toko.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
@endsection
