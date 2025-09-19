 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('guru') ?>" class="brand-link">
      <span class="brand-text font-weight-light">LOGIN GURU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
           <a href="#" class="d-block">Selamat Datang, <br> <?= $this->session->userdata('nama_guru'); ?></a>
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
       <?php $status_guru = $this->session->userdata('status_guru'); ?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?=base_url('guru') ?>" class="nav-link">
              <i class="nav-icon far fas fa-home"></i>
              <p>
                DASHBOARD
              </p>
            </a>
          </li>

          <?php if ($status_guru == 'bk') { ?>
            <li class="nav-item">
            <a href="<?=base_url('guru/jadwalKonseling') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                JADWAL KONSELING
              </p>
            </a>
          </li>
          

          <li class="nav-item">
            <a href="<?=base_url('guru/pengajuanKonseling') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                PENGAJUAN KONSELING
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('guru/pelanggaranSiswa') ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>PELANGGARAN SISWA</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('guru/pengembanganDiri') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                PENGEMBANGAN DIRI
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?=base_url('guru/edukasi') ?>" class="nav-link">
              <i class="nav-icon far fas fa-calendar"></i>
              <p>
                EDUKASI
              </p>
            </a>
          </li>
          <?php } else {
            
          } ?>

          <li class="nav-item">
            <a href="<?=base_url('guru/laporanPengaduan') ?>" class="nav-link">
              <i class="nav-icon far fas fa-bell"></i>
              <p>
                LAPORKAN PENGADUAN
              </p>
            </a>
          </li>

           <?php if ($status_guru == 'bk') { ?>

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
                <a href="<?=base_url('guru/laporanJadwalKonseling') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>JADWAL KONSELING</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('guru/laporanPelanggaranSiswa') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PELANGGARAN SISWA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url('guru/laporanPengajuanKonseling') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PENGAJUAN KONSELING</p>
                </a>
              </li>              
            </ul>
          </li>
          <?php } else {
            
          } ?>
          
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