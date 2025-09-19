<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PELANGGARAN SISWA</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('guru') ?>">HOME</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('guru/pelanggaranSiswa') ?>">PELANGGARAN SISWA</a></li>
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
            <?php $status_guru = $this->session->userdata('status_guru'); ?>
            <div class="card">
              <div class="card-header">
                <?php if ($status_guru == 'bk') { ?>
                    <h3 class="card-title"><h3 class="card-title"></h3><button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"> Tambah Data </button> </h3>
                <?php } else {
                    
                }?>
            </div>
              <div class="card-body">
                <h5> Siswa : <b><?= $detailSiswa->nama_lengkap ?></b> <br> 
                      Total Poin : <b><?= $totalPoin ?></b>
                     
                  <?php
$selisih = 1000 - $totalPoin;

// Fungsi membuat link PDF berdasarkan jenis SP dan ID siswa
function generatePdfUrl($peringatan, $siswa_id, $base_url) {
    return $base_url . 'guru/print' . $peringatan . '/' . $siswa_id;
}

// Fungsi membuat pesan WhatsApp otomatis
function generateMessage($nama_lengkap, $peringatan, $siswa_id, $base_url) {
    $pdfUrl = generatePdfUrl($peringatan, $siswa_id, $base_url);
    $message = "Halo, ini pemberitahuan untuk siswa bernama *$nama_lengkap*. ";
    $message .= "Mendapatkan peringatan *$peringatan* berdasarkan akumulasi poin pelanggaran.\n\n";
    $message .= "Mohon ditindaklanjuti.";
    return urlencode($message);
}
?>

<?php if ($selisih >= 600): ?>
  <p>(Aman)</p>

<?php elseif ($selisih >= 450): ?>
  <p>(SP1)</p>
    <?php if ($status_guru == 'bk') { ?>
        <a href="<?= base_url('guru/printSp1/' . $detailSiswa->siswa_id) ?>" class="btn btn-warning btn-sm" target="_blank">Print SP1</a>
        <a href="https://wa.me/<?= $detailSiswa->no_ortu ?>?text=<?= generateMessage($detailSiswa->nama_lengkap, 'Sp1', $detailSiswa->siswa_id, base_url()) ?>" class="btn btn-success btn-sm" target="_blank">Kirim WA</a>
    <?php } else {
        
    } ?>

<?php elseif ($selisih >= 350): ?>
  <p>(SP2)</p>
    <?php if ($status_guru == 'bk') { ?>
        <a href="<?= base_url('guru/printSp2/' . $detailSiswa->siswa_id) ?>" class="btn btn-warning btn-sm" target="_blank">Print SP2</a>
        <a href="https://wa.me/<?= $detailSiswa->no_ortu ?>?text=<?= generateMessage($detailSiswa->nama_lengkap, 'Sp2', $detailSiswa->siswa_id, base_url()) ?>" class="btn btn-success btn-sm" target="_blank">Kirim WA</a>
    <?php } else {
        
    } ?>

