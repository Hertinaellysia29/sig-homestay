<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">

      @can('admin')

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Administrator</span>
        </h6>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/homestay*') ? 'active' : '' }}" href="/dashboard/homestay">
              <span data-feather="book-open"></span>
              Homestay
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/wisata*') ? 'active' : '' }}" href="/dashboard/wisata">
              <span data-feather="book-open"></span>
              Wisata
            </a>
          </li>

          
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/desa*') ? 'active' : '' }}" href="/dashboard/desa">
              <span data-feather="book-open"></span>
              Desa
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/user*') ? 'active' : '' }}" href="/dashboard/user">
              <span data-feather="user"></span>
              User
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/">
              <span data-feather="arrow-left"></span>
              Halaman Utama
            </a>
          </li>
        </ul>

      @else

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Pemilik Homestay</span>
        </h6>

        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/homestay*') ? 'active' : '' }}" href="/dashboard/homestay">
              <span data-feather="book-open"></span>
              Homestay
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard/pemilik-homestay*') ? 'active' : '' }}" href="/dashboard/pemilik-homestay">
              <span data-feather="user"></span>
              Akun
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/">
              <span data-feather="arrow-left"></span>
              Halaman Utama
            </a>
          </li>
        </ul>

      @endcan


    </div>
  </nav>
