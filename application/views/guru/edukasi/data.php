<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>EDUKASI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('guru') ?>">HOME</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('guru/edukasi') ?>">EDUKASI</a></li>
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
                 <button type="button" class="btn btn-default" data-toggle="modal" data-target="#add"> Tambah Data </button>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center" width="15px">No</th>
                      <th class="text-center">Judul</th>
                      <th class="text-center">File</th>
                      <th class="text-center" width="50px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($edukasi as $key => $value) { ?>
                      <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td class="text-center"><?= $value->judul ?></td>
                        <td class="text-center">
                          <?php if ($value->jenis == "foto") : ?>
                              <?php 
                                $ext = pathinfo($value->file_edukasi, PATHINFO_EXTENSION); 
                                if (in_array(strtolower($ext), ['jpg','jpeg','png'])) { 
                              ?>
                                <a href="<?= base_url('assets/image/file_edukasi/'.$value->file_edukasi) ?>" target="_blank">
                                  <img src="<?= base_url('assets/image/file_edukasi/'.$value->file_edukasi) ?>" width="100px">
                                </a>
                              <?php } elseif ($ext == 'pdf') { ?>
                                <a href="<?= base_url('assets/image/file_edukasi/'.$value->file_edukasi) ?>" target="_blank">
                                  <i class="fas fa-file-pdf fa-2x text-danger"></i> Lihat PDF
                                </a>
                              <?php } ?>

                          <?php elseif ($value->jenis == "vidio") : ?>
                              <?php 
                                $embed_link = "";
                                if (strpos($value->link, 'watch?v=') !== false) {
                                    $youtube_id = explode("v=", $value->link)[1];
                                    $youtube_id = explode("&", $youtube_id)[0];
                                    $embed_link = "https://www.youtube.com/embed/".$youtube_id;
                                } elseif (strpos($value->link, 'youtu.be') !== false) {
                                    $youtube_id = explode("/", $value->link)[3];
                                    $embed_link = "https://www.youtube.com/embed/".$youtube_id;
                                } else {
                                    $embed_link = $value->link;
                                }
                              ?>
                              <iframe width="300" height="200" src="<?= $embed_link ?>" frameborder="0" allowfullscreen></iframe>

                          <?php elseif ($value->jenis == "link") : ?>
                              <a href="<?= $value->link ?>" target="_blank" class="btn btn-info btn-sm">
                                <i class="fa fa-link"></i> Kunjungi Link
                              </a>
                          <?php endif; ?>
                        </td>
                        <td class="text-center">
                          <button type="button" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#edit<?= $value->edukasi_id ?>" ><i class="fa fa-edit"></i></button>
                          <a href="#" onclick="confirmDelete('<?= base_url('guru/hapus_edukasi/'.$value->edukasi_id) ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                    <?php echo form_open_multipart('guru/add_edukasi') ?>         
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Judul</label>
                                <input class="form-control" type="text" name="judul" placeholder="Judul" required>
                            </div>
                        </div>

                       <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Jenis File</label>
                            <select name="jenis" id="jenis" class="form-control">
                              <option value="">-- Pilih --</option>
                              <option value="vidio">Video Edukasi</option>
                              <option value="foto">Browser</option>
                              <option value="link">Link Edukasi</option>
                            </select>
                          </div>
                        </div>

                        <!-- Input Link -->
                        <div class="col-lg-6" id="form-link" style="display:none;">
                          <div class="form-group">
                            <label>Link</label>
                            <input type="text" class="form-control" name="link">
                          </div>
                        </div>

                        <!-- Input File -->
                        <div class="col-lg-6" id="form-file" style="display:none;">
                          <div class="form-group">
                            <label>File</label>
                            <div class="custom-file">
                              <input type="file" name="file_edukasi" class="custom-file-input" id="inputGroupFile04">
                              <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                            </div>
                          </div>
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

    <!-- Edit -->
     <?php foreach ($edukasi as $key => $value) { ?>
        <div class="modal fade" id="edit<?= $value->edukasi_id ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">EDIT <?= $title ?></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <?php echo form_open_multipart('guru/edit_edukasi/'.$value->edukasi_id) ?>         
                      <div class="form-row">
                          <div class="form-group col-md-12">
                              <label>Judul</label>
                              <input class="form-control" type="text" name="judul" value="<?= $value->judul ?>" required>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label>Jenis File</label>
                            <select name="jenis" id="jenis_edit<?= $value->edukasi_id ?>" class="form-control">
                              <option value="">-- Pilih --</option>
                              <option value="vidio" <?= $value->jenis=="vidio" ? "selected" : "" ?>>Video Edukasi</option>
                              <option value="foto" <?= $value->jenis=="foto" ? "selected" : "" ?>>Browser</option>
                              <option value="link" <?= $value->jenis=="link" ? "selected" : "" ?>>Link Edukasi</option>
                            </select>
                          </div>
                        </div>

                        <!-- Input Link -->
                        <div class="col-lg-4" id="form-link-edit<?= $value->edukasi_id ?>" style="display: <?= $value->jenis=="vidio" ? "block" : "none" ?>;">
                          <div class="form-group">
                            <label>Link</label>
                            <input type="text" class="form-control" name="link" value="<?= $value->link ?>">
                          </div>
                        </div>

                        <!-- Input File -->
                        <div class="col-lg-4" id="form-file-edit<?= $value->edukasi_id ?>" style="display: <?= $value->jenis=="foto" ? "block" : "none" ?>;">
                          <div class="form-group">
                            <label>File (biarkan kosong jika tidak diganti)</label>
                            <div class="custom-file">
                              <input type="file" name="file_edukasi" class="custom-file-input" id="inputGroupFile04<?= $value->edukasi_id ?>">
                              <label class="custom-file-label" for="inputGroupFile04<?= $value->edukasi_id ?>">Choose file</label>
                            </div>
                            <?php if($value->file_edukasi): ?>
                              <small class="text-muted">File saat ini: <?= $value->file_edukasi ?></small>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Update</button>
              </div>
              <?php echo form_close() ?>
            </div>
          </div>
        </div>
    <?php } ?>
    <!-- End -->


    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const jenisSelect = document.getElementById("jenis");
        const formLink = document.getElementById("form-link");
        const formFile = document.getElementById("form-file");

        jenisSelect.addEventListener("change", function () {
          if (this.value === "vidio" || this.value === "link") {
            formLink.style.display = "block";
            formFile.style.display = "none";
          } else if (this.value === "foto") {
            formFile.style.display = "block";
            formLink.style.display = "none";
          } else {
            formLink.style.display = "none";
            formFile.style.display = "none";
          }
        });
      });
    </script>

    <script>
      $(document).ready(function(){
        // untuk form edit (setiap modal punya ID berbeda)
        <?php foreach($edukasi as $val){ ?>
          $('#jenis_edit<?= $val->edukasi_id ?>').on('change', function(){
              if ($(this).val() === 'vidio' || $(this).val() === 'link') {
                  $('#form-link-edit<?= $val->edukasi_id ?>').show();
                  $('#form-file-edit<?= $val->edukasi_id ?>').hide();
              } else if ($(this).val() === 'foto') {
                  $('#form-link-edit<?= $val->edukasi_id ?>').hide();
                  $('#form-file-edit<?= $val->edukasi_id ?>').show();
              } else {
                  $('#form-link-edit<?= $val->edukasi_id ?>').hide();
                  $('#form-file-edit<?= $val->edukasi_id ?>').hide();
              }
          });
        <?php } ?>
      });
    </script>
