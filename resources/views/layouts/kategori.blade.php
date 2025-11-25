@extends('layouts.index')
@section('content')

<style>
.guru {
    padding-top: 8%;
    margin-bottom: 5%;
}

/* Thumbnail gambar guru */
.thumb {
    max-width: 900px;
    margin: 0 auto 30px auto;
    overflow: hidden;
    position: relative;
    text-align: center;
}
.thumb img.img {
    max-width: 100%;
    height: auto;
    display: inline-block;
}

/* Table guru */
.table-responsive {
    max-width: 900px;
    margin: 0 auto;
}
.table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #333;
}
.table thead tr {
    background-color: #f8f9fa;
}
.table th, .table td {
    border: 1px solid #dee2e6;
    padding: 12px 15px;
    text-align: left;
}
.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}
.table tbody tr:hover {
    background-color: #e9ecef;
}
.breadcrumb-item + .breadcrumb-item::before {
        color: orange;
    }
    .breadcrumb .breadcrumb-item a {
        color: #002147;
        font-weight: 600;
    }

    .breadcrumb .breadcrumb-item a:hover {
        color: #002147;
        text-decoration: underline;
    }
</style>

@if(isset($gurus) && $gurus->count() > 0)
<section class="guru">
    <div class="container">
        <!-- Breadcrumb sejajar dengan konten -->
        <div class="table-responsive mb-4" style="max-width:900px; margin:0 auto;">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light p-3 rounded">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-decoration-none">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">
                        Toko
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Thumbnail -->
        {{-- <div class="thumb">
            <a href="#">
                <img class="img" src="https://sman1yogya.sch.id/assets/images/uploads/page/guru.jpg" alt="Guru">
            </a>
        </div> --}}

        <!-- Tabel Tenaga Pendidik -->
        <div class="table-responsive">
            <h2 class="fw-bold mb-4">Toko</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">No</th>
                        <th scope="col" style="width: 25%;">Nama Toko</th>
                        <th scope="col" style="width: 30%;">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tokos as $index => $toko)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $toko->nama_toko }}</td>
                        <td>{{ $toko->deskripsi }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</section>
@endif

@endsection
