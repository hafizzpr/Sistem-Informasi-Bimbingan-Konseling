<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 10px;
            border-bottom: 2px solid black;
        }

        .header-container img {
            width: 80px; /* Sesuaikan ukuran logo */
            margin-right: 15px;
        }

        .header-container .header-text {
            text-align: center;
        }

        .header-container .header-text h4 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
        }

        .header-container .header-text h6 {
            margin: 0;
            font-size: 10pt;
        }

        .table-container {
            width: 100%;
            margin-top: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid;
            font-size: 10pt;
            padding: 5px;
            text-align: left;
        }

        .table-container th {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .mt-2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header-container">
        <div class="header-text">
            <img src="<?= base_url() ?>assets/image/kop_pas.png" width="100%" alt="Logo">
        </div>
    </div>

    <h5 class="text-center mt-2" style="font-size: 12pt;">DATA PELANGGARAN SISWA</h5>
    <p><?= $label ?></p>

    <!-- Table Section -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal</th>
                    <th>Jenis Pelanggaran</th>
                    <th>Poin</th>
                    <th>Kategori</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $dataGrouped = [];

                // Group data dan hitung total poin per siswa
                foreach ($PelanggaranSiswa as $item) {
                    $nama = $item->nama_lengkap;
                    if (!isset($dataGrouped[$nama])) {
                        $dataGrouped[$nama] = [
                            'siswa' => $item,
                            'pelanggaran' => [],
                            'total_poin' => 0
                        ];
                    }
                    $dataGrouped[$nama]['pelanggaran'][] = $item;
                    $dataGrouped[$nama]['total_poin'] += $item->poin_pengurang;
                }

                if (empty($dataGrouped)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ada</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($dataGrouped as $nama => $group): ?>
                        <?php foreach ($group['pelanggaran'] as $index => $val): ?>
                            <tr>
                                <?php if ($index == 0): ?>
                                    <td class="text-center" rowspan="<?= count($group['pelanggaran']) ?>"><?= $no++ ?></td>
                                    <td class="text-center" rowspan="<?= count($group['pelanggaran']) ?>"><?= $val->nama_lengkap ?></td>
                                <?php endif; ?>
                                <td class="text-center"><?= $val->tanggal ?></td>
                                <td class="text-center"><?= $val->nama_pelanggaran ?></td>
                                <td class="text-center"><?= $val->poin_pengurang ?></td>
                                <td class="text-center"><?= $val->kategori ?></td>
                                <td class="text-center"><?= $val->nama_semester ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Poin untuk <?= $nama ?>:</strong></td>
                            <td colspan="3" class="text-left"><strong><?= $group['total_poin'] ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
