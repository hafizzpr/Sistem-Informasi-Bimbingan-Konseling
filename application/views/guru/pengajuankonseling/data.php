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
              <div class="card-header"></div>
              <div class="card-body">
                <div id="calendar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

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
                        url: '<?= base_url('guru/viewPengajuanKonseling/' . $value->pengajuan_id) ?>',
                        color: '<?= $color ?>'
                    },
                    <?php } ?>
                ]
            });
            calendar.render();
        });
    </script>