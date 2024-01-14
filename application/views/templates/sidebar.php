    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-default sidebar sidebar-light accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <img src="<?= BASE_THEME . 'images/icon/logo.png' ?>" alt="logo" style="width: 100%; padding: 20px;">
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL . 'dashboard' ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Konten
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link pb-0" href="<?= BASE_URL . 'event' ?>">
          <i class="fas fa-fw fa-list"></i>
          <span>Daftar Event</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL . 'mitra' ?>">
          <i class="fas fa-fw fa-store"></i>
          <span>Mitra</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Pertanyaan
      </div>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL . 'question' ?>">
          <i class="fas fa-fw fa-comments"></i>
          <span>Daftar Pertanyaan</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