<?php else: ?>
  <p>(SP3)</p>
    <?php if ($status_guru == 'bk') { ?>
        <a href="<?= base_url('guru/printSp3/' . $detailSiswa->siswa_id) ?>" class="btn btn-danger btn-sm" target="_blank">Print SP3</a>
        <a href="https://wa.me/<?= $detailSiswa->no_ortu ?>?text=<?= generateMessage($detailSiswa->nama_lengkap, 'Sp3', $detailSiswa->siswa_id, base_url()) ?>" class="btn btn-success btn-sm" target="_blank">Kirim WA</a>
    <?php } else {
        
    } ?>

  <?php endif; ?>

                </h5>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Jenis Pelanggaran</th>
                    <th class="text-center">Poin</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Lokasi</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($pelanggaran) && is_array($pelanggaran)) { ?>
                      <?php 
                          $current_semester = null; 
                          $no = 1; 
                          $semester_group = [];

                          // Kelompokkan berdasarkan semester
                          foreach ($pelanggaran as $value) {
                              $semester_group[$value->nama_semester][] = $value;
                          }

                          // Tampilkan per semester
                          foreach ($semester_group as $nama_semester => $items) {
                              // Hitung total poin
                              $total_poin = 0;
                              foreach ($items as $item) {
                                  $total_poin += $item->poin_pengurang;
                              }
                      ?>
                          <!-- Header Semester -->
                          <tr>
                              <td colspan="8" style="background:#f0f0f0; font-weight:bold;">
                                  <?= $nama_semester ?> | Total Poin Pelanggaran: <b><?= $total_poin ?> poin</b>
                              </td>
                          </tr>

                          <?php $no = 1; foreach ($items as $value) { ?>
                              <tr>
                                  <td><?= $no++ ?></td>
                                  <td class="text-center"><?= $value->nama_pelanggaran ?></td>
                                  <td class="text-center"><?= $value->poin_pengurang ?></td>
                                  <td class="text-center"><?= $value->kategori ?></td>
                                  <td class="text-center"><?= $value->lokasi ?></td>
                                  <td class="text-center"><?= $value->tanggal ?></td>
                                  <td class="text-center">
                                      <?php
                                        $create_at = new DateTime($value->create_at);
                                        $now = new DateTime();
                                        $interval = $create_at->diff($now)->days;

                                        if ($interval <= 7) {
                                        ?>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit<?= $value->pelanggaran_id ?>">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        <?php
                                        } else {
                                        ?>
                                            <button type="button" class="btn btn-secondary btn-sm" disabled>
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        <?php
                                        }
                                      ?>

                                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#view<?= $value->pelanggaran_id ?>"><i class="fa fa-eye"></i></button>
                                      <a href="#" onclick="confirmDelete('<?= base_url('admin/hapuspelanggaranSiswa/' . $value->pelanggaran_id . '/' . $detailSiswa->siswa_id) ?>')" class="btn btn-sm btn-danger">
                                          <i class="fa fa-trash"></i>
                                      </a>
                                  </td>
                              </tr>
                          <?php } ?>
                      <?php } ?>
                  <?php } else { ?>
                      <tr>
                          <td colspan="8" class="text-center text-danger">
                              Tidak ada data pelanggaran untuk ditampilkan.
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
                  <?php echo form_open_multipart('guru/add_pelanggaranSiswa/' .$detailSiswa->siswa_id) ?>         
                      <div class="form-row">
                          <div class="form-group col-md-5">
                              <label>Nama Lengkap</label>
                              <input class="form-control" type="text" value="<?= $detailSiswa->nama_lengkap ?>" readonly="readonly">
                          </div>
                          <div class="form-group col-md-5">
                              <label>NISN</label>
                              <input class="form-control" type="text" value="<?= $detailSiswa->nisn ?>" readonly="readonly">
                          </div>
                          <div class="form-group col-md-2">
                              <label>Kelas</label>
                              <input class="form-control" type="text" value="<?= $detailSiswa->kelas ?>" readonly="readonly">
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-12">
                              <label>Jenis Pelanggaran</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="jenis_id">
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

    <!-- Edit -->
     <?php $no=1; foreach ($pelanggaran as $key => $value) { ?>
      <div class="modal fade" id="edit<?= $value->pelanggaran_id ?>">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">EDIT DATA</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <?php echo form_open_multipart('guru/update_pelanggaranSiswa/' .$value->pelanggaran_id . '/' .$value->siswa_id) ?>         
                      <div class="form-row">
                          <div class="form-group col-md-5">
                              <label>Nama Lengkap</label>
                              <input class="form-control" type="text" value="<?= $detailSiswa->nama_lengkap ?>" readonly="readonly">
                          </div>
                          <div class="form-group col-md-5">
                              <label>NISN</label>
                              <input class="form-control" type="text" value="<?= $detailSiswa->nisn ?>" readonly="readonly">
                          </div>
                          <div class="form-group col-md-2">
                              <label>Kelas</label>
                              <input class="form-control" type="text" value="<?= $detailSiswa->kelas ?>" readonly="readonly">
                          </div>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-6">
                              <label>Tanggal Kejadian</label>
                              <input class="form-control" type="date" name="tanggal" value="<?= $value->tanggal ?>" placeholder="Tanggal Kejadian" require>
                          </div>
                          <div class="form-group col-md-6">
                              <label>Lokasi Kejadian</label>
                              <input class="form-control" type="text" name="lokasi" value="<?= $value->lokasi ?>" placeholder="Lokasi Kejadian" require>
                          </div>
                      </div>

                      <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea id="summernote2" class="form-control" name="deskripsi" rows="2" required><?= $value->deskripsi ?></textarea>
                      </div>

                      <div class="form-row">
                          <div class="form-group col-md-12">
                              <label>Jenis Pelanggaran</label>
                                <select class="form-control" style="width: 100%;" name="jenis_id">
                                    <option value="<?= $value->jenis_id ?>"><?= $value->nama_pelanggaran ?> == (<?= $value->poin_pengurang ?> Poin) == <?= $value->kategori ?></option>
                                    <?php foreach ($dataPelanggaran as $key => $value) { ?>
                                    <option value="<?= $value->jenis_id ?>"><?= $value->nama_pelanggaran ?> == (<?= $value->poin_pengurang ?> Poin) == <?= $value->kategori ?></option>
                                    <?php } ?>
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
      <?php } ?>
    <!-- end -->

    <!-- view -->
     <?php $no=1; foreach ($pelanggaran as $key => $value) { ?>
      <div class="modal fade" id="view<?= $value->pelanggaran_id ?>">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">VIEW DATA</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">  
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Nama Siswa</th>
                        <td>:</td>
                        <td><?= $detailSiswa->nama_lengkap ?></td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>:</td>
                        <td><?= $detailSiswa->nisn ?></td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>:</td>
                        <td><?= $detailSiswa->kelas ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Kejadian</th>
                        <td>:</td>
                        <td><?= $value->tanggal ?></td>
                    </tr>
                    <tr>
                        <th>Lokasi Kejadian</th>
                        <td>:</td>
                        <td><?= $value->lokasi ?></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>:</td>
                        <td><?= $value->deskripsi ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pelanggaran</th>
                        <td>:</td>
                        <td><?= $value->nama_pelanggaran ?></td>
                    </tr>
                    <tr>
                        <th>Poin</th>
                        <td>:</td>
                        <td><?= $value->poin_pengurang ?></td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>:</td>
                        <td><?= $value->kategori ?></td>
                    </tr>
                </table>
              </div>
              </div>
          </div>
      </div>
      <?php } ?>
    <!-- end -->