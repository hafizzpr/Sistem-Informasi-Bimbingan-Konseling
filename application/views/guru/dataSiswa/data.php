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
                <h3 class="card-title"></h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Nis</th>
                    <th class="text-center">No Hp</th>
                    <th class="text-center">Jenis Kelamin</th>
                    <th class="text-center">Nama Ibu</th>
                  </tr>
                  </thead>
                  <tbody>
                        <?php $no=1; foreach ($dataSiswa as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $value->nama_lengkap?></td>
                                <td class="text-center"><?= $value->nis?></td>
                                <td class="text-center"><?= $value->no_siswa ?></td>
                                <td class="text-center"><?= $value->jenis_kelamin ?></td>
                                <td class="text-center"><?= $value->nama_ibu ?></td>
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