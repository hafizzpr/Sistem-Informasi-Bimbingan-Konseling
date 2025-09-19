<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?= $title ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('guru') ?>">HOME</a></li>
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
                <?php if ($detail_guru->status_guru == 'bk') { ?>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"> Tambah Jadwal </button>
                <?php } else {
                  
                } ?>
                <h3 class="card-title"></h3>
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
                    <?php echo form_open_multipart('guru/tambahJadwalKonseling') ?>         
                        <div class="form-row">
                            <input type="hidden" name="guru_id" value="<?= $this->session->userdata('guru_id') ?>">

                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label>Siswa</label>
                                    <select class="form-control select2" style="width: 100%;" name="siswa_id">
                                        <option>--Pilih Siswa--</option>
                                        <?php foreach ($dataSiswa as $key => $value) { ?>
                                        <option value="<?= $value->siswa_id ?>"><?= $value->nama_lengkap ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Tanggal</label>
                                <input class="form-control" type="date" name="tanggal" placeholder="Tanggal" required min="<?= $besok ?>">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Waktu</label>
                                <input class="form-control" type="time" name="waktu" placeholder="Waktu" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label>Tempat</label>
                                <input class="form-control" type="text" name="tempat" placeholder="Tempat" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Link Zoom (Opsinonal)</label>
                            <input class="form-control" type="text" name="link_zoom" placeholder="link_zoom">
                        </div>

                        <div class="form-group">
                            <label>Topik</label>
                            <textarea id="summernote" class="form-control" name="topik" rows="2" required></textarea>
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
                    <?php foreach ($jadwalKonseling as $value) {
                        // Tentukan warna berdasarkan status
                        if ($value->status == 'selesai') {
                            $color = '#28a745'; // hijau
                        } elseif ($value->status == 'batal') {
                            $color = '#dc3545'; // merah
                        } else {
                            $color = '#007bff'; // biru (default terjadwal)
                        }
                    ?>
                    {
                        title: '<?= $value->nama_lengkap ?>',
                        start: '<?= $value->tanggal ?>',
                        url: '<?= base_url('guru/viewJadwalKonseling/' . $value->jadwal_id) ?>',
                        color: '<?= $color ?>'
                    },
                    <?php } ?>
                ]
            });
            calendar.render();
        });
    </script>