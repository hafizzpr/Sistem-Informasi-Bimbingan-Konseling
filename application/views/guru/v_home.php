<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">DASHBOARD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('guru') ?>">HOME</a></li>
              <li class="breadcrumb-item active">DASHBOARD</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <?php $status_guru = $this->session->userdata('status_guru'); ?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-6">
            <div class="card card-primary card-outline">
              <?php foreach ($dataGuru as $key => $value) { ?>
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?= base_url('assets/image/foto_guru/' .$value->foto_guru) ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $value->nama_guru ?></h3>

                <p class="text-muted text-center"><?= $value->nip ?> </p>

                <center>
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $value->guru_id ?>" >Edit Data</button>
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#pass<?= $value->user_id ?>" >Edit Password</button>
                </center>
              </div>
              <?php } ?>
            </div>
          </div>

            <?php if ($status_guru == 'bk') { ?>
              <?php
                $jumlahSiswa = isset($jumlahSiswa) ? $jumlahSiswa : [];
                $jumlahPelanggaran = isset($jumlahPelanggaran) ? $jumlahPelanggaran : [];
                ?>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                <div id="kelasCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <div class="row">
                        <?php if (count($jumlahSiswa) > 0): ?>
                          <?php foreach ($jumlahSiswa as $siswa): ?>
                            <div class="col-lg-4 mb-3">
                              <div class="small-box bg-info p-3 rounded">
                                <div class="inner">
                                  <h3>Kelas <?= htmlspecialchars($siswa->kelas) ?> : <?= (int)$siswa->jumlah ?> <br> siswa</h3>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-person"></i>
                                </div>
                                <a href="<?= base_url('guru/dataSiswa/' . urlencode($siswa->kelas)) ?>" class="small-box-footer d-block mt-2 text-white">
                                  More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <div class="col-12">
                            <div class="alert alert-info">Tidak ada data jumlah siswa.</div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>

                    <div class="carousel-item">
                      <div class="row">
                        <?php if (count($jumlahPelanggaran) > 0): ?>
                          <?php foreach ($jumlahPelanggaran as $pel): ?>
                            <div class="col-lg-4 mb-3">
                              <div class="small-box bg-danger p-3 rounded">
                                <div class="inner">
                                  <h3><?= htmlspecialchars($pel->kelas) ?> : <?= (int)$pel->total_poin ?> poin</h3>
                                  <p>Total Pelanggaran</p>
                                </div>
                                <div class="icon">
                                  <i class="ion ion-alert"></i>
                                </div>
                                <a href="<?= base_url('guru/datapelanggaranSiswa/' . urlencode($pel->kelas)) ?>" class="small-box-footer d-block mt-2 text-white">
                                  More info <i class="fas fa-arrow-circle-right"></i>
                                </a>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <div class="col-12">
                            <div class="alert alert-warning">Tidak ada data pelanggaran. (Menampilkan 0 untuk tiap kelas yang tidak punya pelanggaran)</div>
                          </div>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>

                  <!-- Kontrol -->
                  <button class="carousel-control-prev" type="button" data-bs-target="#kelasCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#kelasCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
              <?php } else { ?>
                <?php if (count($jumlahSiswa) > 0): ?>
                  <?php foreach ($jumlahSiswa as $siswa): ?>
                    <div class="col-lg-4 col-6 mb-3">
                      <div class="small-box bg-info p-3 rounded">
                        <div class="inner">
                          <h3>Kelas <?= htmlspecialchars($siswa->kelas) ?> : <?= (int)$siswa->jumlah ?> <br> siswa</h3>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person"></i>
                        </div>
                        <a href="<?= base_url('guru/dataKelasSiswa/' . urlencode($siswa->kelas)) ?>" class="small-box-footer d-block mt-2 text-white">
                          More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <div class="col-12">
                    <div class="alert alert-info">Tidak ada data jumlah siswa.</div>
                  </div>
                <?php endif; ?>
              <?php } ?>

            <?php if ($status_guru == 'bk') { ?>
            <div class="col-lg-6 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?= $totalJadwal ?></h3>

                  <p>Total Jadwal Konseling</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?= base_url('guru/jadwalKonseling') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-6 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?= $totalKonseling ?></h3>

                  <p>Total Pengajuan Konseling</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= base_url('guru/pengajuanKonseling') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
             <?php } else {
            
            } ?>
          </div>

          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total Poin Pelanggaran per Semester</h3>
              </div>
              <div class="card-body">
                <canvas id="chartPoinSemester" height="100"></canvas>

                <script>
                  // Ambil data langsung dari PHP
                  var labels = <?= json_encode(array_column($poinSemester, 'nama_semester')) ?>;
                  var totalPoin = <?= json_encode(array_map('intval', array_column($poinSemester, 'total_poin'))) ?>;

                  var ctx = document.getElementById('chartPoinSemester').getContext('2d');
                  new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: labels,
                      datasets: [{
                        label: 'Total Poin Pelanggaran per Semester',
                        data: totalPoin,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                      }]
                    },
                    options: {
                      responsive: true,
                      scales: {
                        y: {
                          beginAtZero: true,
                          title: {
                            display: true,
                            text: 'Total Poin'
                          }
                        },
                        x: {
                          title: {
                            display: true,
                            text: ''
                          }
                        }
                      }
                    }
                  });
                </script>
              </div>

              <div class="card-body">
                  <canvas id="chartJenisPelanggaran" height="100"></canvas>
                  <script>
                      // Ambil data dari PHP
                      var labels = <?= json_encode(array_column($jenisPelanggaran, 'nama_pelanggaran')) ?>;
                      var jumlahPelanggaran = <?= json_encode(array_map('intval', array_column($jenisPelanggaran, 'jumlah'))) ?>;

                      var ctx = document.getElementById('chartJenisPelanggaran').getContext('2d');
                      new Chart(ctx, {
                          type: 'bar',
                          data: {
                              labels: labels,
                              datasets: [{
                                  label: 'Jumlah Pelanggaran per Jenis',
                                  data: jumlahPelanggaran,
                                  backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                  borderColor: 'rgba(54, 162, 235, 1)',
                                  borderWidth: 1
                              }]
                          },
                          options: {
                              responsive: true,
                              scales: {
                                  y: {
                                      beginAtZero: true,
                                      title: {
                                          display: true,
                                          text: 'Jumlah Pelanggaran'
                                      }
                                  },
                                  x: {
                                      title: {
                                          display: true,
                                          text: 'Jenis Pelanggaran'
                                      }
                                  }
                              }
                          }
                      });
                  </script>
              </div>
            </div>
          </div>
        </div>

        <?php if ($status_guru == 'bk') { ?>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Pelanggaran Siswa Tertinggi</h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Siswa</th>
                      <th class="text-center">Poin Pengurangan</th>
                    </tr>
                    </thead>
                    <tbody>
                          <?php $no=1; foreach ($top_pelanggaran as $key => $value) { ?>
                              <tr>
                                  <td class="text-center"><?= $no++ ?></td>
                                  <td class="text-center"><?= $value->nama_lengkap?></td>
                                  <td class="text-center"><?= $value->total_poin ?></td>
                              </tr>
                          <?php } ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Jadwal Konseling</h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Siswa</th>
                      <th class="text-center">Jadwal</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($dataKonseling as $value): ?>
                            <?php
                                $tanggal_konseling = date('Y-m-d', strtotime($value->tanggal));
                                $waktu_konseling   = date('H:i', strtotime($value->waktu));
                                $sekarang_tanggal  = date('Y-m-d');
                                $sekarang_waktu    = date('H:i');

                                $peringatan = '';
                                $selisih_hari = (strtotime($tanggal_konseling) - strtotime($sekarang_tanggal)) / (60 * 60 * 24);

                                // PERINGATAN: jika jadwal hari ini dan waktunya sudah tiba
                                if ($tanggal_konseling == $sekarang_tanggal && $waktu_konseling <= $sekarang_waktu) {
                                    $peringatan = '<div class="alert alert-danger p-1 m-0"><small>🔔 Jadwal Konseling Sedang Berlangsung atau Waktunya Tiba!</small></div>';
                                }

                                // LABEL TANGGAL
                                if ($selisih_hari == 0) {
                                    $label = '<span class="badge bg-success">Hari Ini</span>';
                                } elseif ($selisih_hari == 1) {
                                    $label = '<span class="badge bg-info">Besok</span>';
                                } elseif ($selisih_hari == 2) {
                                    $label = '<span class="badge bg-warning">2 Hari Lagi</span>';
                                } elseif ($selisih_hari > 2) {
                                    $label = '<span class="badge bg-secondary">'. $selisih_hari .' Hari Lagi</span>';
                                } else {
                                    $label = '';
                                }
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $value->nama_lengkap ?></td>
                                <td class="text-center">
                                    <?= date('d F Y', strtotime($value->tanggal)) ?>
                                    - <?= $waktu_konseling ?><br>
                                    <?= $label ?>
                                    <?= $peringatan ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('guru/viewJadwalKonseling/' . $value->jadwal_id) ?>" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pengajuan Konseling</h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Siswa</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                          <?php $no = 1; foreach ($dataPengajuan as $value): ?>
                              <?php
                                  $tgl_pengajuan = date('Y-m-d', strtotime($value->tanggal_pengajuan));
                                  $hari_ini       = date('Y-m-d');
                                  $selisih_hari   = (strtotime($tgl_pengajuan) - strtotime($hari_ini)) / (60 * 60 * 24);

                                  // Label Hari
                                  if ($selisih_hari == 0) {
                                      $label = '<span class="badge bg-success">Hari Ini</span>';
                                  } elseif ($selisih_hari == 1) {
                                      $label = '<span class="badge bg-info">Besok</span>';
                                  } elseif ($selisih_hari == 2) {
                                      $label = '<span class="badge bg-warning">2 Hari Lagi</span>';
                                  } elseif ($selisih_hari > 2) {
                                      $label = '<span class="badge bg-secondary">' . $selisih_hari . ' Hari Lagi</span>';
                                  } else {
                                      $label = '<span class="badge bg-danger">Sudah Lewat</span>';
                                  }
                              ?>
                              <tr>
                                  <td class="text-center"><?= $no++ ?></td>
                                  <td class="text-center"><?= $value->nama_lengkap ?></td>
                                  <td class="text-center">
                                      <?= date('d-m-Y', strtotime($value->tanggal_pengajuan)) ?><br>
                                      <?= $label ?>
                                  </td>
                                  <td class="text-center">
                                      <span class="badge bg-warning"><?= $value->status ?></span>
                                  </td>
                                  <td class="text-center">
                                      <a href="<?= base_url('guru/viewPengajuan/' . $value->pengajuan_id) ?>" class="btn btn-sm btn-primary">
                                          <i class="fa fa-eye"></i> Lihat
                                      </a>
                                  </td>
                              </tr>
                          <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Pengajuan Konseling Acc</h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Siswa</th>
                      <th class="text-center">Poin Pengurangan</th>
                    </tr>
                    </thead>
                    <tbody>
                          <?php $no=1; foreach ($top_pelanggaran as $key => $value) { ?>
                              <tr>
                                  <td class="text-center"><?= $no++ ?></td>
                                  <td class="text-center"><?= $value->nama_lengkap?></td>
                                  <td class="text-center"><?= $value->total_poin ?></td>
                              </tr>
                          <?php } ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
        <?php } else {
            
        } ?>
      </div>
    </section>
  </div>

    <!-- edit -->
        <?php foreach ($dataGuru as $key => $value) { ?>
            <div class="modal fade" id="edit<?= $value->guru_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Guru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <?php echo form_open_multipart('guru/updatedataGuru/' .$value->guru_id) ?>
                    <div class="modal-body">
                       <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama</label>
                                <input class="form-control" type="text" value="<?= $value->nama_guru ?>" name="nama_guru" readonly="readonly">
                            </div>
                            <div class="form-group col-md-6">
                                <label>NIP</label>
                                <input class="form-control" type="text" value="<?= $value->nip ?>" name="nip">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>FOTO</label> <br>
                            <img src="<?= base_url('assets/image/foto_guru/' .$value->foto_guru) ?>" width="10%"> <br> <br>
                            <div class="custom-file">
                                <input type="file" name="foto_guru" class="custom-file-input" id="inputGroupFile04">
                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <!-- end -->

    <!-- password -->
        <?php foreach ($PassGuru as $key => $value) { ?>
            <div class="modal fade" id="pass<?= $value->user_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">EDIT PASSWORD<?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('guru/update_pass/' .$value->user_id) ?>         
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" type="text" name="username" value="<?= $value->username ?>" placeholder="Username" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>

                            </div>
                                <div class="modal-footer">
                                <button type="close" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <!-- end -->