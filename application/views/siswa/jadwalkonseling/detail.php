<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('siswa/jadwalKonseling') ?>">JADWAL KONSELING</a></li>
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