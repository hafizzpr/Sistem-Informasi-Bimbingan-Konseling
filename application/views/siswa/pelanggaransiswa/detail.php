<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PELANGGARAN SISWA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('siswa') ?>">HOME</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('siswa/pelanggaranSiswa') ?>">PELANGGARAN SISWA</a></li>
              <li class="breadcrumb-item active">DETAIL</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
              </div>
              <div class="card-body">
                <h5> Siswa : <b><?= $detailSiswa->nama_lengkap ?></b> <br> 
                      Total Poin : <b><?= $totalPoin ?></b>
                     
                  <?php
                    $selisih = 1000 - $totalPoin;
                  ?>
                  <?php if ($selisih >= 600): ?>
                      <span style="color: green;">Aman</span>

                  <?php elseif ($selisih >= 450): ?>
                      <span style="color: orange;">Perilaku Kurang Baik (SP1)</span>

                  <?php elseif ($selisih >= 350): ?>
                      <span style="color: orange;">Perilaku Tidak Baik (SP2)</span>

                  <?php else: ?>
                      <span style="color: red;">Perilaku Sangat Tidak Baik (SP3)</span>

                  <?php endif; ?>


                </h5>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Jenis Pelanggaran</th>
                    <th class="text-center">Poin</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php if (!empty($pelanggaran) && is_array($pelanggaran)) { ?>
                        <?php 
                            $current_semester = null; 
                            $no = 1; 
                            $semester_group = [];

                            // Kelompokkan berdasarkan semester
                            foreach ($pelanggaran as $value) {
                                $semester_group[$value->nama_semester][] = $value;
                            }

                            // Tampilkan per semester
                            foreach ($semester_group as $nama_semester => $items) {
                                // Hitung total poin
                                $total_poin = 0;
                                foreach ($items as $item) {
                                    $total_poin += $item->poin_pengurang;
                                }
                        ?>
                            <!-- Header Semester -->
                            <tr>
                                <td colspan="8" style="background:#f0f0f0; font-weight:bold;">
                                    <?= $nama_semester ?> | Total Poin Pelanggaran: <b><?= $total_poin ?> poin</b>
                                </td>
                            </tr>

                            <?php $no = 1; foreach ($items as $value) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="text-center"><?= $value->nama_pelanggaran ?></td>
                                    <td class="text-center"><?= $value->poin_pengurang ?></td>
                                    <td class="text-center"><?= $value->kategori ?></td>
                                    <td class="text-center"><?= $value->lokasi ?></td>
                                    <td class="text-center"><?= $value->tanggal ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#view<?= $value->pelanggaran_id ?>"><i class="fa fa-eye"></i></button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="8" class="text-center text-danger">
                                Tidak ada data pelanggaran untuk ditampilkan.
                            </td>
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

  <!-- view -->
     <?php $no=1; foreach ($pelanggaran as $key => $value) { ?>
      <div class="modal fade" id="view<?= $value->pelanggaran_id ?>">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">VIEW DATA</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">  
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nama Siswa</th>
                        <td>:</td>
                        <td><?= $detailSiswa->nama_lengkap ?></td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>:</td>
                        <td><?= $detailSiswa->nisn ?></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>:</td>
                        <td><?= $detailSiswa->kelas ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Kejadian</th>
                        <td>:</td>
                        <td><?= $value->tanggal ?></td>
                    </tr>
                    <tr>
                        <th>Lokasi Kejadian</th>
                        <td>:</td>
                        <td><?= $value->lokasi ?></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>:</td>
                        <td><?= $value->deskripsi ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pelanggaran</th>
                        <td>:</td>
                        <td><?= $value->nama_pelanggaran ?></td>
                    </tr>
                    <tr>
                        <th>Poin</th>
                        <td>:</td>
                        <td><?= $value->poin_pengurang ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>:</td>
                        <td><?= $value->kategori ?></td>
                    </tr>
                </table>
              </div>
              </div>
          </div>
      </div>
      <?php } ?>
    <!-- end -->