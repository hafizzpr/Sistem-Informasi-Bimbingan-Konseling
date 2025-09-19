 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('siswa') ?>" class="brand-link">
      <span class="brand-text font-weight-light">LOGIN SISWA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">Selamat Datang, <br> <?= $this->session->userdata('nama_lengkap'); ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?=base_url('siswa') ?>" class="nav-link">
              <i class="nav-icon far fas fa-home"></i>
              <p>
                DASHBOARD
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('siswa/jadwalKonseling') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                JADWAL KONSELING
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('siswa/pengajuanKonseling') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                PENGAJUAN KONSELING
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('siswa/pelanggaranSiswa') ?>" class="nav-link">
              <i class="nav-icon far fas fa-bell"></i>
              <p>
                PELANGGARAN SISWA
              </p>
            </a>
          </li>

           <li class="nav-item">
            <a href="<?=base_url('siswa/pengembanganDiri') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                PENGEMBANGAN DIRI
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('siswa/edukasi') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                EDUKASI
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('siswa/laporanPengaduan') ?>" class="nav-link">
              <i class="nav-icon far fas fa-bell"></i>
              <p>
                LAPORKAN PENGADUAN
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link" id="logout-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">LOGOUT</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>