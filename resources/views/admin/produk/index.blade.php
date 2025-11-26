@extends('admin.layouts.admin')
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3 px-2">
        <h5 class="fw-bold text-dark">Data Produk</h5>
        <a href="{{ route('admin.produk.create') }}"
           class="btn btn-primary rounded-3 fw-bold"
           style="background:#0d47a1;">
            <i class=""></i>Tambah
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="5%">ID</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th width="10%">Gambar</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $item)
                        <tr class="text-center">
                            <td>{{ $item->id_produk }}</td>
                            <td class="">{{ $item->nama_produk }}</td>
                            <td class="">{{ $item->harga }}</td>
                            <td class="">{{ $item->stok }}</td>
                            <td class="">{{ Str::limit($item->deskripsi ?? 'Tidak ada', 50) }}</td>
                            <td class="">
                                @if($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" width="100" height="100" class="img-thumbnail">
                                @else
                                    <span class="badge bg-secondary">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.produk.edit', Crypt::encrypt($produk->id_produk)) }}"
                                       class="btn btn-sm btn-warning fw-bold"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <span class="fw-bold">Edit</span>
                                    </a>
                                    <form action="{{ route('admin.produk.destroy', Crypt::encrypt($produk->id_produk)) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger fw-bold"
                                                data-bs-toggle="tooltip" title="Hapus">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                <i class="fa-solid fa-circle-info"></i> Belum Ada Data Produk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
