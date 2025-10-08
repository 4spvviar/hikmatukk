<style>
    body{
      font-family: "Poppins", sans-serif;
      background:#f8f9fa;
    }
    /* --- SIDEBAR --- */
    .sidebar{
      width:260px;
      min-height:100vh;
      background:#ffffff;
      border-right:1px solid #e4e6eb;
      display:flex;
      flex-direction:column;
    }
    /* Header biru */
    .sidebar-header{
      background:#0da150;
      color:#fff;
      padding:1.5rem 1rem;
      display:flex;
      align-items:center;
      gap:.75rem;
      /* background-color: rgba(255, 255, 255, 0.3) !important;
      backdrop-filter: blur(10px); */
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
    }
    /* .sidebar-header .logo-box{
      background:#fff;
      color:#002147;
      font-weight:700;
      font-size:1.2rem;
      border-radius:.25rem;
      padding:.4rem .6rem;
    } */
    .sidebar-header span{
      font-weight:600;
      font-size:1.1rem;
    }

    /* nav menu */
    .sidebar .nav-link{
      color:#5a5c69;
      padding:.65rem 1.25rem;
      display:flex;
      align-items:center;
      gap:.5rem;
      font-weight:500;
      font-size:.95rem;
      transition:all .2s;
    }
    .sidebar .nav-link:hover,
    .sidebar .nav-link.active{
      background:#eaecf4;
      color:#4e73df;
    }

    .sidebar-heading{
      text-transform:uppercase;
      font-size:.75rem;
      color:#b7b9cc;
      padding:1rem 1.25rem .25rem;
      font-weight:700;
    }

    .sidebar-footer{
      margin-top:auto;
      padding:1rem 1.25rem;
      font-size:.8rem;
      color:#b7b9cc;
    }
    .sidebar .nav-linku{
      color:#5a5c69;
      padding:.65rem 1.25rem;
      display:flex;
      align-items:center;
      gap:.5rem;
      font-weight:500;
      font-size:.95rem;
      transition:all .2s;
      text-decoration: none;
    }
    .sidebar .nav-linku:hover,
    .sidebar .nav-linku.active{
      background:#eaecf4;
      color:#cc0b0b;
    }
  </style>
</head>
<body>

<!-- ============ SIDEBAR ============ -->
<div class="sidebar position-fixed" style="top: 0; left: 0; height: 100vh; overflow-y: auto;">
    <!-- header -->
    <div class="sidebar-header">
        {{-- @if($profile->logo)
            <img src="{{ asset('storage/' . $profile->logo) }}" alt="Foto" width="50" height="50" class="rounded-circle">
        @else
            <span class="badge bg-secondary">Tidak ada</span>
        @endif --}}
        <img src="{{ asset('assets/foto/mts tercinta.png') }}" alt="Foto" width="50" height="50" class="rounded-circle">
        <span>RuangAdmin</span>
    </div>

    <!-- menu -->
    <ul class="nav flex-column mt-2">
        <li>
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <div class="sidebar-heading">Features</div>
        <li>
            <a class="nav-link" href="{{ route('admin.user.index') }}"><i class="bi bi-person-circle"></i> User</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.siswa.index') }}"><i class="bi bi-person"></i> Siswa</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.guru.index') }}"><i class="bi bi-person-badge"></i> Guru</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.ekstrakulikuler.index') }}"><i class="bi bi-trophy"></i> Ekstrakulikuler</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.galeri.index') }}"><i class="bi bi-images"></i> Galeri</a>
        </li>
        <li>
          <a class="nav-link" href="{{ route('admin.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('admin.profile_sekolah.index') }}"><i class="bi bi-building"></i> Profile Sekolah</a>
        </li>
        <hr class="my-4" style="border-top: 3px solid rgb(255, 255, 255);">
        <li>
            <a class="nav-linku" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class=" bi bi-box-arrow-right">   Logout</i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>

    <div class="sidebar-footer">
        MTsN 7 Tasikmalaya @1996
    </div>
</div>
