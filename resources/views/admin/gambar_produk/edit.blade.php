@extends('admin.layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Edit Gambar Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.gambar_produk.update', Crypt::encrypt($gambar_produk->id_gambar)) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="id_gambar" class="form-label">id_gambar</label>
                            <input type="text" class="form-control @error('id_gambar') is-invalid @enderror" id="id_gambar" name="id_gambar" value="{{ old('id_gambar', $gambar_produk->id_gambar) }}" required>
                            @error('id_gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="id_produk" class="form-label">id_produk</label>
                            <textarea class="form-control @error('id_produk') is-invalid @enderror" id="id_produk" name="id_produk" rows="5" required>{{ old('id_produk', $gambar_produk->id_produk) }}</textarea>
                            @error('id_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_gambar" class="form-label">nama_gambar</label>
                            @if($gambar_produk->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $gambar_produk->gambar) }}" alt="Gambar Lama" width="100" height="100" class="rounded">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.gambar_produk.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
