<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LAPORAN PENGADUAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">HOME</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/laporanPengaduan') ?>">LAPORAN PENGADUAN</a></li>
              <li class="breadcrumb-item active">DATA</li>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Judul</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center">Foto Laporan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($laporanPengaduan as $key => $value) { ?>
                      <tr>
                          <td class="text-center" width="10px"><?= $no++ ?></td>
                          <td class="text-center"><?= $value->judul_laporan?></td>
                          <td class="text-center"><?= $value->ket_laporan?></td>
                          <td class="text-center"><?= $value->nama_siswa?></td>
                          <td class="text-center"><a href="<?= base_url('assets/image/foto_laporan/' .$value->foto_laporan) ?>" target="_blank"><img src="<?= base_url('assets/image/foto_laporan/' .$value->foto_laporan) ?>" alt="" width="70px"></a></td>
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