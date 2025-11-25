@extends('layouts.index')
@section('content')

<!-- Section Produk -->
<section id="produk" class="produk">
  <div class="container">
    <!-- Breadcrumb -->
    <div class="row justify-content-center">
        <div class="col-lg-17">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-light p-3 rounded">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-decoration-none">
                            <i class="fas fa-home" style="col"></i> Home
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">
                        Produk
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row g-3">
      @foreach($produks as $produk)
      @if($produk->gambar)
      <!-- Item Galeri -->
      <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="gallery-item">
          <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}" class="img-fluid" data-description="{{ $produk->deskripsi ?? '' }}">
          <div class="overlay">
            <p>{{ $produk->nama_produk }}</p>
          </div>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </div>
</section>

<!-- Modal Detail Produk -->
<div id="produkModal" class="modal">
  <span class="close" id="modalClose">&times;</span>
  <img class="modal-content" id="modalImage">
  <div id="caption"></div>
  <div id="modalDescription" style="color: white; max-width: 80%; margin: 10px auto; text-align: center;"></div>
</div>

<style>
.ekskul{
    padding-top:8%;
    margin-bottom: 5%;
}
.gallery-item {
  position: relative;
  overflow: hidden;
  border-radius: 10px;
  cursor: pointer;
  transition: transform 0.3s ease-in-out;
}
.gallery-item img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  transition: transform 0.3s ease-in-out;
}
.gallery-item:hover img {
  transform: scale(1.1);
}
.gallery-item .overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0,0,0,0.6);
  color: #fff;
  padding: 10px;
  text-align: center;
  opacity: 0;
  transition: opacity 0.3s ease-in-out;
}
.gallery-item:hover .overlay {
  opacity: 1;
}
.modal {
  display: none;
  position: fixed;
  z-index: 9999;
  padding-top: 70px;
  left: 0; top: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.9);
}
.modal-content {
  margin: auto;
  display: block;
  max-width: 60%;
  max-height: 600px;
  border-radius: 10px;
}
#caption {
  margin: 15px auto;
  text-align: center;
  color: #fff;
}
#modalDescription {
  font-size: 1.2rem;
  margin-top: 10px;
}
.close {
  position: absolute;
  top: 20px; right: 35px;
  color: #fff;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
}
.close:hover { color: red; }
.breadcrumb-item + .breadcrumb-item::before {
        color: orange;
    }
    .breadcrumb .fa-home {
        color: #002147;
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

<script>
document.addEventListener('DOMContentLoaded', function () {
  const modal = document.getElementById('ekskulModal');
  const modalImg = document.getElementById('modalImage');
  const captionText = document.getElementById('caption');
  const modalDescription = document.getElementById('modalDescription');
  const closeBtn = document.getElementById('modalClose');

  document.querySelectorAll('.gallery-item img').forEach(img => {
    img.addEventListener('click', function () {
      modal.style.display = 'block';
      modalImg.src = this.src;
      captionText.textContent = this.alt;
      modalDescription.textContent = this.getAttribute('data-description') || '';
    });
  });

  closeBtn.onclick = function () {
    modal.style.display = 'none';
  };

  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };
});
</script>
@endsection
