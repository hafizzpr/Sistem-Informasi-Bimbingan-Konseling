<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DATA PENGEMBANGAN DIRI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('guru') ?>">HOME</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('guru/pengembanganDiri') ?>">DATA PENGEMBANGAN DIRI</a></li>
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
                <b>Siswa : </b> <?= $detailSiswa->nama_lengkap ?>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Jenis</th>
                    <th class="text-center">Deskripsi</th>
                    <th class="text-center">Tingkat</th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Catatan</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($pengembanganDiri as $key => $value) { ?>
                      <tr>
                          <td class="text-center" width="10px"><?= $no++ ?></td>
                          <td class="text-center"><?= $value->jenis?></td>
                          <td class="text-center"><?= $value->deskripsi?></td>
                          <td class="text-center"><?= $value->tingkat?></td>
                          <td class="text-center"><?= $value->tahun_mulai?></td>
                          <td class="text-center"><?= $value->catatan?></td>
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
