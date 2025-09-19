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
              <div class="card-header">
                <h3 class="card-title"></h3><button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"> Tambah Data </button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Pelanggaran</th>
                    <th class="text-center">Poin Pengurangan</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach ($dataPelanggaran as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $value->nama_pelanggaran?></td>
                                <td class="text-center"><?= $value->poin_pengurang ?></td>
                                <td class="text-center"><?= $value->kategori ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#edit<?= $value->jenis_id ?>" ><i class="fa fa-edit"></i></button>
                                    <a href="#" 
                                        onclick="confirmDelete('<?= base_url('admin/hapusdataPelanggaran/' .$value->jenis_id) ?>')" 
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
                    <?php echo form_open_multipart('admin/add_dataPelanggaran') ?>         
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama Pelanggaran</label>
                                <input class="form-control" type="text" name="nama_pelanggaran" placeholder="Nama Pelanggaran" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Poin Pelanggaran</label>
                                <input class="form-control" type="number" name="poin_pengurang" placeholder="Poin Pelanggaran" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Kategori</label>
                                <select name="kategori" id="" class="form-control">
                                    <option>-- Pilih Kategori --</option>
                                    <option value="Pelanggaran Ringan">Pelanggaran Ringan</option>
                                    <option value="Pelanggaran Sedang">Pelanggaran Sedang</option>
                                    <option value="Pelanggaran Berat">Pelanggaran Berat</option>
                                </select>
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
        <?php foreach ($dataPelanggaran as $key => $value) { ?>
            <div class="modal fade" id="edit<?= $value->jenis_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Pelanggaran</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <?php echo form_open('admin/updatedataPelanggaran/' .$value->jenis_id) ?>
                    <div class="modal-body">
                       <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama Pelanggaran</label>
                                <input class="form-control" type="text" name="nama_pelanggaran" value="<?= $value->nama_pelanggaran ?>" placeholder="Nama Pelanggaran" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Poin Pelanggaran</label>
                                <input class="form-control" type="number" name="poin_pengurang" value="<?= $value->poin_pengurang ?>" placeholder="Poin Pelanggaran" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Kategori</label>
                                <select name="kategori" id="" class="form-control">
                                    <option value="<?= $value->kategori ?>"><?= $value->kategori ?></option>
                                    <option value="Pelanggaran Ringan">Pelanggaran Ringan</option>
                                    <option value="Pelanggaran Sedang">Pelanggaran Sedang</option>
                                    <option value="Pelanggaran Berat">Pelanggaran Berat</option>
                                </select>
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