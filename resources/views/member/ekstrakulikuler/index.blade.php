@extends('operator.layouts.operator')
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3 px-2">
        <h5 class="fw-bold text-dark">Data Ekstrakulikuler</h5>
        <a href="{{ route('operator.ekstrakulikuler.create') }}"
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
                        <th>Nama Ekskul</th>
                        <th>Pembina</th>
                        <th>Jadwal Latihan</th>
                        <th>Deskripsi</th>
                        <th width="">Gambar</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ekstrakulikulers as $ekstrakulikuler)
                        <tr class="text-center">
                            <td>{{ $ekstrakulikuler->id_ekskul }}</td>
                            <td class="">{{ $ekstrakulikuler->nama_ekskul }}</td>
                            <td class="">{{ $ekstrakulikuler->pembina }}</td>
                            <td class="">{{ $ekstrakulikuler->jadwal_latihan }}</td>
                            <td class="">{{ Str::limit($ekstrakulikuler->deskripsi ?? 'Tidak ada', 50) }}</td>
                            <td class="">
                                @if($ekstrakulikuler->gambar)
                                    <img src="{{ asset('storage/' . $ekstrakulikuler->gambar) }}" alt="Gambar" width="50" height="50" class="rounded-circle">
                                @else
                                    <span class="badge bg-secondary">Tidak ada</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('operator.ekstrakulikuler.edit', Crypt::encrypt($ekstrakulikuler->id_ekskul)) }}"
                                       class="btn btn-sm btn-warning fw-bold"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <span class="fw-bold">Edit</span>
                                    </a>
                                    <form action="{{ route('operator.ekstrakulikuler.destroy', Crypt::encrypt($ekstrakulikuler->id_ekskul)) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger fw-bold"
                                                data-bs-toggle="tooltip" title="Hapus">
                                            <span class="fw-bold">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">
                                <i class="fa-solid fa-circle-info"></i> Belum Ada Data Ekstarkulikuler
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
