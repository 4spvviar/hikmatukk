@extends('admin.layouts.admin')
@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3 px-2">
        <h5 class="fw-bold text-dark">Daftar Toko</h5>
        <a href="{{ route('admin.toko.create') }}"
           class="btn btn-primary rounded-3 fw-bold"
           style="background:#0d47a1;">
            Tambah
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="5%">ID</th>
                        <th>Nama Toko</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($tokos as $toko)
                        <tr class="text-center">

                            <td>{{ $toko->id_toko }}</td>
                            <td>{{ $toko->nama_toko }}</td>
                            <td>{{ $toko->deskripsi }}</td>

                            <td>
                                @if($toko->gambar)
                                    <img src="{{ asset('storage/' . $toko->gambar) }}"
                                         alt="Gambar Toko" width="50" height="50"
                                         class="rounded">
                                @else
                                    <span class="badge bg-secondary">Tidak ada</span>
                                @endif
                            </td>

                            <td>{{ $toko->kontak_toko }}</td>
                            <td>{{ $toko->alamat }}</td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.toko.edit', Crypt::encrypt($toko->id_toko)) }}"
                                       class="btn btn-sm btn-warning fw-bold">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.toko.destroy', Crypt::encrypt($toko->id_toko)) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus toko ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger fw-bold">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                Belum ada data toko.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
