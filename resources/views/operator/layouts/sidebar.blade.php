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
    }
    .sidebar-header .logo-box{
      background:#fff;
      color:#0d47a1;
      font-weight:700;
      font-size:1.2rem;
      border-radius:.25rem;
      padding:.4rem .6rem;
    }
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
<div class="sidebar">
    <!-- header -->
    <div class="sidebar-header">
        <img src="{{ asset('assets/foto/mts tercinta.png') }}" alt="Logo" height="50" class="rounded-circle">
        <span>OperatorCon</span>
    </div>

    <!-- menu -->
    <ul class="nav flex-column mt-2">
        <li>
            <a class="nav-link" href="{{ route('operator.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <div class="sidebar-heading">Features</div>
        <li>
            <a class="nav-link" href="{{ route('operator.siswa.index') }}"><i class="bi bi-person"></i> Siswa</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('operator.ekstrakulikuler.index') }}"><i class="bi bi-trophy"></i> Ekstrakulikuler</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('operator.galeri.index') }}"><i class="bi bi-images"></i> Galeri</a>
        </li>
        <li>
            <a class="nav-link" href="{{ route('operator.berita.index') }}"><i class="bi bi-newspaper"></i> Berita</a>
        </li>
        <hr class="my-4">
        <li>
            <a class="nav-linku" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"> Logout</i>
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
