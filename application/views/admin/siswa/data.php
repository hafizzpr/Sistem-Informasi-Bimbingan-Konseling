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
                <h3 class="card-title"></h3>
                    <form method="post" action="<?= base_url('admin/import_excel_siswa') ?>" enctype="multipart/form-data">
                        <input type="file" name="file_excel" accept=".xls,.xlsx" required>
                        <button type="submit" class="btn btn-success btn-sm">Upload Excel</button>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add"> Tambah Data </button>
                        <a href="<?= base_url('admin/update_kelas') ?>" class="btn btn-default btn-sm" >Update Kelas</a>
                    </form>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Nis</th>
                    <th class="text-center">No Hp</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Kelas</th>
                    <th class="text-center">Status Akun</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach ($dataSiswa as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $value->nama_lengkap?></td>
                                <td class="text-center"><?= $value->nis?></td>
                                <td class="text-center"><?= $value->no_siswa ?></td>
                                <td class="text-center"><?= $value->username ?></td>
                                <td class="text-center"><?= $value->kelas ?></td>
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
                                        onclick="confirmDelete('<?= base_url('admin/delete_user/' .$value->user_id) ?>')" 
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
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TAMBAH <?= $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('admin/add_dataSiswa') ?>         
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" type="text" name="nama_lengkap" placeholder="Nama Lengkap">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input class="form-control" type="text" name="nis" placeholder="NIS">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input class="form-control" type="text" name="nisn" placeholder="NISN">
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NOMOR HP</label>
                                    <input class="form-control" type="text" name="no_siswa" placeholder="NOmor HP">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select name="kelas" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="">-- Pilih --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir" placeholder="Tempat Lahir">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" type="date" name="tanggal_lahir" placeholder="Tanggal Lahir">
                                 </div>
                            </div>
                        </div>    
                        
                        <div class="row">
                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>NIK</label>
                                    <input class="form-control" type="text" name="nik" placeholder="NIK">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input class="form-control" type="text" name="nama_ibu" placeholder="Nama Ibu">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Agama</label>
                                    <input class="form-control" type="text" name="agama" placeholder="Agama">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>RT</label>
                                    <input class="form-control" type="text" name="rt" placeholder="RT">
                                 </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>RW</label>
                                    <input class="form-control" type="text" name="rw" placeholder="RW">
                                 </div>
                            </div>

                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input class="form-control" type="text" name="kelurahan" placeholder="Kelurahan">
                                 </div>
                            </div>

                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input class="form-control" type="text" name="kecamatan" placeholder="Kecamatan">
                                 </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" rows="2" placeholder="Alamat lengkap" required></textarea>
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
        <?php foreach ($dataSiswa as $key => $value) { ?>
            <div class="modal fade" id="edit<?= $value->user_id ?>">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Siswa</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <?php echo form_open('admin/update_dataSiswa') ?>
                    <div class="modal-body">
                        <input type="hidden" name="user_id" value="<?= $value->user_id ?>">
                        <input type="hidden" name="siswa_id" value="<?= $value->siswa_id ?>">

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" type="text" name="nama_lengkap" value="<?= $value->nama_lengkap ?>">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input class="form-control" type="text" name="nis" value="<?= $value->nis ?>">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input class="form-control" type="text" name="nisn" value="<?= $value->nisn ?>">
                                </div>
                            </div>
                            
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NOMOR HP</label>
                                    <input class="form-control" type="text" name="no_siswa" value="<?= $value->no_siswa ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select name="kelas" class="form-control">
                                        <option value="X" <?= $value->kelas == 'X' ? 'selected' : '' ?>>X</option>
                                        <option value="XI" <?= $value->kelas == 'XI' ? 'selected' : '' ?>>XI</option>
                                        <option value="XII" <?= $value->kelas == 'XII' ? 'selected' : '' ?>>XII</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="L" <?= $value->jenis_kelamin == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="P" <?= $value->jenis_kelamin == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir" value="<?= $value->tempat_lahir ?>">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input class="form-control" type="date" name="tanggal_lahir" value="<?= $value->tanggal_lahir ?>">
                                 </div>
                            </div>
                        </div>    
                        
                        <div class="row">
                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>NIK</label>
                                    <input class="form-control" type="text" name="nik" value="<?= $value->nik ?>">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input class="form-control" type="text" name="nama_ibu" value="<?= $value->nama_ibu ?>">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Agama</label>
                                    <input class="form-control" type="text" name="agama" value="<?= $value->agama ?>">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>RT</label>
                                    <input class="form-control" type="text" name="rt" value="<?= $value->rt ?>">
                                 </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>RW</label>
                                    <input class="form-control" type="text" name="rw" value="<?= $value->rw ?>">
                                 </div>
                            </div>

                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input class="form-control" type="text" name="kelurahan" value="<?= $value->kelurahan ?>">
                                 </div>
                            </div>

                            <div class="col-lg-4">
                                 <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input class="form-control" type="text" name="kecamatan" value="<?= $value->kecamatan ?>">
                                 </div>
                            </div>
                        </div>

                        <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control"><?= $value->alamat ?></textarea>
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
        <?php foreach ($dataSiswa as $key => $value) { ?>
            <div class="modal fade" id="view<?= $value->user_id ?>">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">View Data Siswa</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control" type="text" name="nama_lengkap" value="<?= $value->nama_lengkap ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input class="form-control" type="text" name="nis" value="<?= $value->nis ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input class="form-control" type="text" name="nisn" value="<?= $value->nisn ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>NOMOR HP</label>
                                    <input class="form-control" type="text" name="no_siswa" value="<?= $value->no_siswa ?>" readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input class="form-control" type="text" name="kelas" value="<?= $value->kelas ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <input class="form-control" type="text" name="jenis_kelamin" value="<?php if ($value->jenis_kelamin == 'L') {
                                                                                                            echo 'Laki-Laki';
                                                                                                        } elseif ($value->jenis_kelamin == 'P') {
                                                                                                            echo 'Perempuan';
                                                                                                        } ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Tempat, Tanggal Lahir</label>
                                    <input class="form-control" type="text" name="tempat_lahir" value="<?= $value->tempat_lahir ?> / <?= $value->tanggal_lahir ?>" readonly="readonly">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>NIK</label>
                                    <input class="form-control" type="text" value="<?= $value->nik ?>" readonly="readonly">
                                 </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Nama Ibu</label>
                                    <input class="form-control" type="text" name="nama_ibu" value="<?= $value->nama_ibu ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>Agama</label>
                                    <input class="form-control" type="text" name="agama" value="<?= $value->agama?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>RT</label>
                                    <input class="form-control" type="text" name="rt" value="<?= $value->rt ?> / <?= $value->tanggal_lahir ?>" readonly="readonly">
                                 </div>
                            </div>

                            <div class="col-lg-3">
                                 <div class="form-group">
                                    <label>RW</label>
                                    <input class="form-control" type="text" value="<?= $value->rw ?>" readonly="readonly">
                                 </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input class="form-control" type="text" name="kelurahan" value="<?= $value->kelurahan ?>" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                 <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input class="form-control" type="text" name="kecamatan" value="<?= $value->kecamatan?>" readonly="readonly">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" readonly="readonly"><?= $value->alamat ?></textarea>
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
        <?php foreach ($dataSiswa as $key => $value) { ?>
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
                        <?php echo form_open_multipart('admin/update_password/' .$value->user_id) ?>         
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