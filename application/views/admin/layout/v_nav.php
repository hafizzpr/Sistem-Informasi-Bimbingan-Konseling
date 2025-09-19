 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin') ?>" class="brand-link">
      <span class="brand-text font-weight-light">LOGIN ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
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
            <a href="<?=base_url('admin') ?>" class="nav-link">
              <i class="nav-icon far fas fa-home"></i>
              <p>
                DASHBOARD
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                MASTER DATA
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('admin/dataSiswa') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DATA SISWA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/dataGuru') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DATA GURU</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/dataPelanggaran') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DATA PELANGGARAN</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/dataSemester') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DATA SEMESTER</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('admin/jadwalKonseling') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                JADWAL KONSELING
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('admin/pengajuanKonseling') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                PENGAJUAN KONSELING
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('admin/pelanggaranSiswa') ?>" class="nav-link">
              <i class="nav-icon far fas fa-bell"></i>
              <p>
                PELANGGARAN SISWA
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('admin/laporanPengaduan') ?>" class="nav-link">
              <i class="nav-icon far fas fa-bell"></i>
              <p>
                LAPORKAN PENGADUAN
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('admin/pengembanganDiri') ?>" class="nav-link">
              <i class="nav-icon far fas fa-bell"></i>
              <p>
                PENGEMBANGAN DIRI
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('admin/edukasi') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                EDUKASI
              </p>
            </a>
          </li>

          <li class="nav-header">LAPORAN</li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                LAPORAN
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url('admin/laporanJadwalKonseling') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>JADWAL KONSELING</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/laporanPelanggaranSiswa') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PELANGGARAN SISWA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('admin/laporanPengajuanKonseling') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PENGAJUAN KONSELING</p>
                </a>
              </li>              
            </ul>
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