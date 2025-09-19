<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('guru/jadwalKonseling') ?>">JADWAL KONSELING</a></li>
              <li class="breadcrumb-item active"><?= $title ?></li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <?php
        $besok = date('Y-m-d', strtotime('+1 day'));
    ?>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-body">

                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-one-view-tab" data-toggle="pill" href="#custom-tabs-one-view" role="tab" aria-controls="custom-tabs-one-view" aria-selected="true">View</a>
                        </li>
                        <?php if ($detailJadwalKonseling->status == 'terjadwal') { ?>
                            <?php if ($detail_guru->status_guru == 'bk') { ?>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-jadwal-tab" data-toggle="pill" href="#custom-tabs-one-jadwal" role="tab" aria-controls="custom-tabs-one-jadwal" aria-selected="false">Edit Jadwal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-status-tab" data-toggle="pill" href="#custom-tabs-one-status" role="tab" aria-controls="custom-tabs-one-status" aria-selected="false">Edit Status</a>
                                </li>
                            <?php } else {
                                
                            } ?> 
                        <?php } elseif ($detailJadwalKonseling->status == 'selesai') {
                            echo '';
                        }elseif ($detailJadwalKonseling->status == 'batal') {
                            echo '';
                        } ?>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-view" role="tabpanel" aria-labelledby="custom-tabs-one-view-tab">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <td>:</td>
                                        <td><?= $detailJadwalKonseling->nama_lengkap ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Guru</th>
                                        <td>:</td>
                                        <td><?= $detailJadwalKonseling->nama_guru ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>:</td>
                                        <td><?= $detailJadwalKonseling->tanggal ?></td>
                                    </tr>
                                    <tr>
                                        <th>Waktu</th>
                                        <td>:</td>
                                        <td><?= $detailJadwalKonseling->waktu ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tempat</th>
                                        <td>:</td>
                                        <td><?= $detailJadwalKonseling->tempat ?></td>
                                    </tr>
                                    <tr>
                                        <th>Topik</th>
                                        <td>:</td>
                                        <td><?= $detailJadwalKonseling->topik ?></td>
                                    </tr>
                                    <tr>
                                        <th>Link Zoom</th>
                                        <td>:</td>
                                        <td><?php if (!empty($detailJadwalKonseling->link_zoom)) : ?>
                                                <a href="<?= $detailJadwalKonseling->link_zoom ?>" class="btn btn-primary btn-sm" target="_blank">Zoom</a>
                                            <?php else : ?>
                                                <span class="text-muted">Tidak tersedia</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td><?php if ($detailJadwalKonseling->status == 'terjadwal') {
                                            echo '<button class="btn btn-primary btn-sm"> Terjadwal </button>';
                                        }elseif ($detailJadwalKonseling->status == 'selesai') {
                                        echo '<button class="btn btn-success btn-sm">Jadwal Selesai </button>';
                                        }elseif ($detailJadwalKonseling->status == 'batal') {
                                            echo '<button class="btn btn-danger btn-sm">Jadwal Batal </button>';
                                        } ?></td>
                                    </tr>

                                    <?php if (!empty($catatanKonseling)) : ?>
                                        <?php foreach ($catatanKonseling as $key => $value) : ?>
                                            <tr>
                                                <th col="3" class="text-center">Catatan Konseling</th>
                                            </tr>
                                            
                                            <tr>
                                                <th>Ringkasan Masalah</th>
                                                <td>:</td>
                                                <td><?= $value->ringkasan_masalah ?></td>
                                            </tr>

                                            <tr>
                                                <th>Solusi</th>
                                                <td>:</td>
                                                <td><?= $value->solusi ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada catatan konseling</td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>

                            <?php if ($detailJadwalKonseling->status == 'terjadwal') { ?>
                                <div class="tab-pane fade" id="custom-tabs-one-jadwal" role="tabpanel" aria-labelledby="custom-tabs-one-jadwal-tab">
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('guru/updateJadwalKonseling/' .$detailJadwalKonseling->jadwal_id) ?> 
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <div class="form-group">
                                                        <label>Siswa</label>
                                                        <input class="form-control" type="text" name="siswa_id" value=" <?= $detailJadwalKonseling->nama_lengkap ?> " readonly="readonly">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label>Tanggal</label>
                                                    <input class="form-control" type="date" name="tanggal" value="<?= $detailJadwalKonseling->tanggal ?>" placeholder="Tanggal" required min="<?= $besok ?>">
                                                </div>
                                                
                                                <div class="form-group col-md-4">
                                                    <label>Waktu</label>
                                                    <input class="form-control" type="time" name="waktu" value="<?= $detailJadwalKonseling->waktu ?>" placeholder="Waktu" required>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Tempat</label>
                                                    <input class="form-control" type="text" name="tempat" value="<?= $detailJadwalKonseling->tempat ?>" placeholder="Tempat" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Link Zoom (Opsinonal)</label>
                                                <input class="form-control" type="text" name="link_zoom" placeholder="link_zoom">
                                            </div>

                                            <div class="form-group">
                                                <label>Topik</label>
                                                <textarea id="summernote" class="form-control" name="topik" rows="2" required><?= $detailJadwalKonseling->topik ?></textarea>
                                            </div>

                                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    <?php echo form_close() ?>
                                </div>
                            
                                <div class="tab-pane fade" id="custom-tabs-one-status" role="tabpanel" aria-labelledby="custom-tabs-one-status-tab">
                                    <center>
                                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#selesai<?= $detailJadwalKonseling->jadwal_id ?>"> Jadwal Selesai </button>

                                        <a href="#" 
                                            onclick="confirmBatal('<?= base_url('guru/update_statuskonseling/' . $detailJadwalKonseling->jadwal_id . '/batal') ?>')" 
                                            class="btn btn-sm btn-warning"> Jadwal Batal
                                        </a>

                                        <a href="#" 
                                            onclick="confirmDelete('<?= base_url('guru/hapusJadwalKonseling/' .$detailJadwalKonseling->user_id) ?>')" 
                                            class="btn btn-sm btn-danger"> Hapus Jadwal
                                        </a>
                                    </center>
                                </div>
                            <?php } elseif ($detailJadwalKonseling->status == 'selesai') {
                                echo '';
                            }elseif ($detailJadwalKonseling->status == 'batal') {
                                echo '';
                            } ?>
                        </div>
                    </div>
                    <!-- /.card -->
                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- jadwal selesai -->
    <div class="modal fade" id="selesai<?= $detailJadwalKonseling->jadwal_id ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">TAMBAH <?= $title ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('guru/catatanKonseling/' .$detailJadwalKonseling->jadwal_id )?>         
                <input type="hidden" id="updateStatusUrl" value="<?= base_url('guru/update_statuskonseling/' . $detailJadwalKonseling->jadwal_id . '/selesai') ?>">

                    <div class="form-group">
                        <label>Ringkasan Masalah</label>
                        <textarea id="summernote1" class="form-control" name="ringkasan_masalah" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Solusi</label>
                        <textarea id="summernote2" class="form-control" name="solusi" rows="2" required></textarea>
                    </div>                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            <?php echo form_close() ?>
            </div>
        </div>
    </div>
  <!-- end -->