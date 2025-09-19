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
            <img src="<?= base_url() ?>assets/image/kop2.png" width="100%" alt="Logo">
        </div>
    </div>

    <h5 class="text-center mt-2" style="font-size: 12pt;">DATA PENGAJUAN KONSELING</h5>
    <p><?= $label ?></p>

    <!-- Table Section -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th >Nama Siswa</th>
                    <th >Tanggal Pengajuan</th>
                    <th >Alasan</th>
                    <th >Status</th>
                    <th >Tanggal</th>
                    <th >Catatan</th>
                  </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                if (empty($PengajuanKonseling)) {
                    echo "<tr><td colspan='7' class='text-center'>Data tidak ada</td></tr>";
                } else {
                    // Kelompokkan berdasarkan nama siswa
                    $grouped = [];
                    foreach ($PengajuanKonseling as $item) {
                        $grouped[$item->nama_lengkap][] = $item;
                    }

                    // Tampilkan per siswa
                    foreach ($grouped as $nama => $list) {
                        $rowspan = count($list);
                        foreach ($list as $i => $val) {
                            echo "<tr>";
                            if ($i == 0) {
                                echo "<td class='text-center' rowspan='{$rowspan}'>" . $no++ . "</td>";
                                echo "<td class='text-center' rowspan='{$rowspan}'>{$nama}</td>";
                            }
                            echo "<td class='text-center'>" . date('d-m-Y', strtotime($val->tanggal_pengajuan)) . "</td>";
                            echo "<td class='text-center'>{$val->alasan}</td>";
                            echo "<td class='text-center'>{$val->status}</td>";
                            echo "<td class='text-center'>{$val->tanggal_setuju}</td>";
                            echo "<td class='text-center'>{$val->catatan}</td>";
                            echo "</tr>";
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
