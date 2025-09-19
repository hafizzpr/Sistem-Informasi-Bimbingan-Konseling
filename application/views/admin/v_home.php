<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">DASHBOARD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">HOME</a></li>
              <li class="breadcrumb-item active">DASHBOARD</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
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
                      <div class="col-lg-4 col-6 mb-3">
                        <div class="small-box bg-info p-3 rounded">
                          <div class="inner">
                            <h3>Kelas <?= htmlspecialchars($siswa->kelas) ?> : <?= (int)$siswa->jumlah ?> <br> siswa</h3>
                          </div>
                          <div class="icon">
                            <i class="ion ion-person"></i>
                          </div>
                          <a href="<?= base_url('admin/dataKelasSiswa/' . urlencode($siswa->kelas)) ?>" class="small-box-footer d-block mt-2 text-white">
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
                      <div class="col-lg-4 col-6 mb-3">
                        <div class="small-box bg-danger p-3 rounded">
                          <div class="inner">
                            <h3><?= htmlspecialchars($pel->kelas) ?> : <?= (int)$pel->total_poin ?> poin</h3>
                            <p>Total Pelanggaran</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-alert"></i>
                          </div>
                          <a href="<?= base_url('admin/datapelanggaranSiswa/' . urlencode($pel->kelas)) ?>" class="small-box-footer d-block mt-2 text-white">
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
          <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $totalJadwal ?></h3>

                <p>Total Jadwal Konseling</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('admin/jadwalKonseling') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="<?= base_url('admin/pengajuanKonseling') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
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
                  <h3 class="card-title">Data Terbaru Pelanggaran Siswa</h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Siswa</th>
                      <th class="text-center">Pelanggaran</th>
                      <th class="text-center">Poin Pengurangan</th>
                      <th class="text-center">Tanggal</th>
                    </tr>
                    </thead>
                    <tbody>
                          <?php $no=1; foreach ($dataPelanggaran as $key => $value) { ?>
                              <tr>
                                  <td class="text-center"><?= $no++ ?></td>
                                  <td class="text-center"><?= $value->nama_lengkap?></td>
                                  <td class="text-center"><?= $value->nama_pelanggaran ?></td>
                                  <td class="text-center"><?= $value->poin_pengurang ?></td>
                                  <td class="text-center"><?= $value->tanggal ?></td>
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
                  <h3 class="card-title">Data Terbaru Pengajuan Konseling</h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Siswa</th>
                      <th class="text-center">Alasan</th>
                      <th class="text-center">Tanggal Pengajuan</th>
                      <th class="text-center">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                          <?php $no=1; foreach ($dataPengajuan as $key => $value) { ?>
                              <tr>
                                  <td class="text-center"><?= $no++ ?></td>
                                  <td class="text-center"><?= $value->nama_lengkap?></td>
                                  <td class="text-center"><?= $value->alasan ?></td>
                                  <td class="text-center"><?= $value->tanggal_pengajuan ?></td>
                                  <td class="text-center"><?= $value->status ?></td>
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
                  <h3 class="card-title">Data Terbaru Jadwal Konseling</h3>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-center">Nama Siswa</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Tempat</th>
                      <th class="text-center">Topik</th>
                    </tr>
                    </thead>
                    <tbody>
                          <?php $no=1; foreach ($dataKonseling as $key => $value) { ?>
                              <tr>
                                  <td class="text-center"><?= $no++ ?></td>
                                  <td class="text-center"><?= $value->nama_lengkap?></td>
                                  <td class="text-center"><?= $value->tanggal ?> / <?= $value->waktu ?></td>
                                  <td class="text-center"><?= $value->tempat ?></td>
                                  <td class="text-center"><?= $value->topik ?></td>
                              </tr>
                          <?php } ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>