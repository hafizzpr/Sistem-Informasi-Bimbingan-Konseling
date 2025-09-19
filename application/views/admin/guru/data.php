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
                    <th class="text-center">Nama</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Status Akun</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach ($dataGuru as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $value->nama_guru?></td>
                                <td class="text-center"><?= $value->email ?></td>
                                <td class="text-center"><?= $value->username ?></td>
                                <td class="text-center"> <?php if ($value->status_akun == '1') {
                                    echo '<span class="badge badge-success">Aktif</span>';
                                } else {
                                    echo '<span class="badge badge-danger">Tidak Aktif</span>';
                                } ?>  </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#edit<?= $value->user_id ?>" ><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-warning btn btn-sm" data-toggle="modal" data-target="#password<?= $value->user_id ?>" ><i class="fa fa-key"></i></button>
                                    <button type="button" class="btn btn-success btn btn-sm" data-toggle="modal" data-target="#view<?= $value->user_id ?>" ><i class="fa fa-eye"></i></button>
                                    <a href="#" 
                                        onclick="confirmDelete('<?= base_url('admin/delete_guru/' .$value->user_id) ?>')" 
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
                    <?php echo form_open_multipart('admin/add_dataGuru') ?>         
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nama Lengkap</label>
                                <input class="form-control" type="text" name="nama_guru" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>NIP</label>
                                <input class="form-control" type="text" name="nip" placeholder="NIP" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nomor Telepon</label>
                                <input class="form-control" type="text" name="no_telepon" placeholder="Nomor Telepon" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status Guru</label>
                                <select name="status_guru" id="" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    <option value="bk">BK</option>
                                    <option value="biasa">Biasa</option>
                                </select>
                            </div>
                        </div>

                        <hr>
                        <h6>Akun Login</h6>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password" placeholder="Password" required>
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
        <?php foreach ($dataGuru as $key => $value) { ?>
            <div class="modal fade" id="edit<?= $value->user_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Gur</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <?php echo form_open('admin/update_dataGuru') ?>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="<?= $value->user_id ?>">
                        <input type="hidden" name="guru_id" value="<?= $value->guru_id ?>">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" type="text" name="nama_guru" value="<?= $value->nama_guru ?>">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input class="form-control" type="text" name="nip" value="<?= $value->nip ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nomor Telepon</label>
                                <input class="form-control" type="text" name="no_telepon" value="<?= $value->no_telepon ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status Guru</label>
                                <select name="status_guru" id="" class="form-control">
                                    <option value="<?= $value->status_guru ?>"><?= $value->status_guru ?></option>
                                    <option value="bk">BK</option>
                                    <option value="biasa">Biasa</option>
                                </select>
                            </div>
                        </div>
                        
                        <hr>
                        <h6>Akun Login</h6>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $value->email ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" placeholder="Username" value="<?= $value->username ?>">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status Akun</label>
                                    <select name="status_akun" class="form-control">
                                        <option value="1" <?= $value->status_akun == '1' ? 'selected' : '' ?>>Aktif</option>
                                        <option value="2" <?= $value->status_akun == '2' ? 'selected' : '' ?>>Tidak Aktif</option>
                                    </select>
                                </div>
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

    <!-- view -->
        <?php foreach ($dataGuru as $key => $value) { ?>
            <div class="modal fade" id="view<?= $value->user_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">View Data Guru</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" type="text" name="nama_guru" value="<?= $value->nama_guru ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>NIP</label>
                                    <input class="form-control" type="text" name="nip" value="<?= $value->nip ?>" readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nomor Telepon</label>
                                <input class="form-control" type="text" name="no_telepon" value="<?= $value->no_telepon ?>" readonly="readonly">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Status Guru</label>
                                <input class="form-control" type="text" name="status_guru" value="<?= $value->status_guru ?>" readonly="readonly">
                            </div>
                        </div>

                        <hr>
                        <h6>Akun Login</h6>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="Email" value="<?= $value->email ?>" readonly="readonly">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Username</label>
                                <input class="form-control" type="text" name="username" placeholder="Username" value="<?= $value->username ?>" readonly="readonly">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <!-- end -->

    <!-- password -->
        <?php foreach ($dataGuru as $key => $value) { ?>
            <div class="modal fade" id="password<?= $value->user_id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">EDIT PASSWORD<?= $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open_multipart('admin/update_pass/' .$value->user_id) ?>         
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" type="text" name="username" value="<?= $value->username ?>" placeholder="Username" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>

                            </div>
                                <div class="modal-footer">
                                <button type="close" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        <?php echo form_close() ?>
                    </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <!-- end -->