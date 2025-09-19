<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">HOME</a></li>
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
              <div class="card-header">
                <h3 class="card-title"></h3><button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"> Tambah Jadwal </button>
              </div>
              <div class="card-body">
                <div id="calendar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php
      $besok = date('Y-m-d', strtotime('+1 day'));
  ?>

    <!-- Tambah -->
        <div class="modal fade" id="add">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TAMBAH <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('siswa/add_pengajuanKonseling') ?>     

                      <input type="hidden" name="siswa_id" value="<?= $this->session->userdata('siswa_id') ?>">

                      <div class="form-group">
                          <label>Tanggal</label>
                          <input class="form-control" type="date" name="tanggal_pengajuan" placeholder="Tanggal Pengajuan" required min="<?= $besok ?>">
                      </div>

                      <div class="form-group">
                        <label>Alasan Konseling</label>
                        <textarea id="summernote" class="form-control" name="alasan" rows="2" required></textarea>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    <?php foreach ($pengajuanKonseling as $value) {
                        // Tentukan warna berdasarkan status
                        if ($value->status == 'disetujui') {
                            $color = '#28a745'; // hijau
                        } elseif ($value->status == 'ditolak') {
                            $color = '#dc3545'; // merah
                        } else {
                            $color = '#007bff'; // biru (default terjadwal)
                        }
                    ?>
                    {
                        title: '<?= $value->nama_lengkap ?>',
                        start: '<?= $value->tanggal_pengajuan ?>',
                        url: '<?= base_url('siswa/viewPengajuanKonseling/' . $value->pengajuan_id) ?>',
                        color: '<?= $color ?>'
                    },
                    <?php } ?>
                ]
            });
            calendar.render();
        });
    </script>