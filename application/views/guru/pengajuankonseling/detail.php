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
                        <?php if ($detailPengajuanKonseling->status == 'menunggu') { ?>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-jadwal-tab" data-toggle="pill" href="#custom-tabs-one-jadwal" role="tab" aria-controls="custom-tabs-one-jadwal" aria-selected="false">Pengajuan Jadwal</a>
                            </li>
                        <?php } elseif ($detailPengajuanKonseling->status == 'disetujui') {
                            echo '';
                        }elseif ($detailPengajuanKonseling->status == 'ditolak') {
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
                                        <td><?= $detailPengajuanKonseling->nama_lengkap ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>:</td>
                                        <td><?= $detailPengajuanKonseling->tanggal_pengajuan ?></td>
                                    </tr>
                                    <tr>
                                        <th>Alasan</th>
                                        <td>:</td>
                                        <td><?= $detailPengajuanKonseling->alasan ?></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td><?php if ($detailPengajuanKonseling->status == 'menunggu') {
                                            echo '<button class="btn btn-primary btn-sm"> Menunggu </button>';
                                        }elseif ($detailPengajuanKonseling->status == 'disetujui') {
                                        echo '<button class="btn btn-success btn-sm">Pengajuan Disetujui </button>';
                                        }elseif ($detailPengajuanKonseling->status == 'ditolak') {
                                            echo '<button class="btn btn-danger btn-sm">Pengajuan Ditolak </button>';
                                        } ?></td>
                                    </tr>

                                    <?php if (!empty($detailPengajuanKonseling->status == 'disetujui')) : ?>
                                            <tr>
                                                <th col="3" class="text-center">Jawaban</th>
                                            </tr>
                                            
                                            <tr>
                                                <th>Catatan</th>
                                                <td>:</td>
                                                <td><?= $detailPengajuanKonseling->catatan ?></td>
                                            </tr>

                                            <tr>
                                                <th>Tanggal Disetujui</th>
                                                <td>:</td>
                                                <td><?= $detailPengajuanKonseling->tanggal_setuju ?></td>
                                            </tr>
                                    <?php elseif (!empty($detailPengajuanKonseling->status == 'ditolak'))  : ?>
                                            <tr>
                                                    <th col="3" class="text-center">Jawaban</th>
                                            </tr>
                                            
                                            <tr>
                                                <th>Catatan</th>
                                                <td>:</td>
                                                <td><?= $detailPengajuanKonseling->catatan ?></td>
                                            </tr>

                                            <tr>
                                                <th>Tanggal Ditolak</th>
                                                <td>:</td>
                                                <td><?= $detailPengajuanKonseling->tanggal_setuju ?></td>
                                            </tr>
                                    <?php else  : ?>
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">Belum ada Jawaban</td>
                                        </tr>
                                    <?php endif; ?>

                                </table>
                            </div>

                            <?php if ($detailPengajuanKonseling->status == 'menunggu') { ?>
                                <div class="tab-pane fade" id="custom-tabs-one-jadwal" role="tabpanel" aria-labelledby="custom-tabs-one-jadwal-tab">
                                    <div class="modal-body">
                                        <?php echo form_open_multipart('guru/updatePengajuanKonseling/' .$detailPengajuanKonseling->pengajuan_id) ?>
                                                <div class="form-row">
                                                    <label for="">Status</label>
                                                    <select name="status" id="" class="form-control">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="disetujui">Disetujui</option>
                                                        <option value="ditolak">Ditolak</option>
                                                    </select>
                                                </div>

                                                <br>

                                                <div class="form-group">
                                                    <label>Catatan</label>
                                                    <textarea id="summernote" class="form-control" name="catatan" rows="2" required></textarea>
                                                </div>

                                            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                    <?php echo form_close() ?>
                                </div>                                
                            <?php } elseif ($detailPengajuanKonseling->status == 'disetujui') {
                                echo '';
                            }elseif ($detailPengajuanKonseling->status == 'ditolak') {
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