<nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top" style="background: linear-gradient(to top, #e1e8fd, #7d97f5);">
    <div class="container">
        <a class="navbar-brand" href="/" style="color: #0e0673;"><i class="bi bi-geo-alt-fill fw-bold" style="color: #e1473e"></i> SIG HOMESTAY BALIGE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-1 text-right" id="navbarNav">
            <ul class="navbar-nav ms-auto flex-nowrap">
                <li class="nav-item">
                <a class="nav-link {{ ($active === 'beranda') ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ ($active === 'tentang') ? 'active' : '' }}" href="/tentang">Tentang</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ ($active === 'peta') ? 'active' : '' }}" href="/peta">Peta</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ ($active === 'homestay') ? 'active' : '' }}" href="/homestay">Homestay</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ ($active === 'wisata') ? 'active' : '' }}" href="/wisata">Wisata</a>
                </li>
                <li class="nav-item">
                <a class="nav-link {{ ($active === 'hubungi-kami') ? 'active' : '' }}" href="/hubungi-kami">Hubungi Kami</a>
                </li>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome back, {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar"></i> Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        {{-- <li class="nav-item">
                            <a href="/login" class="nav-link {{ ($active === 'login') ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li> --}}
                    @endauth
                </ul>
            </ul>
        </div>
    </div>
</nav>

<!-- Navigation -->
{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light shadow fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav> --}}