@extends('operator.layouts.operator')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-dark">
                    <h5 class="mb-0">Edit Ekstrakulikuler</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('operator.ekstrakulikuler.update', Crypt::encrypt($ekstrakulikuler->id_ekskul)) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_ekskul" class="form-label">Nama Ekskul</label>
                            <input type="text" class="form-control @error('nama_ekskul') is-invalid @enderror" id="nama_ekskul" name="nama_ekskul" value="{{ old('nama_ekskul', $ekstrakulikuler->nama_ekskul) }}" required>
                            @error('nama_ekskul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pembina" class="form-label">Pembina</label>
                            <input type="text" class="form-control @error('pembina') is-invalid @enderror" id="pembina" name="pembina" value="{{ old('pembina', $ekstrakulikuler->pembina) }}" required>
                            @error('pembina')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jadwal_latihan" class="form-label">Jadwal Latihan</label>
                            <input type="text" class="form-control @error('jadwal_latihan') is-invalid @enderror" id="jadwal_latihan" name="jadwal_latihan" value="{{ old('jadwal_latihan', $ekstrakulikuler->jadwal_latihan) }}" required>
                            @error('jadwal_latihan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $ekstrakulikuler->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            @if($ekstrakulikuler->gambar)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $ekstrakulikuler->gambar) }}" alt="Gambar Lama" width="100" height="100" class="rounded">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('operator.ekstrakulikuler.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
