    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
        Proyek
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL . 'project' ?>">
          <i class="fas fa-fw fa-plus"></i>
          <span>Tambah Proyek</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Daftar Proyek
      </div>

      <li class="nav-item">
        <a class="nav-link pb-0" href="<?= BASE_URL . 'project/draft' ?>">
          <i class="fas fa-fw fa-folder"></i>
          <span>Draft Proyek</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link pb-0" href="<?= BASE_URL . 'project/vote' ?>">
          <i class="fas fa-fw fa-signal"></i>
          <span>Hitung Proyek</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= BASE_URL . 'project/result_voting' ?>">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Hasil Perhitungan Proyek</span>
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