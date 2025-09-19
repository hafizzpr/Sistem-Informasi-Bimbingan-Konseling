<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DATA PENGEMBANGAN DIRI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('siswa') ?>">HOME</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('siswa/pengembanganDiri') ?>">MINAT & BAKAT SISWA</a></li>
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
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"> Tambah Data </button>
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
                    <th class="text-center">Action</th>
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
                          <td class="text-center">
                              <button type="button" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#edit<?= $value->pengembangan_id ?>" ><i class="fa fa-edit"></i></button>
                              <a href="#" 
                                  onclick="confirmDelete('<?= base_url('siswa/hapusdatapengembanganDiri/' .$value->pengembangan_id) ?>')" 
                                  class="btn btn-sm btn-danger">
                                  <i class="fa fa-trash"></i>
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
                    <?php echo form_open_multipart('siswa/add_pengembanganDiri') ?>         
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Jenis</label>
                                <select name="jenis" id="" class="form-control">
                                  <option value="">-- Pilih --</option>
                                  <option value="Minat">Minat</option>
                                  <option value="Bakat">Bakat</option>
                                  <option value="Keahlian">Keahlian</option>
                                  <option value="Cita-cita">Cita-cita</option>
                                  <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tingkat</label>
                                <select name="tingkat" id="" class="form-control">
                                  <option value="">-- Pilih --</option>
                                  <option value="Pemula">Pemula</option>
                                  <option value="Terampil">Terampil</option>
                                  <option value="Mahir">Mahir</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tahun</label>
                                <span>Bisa dikosongkan</span>
                                <input type="text" name="tahun_mulai" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                          <label>Deskripsi</label>
                          <textarea name="deskripsi" class="form-control" id="summernote"></textarea>
                        </div>

                        <div class="form-row">
                          <label>Catatan</label>
                          <textarea name="catatan" class="form-control" id="summernote1"></textarea>
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
        <?php foreach ($pengembanganDiri as $key => $value) { ?>
            <div class="modal fade" id="edit<?= $value->pengembangan_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Pelanggaran</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <?php echo form_open('siswa/updatedatapengembanganDiri/' .$value->pengembangan_id) ?>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Jenis</label>
                                <select name="jenis" id="" class="form-control">
                                  <option value="<?= $value->jenis ?>"><?= $value->jenis ?></option>
                                  <option value="Minat">Minat</option>
                                  <option value="Bakat">Bakat</option>
                                  <option value="Keahlian">Keahlian</option>
                                  <option value="Cita-cita">Cita-cita</option>
                                  <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tingkat</label>
                                <select name="tingkat" id="" class="form-control">
                                  <option value="<?= $value->tingkat ?>"><?= $value->tingkat ?></option>
                                  <option value="Pemula">Pemula</option>
                                  <option value="Terampil">Terampil</option>
                                  <option value="Mahir">Mahir</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tahun</label>
                                <span>Bisa dikosongkan</span>
                                <input type="text" name="tahun_mulai" value="<?= $value->tahun_mulai ?>" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                          <label>Deskripsi</label>
                          <textarea name="deskripsi" class="form-control" id="summernote"><?= $value->deskripsi ?></textarea>
                        </div>

                        <div class="form-row">
                          <label>Catatan</label>
                          <textarea name="catatan" class="form-control" id="summernote1"><?= $value->catatan ?></textarea>
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
