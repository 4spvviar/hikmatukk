@extends('operator.layouts.operator')
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3 px-2">
        <h5 class="fw-bold text-dark">Daftar Siswa</h5>
        <a href="{{ route('operator.siswa.create') }}"
           class="btn btn-primary rounded-3 fw-bold"
           style="background:#0d47a1;">
            Tambah
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr class="text-center">
                        <th width="5%">ID</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Masuk</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswas as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $item->nisn }}</td>
                            <td class="fw-semibold">{{ $item->nama_siswa }}</td>
                            <td>
                                <span class="badge {{ $item->jenis_kelamin == 'Laki-laki' ? 'bg-primary' : 'bg-success' }}">
                                    {{ ucfirst($item->jenis_kelamin) }}
                                </span>
                            </td>
                            <td class="fw-semibold">{{ $item->tahun_masuk }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('operator.siswa.edit', Crypt::encrypt($item->id_siswa)) }}"
                                       class="btn btn-sm btn-warning fw-bold"
                                       data-bs-toggle="tooltip" title="Edit">
                                        <span class="fw-bold">Edit</span>
                                    </a>
                                    <form action="{{ route('operator.siswa.destroy', Crypt::encrypt($item->id_siswa)) }}"
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
                                <i class="fa-solid fa-circle-info"></i> Belum Ada Data Siswa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
