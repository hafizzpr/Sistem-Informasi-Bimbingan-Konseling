  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">DASHBOARD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">HOME</a></li>
              <li class="breadcrumb-item active">DASHBOARD</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="card card-primary card-outline">
              <?php foreach ($dataSiswa as $key => $value) { ?>
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?= base_url('assets/image/foto_siswa/' .$value->foto_siswa) ?>"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $value->nama_lengkap ?></h3>

                <p class="text-muted text-center"><?= $value->nisn ?> (<?= $value->nis ?>)</p>

                <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#edit<?= $value->siswa_id ?>" >Edit data</button>
              </div>
              <?php } ?>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= 1000 - $totalPoin ?></h3>

                <p>SISA POIN SEKARANG</p>
              </div>
              <div class="icon">
                <i class="ion ion-information-circled"></i>
              </div>
              <a href="<?=base_url('siswa/pelanggaranSiswa') ?>" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $totalPengajuan ?></h3>

                <p>PENGAJUAN KONSELING</p>
              </div>
              <div class="icon">
                <i class="ion ion-document-text"></i>
              </div>
              <a href="<?=base_url('siswa/pengajuanKonseling') ?>" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $totalJadwal ?></h3>

                <p>JADWAL KONSULTASI</p>
              </div>
              <div class="icon">
                <i class="ion ion-email"></i>
              </div>
              <a href="<?=base_url('siswa/jadwalKonseling') ?>" class="small-box-footer">View <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Pelanggaran</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Pelanggaran</th>
                    <th class="text-center">Poin</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach ($pelanggaranSiswa as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $value->nama_pelanggaran?></td>
                                <td class="text-center"><?= $value->poin_pengurang ?></td>
                                <td class="text-center"><?= $value->tanggal ?></td>
                                <td class="text-center">
                                  <a href="<?= base_url('siswa/pelanggaranSiswa/' .$value->pelanggaran_id) ?>" class="btn btn-primary btn btn-sm"><i class="fa fa-eye"></i></a>   
                                </td>
                            </tr>
                        <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pengajuan Konseling</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Guru</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Waktu</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach ($jadwalKonseling as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $value->nama_guru?></td>
                                <td class="text-center"><?= $value->tanggal ?></td>
                                <td class="text-center"><?= $value->waktu ?></td>
                                <td class="text-center"><?= $value->status ?></td>
                                <td class="text-center">
                                  <a href="<?= base_url('siswa/viewJadwalKonseling/' .$value->jadwal_id) ?>" class="btn btn-primary btn btn-sm"><i class="fa fa-eye"></i></a>   
                                </td>
                            </tr>
                        <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </section>
  </div>

      <!-- edit -->
        <?php foreach ($dataSiswa as $key => $value) { ?>
            <div class="modal fade" id="edit<?= $value->siswa_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Siswa</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <?php echo form_open_multipart('siswa/updatedataSiswa/' .$value->siswa_id) ?>
                    <div class="modal-body">
                       <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama</label>
                                <input class="form-control" type="text" value="<?= $value->nama_lengkap ?>" name="nama_lengkap" readonly="readonly">
                            </div>
                            <div class="form-group col-md-6">
                                <label>NISN</label>
                                <input class="form-control" type="text" value="<?= $value->nisn ?>" name="nisn" readonly="readonly">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>FOTO</label> <br>
                            <img src="<?= base_url('assets/image/foto_siswa/' .$value->foto_siswa) ?>" width="10%"> <br> <br>
                            <div class="custom-file">
                                <input type="file" name="foto_siswa" class="custom-file-input" id="inputGroupFile04">
                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    <!-- end -->