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
              <div class="card-header"></div>
              <div class="card-body">

                <form method="get" action="<?php echo base_url('admin/cekPelanggaranSiswa') ?>">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <h6>Filter Tanggal</h6>
                                <div class="input-group">
                                    <input type="date" name="tgl_awal" data="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal" placeholder="Tanggal Awal" autocomplete="off">
                                    <span class="btn btn-default">s/d</span>
                                    <input type="date" name="tgl_akhir" data="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir" placeholder="Tanggal Akhir" autocomplete="off"> &nbsp; &nbsp;
                                    <button type="submit" name="filter" data="true" class="btn btn-default">TAMPILKAN</button> &nbsp; &nbsp;
                                    <?php
                                    if(isset($_GET['filter'])) 
                                        echo '<a href="'.base_url('admin/laporanPelanggaranSiswa').'" class="btn btn-danger">RESET</a>';
                                    ?>
                                    </div>
                            </div>
                        </div>
                    </div>
                </form>
                  <hr />
                    <h6 style="margin-bottom: 5px;"><b>Data Pelanggaran Siswa</b></h6>
                    <?php echo $label ?><br />
                    <div style="margin-top: 5px;">
                        <i class="fas fa-file-pdf">&nbsp;</i><a href="<?php echo $url_cetak_PelanggaranSiswa ?>" target="_blank"><b>CETAK PDF</b></a>
                    </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama Siswa</th>
                    <th class="text-center">Tanggal</th>
                    <th class="text-center">Jenis Pelanggaran</th>
                    <th class="text-center">Poin</th>
                    <th class="text-center">Kategori</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                      $no = 1;

                      if (empty($PelanggaranSiswa)) {
                          echo "<tr><td colspan='8' class='text-center'>Data tidak ada</td></tr>";
                      } else {
                          // 1. Kelompokkan data berdasarkan nama siswa
                          $groupedData = [];
                          foreach ($PelanggaranSiswa as $row) {
                              $nama = $row->nama_lengkap;
                              if (!isset($groupedData[$nama])) {
                                  $groupedData[$nama] = [
                                      'poin_total' => 0,
                                      'items' => []
                                  ];
                              }
                              $groupedData[$nama]['items'][] = $row;
                              $groupedData[$nama]['poin_total'] += $row->poin_pengurang;
                          }

                          // 2. Tampilkan data yang sudah dikelompokkan
                          foreach ($groupedData as $nama => $data) {
                              $rowspan = count($data['items']);
                              foreach ($data['items'] as $i => $val) {
                                  $tanggal = date('d-m-Y', strtotime($val->tanggal));
                                  echo "<tr>";
                                  if ($i == 0) {
                                      echo "<td class='text-center' rowspan='{$rowspan}'>" . $no++ . "</td>";
                                      echo "<td class='text-center' rowspan='{$rowspan}'>{$val->nama_lengkap}</td>";
                                  }
                                  echo "<td class='text-center'>{$tanggal}</td>";
                                  echo "<td class='text-center'>{$val->nama_pelanggaran}</td>";
                                  echo "<td class='text-center'>{$val->poin_pengurang}</td>";
                                  echo "<td class='text-center'>{$val->kategori}</td>";
                                  echo "</tr>";
                              }
                              // Baris total poin setelah semua pelanggaran siswa
                              echo "<tr>";
                              echo "<td colspan='3' class='text-right'><strong>Total Poin:</strong></td>";
                              echo "<td colspan='3'><strong>{$data['poin_total']}</strong></td>";
                              echo "</tr>";
                          }
                      }
                      ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>