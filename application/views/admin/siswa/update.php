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
              <li class="breadcrumb-item"><a href="<?=base_url('admin/dataSiswa') ?>">DATA SISWA</a></li>
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
                <h3 class="card-title"></h3>
              </div>
              <div class="card-body">
                    <form method="post" action="<?= base_url('admin/naikkan_dengan_status') ?>">
                        <button type="button" class="btn btn-success btn-sm" onclick="centangSemua()">Pilih Semua</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusCentang()">Hapus Semua</button>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Tidak Naik Kelas?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataSiswa as $value): ?>
                                <tr>
                                    <td><?= $value->nama_lengkap ?></td>
                                    <td><?= $value->kelas ?></td>
                                    <td>
                                        <input type="checkbox" name="tidak_naik[]" value="<?= $value->siswa_id ?>">
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Yakin ingin menaikkan semua siswa ke kelas berikutnya?')">Simpan & Naikkan Semua</button>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script>
    function centangSemua() {
        const checkboxes = document.querySelectorAll('input[name="tidak_naik[]"]');
        checkboxes.forEach(cb => cb.checked = true);
    }

    function hapusCentang() {
        const checkboxes = document.querySelectorAll('input[name="tidak_naik[]"]');
        checkboxes.forEach(cb => cb.checked = false);
    }
</script>