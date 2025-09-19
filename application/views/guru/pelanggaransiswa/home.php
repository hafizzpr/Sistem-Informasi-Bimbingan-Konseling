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
                <h3 class="card-title">
                   <h3 class="card-title"><h3 class="card-title"></h3><button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"> Tambah Data </button> </h3>
                </h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Siswa</th>
                    <th class="text-center">Poin</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach ($dataPl as $value) { ?>
                          <tr>
                              <td class="text-center"><?= $no++ ?></td>
                              <td><?= $value->nama_lengkap ?></td>
                              <td class="text-center"><?= $value->total_poin ?> ( 
                                  <?php
                                    $selisih = 1000 - $value->total_poin;
                                  ?>
                                  <?php if ($selisih >= 600): ?>
                                    <span style="color: green;">Aman</span>
                                  <?php elseif ($selisih >= 450): ?>
                                  <span style="color: orange;">Perilaku Kurang Baik (SP1)</span>
                                  <?php elseif ($selisih >= 350): ?>
                                    <span style="color: red;">Perilaku Sangat Tidak Baik (SP3)</span>
                                  <?php else: ?>
                                    <span style="color: red;">Perilaku Sangat Tidak Baik (SP3)</span>
                                  <?php endif; ?> )
                              </td>
                              <td class="text-center"><?= $value->kelas ?></td>
                              <td class="text-center">
                                  <a href="<?= base_url('guru/viewPelanggaranSiswa/' .$value->siswa_id) ?>" 
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-eye"></i>
                                  </a>
                              </td>
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
                  <?php echo form_open_multipart('guru/add_pelanggaranSiswa1/') ?>         
                      <div class="form-row">
                          <div class="form-group col-md-12">
                              <label>Data Siswa</label>
                                <select class="select2" style="width: 100%;" name="siswa_id">
                                    <option>--Pilih Siswa--</option>
                                    <?php foreach ($dataSiswa as $key => $value) { ?>
                                    <option value="<?= $value->siswa_id ?>"><?= $value->nama_lengkap ?> || <?= $value->nisn ?> || Kelas <?= $value->kelas ?></option>
                                    <?php } ?>
                                </select>
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-12">
                              <label>Jenis Pelanggaran</label>
                                <select class="select2" style="width: 100%;" name="jenis_id">
                                    <option>--Pilih Pelanggaran--</option>
                                    <?php foreach ($dataPelanggaran as $key => $value) { ?>
                                    <option value="<?= $value->jenis_id ?>"><?= $value->nama_pelanggaran ?> == (<?= $value->poin_pengurang ?> Poin) == <?= $value->kategori ?></option>
                                    <?php } ?>
                                </select>
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-6">
                              <label>Tanggal Kejadian</label>
                              <input class="form-control" type="date" name="tanggal" placeholder="Tanggal Kejadian" require>
                          </div>
                          <div class="form-group col-md-6">
                              <label>Lokasi Kejadian</label>
                              <input class="form-control" type="text" name="lokasi" placeholder="Lokasi Kejadian" require>
                          </div>
                      </div>

                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea id="summernote2" class="form-control" name="deskripsi" rows="2" required></textarea>
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