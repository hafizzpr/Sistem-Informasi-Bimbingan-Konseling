<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>LAPORAN PENGADUAN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('siswa') ?>">HOME</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('siswa/laporanPengaduan') ?>">LAPORAN PENGADUAN</a></li>
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
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"> Tambah Data </button> <b>"Gunakan fitur ini dengan bijak"</b>
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
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($laporanPengaduan as $key => $value) { ?>
                      <tr>
                          <td class="text-center" width="10px"><?= $no++ ?></td>
                          <td class="text-center"><?= $value->judul_laporan?></td>
                          <td class="text-center"><?= $value->ket_laporan?></td>
                          <td class="text-center"><?= $value->nama_siswa?></td>
                          <td class="text-center"><img src="<?= base_url('assets/image/foto_laporan/' .$value->foto_laporan) ?>" alt="" width="70px"></td>
                          <td class="text-center">
                            <?php
                              $create_at = new DateTime($value->create_at);
                              $now = new DateTime();
                              $interval = $create_at->diff($now)->days;

                              if ($interval <= 7) {
                              ?>
                                  <button type="button" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#edit<?= $value->laporan_id ?>" ><i class="fa fa-edit"></i></button>
                              <?php
                              } else {
                              ?>
                                  <button type="button" class="btn btn-secondary btn-sm" disabled>
                                      <i class="fa fa-edit"></i>
                                  </button>
                              <?php
                              }
                            ?>

                            <?php
                              $create_at = new DateTime($value->create_at);
                              $now = new DateTime();
                              $interval = $create_at->diff($now)->days;

                              if ($interval <= 7) {
                              ?>
                                  <a href="#" 
                                      onclick="confirmDelete('<?= base_url('siswa/hapusdatalaporanPengaduan/' .$value->laporan_id) ?>')" 
                                      class="btn btn-sm btn-danger">
                                      <i class="fa fa-trash"></i>
                                  </a>
                              <?php
                              } else {
                              ?>
                                  <button type="button" class="btn btn-secondary btn-sm" disabled>
                                       <i class="fa fa-trash"></i>
                                  </button>
                              <?php
                              }
                            ?>
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
                    <?php echo form_open_multipart('siswa/add_laporanPengaduan') ?>         
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Judul</label>
                                <input class="form-control" type="text" name="judul_laporan" placeholder="Judul" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Data Siswa</label>
                                <select class="select2" style="width: 100%;" name="nama_siswa">
                                    <option>--Pilih Siswa--</option>
                                    <?php foreach ($dataSiswa as $key => $value) { ?>
                                    <option value="<?= $value->nama_lengkap ?>"><?= $value->nama_lengkap ?> || <?= $value->nisn ?> || Kelas <?= $value->kelas ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                          <label>Deskripsi</label>
                          <textarea id="summernote" class="form-control" name="ket_laporan" rows="2" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>FOTO</label>
                            <div class="custom-file">
                                <input type="file" name="foto_laporan" class="custom-file-input" id="inputGroupFile04">
                                <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
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

    <!-- edit -->
        <?php foreach ($laporanPengaduan as $key => $value) { ?>
            <div class="modal fade" id="edit<?= $value->laporan_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Laporan</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <?php echo form_open_multipart('siswa/updatedatalaporanPengaduan/' .$value->laporan_id) ?>
                    <div class="modal-body">
                       <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Judul</label>
                                <input class="form-control" type="text" value="<?= $value->judul_laporan ?>" name="judul_laporan" placeholder="Judul" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nama Siswa</label>
                                <input class="form-control" type="text" value="<?= $value->nama_siswa ?>" name="nama_siswa" placeholder="Nama Siswa" required>
                            </div>
                        </div>

                        <div class="form-group">
                          <label>Deskripsi</label>
                          <textarea id="summernote1" class="form-control" name="ket_laporan" rows="2" required><?= $value->ket_laporan ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>FOTO</label> <br>
                            <img src="<?= base_url('assets/image/foto_laporan/' .$value->foto_laporan) ?>" width="10%"> <br> <br>
                            <div class="custom-file">
                                <input type="file" name="foto_laporan" class="custom-file-input" id="inputGroupFile04">
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
