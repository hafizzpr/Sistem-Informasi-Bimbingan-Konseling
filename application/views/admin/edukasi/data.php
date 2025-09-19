<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>EDUKASI</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin') ?>">HOME</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('admin/edukasi') ?>">EDUKASI</a></li>
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
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center" width="15px">No</th>
                      <th class="text-center">Judul</th>
                      <th class="text-center">File</th>
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
