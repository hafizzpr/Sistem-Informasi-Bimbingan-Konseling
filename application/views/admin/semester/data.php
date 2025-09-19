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
                    <th class="text-center">Semester</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach ($dataSemester as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= $value->nama_semester?></td>
                                <td class="text-center">
                                    <?php if ($value->status == 1): ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Non Aktif</span><br>
                                        <a href="<?= base_url('admin/aktifkanSemester/' . $value->semester_id) ?>"
                                          onclick="return confirm('Yakin ingin mengaktifkan semester ini?')"
                                          class="btn btn-success btn-sm mt-1">
                                            Aktifkan
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#edit<?= $value->semester_id ?>" ><i class="fa fa-edit"></i></button>
                                    <a href="#" 
                                        onclick="confirmDelete('<?= base_url('admin/hapusdataSemester/' .$value->semester_id) ?>')" 
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
                    <?php echo form_open_multipart('admin/add_dataSemester') ?> 
                    <div class="form-group">
                        <label>Semester</label>
                        <input class="form-control" type="text" name="nama_semester" placeholder="Semester" required>
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
        <?php foreach ($dataSemester as $key => $value) { ?>
            <div class="modal fade" id="edit<?= $value->semester_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Semester</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <?php echo form_open('admin/updatedataSemester/' .$value->semester_id) ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Semester</label>
                            <input class="form-control" type="text" name="nama_semester" value="<?= $value->nama_semester ?>" placeholder="Semester" required>
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