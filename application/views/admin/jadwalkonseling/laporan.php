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
              <div class="card-header"></div>
              <div class="card-body">

                <form method="get" action="<?php echo base_url('admin/cekJadwalKonseling') ?>">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <h6>Filter Tanggal</h6>
                                <div class="input-group">
                                    <input type="date" name="tgl_awal" data="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
                                    <span class="btn btn-default">s/d</span>
                                    <input type="date" name="tgl_akhir" data="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off"> &nbsp; &nbsp;
                                    <button type="submit" name="filter" data="true" class="btn btn-default">TAMPILKAN</button> &nbsp; &nbsp;
                                    <?php
                                    if(isset($_GET['filter'])) 
                                        echo '<a href="'.base_url('admin/laporanJadwalKonseling').'" class="btn btn-danger">RESET</a>';
                                    ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Waktu</th>
                    <th class="text-center">Tempat</th>
                    <th class="text-center">Topik</th>
                    <th class="text-center">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($jadwalKonseling as $key => $value) { ?>
                      <tr>
                        <td class='text-center'><?= $no++ ?></td>
                        <td class='text-center'><?= $value->nama_lengkap ?></td>
                        <td class='text-center'><?= $value->tanggal ?></td>
                        <td class='text-center'><?= $value->waktu ?></td>
                        <td class='text-center'><?= $value->tempat ?></td>
                        <td class='text-center'><?= $value->topik ?></td>
                        <td class='text-center'><?= $value->status ?></td>
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